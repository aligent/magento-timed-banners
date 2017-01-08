<?php
/**
 * Class Aligent_TimedBanners_Helper_Data
 */
class Aligent_TimedBanners_Helper_Data extends Mage_Core_Helper_Abstract {
    const CONFIG_PREFIX = 'aligent_timedbanners/settings/';
    const DATETIME_FORMAT = 'd/m/y g:i A';

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
    protected function getStart()
    {
        return DateTime::createFromFormat(self::DATETIME_FORMAT, Mage::getStoreConfig(self::CONFIG_PREFIX . 'start'));
    }

    /**
     * @return DateTime
     */
    protected function getEnd()
    {
        return DateTime::createFromFormat(self::DATETIME_FORMAT, Mage::getStoreConfig(self::CONFIG_PREFIX . 'end'));
    }

    /**
     * @return bool
     */
    protected function isWithinTimedBannerRange()
    {
        $oCurrentDateTime = new DateTime();
        $oStart = $this->getStart();
        $oEnd = $this->getEnd();

        // There is only a start and it's now or before
        if ($oStart && !$oEnd && $oCurrentDateTime >= $oStart) { return true; }
        // Both start and end are present and now is between them
        if ($oStart && $oEnd && $oCurrentDateTime >= $oStart && $oCurrentDateTime <= $oEnd) { return true; }
        // There is no start but there is an end and now is before the end
        if (!$oStart && $oEnd && $oCurrentDateTime <= $oEnd) { return true; }

        return false;
    }
}