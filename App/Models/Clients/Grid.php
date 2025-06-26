<?php

namespace App\Models\Clients;

class		Grid
extends		\App\Models\Base
implements	\MvcCore\Ext\Controllers\DataGrids\Models\IGridModel {

	use \MvcCore\Ext\Controllers\DataGrids\Models\TGridModel;
	
	public function __construct () {
		$this->db = self::GetConnection();
	}
	
	/** @return void */
	protected function load () {
		if ($this->offset === NULL) $this->offset = 0;
		if ($this->limit === NULL) $this->limit = PHP_INT_MAX;

		$baseSql = $this->completeBaseSql();
		list ($sqlConditions, $params) = $this->getConditionSqlAndParams(
			/*includeWhere: */TRUE,
			/*columnsAlias: */'t',
			/*params: */[],
			/*driverName: */$this->db->GetConfig()->driver
		);
		
		$countSql = $this->completeSqlCount(
			$baseSql, $sqlConditions
		);
		$pageDataSql = $this->completeSqlPageData(
			$baseSql, $sqlConditions
		);
		
		try {
			$this->totalCount = $this->db
				->Prepare($countSql)
				->FetchOne($params)
				->ToScalar('total_count', 'int');

			$this->pageData = $this->db
				->Prepare($pageDataSql)
				->FetchAll($params)
				->ToArrays();

		} catch (\Throwable $e) {
			\MvcCore\Debug::Log($e);
			$this->totalCount = 0;
			$this->pageData = [];
		}
	}
	
	/**
	 * @param  string $baseSql 
	 * @param  string $sqlConditions 
	 * @return string
	 */
	protected function completeSqlCount ($baseSql, $sqlConditions) {
		return "
			SELECT COUNT(
				t.`id_client`
			) AS `total_count`
			FROM ({$baseSql}) t
			{$sqlConditions};
		";
	}

	/**
	 * @param  string $baseSql 
	 * @param  string $sqlConditions 
	 * @return string
	 */
	protected function completeSqlPageData ($baseSql, $sqlConditions) {
		if (count($this->sorting) === 0) {
			$sortSql = "ORDER BY t.`id_client` ASC";
		} else {
			$sortSql = $this->getSortingSql(
				/*includeOrderBy: */TRUE,
				/*columnsAlias: */'t',
				/*driverName: */$this->db->GetConfig()->driver
			);
		}
		$limitSql = "LIMIT {$this->limit} OFFSET {$this->offset}";
		return "
			SELECT t.*
			FROM ({$baseSql}) t
			{$sqlConditions}
			{$sortSql}
			{$limitSql};
		";
	}

	/** @return string */
	protected function completeBaseSql () {
		return "
			SELECT c.*
			FROM client c
		";
	}

}