<?php


namespace Bluecom\Scheduled\Model;

use Magento\Framework\Api\DataObjectHelper;
use Bluecom\Scheduled\Api\Data\ScheduledInterface;
use Bluecom\Scheduled\Api\Data\ScheduledInterfaceFactory;

class Scheduled extends \Magento\Framework\Model\AbstractModel
{

    protected $scheduledDataFactory;

    protected $dataObjectHelper;

    protected $_eventPrefix = 'bluecom_scheduled_scheduled';

    /**
     * @param \Magento\Framework\Model\Context $context
     * @param \Magento\Framework\Registry $registry
     * @param ScheduledInterfaceFactory $scheduledDataFactory
     * @param DataObjectHelper $dataObjectHelper
     * @param \Bluecom\Scheduled\Model\ResourceModel\Scheduled $resource
     * @param \Bluecom\Scheduled\Model\ResourceModel\Scheduled\Collection $resourceCollection
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\Model\Context $context,
        \Magento\Framework\Registry $registry,
        ScheduledInterfaceFactory $scheduledDataFactory,
        DataObjectHelper $dataObjectHelper,
        \Bluecom\Scheduled\Model\ResourceModel\Scheduled $resource,
        \Bluecom\Scheduled\Model\ResourceModel\Scheduled\Collection $resourceCollection,
        array $data = []
    ) {
        $this->scheduledDataFactory = $scheduledDataFactory;
        $this->dataObjectHelper = $dataObjectHelper;
        parent::__construct($context, $registry, $resource, $resourceCollection, $data);
    }

    /**
     * Retrieve scheduled model with scheduled data
     * @return ScheduledInterface
     */
    public function getDataModel()
    {
        $scheduledData = $this->getData();
        
        $scheduledDataObject = $this->scheduledDataFactory->create();
        $this->dataObjectHelper->populateWithArray(
            $scheduledDataObject,
            $scheduledData,
            ScheduledInterface::class
        );
        
        return $scheduledDataObject;
    }
}
