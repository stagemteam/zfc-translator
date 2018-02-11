<?php
/**
 * @category Stagem
 * @package Stagem_ZfcTranslator
 * @author Serhii Stagem <popow.serhii@gmail.com>
 * @datetime: 03.02.2018 11:58
 */
namespace Stagem\ZfcTranslator;

class ConfigProvider
{
    public function __invoke()
    {
        $config =  require __DIR__ . '/../config/module.config.php';
        unset($config['dependencies']['aliases']['translator']); // remove MVC translator

        return $config;
    }
}