<?php
/**
 * Class Ex_EnhancedLayout_Model_Observer
 *
 * @category    Ex
 * @package     Ex_EnhancedLayout
 * @author      Suky <suky3plex@outlook.com> (http://ex.pendabl.es)
 * @license     http://unlicense.org  Unlicensed Free Software
 */
class Ex_EnhancedLayout_Model_Observer
{

    /**
     * @var bool
     */
    private $_debug = false;

    /**
     * @param $output
     * @param $file
     */
    private function _log($output, $file)
    {
        return Mage::log($output, Zend_Log::DEBUG, $file, true);
    }

    /**
     * Removes CATEGORY_XXX and PRODUCT_XXX handles
     * @note: Widgets for specific categories and specific products WILL NOT WORK!
     * @param Varien_Event_Observer $observer
     */
    public function optimizeLayout(Varien_Event_Observer $observer)
    {
        /** @var Mage_Core_Model_Layout_Update $update */
        $update = $observer->getEvent()->getLayout()->getUpdate();
        /** log before changes applied */
        if($this->_debug){
            $this->_log($update->getHandles(), 'handles_before.log');
        }

        foreach($update->getHandles() as $handle){
            if( strpos($handle, 'CATEGORY_') === 0
                || ( strpos($handle, 'PRODUCT_') === 0 && strpos($handle, 'PRODUCT_TYPE_') === false)){
                $update->removeHandle($handle);
            }
        }
        /** log after changes applied */
        if($this->_debug){
            $this->_log($update->getHandles(), 'handles_after.log');
        }
    }
}
