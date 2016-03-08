<?php
/**
 * ProductController v1
 * @author Ihor Karas <ihor@karas.in.ua>
 * Date: 03.04.15
 * Time: 00:35
 */

namespace api\versions\v1\controllers;


class ProductController extends \api\components\ActiveController
{
	public $modelClass = '\api\versions\v1\models\Product';

public function accessRules()
	{
		return [
			[
				'allow' => true,
				'roles' => ['?'],
			],
			[
				'allow' => true,
				'actions' => [
					'view',
					'create',
					'update',
					'delete'
				],
				'roles' => ['@'],
			],
			[
				'allow' => true,
				'actions' => ['custom'],
				'roles' => ['@'],
				'scopes' => ['custom'],
			],
			[
				'allow' => true,
				'actions' => ['protected'],
				'roles' => ['@'],
				'scopes' => ['protected'],
			]
		];
	}

	public function actionCustom()
	{
		return ['status' => 'ok', 'underScope' => 'custom'];
	}

	public function actionProtected()
	{
		return ['status' => 'ok', 'underScope' => 'protected'];
	}
}