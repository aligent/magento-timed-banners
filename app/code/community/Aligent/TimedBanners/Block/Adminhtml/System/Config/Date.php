<?php
/**
 * Class Aligent_TimedBanners_Block_Adminhtml_System_Config_Date
 */
class Aligent_TimedBanners_Block_Adminhtml_System_Config_Date extends Mage_Adminhtml_Block_System_Config_Form_Field {
    /**
     * @param Varien_Data_Form_Element_Abstract $element the element to generate the html for
     * @return string the element html
     */
    protected function _getElementHtml(Varien_Data_Form_Element_Abstract $element)
    {
        $date = new Varien_Data_Form_Element_Date();
        $format = Mage::app()->getLocale()->getDateFormat(Mage_Core_Model_Locale::FORMAT_TYPE_SHORT);

        $data = array(
            'name'      => $element->getName(),
            'html_id'   => $element->getId(),
            'image'     => $this->getSkinUrl('images/grid-cal.gif'),
        );
        $date->setData($data);
        $date->setValue($element->getValue(), $format);
        $date->setFormat(Mage::app()->getLocale()->getDateFormat(Mage_Core_Model_Locale::FORMAT_TYPE_SHORT));
        $date->setForm($element->getForm());

        return $date->getElementHtml();
    }
}