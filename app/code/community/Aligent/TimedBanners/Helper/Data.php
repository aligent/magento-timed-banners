<?php
/**
 * Class Aligent_TimedBanners_Helper_Data
 *
 * Provides the view-based functionality for checking whether the banner set within
 * the admin interface should be shown or not
 * @author Todd Hainsworth <todd.hainsworth@aligent.com.au>
 */
class Aligent_TimedBanners_Helper_Data extends Mage_Core_Helper_Abstract {
    const CONFIG_PREFIX = 'aligent_timedbanners/settings/';

    /**
     * Return whether or not we should display the banner dependent on whether the functionality
     * is enabled within the backend and the current date and time is within the configured date and time
     * @return bool
     */
    public function shouldShowBanner()
    {
        return Mage::getStoreConfig(self::CONFIG_PREFIX . 'enabled') && $this->isWithinTimedBannerRange();
    }

    /**
     * Get the configured, escaped and translated message to be displayed within the banner
     * @return string
     */
    public function getMessage() {
        return $this->__(
            $this->escapeHtml(Mage::getStoreConfig(self::CONFIG_PREFIX . 'message', Mage::app()->getStore()))
        );
    }

    /**
     * Get the date and time the banner should be shown from
     * @return DateTime
     */
    protected function getStart()
    {
        return $this->getLocale()->date(Mage::getStoreConfig(self::CONFIG_PREFIX . 'start'), $this->getDateTimeFormat());
    }

    /**
     * Get the date and time the banner should be shown until
     * @return DateTime
     */
    protected function getEnd()
    {
        return $this->getLocale()->date(Mage::getStoreConfig(self::CONFIG_PREFIX . 'end'), $this->getDateTimeFormat());
    }

    /**
     * Return whether or not the current date and time is within the configured range.
     *
     * If only the 'start' data is present and the current date is on or after that value then return true
     * If both the 'start' and 'end' data is present and the current date is between the two (inclusive) then return true
     * If only the 'end' data is present and the current date is before the data then return true
     * Otherwise return false
     *
     * @return bool
     */
    protected function isWithinTimedBannerRange()
    {
        $oCurrentDateTime = $this->getLocale()->date(null, $this->getDateTimeFormat());
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

    /**
     * Return the DateTime format that the Timed Banners expect to interact with
     * @return string
     */
    public function getDateTimeFormat() {
        return Mage::app()->getLocale()->getDateTimeFormat(Mage_Core_Model_Locale::FORMAT_TYPE_SHORT);
    }

    /**
     * Get the application locale
     * @return Mage_Core_Model_Locale
     */
    protected function getLocale() {
        return Mage::app()->getLocale();
    }
}