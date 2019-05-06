<?php

namespace Bluecom\Scheduled\Cron;

use Magento\ScheduledImportExport\Controller\Adminhtml\Scheduled\Operation as OperationController;
use Magento\ScheduledImportExport\Model\Scheduled\Operation;
use Magento\Framework\App\Area;
use Magento\Framework\DataObject;

class Test extends OperationController
{
    /**
     * Run task through http request.
     *
     * @return void
     */
    public function execute()
    {
        $writer = new \Zend\Log\Writer\Stream(BP . '/var/log/scheduled.log');
        $logger = new \Zend\Log\Logger();
        $logger->addWriter($writer);
        $logger->info(__('Run'));
        $helper = $this->_objectManager->get('Bluecom\Scheduled\Helper\Data');
        $user_ts = strtotime($helper->getToday());
        $listItems = $helper->getScheduledList();
        $result = false;
        foreach ($listItems as $item) {
            $start_ts = strtotime($item->getStartTime());
            $end_ts = strtotime($item->getEndTime());
            if ($user_ts >= $start_ts && $user_ts<= $end_ts) {
                if ($item->getStatus() == 0) {
                    try {
                        $operationId = $item->getScheduledImportId();
                        $schedule = new DataObject();
                        $schedule->setJobCode(
                            Operation::CRON_JOB_NAME_PREFIX . $operationId
                        );

                        /*
                           We need to set default (frontend) area to send email correctly because we run cron task from backend.
                           If it wouldn't be done, then in email template resources will be loaded from adminhtml area
                           (in which we have only default theme) which is defined in preDispatch()

                           Add: After elimination of skins and refactoring of themes we can't just switch area,
                           cause we can't be sure that theme set for previous area exists in new one
                        */
                        /** @var \Magento\Framework\View\DesignInterface $design */
                        $design = $this->_objectManager->get(\Magento\Framework\View\DesignInterface::class);
                        $area = $design->getArea();
                        $theme = $design->getDesignTheme();
                        $design->setDesignTheme(
                            $design->getConfigurationDesignTheme(Area::AREA_FRONTEND),
                            Area::AREA_FRONTEND
                        );
                        /** @var \Magento\ScheduledImportExport\Model\Observer $result */
                        $result = $this->_objectManager->get(\Magento\ScheduledImportExport\Model\Observer::class)
                            ->processScheduledOperation($schedule, true);
                        // restore current design area and theme
                        $design->setDesignTheme($theme, $area);
                    } catch (\Exception $e) {
                        $logger->info($e->getMessage());
                    }

                    if ($result) {
                        $logger->info(__('The operation ran.'));
                        $logger->info('Finish CronJob');
                        $file_info =  $helper->getFileName($item->getScheduledImportId());
                        $dir = $helper->getRootPath().'/'.$file_info['file_path'];
                        if (file_exists($dir.$file_info['file_name'])) {
                            rename($dir.$file_info['file_name'], $dir."off.".$file_info['file_name']);
                            $logger->info('Finish Rename FIle');
                        }

                        try {
                            $model = $this->_objectManager->create(\Bluecom\Scheduled\Model\Scheduled::class)->load($item->getScheduledId());
                            $model->setStatus(1);
                            $model->save();
                            $logger->info('Change Status');
                        } catch (\Exception $e) {
                            $logger->info($e->getMessage());
                        }
                    } else {
                        $logger->info(__('We can\'t run the operation right now, see error log for details.'));
                    }

                }

            } else {

                if ($item->getStatus() == 1) {
                    try {
                        $operationId = $item->getScheduledBackupImportId();
                        $schedule = new DataObject();
                        $schedule->setJobCode(
                            Operation::CRON_JOB_NAME_PREFIX . $operationId
                        );

                        /*
                           We need to set default (frontend) area to send email correctly because we run cron task from backend.
                           If it wouldn't be done, then in email template resources will be loaded from adminhtml area
                           (in which we have only default theme) which is defined in preDispatch()

                           Add: After elimination of skins and refactoring of themes we can't just switch area,
                           cause we can't be sure that theme set for previous area exists in new one
                        */
                        /** @var \Magento\Framework\View\DesignInterface $design */
                        $design = $this->_objectManager->get(\Magento\Framework\View\DesignInterface::class);
                        $area = $design->getArea();
                        $theme = $design->getDesignTheme();
                        $design->setDesignTheme(
                            $design->getConfigurationDesignTheme(Area::AREA_FRONTEND),
                            Area::AREA_FRONTEND
                        );
                        /** @var \Magento\ScheduledImportExport\Model\Observer $result */
                        $result = $this->_objectManager->get(\Magento\ScheduledImportExport\Model\Observer::class)
                            ->processScheduledOperation($schedule, true);
                        // restore current design area and theme
                        $design->setDesignTheme($theme, $area);
                    } catch (\Exception $e) {
                        $logger->info($e->getMessage());
                    }

                    if ($result) {
                        $logger->info(__('The operation ran.'));
                        $logger->info('Finish Backup CronJob');
                        $file_info =  $helper->getFileName($item->getScheduledBackupImportId());

                        $dir = $helper->getRootPath().'/'.$file_info['file_path'];

                        if (file_exists($dir.$file_info['file_name'])) {
                            rename($dir.$file_info['file_name'], $dir."backup.".$file_info['file_name']);
                            $logger->info('Finish Rename Backup FIle');
                        }


                        try {
                            $model = $this->_objectManager->create(\Bluecom\Scheduled\Model\Scheduled::class)->load($item->getScheduledId());
                            $model->setStatus(0);
                            $model->save();
                            $logger->info('Change Status');
                        } catch (\Exception $e) {
                            $logger->info($e->getMessage());
                        }
                    } else {
                        $logger->info(__('We can\'t run the operation right now, see error log for details.'));
                    }
                }
            }
        }

    }
}
