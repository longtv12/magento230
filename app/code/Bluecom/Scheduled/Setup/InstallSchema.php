<?php


namespace Bluecom\Scheduled\Setup;

use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;

class InstallSchema implements InstallSchemaInterface
{

    /**
     * {@inheritdoc}
     */
    public function install(
        SchemaSetupInterface $setup,
        ModuleContextInterface $context
    ) {
        $table_bluecom_scheduled_scheduled = $setup->getConnection()->newTable($setup->getTable('bluecom_scheduled_scheduled'));

        $table_bluecom_scheduled_scheduled->addColumn(
            'scheduled_id',
            \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
            null,
            ['identity' => true,'nullable' => false,'primary' => true,'unsigned' => true,],
            'Entity ID'
        );

        $table_bluecom_scheduled_scheduled->addColumn(
            'title',
            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            null,
            [],
            'title'
        );

        $table_bluecom_scheduled_scheduled->addColumn(
            'start_time',
            \Magento\Framework\DB\Ddl\Table::TYPE_DATETIME,
            null,
            [],
            'start_time'
        );

        $table_bluecom_scheduled_scheduled->addColumn(
            'end_time',
            \Magento\Framework\DB\Ddl\Table::TYPE_DATETIME,
            null,
            [],
            'end_time'
        );

        $table_bluecom_scheduled_scheduled->addColumn(
            'scheduled_import_id',
            \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
            null,
            ['nullable' => True],
            'scheduled_import_id'
        );

        $table_bluecom_scheduled_scheduled->addColumn(
            'scheduled_backup_import_id',
            \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
            null,
            ['nullable' => True],
            'scheduled_backup_import_id'
        );

        $table_bluecom_scheduled_scheduled->addColumn(
            'status',
            \Magento\Framework\DB\Ddl\Table::TYPE_BOOLEAN,
            null,
            ['default' => '0','nullable' => False],
            'status'
        );

        $setup->getConnection()->createTable($table_bluecom_scheduled_scheduled);
    }
}
