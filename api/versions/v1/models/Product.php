<?php
/**
 * Product module v1
 *
 * @author ihor@karas.in.ua
 * Date: 04.05.15
 * Time: 22:57
 */

namespace api\versions\v1\models;

class Product extends \api\components\db\ActiveRecord
{
/**
	 * @inheritdoc
	 */
	public static function tableName()
	{
		return '{{products}}';
	}

	public static function find() {
		return new ProductQuery(get_called_class());
	}
}

class ProductQuery extends \api\components\db\ActiveQuery
{
}