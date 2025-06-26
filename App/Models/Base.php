<?php

namespace App\Models;

use \MvcCore\Ext\Models\Db\Attrs;

/** 
 * @connection my
 */
#[Attrs\Connection('my')]
class Base
//extends \MvcCore\Ext\Models\Db\Models\SQLite
extends \MvcCore\Ext\Models\Db\Models\MySql
//extends \MvcCore\Ext\Models\Db\Models\SqlSrv
//extends \MvcCore\Ext\Models\Db\Models\PgSql
{

	/** @var ?\MvcCore\Ext\ICache */
	private static $_cache = NULL;

	/** @return ?\MvcCore\Ext\ICache */
	public static function GetCache () {
		return self::$_cache ?: (self::$_cache = \MvcCore\Ext\Cache::GetStore());
	}

	/**
	 * @param \MvcCore\Ext\Models\Db\Connections\MySql $connection 
	 * @param  string                                  $tableFullName 
	 * @param  array<string>                           $ignoredColumns 
	 * @return array<string>
	 */
	public static function GetTableColumns (\MvcCore\Ext\Models\Db\Connections\MySql $connection, $tableFullName, $ignoredColumns = []) {
		$connConfig = $connection->GetConfig();
		$connName = $connConfig->name;
		$dbName = $connConfig->database;
		$cacheKey = "tableColumns_{$connName}_{$dbName}.{$tableFullName}";
		if (count($ignoredColumns) > 0)
			$cacheKey .= '_' . hash('crc32b', implode(',', $ignoredColumns));
		return self::GetCache()->Load(
			$cacheKey,
			function (\MvcCore\Ext\ICache $cache, $cacheKey) use ($connection, $dbName, $tableFullName, $ignoredColumns) {
				$ignoredColumnsSqlCond = count($ignoredColumns) > 0
					? " AND c.`COLUMN_NAME` NOT IN ('" . implode("','", $ignoredColumns) . "') "
					: "";
				$result = $connection
					->Prepare([
						"SELECT c.`COLUMN_NAME` AS `name`			",
						"FROM `INFORMATION_SCHEMA`.`COLUMNS` c		",
						"WHERE										",
						"	c.`TABLE_SCHEMA` = '{$dbName}'			",
						"	AND c.`TABLE_NAME` = '{$tableFullName}'	",
						"	{$ignoredColumnsSqlCond}				",
						"ORDER BY c.`ORDINAL_POSITION` ASC;			",
					])
					->FetchAll()
					->ToScalars('name', 'string');
				$cache->Save($cacheKey, $result, NULL, []);
				return $result;
			}
		);
	}
}