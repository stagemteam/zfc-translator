<?php
/**
 * @category Agere
 * @package Agere_Translator
 * @author Popov Sergiy <popov@agere.com.ua>
 * @datetime: 25.08.2016 12:44
 */
namespace Stagem\Translator\Http;

class LocaleDetectorFactory
{
    public function __invoke($sm)
    {
        $config = $sm->get('Config');
        $detector = new LocaleDetector($config['translator']['locales']);
        $detector->setDefaultLocale($config['translator']['locale']);

        return $detector;
    }
}