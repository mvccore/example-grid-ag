<?php

namespace App\Models\Orders;

class Grid extends \App\Models\Base implements \MvcCore\Ext\Controllers\DataGrids\Models\IGridModel, \MvcCore\Ext\Controllers\DataGrids\Models\IGridColumns {
	
	use \MvcCore\Ext\Controllers\DataGrids\Models\TGridModel;
	use \MvcCore\Ext\Controllers\DataGrids\Models\TGridColumns;

	public function GetConfigColumns () {
		$configColumns = $this->grid->ParseConfigColumns();
		//x($configColumns);
		return $configColumns;
	}
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
				->ToInstances($this->grid->GetRowClass());

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
				t.`id_order`
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
			$sortSql = "ORDER BY t.`id_order` ASC";
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
		$dealerColsArr = self::GetTableColumns($this->db, 'dealer', ['id_dealer']);
		$dealerColsStr = 'd.' . implode(',d.', $dealerColsArr);
		return "
			SELECT
				o.*,
				{$dealerColsStr},
				CONCAT(
					d.dealer_name, 
					IF(d.dealer_surname IS NOT NULL, CONCAT(' ', d.dealer_surname), '')
				) AS dealer_fullname
			FROM `order` o
			LEFT JOIN `dealer` d ON
				o.id_dealer = d.id_dealer
		";
	}

}