<?php

namespace Web4Pro\CustomAuthorization\Plugin;

use Magento\Backend\Block\Widget\Button\Toolbar;

class OrderButton
{
    public function beforePushButtons(Toolbar $subject, $context, $buttonList)
    {
        if ($context->getOrder()) {
            $order = $context->getOrder();
            $url = $context->getUrl('custom/index/login', ['customer_id' => $order->getCustomerId()]);
            $isAllowed = $context->getAuthorization()->isAllowed('Web4Pro_CustomAuthorization::login_button');

            if (!$order->getCustomerIsGuest() && $isAllowed) {
                $buttonList->add(
                    'login_as_customer',
                    [
                        'label' => __('Login as customer'),
                        'onclick' => "window.open('{$url}')",
                    ]
                );
            }
        }
        return [$context, $buttonList];
    }
}
