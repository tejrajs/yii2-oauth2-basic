<?php

namespace api\modules\oauth2server;

class Server extends \OAuth2\Server
{
    use traits\ClassNamespace;
    
    /**
     * @var \api\modules\oauth2server\Module
     */
    protected $module;
    
    public function __construct(Module $module, $storage = array(), array $config = array(), array $grantTypes = array(), array $responseTypes = array(), \OAuth2\TokenType\TokenTypeInterface $tokenType = null, \OAuth2\ScopeInterface $scopeUtil = null, \OAuth2\ClientAssertionType\ClientAssertionTypeInterface $clientAssertionType = null)
    {
        $this->module = $module;
        parent::__construct($storage, $config, $grantTypes, $responseTypes, $tokenType, $scopeUtil, $clientAssertionType);
    }
    
    public function createAccessToken($clientId, $userId, $scope = null, $includeRefreshToken = true)
    {
        $accessToken = $this->getAccessTokenResponseType();
        return $accessToken->createAccessToken($clientId, $userId, $scope, $includeRefreshToken);
    }
    
    public function verifyResourceRequest(\OAuth2\RequestInterface $request = null, \OAuth2\ResponseInterface $response = null, $scope = null)
    {
        if($request === null) {
            $request = $this->module->getRequest();
        }
        return parent::verifyResourceRequest($request, $response, $scope);
    }
    
    public function handleTokenRequest(\OAuth2\RequestInterface $request = null, \OAuth2\ResponseInterface $response = null)
    {
        if($request === null) {
            $request = $this->module->getRequest();
        }
        return parent::handleTokenRequest($request, $response);
    }

    public function handleAuthorizeRequest(\OAuth2\RequestInterface $request = null, \OAuth2\ResponseInterface $response = null, $isAuthorized = false, $userId = null)
    {
        if($request === null) {
            $request = $this->module->getRequest();
        }
        if($response === null) {
            $response = $this->module->getResponse();
        }
        
        return parent::handleAuthorizeRequest($request, $response, $isAuthorized, $userId);
    }
}
