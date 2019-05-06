<?php
namespace Bluecom\Scheduled\Model\Option;

use Magento\Framework\Data\OptionSourceInterface;
use Magento\ScheduledImportExport\Model\ResourceModel\Scheduled\Operation\CollectionFactory;
use Magento\Framework\App\RequestInterface;

class ListScheduled implements OptionSourceInterface
{
	/**
     * @var \Magento\ScheduledImportExport\Model\Scheduled\OperationFactory
     */
    protected $operationCollectionFactory;

    /**
     * @var RequestInterface
     */
    protected $request;

    /**
     * @var array
     */
    protected $customerTree;

    /**
     * @param CollectionFactory $operationCollectionFactory
     * @param RequestInterface $request
     */
    public function __construct(
        CollectionFactory $operationCollectionFactory,
        RequestInterface $request
    ) {
        $this->operationCollectionFactory = $operationCollectionFactory;
        $this->request = $request;
    }

    /**
     * {@inheritdoc}
     */
    public function toOptionArray()
    {
        $data = [['value' => '', 'label' => __('Please Select ....')]];
        $collection = $this->operationCollectionFactory->create();
        foreach ($collection as $item) {
            $array = ['value' => $item->getId(), 'label' => __($item->getName())];
            array_push($data, $array);
        }
        return $data;
    }

}
