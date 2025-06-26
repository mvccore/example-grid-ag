<?php

namespace App\Models\Order;

use \MvcCore\Ext\Models\Db\Attrs\Column,
	\MvcCore\Ext\Models\Db\Attrs\Table,
	\MvcCore\Ext\Controllers\DataGrids\Configs\Column as GridColumn,
	\MvcCore\Ext\Controllers\DataGrids\Configs\Type as GridType;

trait TProps {

	/**
	 * @var ?int
	 * @column id_order
	 * @keyPrimary TRUE
	 * @datagrid Column({
	 *    "columnIndex": 1,
	 *    "headingName": "ID",
	 *    "title": "Order ID",
	 *    "sort": true,
	 *    "filter": true,
	 *    "cssClasses": ["align-right"]
	 * })
	 */
	#[Column('id_order')]
	#[GridColumn(columnIndex: 1, headingName: 'ID Order', title: 'Order ID', sort: TRUE, filter: TRUE, cssClasses: ['align-right'])]
	protected $idOrder			= NULL;

	/**
	 * @var ?int
	 * @column id_dealer
	 * @datagrid Column({
	 *    "columnIndex": 10,
	 *    "headingName": "ID Dealer",
	 *    "title": "Dealer ID",
	 *    "sort": true,
	 *    "filter": true,
	 *    "cssClasses": ["align-right"]
	 * })
	 */
	#[Column('id_dealer')]
	#[GridColumn(columnIndex: 10, headingName: 'ID Dealer', title: 'Dealer ID', sort: TRUE, filter: TRUE, cssClasses: ['align-right'])]
	protected $idDealer			= NULL;

	/**
	 * @var ?int
	 * @column id_client
	 * @datagrid Column({
	 *    "columnIndex": 200,
	 *    "headingName": "ID Client",
	 *    "title": "Client ID",
	 *    "sort": true,
	 *    "filter": true,
	 *    "cssClasses": ["align-right"]
	 * })
	 */
	#[Column('id_client')]
	#[GridColumn(columnIndex: 200, headingName: 'ID Client', title: 'Client ID', sort: TRUE, filter: TRUE, cssClasses: ['align-right'])]
	protected $idClient			= NULL;
	
	/**
	 * @var float
	 * @column order_price_excl_vat
	 * @datagrid Column({
	 *    "columnIndex": 2,
	 *    "headingName": "Price (excl. VAT)",
	 *    "title": "Order Price (excl. VAT)",
	 *    "sort": true,
	 *    "filter": true,
	 *    "types": ["float", "money"],
	 *    "formatArgs": [0],
	 *    "cssClasses": ["align-right"]
	 * })
	 */
	#[Column('order_price_excl_vat')]
	#[GridColumn(columnIndex: 2, headingName: 'Price (excl. VAT)', title: 'Order Price (excl. VAT)', sort: TRUE, filter: TRUE, types: [GridType::SERVER_FLOAT, GridType::CLIENT_MONEY], formatArgs: [0], cssClasses: ['align-right'])]
	protected $priceExclVat		= NULL;
	
	/**
	 * @var float
	 * @column order_price_incl_vat
	 * @datagrid Column({
	 *    "columnIndex": 3,
	 *    "headingName": "Price (incl. VAT)",
	 *    "title": "Order Price (incl. VAT)",
	 *    "sort": true,
	 *    "filter": true,
	 *    "types": ["float", "money"],
	 *    "formatArgs": [0],
	 *    "cssClasses": ["align-right"],
	 *    "disabled": true
	 * })
	 */
	#[Column('order_price_incl_vat')]
	#[GridColumn(columnIndex: 3, headingName: 'Price (incl. VAT)', title: 'Order Price (incl. VAT)', sort: TRUE, filter: TRUE, types: [GridType::SERVER_FLOAT, GridType::CLIENT_MONEY], formatArgs: [0], cssClasses: ['align-right'], disabled: TRUE)]
	protected $priceInclVat		= NULL;

	/**
	 * @var \DateTime
	 * @column order_date_submit
	 * @datagrid Column({
	 *    "columnIndex": 4,
	 *    "headingName": "Date Submit",
	 *    "title": "Order Date Submit",
	 *    "sort": true,
	 *    "filter": true,
	 *    "types": ["\\DateTime", "dateTime"],
	 *    "cssClasses": ["align-center"]
	 * })
	 */
	#[Column('order_date_submit')]
	#[GridColumn(columnIndex: 4, headingName: 'Date Submit', title: 'Order Date Submit', sort: TRUE, filter: TRUE, types: [GridType::SERVER_DATETIME, GridType::CLIENT_DATETIME], cssClasses: ['align-center'])]
	protected $dateSubmit;

	/**
	 * @var ?\DateTime
	 * @column order_date_dispatch
	 * @datagrid Column({
	 *    "columnIndex": 5,
	 *    "headingName": "Date Dispatch",
	 *    "title": "Order Date Dispatch",
	 *    "sort": true,
	 *    "filter": true,
	 *    "types": ["?\\DateTime", "dateTime"],
	 *    "cssClasses": ["align-center"]
	 * })
	 */
	#[Column('order_date_dispatch')]
	#[GridColumn(columnIndex: 5, headingName: 'Date Dispatch', title: 'Order Date Dispatch', sort: TRUE, filter: TRUE, types: [GridType::SERVER_DATETIME_NULL, GridType::CLIENT_DATETIME], cssClasses: ['align-center'])]
	protected $dateDispatch		= NULL;

	/**
	 * @var bool
	 * @column order_date_dispatch
	 * @datagrid Column({
	 *    "columnIndex": 6,
	 *    "headingName": "Paid",
	 *    "title": "Order Paid",
	 *    "sort": true,
	 *    "filter": true,
	 *    "cssClasses": ["align-center"]
	 * })
	 */
	#[Column('order_date_dispatch')]
	#[GridColumn(columnIndex: 6, headingName: 'Paid', title: 'Order Paid', sort: TRUE, filter: TRUE, cssClasses: ['align-center'])]
	protected $paid				= FALSE;

	/**
	 * @var bool
	 * @column order_status
	 * @datagrid Column({
	 *    "columnIndex": 7,
	 *    "headingName": "Status",
	 *    "title": "Order Status",
	 *    "sort": true,
	 *    "filter": true,
	 *    "cssClasses": ["align-center"]
	 * })
	 */
	#[Column('order_status')]
	#[GridColumn(columnIndex: 7, headingName: 'Status', title: 'Order Status', sort: TRUE, filter: TRUE, cssClasses: ['align-center'])]
	protected $status			= 'NEW';

}
