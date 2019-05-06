<?php


namespace Bluecom\Scheduled\Api;

use Magento\Framework\Api\SearchCriteriaInterface;

interface ScheduledRepositoryInterface
{


    /**
     * Save Scheduled
     * @param \Bluecom\Scheduled\Api\Data\ScheduledInterface $scheduled
     * @return \Bluecom\Scheduled\Api\Data\ScheduledInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function save(
        \Bluecom\Scheduled\Api\Data\ScheduledInterface $scheduled
    );

    /**
     * Retrieve Scheduled
     * @param string $scheduledId
     * @return \Bluecom\Scheduled\Api\Data\ScheduledInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getById($scheduledId);

    /**
     * Retrieve Scheduled matching the specified criteria.
     * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
     * @return \Bluecom\Scheduled\Api\Data\ScheduledSearchResultsInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getList(
        \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
    );

    /**
     * Delete Scheduled
     * @param \Bluecom\Scheduled\Api\Data\ScheduledInterface $scheduled
     * @return bool true on success
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function delete(
        \Bluecom\Scheduled\Api\Data\ScheduledInterface $scheduled
    );

    /**
     * Delete Scheduled by ID
     * @param string $scheduledId
     * @return bool true on success
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function deleteById($scheduledId);
}
