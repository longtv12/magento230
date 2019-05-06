<?php


namespace Bluecom\Scheduled\Controller\Adminhtml\Scheduled;

class Delete extends \Bluecom\Scheduled\Controller\Adminhtml\Scheduled
{
    protected $scheduledFactory;

    /**
     * @param \Magento\Backend\App\Action\Context $context
     * @param \Magento\Framework\Registry $coreRegistry
     * @param \Bluecom\Scheduled\Model\ScheduledFactory $scheduledFactory
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\Registry $coreRegistry,
        \Bluecom\Scheduled\Model\ScheduledFactory $scheduledFactory
    ) {
        $this->scheduledFactory = $scheduledFactory;
        parent::__construct($context, $coreRegistry);
    }
    /**
     * Delete action
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
         /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();
        // check if we know what should be deleted
        $id = $this->getRequest()->getParam('scheduled_id');
        if ($id) {
            try {
                // init model and delete
                $model = $this->scheduledFactory->create();
                $model->load($id);
                $model->delete();
                // display success message
                $this->messageManager->addSuccessMessage(__('You deleted the Scheduled.'));
                // go to grid
                return $resultRedirect->setPath('*/*/');
            } catch (\Exception $e) {
                // display error message
                $this->messageManager->addErrorMessage($e->getMessage());
                // go back to edit form
                return $resultRedirect->setPath('*/*/edit', ['scheduled_id' => $id]);
            }
        }
        // display error message
        $this->messageManager->addErrorMessage(__('We can\'t find a Scheduled to delete.'));
        // go to grid
        return $resultRedirect->setPath('*/*/');
    }
}
