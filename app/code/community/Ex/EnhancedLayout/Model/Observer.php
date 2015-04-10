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
     * @param Varien_Event_Observer $observer
     */
    public function optimizeLayout(Varien_Event_Observer $observer)
    {
        /** @var Mage_Core_Model_Layout_Update $update */
        $update = $observer->getEvent()->getLayout()->getUpdate();

        foreach($update->getHandles() as $handle){
            if( strpos($handle, 'CATEGORY_') === 0
                || ( strpos($handle, 'PRODUCT_') === 0 && strpos($handle, 'PRODUCT_TYPE_') === false)){
                $update->removeHandle($handle);
            }
        }
    }
}
