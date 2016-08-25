<?php
namespace Agere\Translator;

return array(

    'service_manager' => [
        'aliases' => [
            'translator' => 'MvcTranslator',
        ],
        //'abstract_factories' => array(
        //    'Zend\Cache\Service\StorageCacheAbstractServiceFactory',
        //    'Zend\Log\LoggerAbstractServiceFactory',
        //),
    ],

    'translator' => [
        'locale' => 'en_GB',
        'translation_file_patterns' => [
            [
                'type'     => 'gettext',
                'base_dir' => __DIR__ . '/../language',
                'pattern'  => '%s.mo',
                'text_domain' => __NAMESPACE__,
            ],
        ],
    ],

);
