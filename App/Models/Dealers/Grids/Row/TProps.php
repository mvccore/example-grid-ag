<?php

namespace App\Models\Dealers\Grids\Row;

use \MvcCore\Ext\Controllers\DataGrids\Configs\Column as GridColumn,
	\MvcCore\Ext\Controllers\DataGrids\Configs\Type as GridType;

trait TProps {

	/**
	 * @var string
	 * @datagrid Column({
	 *    "columnIndex": 11,
	 *    "dbColumnName": "dealer_fullname",
	 *    "headingName": "Full Name",
	 *    "title": "Dealer Full Name",
	 *    "sort": true,
	 *    "filter": true
	 * })
	 */
	#[GridColumn(columnIndex: 11, dbColumnName: 'dealer_fullname', headingName: 'Full Name', title: 'Dealer Full Name', types: ['string'], sort: TRUE, filter: TRUE)]
	protected $fullName;
	
	/**
	 * @var ?string
	 * @datagrid Column({
	 *    "columnIndex": 111,
	 *    "dbColumnName": "dealer_fullname_parent",
	 *    "headingName": "Parent Full Name",
	 *    "title": "Dealer Parent Full Name",
	 *    "sort": true,
	 *    "filter": true,
	 *    "disabled": true
	 * })
	 */
	#[GridColumn(columnIndex: 111, dbColumnName: 'dealer_fullname_parent', headingName: 'Parent Full Name',  title: 'Dealer Parent Full Name', types: ['?string'], sort: TRUE, filter: TRUE, disabled: TRUE)]
	protected $fullNameParent			= NULL;
	
	/**
	 * @var ?int
	 * @datagrid Column({
	 *    "columnIndex": 120,
	 *    "dbColumnName": "id_dealer_parent_parent",
	 *    "headingName": "Parent Of Parent ID",
	 *    "title": "Dealer Parent Of Parent ID",
	 *    "sort": true,
	 *    "filter": true,
	 *    "cssClasses": ["align-right"],
	 *    "disabled": true
	 * })
	 */
	#[GridColumn(columnIndex: 120, dbColumnName: 'id_dealer_parent_parent', headingName: 'ID Parent Of Parent', title: 'Dealer ID Parent Of Parent', types: ['?int'], sort: TRUE, filter: TRUE, cssClasses: ['align-right'], disabled: TRUE)]
	protected $idParentOfParent			= NULL;
	
	/**
	 * @var ?string
	 * @datagrid Column({
	 *    "columnIndex": 121,
	 *    "dbColumnName": "dealer_fullname_parent_parent",
	 *    "headingName": "Parent Of Parent Full Name",
	 *    "title": "Dealer Parent Of Parent Full Name",
	 *    "sort": true,
	 *    "filter": true,
	 *    "disabled": true
	 * })
	 */
	#[GridColumn(columnIndex: 121, dbColumnName: 'dealer_fullname_parent_parent', headingName: 'Parent Of Parent Full Name', title: 'Dealer Parent Of Parent Full Name', types: ['?string'], sort: TRUE, filter: TRUE, disabled: TRUE)]
	protected $fullNameParentOfParent	= NULL;
	
}