<?php

namespace Web4Pro\CustomAuthorization\Model\ResourceModel\LoginAsCustomer;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use Web4Pro\CustomAuthorization\Model\LoginAsCustomer as Model;
use Web4Pro\CustomAuthorization\Model\ResourceModel\LoginAsCustomer as ResourceModel;

class Collection extends AbstractCollection
{
    protected $_idFieldName = 'entity_id';

    public function _construct()
    {
        $this->_init(Model::class, ResourceModel::class);
    }
}
