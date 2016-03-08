<?php

namespace api\modules\oauth2server\filters;

use Yii;
use yii\base\Controller;
use api\modules\oauth2server\Module;
use api\modules\oauth2server\exceptions\HttpException;

class ErrorToExceptionFilter extends \yii\base\Behavior
{
    /**
     * @inheritdoc
     */
    public function events()
    {
        return [Controller::EVENT_AFTER_ACTION => 'afterAction'];
    }

    /**
     * @param ActionEvent $event
     * @return boolean
     * @throws HttpException when the request method is not allowed.
     */
    public function afterAction($event)
    {
        $response = Module::getInstance()->getServer()->getResponse();

        $isValid = true;
        if($response !== null) {
            $isValid = $response->isInformational() || $response->isSuccessful() || $response->isRedirection();
        }
        if(!$isValid) {
            throw new HttpException($response->getStatusCode(), $this->getErrorMessage($response), $response->getParameter('error_uri'));
        }
    }
    
    protected function getErrorMessage(\OAuth2\Response $response)
    {
        $message = Module::t('common', $response->getParameter('error_description'));
        if($message === null) {
            $message = Module::t('common', 'An internal server error occurred.');
        }
        return $message;
    }
}
