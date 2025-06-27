<?php

namespace App\Controllers\Grids;

use \MvcCore\Controller\IConstants as CtrlConsts,
    \MvcCore\Ext\Controllers\DataGrid\IConstants as GridConsts,
	\MvcCore\Ext\Controllers\DataGrids\AgGrid\IConstants as AgGridConsts,
    \MvcCore\Ext\Controllers\DataGrids\AgGrids\Configs\Rendering as AgConfigRendering,
    \MvcCore\Ext\Controllers\DataGrids\AgGrids\Configs\IRendering as AgConfigRenderingConsts;

class AgGrid extends \MvcCore\Ext\Controllers\DataGrids\AgGrid {
	
    /**
	 * Create `\MvcCore\Ext\Controllers\DataGrid` instance.
	 * @param  \MvcCore\Controller|NULL $controller
	 * @param  string|int|NULL          $childControllerIndex Automatic name for this instance used in view.
	 * @return void
	 */
	public function __construct ($controller = NULL, $childControllerIndex = NULL) {
		parent::__construct($controller, $childControllerIndex);
        
		// customize grid
		$this
			//->SetClientPageMode(self::CLIENT_PAGE_MODE_MULTI)
			->SetClientRequestBlockSize(100)
			->SetClientRowBuffer(50)
			->SetDataRequestMethod(AgGridConsts::AJAX_DATA_REQUEST_METHOD_JSONP)
			->SetSortingMode(
				//IDataGrid::SORT_DISABLED
				GridConsts::SORT_MULTIPLE_COLUMNS
			)
			->SetFilteringMode(
				//IDataGrid::FILTER_DISABLED
				GridConsts::FILTER_MULTIPLE_COLUMNS |
				GridConsts::FILTER_ALLOW_EQUALS |
				GridConsts::FILTER_ALLOW_RANGES |
				GridConsts::FILTER_ALLOW_LIKE_ANYWHERE
			)
			->SetItemsPerPage(0)
			->SetCountScales([0,100,500,1000])
			->SetClientChangeHistory(TRUE)
			
			->SetAllowedCustomUrlCountScale(TRUE)
            ->SetUrlData($this->parentController->Url(':GridData', [GridConsts::URL_PARAM_ACTION => AgGridConsts::GRID_ACTION_DATA]))
            ->SetUrlColumnsChanges($this->parentController->Url(':GridColChanges', [GridConsts::URL_PARAM_ACTION => AgGridConsts::GRID_ACTION_COLUMNS_CHANGES]))
			->SetRowSelection(AgGridConsts::ROW_SELECTION_SINGLE | AgGridConsts::ROW_SELECTION_AUTOSELECT_FIRST | AgGridConsts::ROW_SELECTION_NOT_DESELECT);
	}

    /** @return void */
    public function Init () {
		if (!$this->DispatchStateCheck(CtrlConsts::DISPATCH_STATE_INITIALIZED))
			return;
		
		if ($this->ajaxDataRequest !== TRUE) {
			// customize layout
			$configRendering = (new AgConfigRendering)
				->SetRenderTableHeadFiltering(TRUE)
				->SetRenderTableHeadSorting(TRUE)
				->SetRenderControlCountScales(GridConsts::CONTROL_DISPLAY_ALWAYS)
				->SetRenderControlRefresh(GridConsts::CONTROL_DISPLAY_ALWAYS)
				->SetRenderControlPaging(GridConsts::CONTROL_DISPLAY_IF_NECESSARY)
				->SetRenderControlStatus(GridConsts::CONTROL_DISPLAY_ALWAYS)
				->SetRenderControlPagingFirstAndLast(TRUE);
		
			if ($this->configRendering !== NULL)
				$configRendering->Merge($this->configRendering);

			$this->SetConfigRendering($configRendering);
		}

		parent::Init();
	}

    /** @return void */
    public function PreDispatch () {
		if (!$this->DispatchStateCheck(CtrlConsts::DISPATCH_STATE_PRE_DISPATCHED))
			return;
		
		parent::PreDispatch();
		
		if (!$this->viewEnabled) return;

		$this->AddCssClasses($this->id);
		
		$filteringTitleDescLines = [
			"Special search characters:",
			";"		=> "semicolon separate multiple values,",
			"%"		=> "search wildcard for zero or more characters (only texts and dates),",
			"_"		=> "search wildcard for any single character (only texts and dates),",
			"!"		=> "exclamation mark at the beginning to search records not equal as value,",
			">"		=> "character at the beginning to search for greater records,",
			"<"		=> "character at the beginning to search for less records,",
			">="	=> "character at the beginning to search for greater than or equal records,",
			"<="	=> "character at the beginning to find less or equal records.",
			"The `null` keyword selects rows that have no value in the column."
		];
		$filteringTitleDescItems = [];
		foreach ($filteringTitleDescLines as $index => $filteringTitleDescLine) {
			if (is_numeric($index)) {
				$filteringTitleDescItems[] = $filteringTitleDescLine;
			} else {
				$spaces = $index === '%'
                    ? 3
                    : (in_array($index, ["!", ";"]) 
                        ? 5 
                        : 6 - (mb_strlen($index) * 2));
				$filteringTitleDescItems[] = $index . str_repeat(' ', 7 + $spaces) . $filteringTitleDescLine;
			}
		}
		$filteringTitleDesc = implode("\n", $filteringTitleDescItems);
		$this->configRendering->SetTableHeadFilteringTitle($filteringTitleDesc);
	}
}
