<?php
/**
 * Enter description here...
 *
 * @category Agere
 * @package Agere_<package>
 * @author Popov Sergiy <popov@agere.com.ua>
 * @datetime: 11.11.2016 10:46
 */
namespace Stagem\Translator\Service\Factory;

/**
 * @todo Це заготовка яку потрібно реалізувати
 * @todo Базується на\Mage_Adminhtml_Controller_Action::__
 */
class TranslateAwareTrait
{
    /**
     * Translate a phrase
     *
     * @return string
     */
    public function __()
    {
        $args = func_get_args();
        $expr = new Mage_Core_Model_Translate_Expr(array_shift($args), $this->getUsedModuleName());
        array_unshift($args, $expr);
        return Mage::app()->getTranslator()->translate($args);
    }
}