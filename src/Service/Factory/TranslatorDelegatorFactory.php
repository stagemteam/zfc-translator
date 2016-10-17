<?php
/**
 * @category Agere
 * @package Agere_Translator
 * @author Popov Sergiy <popov@agere.com.ua>
 * @datetime: 16.10.2016 16:44
 */
namespace Agere\Translator\Service\Factory;

use Interop\Container\ContainerInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\ServiceManager\DelegatorFactoryInterface;
use Zend\I18n\Translator\TranslatorAwareInterface;
use Zend\Mvc\I18n\Translator;
use Zend\Stdlib\Exception;
use Magere\Entity\Controller\Plugin\ModulePlugin;
use Agere\Current\Plugin\Current as CurrentPlugin;

class TranslatorDelegatorFactory implements DelegatorFactoryInterface
{
    public function createDelegatorWithName(ServiceLocatorInterface $sm, $name, $requestedName, $callback )
    {
        $service = $callback();
        if ($service instanceof TranslatorAwareInterface) {
            $cpm = $sm->get('ControllerPluginManager');
            if ($cpm->has('module')) {
                /** @var ModulePlugin $modulePlugin */
                $modulePlugin = $cpm->get('module');
                $textDomain = $modulePlugin->setRealContext($service)->getModule()->getNamespace();
            } elseif ($cpm->has('current')) {
                /** @var CurrentPlugin $currentPlugin */
                $currentPlugin = $cpm->get('current');
                $textDomain = $currentPlugin->getModule();
            } else {
                throw new Exception\LogicException(
                    'Cannot get module text domain. "agerecompany/zfc-module or "popovsergiy/zfc-current" is required. '
                    . 'Add one of this dependency to composer.json'
                );
            }

            /** @var Translator $translator */
            $translator = $sm->get('translator');
            $service->setTranslator($translator);
            $service->setTranslatorTextDomain($textDomain);
        }

        return $service;
    }
}