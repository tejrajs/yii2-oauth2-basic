<?php

namespace api\modules\oauth2server\filters\auth;

use api\modules\oauth2server\Module;

class CompositeAuth extends \yii\filters\auth\CompositeAuth
{
    /**
     * @inheritdoc
     */
    public function beforeAction($action)
    {
        $server = Module::getInstance()->getServer();
        $server->verifyResourceRequest();
        
        return parent::beforeAction($action);
    }
}
