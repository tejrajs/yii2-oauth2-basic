<?php

namespace api\modules\user\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use api\modules\user\models\LoginForm;
/**
 * Default controller for the `user` module
 */
class DefaultController extends Controller
{
	public function behaviors()
	{
		return [
				'access' => [
						'class' => AccessControl::className(),
						'only' => ['logout'],
						'rules' => [
								[
										'actions' => ['logout','index','authorize'],
										'allow' => true,
										'roles' => ['@'],
								],
						],
				],
				'verbs' => [
						'class' => VerbFilter::className(),
						'actions' => [
								'logout' => ['post'],
						],
				],
		];
	}
	/**
	 * Renders the index view for the module
	 * @return string
	 */
	public function actionIndex()
	{
		return $this->render('index');
	}
	/**
	 * Renders the login view for the module
	 * @return string
	 */
	public function actionLogin()
	{
		if (!\Yii::$app->user->isGuest) {
			return $this->redirect(['/user/check']);
		}
	
		$model = new LoginForm();
		if ($model->load(Yii::$app->request->post()) && $model->login()) {
			return $this->redirect(['/user/authorize']);
		}
		return $this->render('login', [
				'model' => $model,
		]);
	}
	
	public function actionLogout()
	{
		Yii::$app->user->logout();
	
		return $this->goHome();
	}
	
    public function actionAuthorize()
    {
    	if (Yii::$app->getUser()->getIsGuest())
    		return $this->redirect(['/user/login']);
    
    	/** @var $module \filsh\yii2\oauth2server\Module */
    	$module = Yii::$app->getModule('oauth2');
    	$response = $module->handleAuthorizeRequest(!Yii::$app->getUser()->getIsGuest(), Yii::$app->getUser()->getId());
    
    	/** @var object $response \OAuth2\Response */
    	Yii::$app->getResponse()->format = \yii\web\Response::FORMAT_JSON;
    
    	return $response->getParameters();
    }
}
