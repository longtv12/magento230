<?php


namespace Bluecom\Scheduled\Model\ResourceModel\Scheduled;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{

    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init(
            \Bluecom\Scheduled\Model\Scheduled::class,
            \Bluecom\Scheduled\Model\ResourceModel\Scheduled::class
        );
    }
}
