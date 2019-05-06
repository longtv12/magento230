<?php

namespace Bluecom\Scheduled\Helper;

use Magento\Framework\App\Helper\Context;
use Magento\ScheduledImportExport\Model\Scheduled\OperationFactory;

class Data extends \Magento\Framework\App\Helper\AbstractHelper
{
    protected $scheduledCollectionFactory;

    protected $sortOrder;

    protected $date;

    protected $directory_list;

    /**
     * @var \Magento\ScheduledImportExport\Model\Scheduled\OperationFactory
     */
    protected $operationFactory;

    public function __construct(
        \Magento\Framework\App\Filesystem\DirectoryList $directory_list,
        \Magento\Framework\Stdlib\DateTime\DateTime $date,
        OperationFactory $operationFactory,
        \Bluecom\Scheduled\Model\ResourceModel\Scheduled\CollectionFactory $scheduledCollectionFactory,
        \Magento\Framework\Api\SortOrder $sortOrder,
        Context $context
    )
    {
        $this->directory_list = $directory_list;
        $this->operationFactory = $operationFactory;
        $this->date = $date;
        $this->scheduledCollectionFactory = $scheduledCollectionFactory;
        $this->sortOrder = $sortOrder;
        parent::__construct($context);
    }

    public function getScheduledList() {
        $collection = $this->scheduledCollectionFactory->create();
        return $collection;
    }

    public function getToday() {
        return $this->date->gmtDate();
    }

    public function getFileName($id) {
        $item = $this->operationFactory->create()->load($id);
        return $item->getFileInfo();
    }

    public function getRootPath(){
        return $this->directory_list->getRoot();
    }
}