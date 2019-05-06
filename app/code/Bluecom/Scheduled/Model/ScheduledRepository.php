<?php


namespace Bluecom\Scheduled\Model;

use Magento\Framework\Reflection\DataObjectProcessor;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Api\SortOrder;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\CouldNotSaveException;
use Bluecom\Scheduled\Api\Data\ScheduledInterfaceFactory;
use Bluecom\Scheduled\Api\ScheduledRepositoryInterface;
use Magento\Store\Model\StoreManagerInterface;
use Bluecom\Scheduled\Api\Data\ScheduledSearchResultsInterfaceFactory;
use Magento\Framework\Api\DataObjectHelper;
use Bluecom\Scheduled\Model\ResourceModel\Scheduled\CollectionFactory as ScheduledCollectionFactory;
use Bluecom\Scheduled\Model\ResourceModel\Scheduled as ResourceScheduled;

class ScheduledRepository implements ScheduledRepositoryInterface
{

    protected $scheduledCollectionFactory;

    protected $dataObjectHelper;

    protected $dataObjectProcessor;

    protected $resource;

    protected $scheduledFactory;

    protected $searchResultsFactory;

    private $storeManager;

    protected $dataScheduledFactory;


    /**
     * @param ResourceScheduled $resource
     * @param ScheduledFactory $scheduledFactory
     * @param ScheduledInterfaceFactory $dataScheduledFactory
     * @param ScheduledCollectionFactory $scheduledCollectionFactory
     * @param ScheduledSearchResultsInterfaceFactory $searchResultsFactory
     * @param DataObjectHelper $dataObjectHelper
     * @param DataObjectProcessor $dataObjectProcessor
     * @param StoreManagerInterface $storeManager
     */
    public function __construct(
        ResourceScheduled $resource,
        ScheduledFactory $scheduledFactory,
        ScheduledInterfaceFactory $dataScheduledFactory,
        ScheduledCollectionFactory $scheduledCollectionFactory,
        ScheduledSearchResultsInterfaceFactory $searchResultsFactory,
        DataObjectHelper $dataObjectHelper,
        DataObjectProcessor $dataObjectProcessor,
        StoreManagerInterface $storeManager
    ) {
        $this->resource = $resource;
        $this->scheduledFactory = $scheduledFactory;
        $this->scheduledCollectionFactory = $scheduledCollectionFactory;
        $this->searchResultsFactory = $searchResultsFactory;
        $this->dataObjectHelper = $dataObjectHelper;
        $this->dataScheduledFactory = $dataScheduledFactory;
        $this->dataObjectProcessor = $dataObjectProcessor;
        $this->storeManager = $storeManager;
    }

    /**
     * {@inheritdoc}
     */
    public function save(
        \Bluecom\Scheduled\Api\Data\ScheduledInterface $scheduled
    ) {
        /* if (empty($scheduled->getStoreId())) {
            $storeId = $this->storeManager->getStore()->getId();
            $scheduled->setStoreId($storeId);
        } */
        try {
            $this->resource->save($scheduled);
        } catch (\Exception $exception) {
            throw new CouldNotSaveException(__(
                'Could not save the scheduled: %1',
                $exception->getMessage()
            ));
        }
        return $scheduled;
    }

    /**
     * {@inheritdoc}
     */
    public function getById($scheduledId)
    {
        $scheduled = $this->scheduledFactory->create();
        $this->resource->load($scheduled, $scheduledId);
        if (!$scheduled->getId()) {
            throw new NoSuchEntityException(__('Scheduled with id "%1" does not exist.', $scheduledId));
        }
        return $scheduled;
    }

    /**
     * {@inheritdoc}
     */
    public function getList(
        \Magento\Framework\Api\SearchCriteriaInterface $criteria
    ) {
        $collection = $this->scheduledCollectionFactory->create();
        foreach ($criteria->getFilterGroups() as $filterGroup) {
            $fields = [];
            $conditions = [];
            foreach ($filterGroup->getFilters() as $filter) {
                if ($filter->getField() === 'store_id') {
                    $collection->addStoreFilter($filter->getValue(), false);
                    continue;
                }
                $fields[] = $filter->getField();
                $condition = $filter->getConditionType() ?: 'eq';
                $conditions[] = [$condition => $filter->getValue()];
            }
            $collection->addFieldToFilter($fields, $conditions);
        }
        
        $sortOrders = $criteria->getSortOrders();
        if ($sortOrders) {
            /** @var SortOrder $sortOrder */
            foreach ($sortOrders as $sortOrder) {
                $collection->addOrder(
                    $sortOrder->getField(),
                    ($sortOrder->getDirection() == SortOrder::SORT_ASC) ? 'ASC' : 'DESC'
                );
            }
        }
        $collection->setCurPage($criteria->getCurrentPage());
        $collection->setPageSize($criteria->getPageSize());
        
        $searchResults = $this->searchResultsFactory->create();
        $searchResults->setSearchCriteria($criteria);
        $searchResults->setTotalCount($collection->getSize());
        $searchResults->setItems($collection->getItems());
        return $searchResults;
    }

    /**
     * {@inheritdoc}
     */
    public function delete(
        \Bluecom\Scheduled\Api\Data\ScheduledInterface $scheduled
    ) {
        try {
            $this->resource->delete($scheduled);
        } catch (\Exception $exception) {
            throw new CouldNotDeleteException(__(
                'Could not delete the Scheduled: %1',
                $exception->getMessage()
            ));
        }
        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function deleteById($scheduledId)
    {
        return $this->delete($this->getById($scheduledId));
    }
}
