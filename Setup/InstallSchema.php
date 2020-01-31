<?php

namespace Web4Pro\CustomAuthorization\Setup;

use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;

class InstallSchema implements InstallSchemaInterface
{
    public function install(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $installer = $setup;
        $installer->startSetup();

        $table = $setup->getConnection()->newTable(
            $setup->getTable(
                'web4pro_login_as_customer'
            )
        );

        $table->addColumn(
            'entity_id',
            \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
            null,
            ['identity' => true,'nullable' => false,'primary' => true,'unsigned' => true],
            'Entity ID'
        )->addColumn(
            'customer_id',
            \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
            null,
            [],
            'customer_id'
        )->addColumn(
            'customer_email',
            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            255,
            [],
            'customer_email'
        )->addColumn(
            'admin_username',
            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            255,
            [],
            'admin_username'
        )->addColumn(
            'admin_id',
            \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
            null,
            [],
            'admin_id'
        )->addColumn(
            'admin_name',
            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            255,
            [],
            'admin_name'
        )->addColumn(
            'created_at',
            \Magento\Framework\DB\Ddl\Table::TYPE_TIMESTAMP,
            null,
            ['default' => \Magento\Framework\DB\Ddl\Table::TIMESTAMP_INIT],
            'Date of Create'
        )->setComment('Admin authorization as customer table');

        $setup->getConnection()->createTable($table);

        $setup->endSetup();
    }
}
