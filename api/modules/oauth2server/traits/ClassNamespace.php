<?php

namespace api\modules\oauth2server\traits;

trait ClassNamespace
{
    public static function className()
    {
        return get_called_class();
    }
}