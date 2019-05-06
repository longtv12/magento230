<?php


namespace Bluecom\Scheduled\Model\Data;

use Bluecom\Scheduled\Api\Data\ScheduledInterface;

class Scheduled extends \Magento\Framework\Api\AbstractExtensibleObject implements ScheduledInterface
{

    /**
     * Get scheduled_id
     * @return string|null
     */
    public function getScheduledId()
    {
        return $this->_get(self::SCHEDULED_ID);
    }

    /**
     * Set scheduled_id
     * @param string $scheduledId
     * @return \Bluecom\Scheduled\Api\Data\ScheduledInterface
     */
    public function setScheduledId($scheduledId)
    {
        return $this->setData(self::SCHEDULED_ID, $scheduledId);
    }

    /**
     * Get title
     * @return string|null
     */
    public function getTitle()
    {
        return $this->_get(self::TITLE);
    }

    /**
     * Set title
     * @param string $title
     * @return \Bluecom\Scheduled\Api\Data\ScheduledInterface
     */
    public function setTitle($title)
    {
        return $this->setData(self::TITLE, $title);
    }

    /**
     * Retrieve existing extension attributes object or create a new one.
     * @return \Bluecom\Scheduled\Api\Data\ScheduledExtensionInterface|null
     */
    public function getExtensionAttributes()
    {
        return $this->_getExtensionAttributes();
    }

    /**
     * Set an extension attributes object.
     * @param \Bluecom\Scheduled\Api\Data\ScheduledExtensionInterface $extensionAttributes
     * @return $this
     */
    public function setExtensionAttributes(
        \Bluecom\Scheduled\Api\Data\ScheduledExtensionInterface $extensionAttributes
    ) {
        return $this->_setExtensionAttributes($extensionAttributes);
    }

    /**
     * Get start_time
     * @return string|null
     */
    public function getStartTime()
    {
        return $this->_get(self::START_TIME);
    }

    /**
     * Set start_time
     * @param string $startTime
     * @return \Bluecom\Scheduled\Api\Data\ScheduledInterface
     */
    public function setStartTime($startTime)
    {
        return $this->setData(self::START_TIME, $startTime);
    }

    /**
     * Get end_time
     * @return string|null
     */
    public function getEndTime()
    {
        return $this->_get(self::END_TIME);
    }

    /**
     * Set end_time
     * @param string $endTime
     * @return \Bluecom\Scheduled\Api\Data\ScheduledInterface
     */
    public function setEndTime($endTime)
    {
        return $this->setData(self::END_TIME, $endTime);
    }

    /**
     * Get scheduled_import_id
     * @return string|null
     */
    public function getScheduledImportId()
    {
        return $this->_get(self::SCHEDULED_IMPORT_ID);
    }

    /**
     * Set scheduled_import_id
     * @param string $scheduledImportId
     * @return \Bluecom\Scheduled\Api\Data\ScheduledInterface
     */
    public function setScheduledImportId($scheduledImportId)
    {
        return $this->setData(self::SCHEDULED_IMPORT_ID, $scheduledImportId);
    }

    /**
     * Get status
     * @return string|null
     */
    public function getStatus()
    {
        return $this->_get(self::STATUS);
    }

    /**
     * Set status
     * @param string $status
     * @return \Bluecom\Scheduled\Api\Data\ScheduledInterface
     */
    public function setStatus($status)
    {
        return $this->setData(self::STATUS, $status);
    }

    /**
     * Get scheduled_backup_import_id
     * @return string|null
     */
    public function getScheduledBackupImportId()
    {
        return $this->_get(self::SCHEDULED_BACKUP_IMPORT_ID);
    }

    /**
     * Set scheduled_backup_import_id
     * @param string $scheduledBackupImportId
     * @return \Bluecom\Scheduled\Api\Data\ScheduledInterface
     */
    public function setScheduledBackupImportId($scheduledBackupImportId)
    {
        return $this->setData(self::SCHEDULED_BACKUP_IMPORT_ID, $scheduledBackupImportId);
    }
}