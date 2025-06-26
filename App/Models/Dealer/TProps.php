<?php

namespace App\Models\Dealer;

use \MvcCore\Ext\Models\Db\Attrs\Column,
	\MvcCore\Ext\Models\Db\Attrs\Table,
	\MvcCore\Ext\Controllers\DataGrids\Configs\Column as GridColumn,
	\MvcCore\Ext\Controllers\DataGrids\Configs\Type as GridType;

trait TProps {

	/**
	 * @var ?int
	 * @column id_dealer
	 * @keyPrimary TRUE
	 * @datagrid Column({
	 *    "columnIndex": 10,
	 *    "headingName": "ID Dealer",
	 *    "sort": true,
	 *    "filter": true,
	 *    "cssClasses": ["align-right"]
	 * })
	 */
	#[Column('id_dealer')]
	#[GridColumn(columnIndex: 10, headingName: 'ID Dealer', sort: TRUE, filter: TRUE, cssClasses: ['align-right'])]
	protected $idDealer			= NULL;
	
	/**
	 * @var ?int
	 * @column id_dealer_parent
	 * @datagrid Column({
	 *    "columnIndex": 110,
	 *    "headingName": "Parent ID",
	 *    "title": "Dealer Parent ID",
	 *    "sort": true,
	 *    "filter": true,
	 *    "cssClasses": ["align-right"],
	 *    "disabled": true
	 * })
	 */
	#[Column('id_dealer_parent')]
	#[GridColumn(columnIndex: 110, headingName: 'Parent ID', title: 'Dealer Parent ID', sort: TRUE, filter: TRUE, cssClasses: ['align-right'], disabled: TRUE)]
	protected $idParent			= NULL;
	
	/**
	 * @var ?string
	 * @column dealer_name
	 * @datagrid Column({ "disabled": true })
	 */
	#[Column('dealer_name')]
	#[GridColumn(disabled: TRUE)]
	protected $name				= NULL; // could be nullable in orders grid
	
	/**
	 * @var ?string
	 * @column dealer_surname
	 * @datagrid Column({ "disabled": true })
	 */
	#[Column('dealer_surname')]
	#[GridColumn(disabled: TRUE)]
	protected $surname			= NULL;
	
	/**
	 * @var ?string
	 * @column dealer_description
	 * @datagrid Column({
	 *    "columnIndex": 12,
	 *    "headingName": "Description",
	 *    "title": "Dealer Description",
	 *    "sort": true,
	 *    "filter": true
	 * })
	 */
	#[Column('dealer_description')]
	#[GridColumn(columnIndex: 12, headingName: 'Description', title: 'Dealer Description', sort: TRUE, filter: TRUE)]
	protected $description		= NULL;
	
	/**
	 * @var float
	 * @column dealer_turn_over_excl_vat
	 * @datagrid Column({
	 *    "columnIndex": 13,
	 *    "headingName": "TurnOver (excl. VAT)",
	 *    "title": "Dealer TurnOver (excl. VAT)",
	 *    "sort": true,
	 *    "filter": true,
	 *    "types": ["float", "money"],
	 *    "formatArgs": [0],
	 *    "cssClasses": ["align-right"]
	 * })
	 */
	#[Column('dealer_turn_over_excl_vat')]
	#[GridColumn(columnIndex: 13, headingName: 'TurnOver (excl. VAT)', title: 'Dealer TurnOver (excl. VAT)', sort: TRUE, filter: TRUE, types: [GridType::SERVER_FLOAT, GridType::CLIENT_MONEY], formatArgs: [0], cssClasses: ['align-right'])]
	protected $turnOverExclVat	= NULL;
	
	/**
	 * @var float
	 * @column dealer_turn_over_incl_vat
	 * @datagrid Column({
	 *    "columnIndex": 14,
	 *    "headingName": "TurnOver (incl. VAT)",
	 *    "title": "Dealer TurnOver (incl. VAT)",
	 *    "sort": true,
	 *    "filter": true,
	 *    "types": ["float", "money"],
	 *    "formatArgs": [0],
	 *    "cssClasses": ["align-right"],
	 *    "disabled": true
	 * })
	 */
	#[Column('dealer_turn_over_incl_vat')]
	#[GridColumn(columnIndex: 14, headingName: 'TurnOver (incl. VAT)', title: 'Dealer TurnOver (incl. VAT)', sort: TRUE, filter: TRUE, types: [GridType::SERVER_FLOAT, GridType::CLIENT_MONEY], formatArgs: [0], cssClasses: ['align-right'], disabled: TRUE)]
	protected $turnOverInclVat	= NULL;

}
