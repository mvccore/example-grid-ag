<?php

namespace App\Controllers;

use \MvcCore\Ext\Controllers\DataGrid\IConstants as GridConsts,
	\MvcCore\Ext\Controllers\DataGrids\AgGrid\IConstants as AgGridConsts,
	\MvcCore\Ext\Controllers\DataGrids\AgGrid,
	\MvcCore\Ext\Controllers\DataGrids\Configs\Column,
	\MvcCore\Ext\Controllers\DataGrids\AgGrids\Configs\Rendering,
	\MvcCore\Ext\Controllers\DataGrids\AgGrids\Configs\IRendering as RenderingConsts;

class Client extends Base {

	use \App\Controllers\TGrid;

	/** @return void */
	public function IndexAction () {
		$this->view->heading = $this->view->title = 'AgGrid Client Table Demo';
		$this->view->grid = self::GetGrid($this);
		
	}

	/** @return AgGrid */
	public static function GetGrid (\App\Controllers\Base $ctrl) {
		if (self::$grid === NULL) {
			self::$grid = (new AgGrid)
				->SetId('clients')
				->SetAppRouteName('Client:Index')
				->SetModel(new \App\Models\Clients\Grid)
				->SetUrlData($ctrl->Url(':GridData', [GridConsts::URL_PARAM_ACTION => AgGridConsts::GRID_ACTION_DATA]))
				->SetFilteringMode(GridConsts::FILTER_ALLOW_DEFAULT)
				->SetConfigColumns([
					(new Column('id_client'))		->SetHeadingName('ID Client')	->SetTypes(['int'])		->SetFilter(TRUE)	->SetSort(TRUE)	->SetCssClasses(['align-right']),
					(new Column('client_name'))		->SetHeadingName('Name')		->SetTypes(['string'])	->SetFilter(TRUE)	->SetSort(TRUE),
					(new Column('client_fullname'))	->SetHeadingName('Full Name')	->SetTypes(['string'])	->SetFilter(TRUE)	->SetSort(TRUE),
					(new Column('client_discount'))	->SetHeadingName('Discount')	->SetTypes(['float'])	->SetFilter(TRUE)	->SetSort(TRUE)	->SetCssClasses(['align-right'])->SetFormatArgs([1]),
					(new Column('client_street'))	->SetHeadingName('Street')		->SetTypes(['string'])	->SetFilter(TRUE)	->SetSort(TRUE),
					(new Column('client_city'))		->SetHeadingName('City')		->SetTypes(['string'])	->SetFilter(TRUE)	->SetSort(TRUE),
					(new Column('client_zip'))		->SetHeadingName('ZIP')			->SetTypes(['string'])	->SetFilter(TRUE)	->SetSort(TRUE),
					(new Column('client_region'))	->SetHeadingName('Region')		->SetTypes(['string'])	->SetFilter(TRUE)	->SetSort(TRUE)	->SetDisabled(TRUE),
					(new Column('client_country'))	->SetHeadingName('Country')		->SetTypes(['string'])	->SetFilter(TRUE)	->SetSort(TRUE)	->SetDisabled(TRUE)
				]);
		}
		return self::$grid;
	}

}
