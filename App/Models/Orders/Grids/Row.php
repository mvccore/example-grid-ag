<?php

namespace App\Models\Orders\Grids;

class Row extends \App\Models\Base implements \MvcCore\Ext\Controllers\DataGrids\AgGrids\Models\IGridRow {

	use \MvcCore\Ext\Controllers\DataGrids\AgGrids\Models\TGridRow;

	use \App\Models\Order\TProps;

	use \App\Models\Dealers\Grids\Row\TProps;

}