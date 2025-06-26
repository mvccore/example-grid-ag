<?php

namespace App\Models\Dealers\Grids;

use \MvcCore\Ext\Controllers\DataGrids\Configs\Column as GridColumn,
	\MvcCore\Ext\Controllers\DataGrids\Configs\Type as GridType;

class Row extends \App\Models\Base implements \MvcCore\Ext\Controllers\DataGrids\AgGrids\Models\IGridRow {

	use \MvcCore\Ext\Controllers\DataGrids\AgGrids\Models\TGridRow;

	use \App\Models\Dealer\TProps;

	use \App\Models\Dealers\Grids\Row\TProps;
	
}