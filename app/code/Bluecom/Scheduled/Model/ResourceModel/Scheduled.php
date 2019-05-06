<?php


namespace Bluecom\Scheduled\Model\ResourceModel;

class Scheduled extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{

    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('bluecom_scheduled_scheduled', 'scheduled_id');
    }
}
