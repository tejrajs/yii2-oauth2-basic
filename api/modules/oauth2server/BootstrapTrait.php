<?php

namespace api\modules\oauth2server;

trait BootstrapTrait
{
    /**
     * @var array Model's map
     */
    private $_modelMap = [
        'OauthClients'               => 'api\modules\oauth2server\models\OauthClients',
        'OauthAccessTokens'          => 'api\modules\oauth2server\models\OauthAccessTokens',
        'OauthAuthorizationCodes'    => 'api\modules\oauth2server\models\OauthAuthorizationCodes',
        'OauthRefreshTokens'         => 'api\modules\oauth2server\models\OauthRefreshTokens',
        'OauthScopes'                => 'api\modules\oauth2server\models\OauthScopes',
    ];
    
    /**
     * @var array Storage's map
     */
    private $_storageMap = [
        'access_token'          => 'api\modules\oauth2server\storage\Pdo',
        'authorization_code'    => 'api\modules\oauth2server\storage\Pdo',
        'client_credentials'    => 'api\modules\oauth2server\storage\Pdo',
        'client'                => 'api\modules\oauth2server\storage\Pdo',
        'refresh_token'         => 'api\modules\oauth2server\storage\Pdo',
        'user_credentials'      => 'api\modules\oauth2server\storage\Pdo',
        'public_key'            => 'api\modules\oauth2server\storage\Pdo',
        'jwt_bearer'            => 'api\modules\oauth2server\storage\Pdo',
        'scope'                 => 'api\modules\oauth2server\storage\Pdo',
    ];
    
    protected function initModule(Module $module)
    {
        $this->_modelMap = array_merge($this->_modelMap, $module->modelMap);
        foreach ($this->_modelMap as $name => $definition) {
            \Yii::$container->set("api\\modules\\oauth2server\\models\\" . $name, $definition);
            $module->modelMap[$name] = is_array($definition) ? $definition['class'] : $definition;
        }

        $this->_storageMap = array_merge($this->_storageMap, $module->storageMap);
        foreach ($this->_storageMap as $name => $definition) {
            \Yii::$container->set($name, $definition);
            $module->storageMap[$name] = is_array($definition) ? $definition['class'] : $definition;
        }
    }
}