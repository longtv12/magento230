<?php


namespace Bluecom\Scheduled\Api\Data;

interface ScheduledSearchResultsInterface extends \Magento\Framework\Api\SearchResultsInterface
{


    /**
     * Get Scheduled list.
     * @return \Bluecom\Scheduled\Api\Data\ScheduledInterface[]
     */
    public function getItems();

    /**
     * Set title list.
     * @param \Bluecom\Scheduled\Api\Data\ScheduledInterface[] $items
     * @return $this
     */
    public function setItems(array $items);
}
