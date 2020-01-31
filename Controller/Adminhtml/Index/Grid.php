<?php

namespace Web4Pro\CustomAuthorization\Controller\Adminhtml\Index;

use Magento\Backend\App\Action;
use Magento\Framework\View\Result\PageFactory;

class Grid extends Action
{
    const ADMIN_RESOURCE = 'Web4Pro_CustomAuthorization::login_grid';

    const PAGE_TITLE = 'Admin sessions as customers';

    protected $pageFactory;

    public function __construct(
        Action\Context $context,
        PageFactory $pageFactory
    ) {
        $this->pageFactory = $pageFactory;
        parent::__construct($context);
    }

    public function execute()
    {
        $resultPage = $this->pageFactory->create();
        $resultPage->getConfig()->getTitle()->prepend((__(static::PAGE_TITLE)));

        return $resultPage;
    }
}
