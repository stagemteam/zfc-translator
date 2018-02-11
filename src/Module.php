<?php
namespace Stagem\Translator;

use Zend\Http\Request as HttpRequest;
use Stagem\Translator\Http\LocaleDetector;
use Zend\Mvc\I18n\Translator;

class Module
{
    public function onBootstrap($e)
    {
        $sm = $e->getApplication()->getServiceManager();
        //$config = $sm->get('Config');
        /** @var Translator $translator */
        $translator = $sm->get('Translator');
        /** @var LocaleDetector $localeDetector */
        $localeDetector = $sm->get('LocaleDetector');

        // @todo Реалізувати розширене рішення @link https://juriansluiman.nl/article/118/auto-detect-user-locale-with-zend-http-request-headers-and-ext-intl
        $locale = (($request = $e->getRequest()) instanceof HttpRequest)
            ? $localeDetector->detect(\Locale::acceptFromHttp($request->getServer('HTTP_ACCEPT_LANGUAGE')))
            : null;

        $translator->setLocale($locale)
            ->setFallbackLocale($localeDetector->getDefaultLocale());
    }

    public function getConfig()
    {
        $config = include __DIR__ . '/../config/module.config.php';
        $config['service_manager'] = $config['dependencies'];
        unset($config['dependencies']);

        return $config;
    }
}
