<?php
/**
 * Class Aligent_TimedBanners_Block_Adminhtml_System_Config_Datetime
 *
 * Provides an AdminHtml input for DateTimes
 *
 * @author Todd Hainsworth <todd.hainsworth@aligent.com.au>
 */
class Aligent_TimedBanners_Block_Adminhtml_System_Config_Datetime extends Mage_Adminhtml_Block_System_Config_Form_Field {
    /**
     * Get the HTML required to display the DateTime element
     * @param Varien_Data_Form_Element_Abstract $element the element to generate the html for
     * @return string the element html
     */
    protected function _getElementHtml(Varien_Data_Form_Element_Abstract $element)
    {
        $date = new Varien_Data_Form_Element_Date();
        $format = Mage::helper('aligent_timedbanners')->getDateTimeFormat();

        $data = array(
            'name'         => $element->getName(),
            'html_id'      => $element->getId(),
            'image'        => $this->getSkinUrl('images/grid-cal.gif'),
            'time'         => true,
            'input_format' => $format,
            'format'       => $format,
        );
        $date->setData($data);
        $date->setValue($element->getValue(), $format);
        $date->setFormat($format);
        $date->setForm($element->getForm());

        return $date->getElementHtml();
    }
}