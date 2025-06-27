<?php

namespace App\Controllers;

use \App\Controllers\Grids\AgGrid;

class Order extends Base {
	
	use \App\Controllers\Grids\TGridController;

	/** @return void */
	public function IndexAction () {
		$this->view->heading = $this->view->title = 'AgGrid Order Table Demo';
		$this->view->grid = $grid = self::GetGrid($this);
		$grid->SetClientTitleTemplate("{$this->view->title} [<".$grid::URL_PARAM_GRID.">]");
	}
	
	/** @return AgGrid */
	public static function GetGrid (\App\Controllers\Base $ctrl) {
		return self::$grid ?: (self::$grid = (new AgGrid)
			//->SetCache(FALSE) // to develop columns
			->SetId('orders')
			->SetModel(new \App\Models\Orders\Grid)
			->SetRowClass('\App\Models\Orders\Grids\Row')
			->SetAppRouteName('Order:')
			->SetAppRouteName('Order:Index'));
	}

}
