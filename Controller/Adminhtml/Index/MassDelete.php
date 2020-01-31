<?php

namespace Web4Pro\CustomAuthorization\Controller\Adminhtml\Index;

use Magento\Backend\App\Action;
use Magento\Ui\Component\MassAction\Filter;
use Psr\Log\LoggerInterface;
use Web4Pro\CustomAuthorization\Model\ResourceModel\LoginAsCustomer\CollectionFactory;

class MassDelete extends Action
{
    protected $filter;

    protected $collectionFactory;

    protected $logger;

    public function __construct(Action\Context $context, Filter $filter, CollectionFactory $collectionFactory, LoggerInterface $logger)
    {
        $this->collectionFactory = $collectionFactory;
        $this->filter = $filter;
        $this->logger = $logger;
        parent::__construct($context);
    }

    public function execute()
    {
        $collection = $this->filter->getCollection($this->collectionFactory->create());
        $collectionSize = $collection->getSize();
        foreach ($collection as $item) {
            try {
                $item->delete();
            } catch (\Exception $e) {
                $this->logger->error($e->getMessage());
                $this->messageManager->addErrorMessage(__('Session with id %1 not deleted', $item->getId()));
            }
        }
        $this->messageManager->addSuccessMessage(__('A total of %1 record(s) have been deleted.', $collectionSize));
        return $this->resultRedirectFactory->create()->setPath('*/*/grid');
    }
}
