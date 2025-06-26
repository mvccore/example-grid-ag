<?php

namespace App\Controllers;

class Base extends \MvcCore\Controller {
	
	/** @return void */
	public function Init() {
		parent::Init();
		
		\MvcCore\Ext\Tools\Locale::SetLocale(LC_ALL, 'en_US.UTF-8@Euro');
	}
	
	/** @return void */
	public function PreDispatch () {
		parent::PreDispatch();
		if ($this->viewEnabled) {
			$this->preDispatchSetUpAssetsBase();
			$this->view->title = '';
			$this->view->heading = '';
			
			$this->view->basePath = $this->request->GetBasePath();
			$this->view->currentRouteCssClass = str_replace(
				':', '-', strtolower(
					$this->router->GetCurrentRoute()->GetName()
				)
			);
		}
	}
	
	/** @return void */
	protected function preDispatchSetUpAssetsBase () {
		\MvcCore\Ext\Views\Helpers\Assets::SetGlobalOptions(
			(array) \MvcCore\Config::GetConfigSystem()->assets
		);
		$static = $this->application->GetPathStatic();
		$this->view->Css('fixedHead')
			->Append($static . '/css/components/resets.css')
			->AppendRendered($static . '/css/components/fonts.css')
			->Append($static . '/css/layout.css');
		//$this->view->Js('fixedHead')
		//	->Append($static . '/js/libs/Module.js');
	}

}
