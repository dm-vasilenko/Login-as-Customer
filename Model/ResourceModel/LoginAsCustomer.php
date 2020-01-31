<?php

namespace Web4Pro\CustomAuthorization\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class LoginAsCustomer extends AbstractDb
{

    protected function _construct()
    {
        $this->_init('web4pro_login_as_customer', 'entity_id');
    }
}
