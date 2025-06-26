<?php

namespace App\Models;

use \MvcCore\Ext\Models\Db\Attrs\Table;

/**
 * @table order
 */
#[Table('order')]
class Order extends \App\Models\Base {

	use \App\Models\Order\TProps,
		\App\Models\Order\TGettersSetters;

}