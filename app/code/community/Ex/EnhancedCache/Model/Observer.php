<?php
/**
 * Class Ex_EnhancedCache_Model_Observer
 *
 * @category    Ex
 * @package     Ex_EnhancedCache
 * @author      Suky <suky3plex@outlook.com> (http://ex.pendabl.es)
 * @license     http://unlicense.org  Unlicensed Free Software
 */
class Ex_EnhancedCache_Model_Observer
{

    /**
     * @param Varien_Event_Observer $observer
     */
    public function cacheCmsBlocks(Varien_Event_Observer $observer)
    {
        /** @var Mage_Core_Block_Abstract $block */
        $block = $observer->getEvent()->getBlock();
        if ($block instanceof Mage_Cms_Block_Widget_Block || $block instanceof Mage_Cms_Block_Block){
            $cacheKeyData = array(
                Mage_Cms_Model_Block::CACHE_TAG,
                $block->getBlockId(),
                Mage::app()->getStore()->getId()
            );

            $block->setCacheKey(implode('_', $cacheKeyData));
            $block->setCacheTags(
                array(Mage_Cms_Model_Block::CACHE_TAG)
            );
        }
    }
}
