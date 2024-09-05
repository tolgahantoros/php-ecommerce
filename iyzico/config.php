<?php

require_once('IyzipayBootstrap.php');

IyzipayBootstrap::init();

class Config
{
    public static function options()
    {
        $options = new \Iyzipay\Options();
        $options->setApiKey("sandbox-OHYIAz9b8ot1YxUa62QnuRqxqmupd7Ht");
        $options->setSecretKey("sandbox-FkuqftrfuEzLfVHpB5geiJ56IDVQRuf2");
        $options->setBaseUrl("https://sandbox-api.iyzipay.com");
        return $options;
    }
}
