<?php

namespace Web4Pro\CustomAuthorization\Model;

use Magento\Framework\Model\AbstractModel;
use Web4Pro\CustomAuthorization\Model\ResourceModel\LoginAsCustomer as ResourceModel;

class LoginAsCustomer extends AbstractModel
{
    public function _construct()
    {
        $this->_init(ResourceModel::class);
    }
}
