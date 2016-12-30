<?php
/**
 * Class Aligent_TimedBanners_Helper_Data
 */
class Aligent_TimedBanners_Helper_Data extends Mage_Core_Helper_Abstract {
    const CONFIG_PREFIX = 'aligent/holiday_banner/';

    /**
     * @return bool
     */
    public function shouldShowBanner()
    {
        return Mage::getStoreConfig(self::CONFIG_PREFIX . 'enabled') && $this->isHoliday();
    }

    /**
     * @return string
     */
    public function getHolidayMessage() {
        return $this->__(Mage::getStoreConfig(self::CONFIG_PREFIX . 'message', Mage::app()->getStore()));
    }

    /**
     * @return DateTime
     */
    protected function getHolidayStartDate()
    {
        return DateTime::createFromFormat('d/m/y', Mage::getStoreConfig(self::CONFIG_PREFIX . 'start_date'));
    }

    /**
     * @return DateTime
     */
    protected function getHolidayEndDate()
    {
        return DateTime::createFromFormat('d/m/y', Mage::getStoreConfig(self::CONFIG_PREFIX . 'end_date'));
    }

    /**
     * @return bool
     */
    protected function isHoliday()
    {
        $oCurrentDate = new DateTime();
        return $oCurrentDate >= $this->getHolidayStartDate() && $oCurrentDate <= $this->getHolidayEndDate();
    }

}