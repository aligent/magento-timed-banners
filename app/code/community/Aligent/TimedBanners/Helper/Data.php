<?php
/**
 * Class Aligent_TimedBanners_Helper_Data
 */
class Aligent_TimedBanners_Helper_Data extends Mage_Core_Helper_Abstract {
    const CONFIG_PREFIX = 'aligent/timedbanners/';

    /**
     * @return bool
     */
    public function shouldShowBanner()
    {
        return Mage::getStoreConfig(self::CONFIG_PREFIX . 'enabled') && $this->isWithinTimedBannerRange();
    }

    /**
     * @return string
     */
    public function getMessage() {
        return $this->__(Mage::getStoreConfig(self::CONFIG_PREFIX . 'message', Mage::app()->getStore()));
    }

    /**
     * @return DateTime
     */
    protected function getStartDate()
    {
        return DateTime::createFromFormat('d/m/y', Mage::getStoreConfig(self::CONFIG_PREFIX . 'start_date'));
    }

    /**
     * @return DateTime
     */
    protected function getEndDate()
    {
        return DateTime::createFromFormat('d/m/y', Mage::getStoreConfig(self::CONFIG_PREFIX . 'end_date'));
    }

    /**
     * @return bool
     */
    protected function isWithinTimedBannerRange()
    {
        $oCurrentDate = new DateTime();
        return $oCurrentDate >= $this->getStartDate() && $oCurrentDate <= $this->getEndDate();
    }

}