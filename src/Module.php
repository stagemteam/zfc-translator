<?php
namespace Agere\Translator;

class Module
{
    public function onBootstrap($e)
    {
        $translator = $e->getApplication()->getServiceManager()->get('translator');
        $translator
            ->setLocale(\Locale::acceptFromHttp($_SERVER['HTTP_ACCEPT_LANGUAGE']))
            ->setFallbackLocale('ru_RU');
    }

    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }
}
