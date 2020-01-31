<?php

namespace Web4Pro\CustomAuthorization\Controller\Adminhtml\Index;

use Magento\Backend\App\Action;
use Magento\Backend\Model\Auth\Session as AuthSession;
use Magento\Customer\Model\CustomerFactory;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Url;
use Psr\Log\LoggerInterface;
use Web4Pro\CustomAuthorization\Model\LoginAsCustomerFactory as ModelFactory;

class Login extends Action
{
    protected $customer;

    protected $authSession;

    protected $url;

    protected $modelFactory;

    protected $logger;

    public function __construct(
        Action\Context $context,
        CustomerFactory $customer,
        AuthSession $authSession,
        Url $url,
        ModelFactory $modelFactory,
        LoggerInterface $logger
    ) {
        $this->customer = $customer;
        $this->authSession = $authSession;
        $this->url = $url;
        $this->modelFactory = $modelFactory;
        $this->logger = $logger;
        parent::__construct($context);
    }

    public function execute()
    {
        $customerId = $this->getRequest()->getParam('customer_id');
        $customer = $this->customer->create()->load($customerId);
        $user = $this->authSession->getUser();

        $data =
            [
                'customer_id' => $customerId,
                'customer_email' => $customer->getEmail(),
                'admin_username' => $user->getUserName(),
                'admin_id' => $user->getId(),
                'admin_name' => $user->getFirstName(),

            ];
        $model = $this->modelFactory->create();
        $model->setData($data);
        try {
            $model->save();
        } catch (CouldNotSaveException $e) {
            $this->logger->error($e->getMessage());
        }

        $url = $this->url->setScope($customer->getStore());
        $redirectUrl = $url->getUrl(
            'custom_auth/index/login',
            ['customer_id' => $customerId,'_nosid' => true]
        );
        $this->getResponse()->setRedirect(
            $redirectUrl
        );
    }
}
