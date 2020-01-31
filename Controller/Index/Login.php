<?php

namespace Web4Pro\CustomAuthorization\Controller\Index;

use Magento\Customer\Model\CustomerFactory;
use Magento\Customer\Model\Session;
use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;

class Login extends Action
{
    protected $customer;

    protected $customerSession;

    public function __construct(Context $context, CustomerFactory $customer, Session $session)
    {
        $this->customer = $customer;
        $this->customerSession = $session;
        parent::__construct($context);
    }

    public function execute()
    {
        $customerId = $this->getRequest()->getParam('customer_id');
        $customer = $this->customer->create()->load($customerId);

        if ($this->customerSession->isLoggedIn()) {
            $this->customerSession->logout();
        }
        $this->customerSession->setCustomerAsLoggedIn($customer);

        $resultRedirect = $this->resultRedirectFactory->create();
        $resultRedirect->setPath('customer/account');
        return $resultRedirect;
    }
}
