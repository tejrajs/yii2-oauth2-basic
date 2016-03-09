<?php
/**
 * Parents controller for all ones
 * Created by PhpStorm.
 * @author Ihor Karas <ihor@karas.in.ua>
 * Date: 03.04.15
 * Time: 00:29
 */

namespace api\components;

use yii\helpers\ArrayHelper;
use yii\filters\auth\HttpBearerAuth;
use yii\filters\auth\QueryParamAuth;
use api\modules\oauth2server\filters\ErrorToExceptionFilter;
use api\modules\oauth2server\filters\auth\CompositeAuth;

class Controller extends \yii\rest\Controller
{
	/**
	 * @inheritdoc
	 */
	public function behaviors()
	{
		return ArrayHelper::merge(parent::behaviors(), [
				'authenticator' => [
						'class' => CompositeAuth::className(),
						'authMethods' => [
								['class' => HttpBearerAuth::className()],
								['class' => QueryParamAuth::className(), 'tokenParam' => 'accessToken'],
						]
				],
				'exceptionFilter' => [
						'class' => ErrorToExceptionFilter::className()
				],
		]);
	}
	//use \api\components\traits\ControllersCommonTrait;
}