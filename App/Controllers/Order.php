<?php

namespace App\Controllers;

use \MvcCore\Ext\Controllers\DataGrid\IConstants as GridConsts,
	\MvcCore\Ext\Controllers\DataGrids\AgGrid\IConstants as AgGridConsts,
	\MvcCore\Ext\Controllers\DataGrids\AgGrid,
	\MvcCore\Ext\Controllers\DataGrids\AgGrids\Configs\IRendering as RenderConsts;

class Order extends Base {
	
	use \App\Controllers\TGrid;

	/** @return void */
	public function IndexAction () {
		$this->view->heading = $this->view->title = 'AgGrid Order Table Demo';
		$this->view->grid = $grid = self::GetGrid($this);
		$grid->SetClientTitleTemplate("{$this->view->title} [<".$grid::URL_PARAM_GRID.">]");
	}
	
	/** @return AgGrid */
	public static function GetGrid (\App\Controllers\Base $ctrl) {
		if (self::$grid === NULL) {
			$model = new \App\Models\Orders\Grid;
			self::$grid = (new AgGrid)
				//->SetCache(FALSE) // to develop columns
				->SetId('orders')
				->SetModel($model)
				->SetRowClass('\App\Models\Orders\Grids\Row')
				->SetAppRouteName('Order:')

				//->SetClientPageMode(AgGridConsts::CLIENT_PAGE_MODE_MULTI)

				->SetClientRequestBlockSize(100)
				->SetClientRowBuffer(50)
				
				->SetDataRequestMethod(AgGridConsts::AJAX_DATA_REQUEST_METHOD_JSONP)
				->SetItemsPerPage(0)
				->SetCountScales([0, 100, 500, 1000, ])

				->SetAllowedCustomUrlCountScale(TRUE)
				->SetSortingMode(
					//GridConsts::SORT_DISABLED
					GridConsts::SORT_MULTIPLE_COLUMNS
				)
				->SetFilteringMode(
					//GridConsts::FILTER_DISABLED
					GridConsts::FILTER_MULTIPLE_COLUMNS |
					GridConsts::FILTER_ALLOW_EQUALS |
					GridConsts::FILTER_ALLOW_RANGES |
					GridConsts::FILTER_ALLOW_LIKE_ANYWHERE
				)
				->SetClientChangeHistory(TRUE)

				->SetAppRouteName('Order:Index')
				->SetUrlData($ctrl->Url(':GridData', [GridConsts::URL_PARAM_ACTION => AgGridConsts::GRID_ACTION_DATA]))
				->SetUrlColumnsChanges($ctrl->Url(':GridColChanges', [GridConsts::URL_PARAM_ACTION => AgGridConsts::GRID_ACTION_COLUMNS_CHANGES]))
				->SetRowSelection(AgGridConsts::ROW_SELECTION_SINGLE | AgGridConsts::ROW_SELECTION_AUTOSELECT_FIRST | AgGridConsts::ROW_SELECTION_NOT_DESELECT)
				->SetConfigRendering(
					(new \MvcCore\Ext\Controllers\DataGrids\AgGrids\Configs\Rendering)
						->SetRenderTableHeadFiltering(TRUE)
						->SetHandlerAssets([$ctrl, 'HandleAssetsInit'])
				);
		}
		return self::$grid;
	}

}
