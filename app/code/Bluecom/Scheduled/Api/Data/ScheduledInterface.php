<?php


namespace Bluecom\Scheduled\Api\Data;

interface ScheduledInterface
{

    const STATUS = 'status';
    const END_TIME = 'end_time';
    const START_TIME = 'start_time';
    const SCHEDULED_BACKUP_IMPORT_ID = 'scheduled_backup_import_id';
    const SCHEDULED_ID = 'scheduled_id';
    const TITLE = 'title';
    const SCHEDULED_IMPORT_ID = 'scheduled_import_id';


    /**
     * Get scheduled_id
     * @return string|null
     */
    public function getScheduledId();

    /**
     * Set scheduled_id
     * @param string $scheduledId
     * @return \Bluecom\Scheduled\Api\Data\ScheduledInterface
     */
    public function setScheduledId($scheduledId);

    /**
     * Get title
     * @return string|null
     */
    public function getTitle();

    /**
     * Set title
     * @param string $title
     * @return \Bluecom\Scheduled\Api\Data\ScheduledInterface
     */
    public function setTitle($title);

    /**
     * Get start_time
     * @return string|null
     */
    public function getStartTime();

    /**
     * Set start_time
     * @param string $startTime
     * @return \Bluecom\Scheduled\Api\Data\ScheduledInterface
     */
    public function setStartTime($startTime);

    /**
     * Get end_time
     * @return string|null
     */
    public function getEndTime();

    /**
     * Set end_time
     * @param string $endTime
     * @return \Bluecom\Scheduled\Api\Data\ScheduledInterface
     */
    public function setEndTime($endTime);

    /**
     * Get scheduled_import_id
     * @return string|null
     */
    public function getScheduledImportId();

    /**
     * Set scheduled_import_id
     * @param string $scheduledImportId
     * @return \Bluecom\Scheduled\Api\Data\ScheduledInterface
     */
    public function setScheduledImportId($scheduledImportId);

    /**
     * Get status
     * @return string|null
     */
    public function getStatus();

    /**
     * Set status
     * @param string $status
     * @return \Bluecom\Scheduled\Api\Data\ScheduledInterface
     */
    public function setStatus($status);

    /**
     * Get scheduled_backup_import_id
     * @return string|null
     */
    public function getScheduledBackupImportId();

    /**
     * Set scheduled_backup_import_id
     * @param string $scheduledBackupImportId
     * @return \Bluecom\Scheduled\Api\Data\ScheduledInterface
     */
    public function setScheduledBackupImportId($scheduledBackupImportId);
}
