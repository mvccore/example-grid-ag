<?php

namespace App;

use \MvcCore\Environment\IConstants as EnvConsts;

class Bootstrap {

	/** @return \MvcCore\Application */
	public static function Init () {
		$app = \MvcCore\Application::GetInstance();
		
		static::patchCoreClasses($app);
		
		static::getCache($app);
		
		$env = $app->GetEnvironment();

		// Uncomment those lines to develop application startup (eg: Bootstrap, Router):
		if ($env->IsDevelopment()) \MvcCore\Ext\Debugs\Tracy::Init();
		
		// PHP 8+ and Attributes anotation:
		if (PHP_VERSION_ID >= 80000) $app->SetAttributesAnotations(TRUE);

		// for new browsers supporting cookie with SameSite=Strict:
		$app->SetCsrfProtection(\MvcCore\Application\IConstants::CSRF_PROTECTION_COOKIE);
		
		static::getSysConfig();

		static::getRouter();
		
		return $app;
	}
	
	/** @return void */
	protected static function patchCoreClasses (\MvcCore\Application $app) {
		// Patch MvcCore with extended classes:
		$app
			->SetDebugClass('\MvcCore\Ext\Debugs\Tracy')
			->SetConfigClass('\MvcCore\Ext\Configs\Cached');
	}
	
	/** @return \MvcCore\Ext\ICache */
	protected static function getCache (\MvcCore\Application $app) {
		$cacheDbName = 'mvccore_example_grid_ag';
		$cache = \MvcCore\Ext\Caches\Redis::GetInstance([
			\MvcCore\Ext\ICache::CONNECTION_PERSISTENCE	=> $cacheDbName,
			\MvcCore\Ext\ICache::CONNECTION_DATABASE	=> $cacheDbName,
			/*\MvcCore\Ext\ICache::PROVIDER_CONFIG		=> [
				'\Redis::OPT_SERIALIZER'				=> '\Redis::SERIALIZER_PHP'
			]*/
		]);
		\MvcCore\Ext\Cache::RegisterStore(
			'\MvcCore\Ext\Caches\Redis', $cache
		);
		$cache->Connect();
		$cache->SetEnabled(FALSE); // tmp disable
		return $cache;
	}
	
	/** @return \MvcCore\Config */
	protected static function getSysConfig () {
		\MvcCore\Ext\Configs\Cached::SetEnvironmentGroups([
			EnvConsts::PRODUCTION 	=> [EnvConsts::GAMMA],
			EnvConsts::GAMMA 		=> [EnvConsts::PRODUCTION],
			EnvConsts::DEVELOPMENT 	=> [
				EnvConsts::PRODUCTION,
				EnvConsts::ALPHA,
				EnvConsts::BETA,
				EnvConsts::GAMMA
			],
		]);
		return \MvcCore\Config::GetConfigSystem();
	}
	
	/** @return void */
	protected static function getRouter () {
		\MvcCore\Router::GetInstance([
			'home'			=> [
				'match'				=> '#^/(index\.php)?$#',
				'reverse'			=> '/',
				'controllerAction'	=> 'Index:Index',
				'defaults'			=> ['order' => 'desc'],
				'constraints'		=> ['order' => 'a-z'],
			],
			'client'			=> [
				'pattern'			=> '/clients/<grid>',
				'controllerAction'	=> 'Client:Index',
				'constraints'		=> ['grid' => '.*'],
			],
			'dealer'			=> [
				'pattern'			=> '/dealers/<grid>',
				'controllerAction'	=> 'Dealer:Index',
				'constraints'		=> ['grid' => '.*'],
			],
			'order'				=> [
				'pattern'			=> '/orders/<grid>',
				'controllerAction'	=> 'Order:Index',
				'constraints'		=> ['grid' => '.*'],
			],
		]);
	}
}


