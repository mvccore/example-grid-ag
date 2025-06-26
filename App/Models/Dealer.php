<?php

namespace App\Models;

use \MvcCore\Ext\Models\Db\Attrs\Table;

/**
 * @table dealer
 */
#[Table('dealer')]
class Dealer extends \App\Models\Base {

	use \App\Models\Dealer\TProps,
		\App\Models\Dealer\TGettersSetters;

}