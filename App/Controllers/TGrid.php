<?php

namespace App\Controllers;

use \MvcCore\Ext\Controllers\DataGrids\AgGrid;

trait TGrid {
	
	/** @var AgGrid */
	protected static $grid;

	/** @var bool */
	protected static $gridAssetsInitialized = FALSE;
	
	public function HandleAssetsInit (array $assetsGroupsCss, array $assetsGroupsJs, \MvcCore\IController $ctrl, AgGrid $grid) {
		if (self::$gridAssetsInitialized) return;
		self::$gridAssetsInitialized = TRUE;
		$view = $ctrl->GetView();
		$cssVarHead = $view->Css('agGrid');
		foreach ($assetsGroupsCss as $assetsGroupCss) {
			if (count($assetsGroupCss->paths) === 0) continue;
			foreach ($assetsGroupCss->paths as $assetsGroupCssPath)
				$cssVarHead->VendorAppend(
					$assetsGroupCssPath,
					$assetsGroupCss->media,
					$assetsGroupCss->notMin
				);
		}
		$jsVarHead = $view->Js('agGrid');
		foreach ($assetsGroupsJs as $assetsGroupJs) {
			if (count($assetsGroupJs->paths) === 0) continue;
			foreach ($assetsGroupJs->paths as $assetsGroupJsPath)
				$jsVarHead->VendorAppend(
					$assetsGroupJsPath,
					$assetsGroupJs->async,
					$assetsGroupJs->defer,
					$assetsGroupJs->notMin
				);
		}
	}
	
	/** @return void */
	public function GridDataInit () {
		self::GetGrid($this);
	}
	
	/** @return void */
	/*public function GridColStatesInit () {
		$this->ajax = TRUE;
		$this->viewEnabled = FALSE;
		self::GetGrid($this);
	}*/

	/** @return void */
	public function GridColChangesInit () {
		$this->ajax = TRUE;
		$this->viewEnabled = FALSE;
		self::GetGrid($this);
	}

}
