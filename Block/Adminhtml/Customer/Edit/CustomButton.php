<?php

namespace Web4Pro\CustomAuthorization\Block\Adminhtml\Customer\Edit;

use Magento\Backend\Block\Widget\Context;
use Magento\Customer\Block\Adminhtml\Edit\GenericButton;
use Magento\Framework\Registry;
use Magento\Framework\View\Element\UiComponent\Control\ButtonProviderInterface;

class CustomButton extends GenericButton implements ButtonProviderInterface
{
    protected $_authorization;

    /**
     * Constructor
     *
     * @param Context $context
     * @param Registry $registry
     */
    public function __construct(
        Context                       $context,
        Registry                      $registry
    ) {
        parent::__construct($context, $registry);
        $this->_authorization = $context->getAuthorization();
    }

    public function getButtonData()
    {
        $customerId = $this->getCustomerId();

        $canModify = $customerId && $this->_authorization->isAllowed('Web4Pro_CustomAuthorization::login_button');

        // confirm message
//        $message = __('Are you sure you want to do this?');
        if ($canModify) {
            return [
                'label' => __('Log in as customer'),
                'on_click' => "window.open('{$this->getCustomUrl()}')",
                'sort_order' => -1,
                'target' => '_blank'

            ];
        }
        return [];
    }

    public function getCustomUrl()
    {
        return $this->getUrl('custom/index/login', ['customer_id' => $this->getCustomerId()]);
    }
}
