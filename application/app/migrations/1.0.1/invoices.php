<?php

use Phalcon\Db\Column;
use Phalcon\Db\Exception;
use Phalcon\Db\Index;
use Phalcon\Db\Reference;
use Phalcon\Migrations\Mvc\Model\Migration;

/**
 * Class InvoicesMigration_101
 */
class InvoicesMigration_101 extends Migration
{
    /**
     * Define the table structure
     *
     * @return void
     * @throws Exception
     */
    public function morph(): void
    {
        $this->morphTable('invoices', [
            'columns' => [
                new Column(
                    'id',
                    [
                        'type' => Column::TYPE_INTEGER,
                        'notNull' => true,
                        'autoIncrement' => true,
                        'size' => 1,
                        'first' => true
                    ]
                ),
                new Column(
                    'invoice_code',
                    [
                        'type' => Column::TYPE_INTEGER,
                        'unsigned' => true,
                        'notNull' => true,
                        'size' => 4,
                        'after' => 'id'
                    ]
                ),
                new Column(
                    'subject',
                    [
                        'type' => Column::TYPE_TEXT,
                        'notNull' => false,
                        'after' => 'invoice_code'
                    ]
                ),
                new Column(
                    'issue_date',
                    [
                        'type' => Column::TYPE_DATE,
                        'notNull' => true,
                        'after' => 'subject'
                    ]
                ),
                new Column(
                    'due_date',
                    [
                        'type' => Column::TYPE_DATE,
                        'notNull' => true,
                        'after' => 'issue_date'
                    ]
                ),
                new Column(
                    'for',
                    [
                        'type' => Column::TYPE_INTEGER,
                        'notNull' => true,
                        'size' => 1,
                        'after' => 'due_date'
                    ]
                ),
                new Column(
                    'from',
                    [
                        'type' => Column::TYPE_INTEGER,
                        'notNull' => true,
                        'size' => 1,
                        'after' => 'for'
                    ]
                ),
                new Column(
                    'is_paid',
                    [
                        'type' => Column::TYPE_ENUM,
                        'default' => "N",
                        'notNull' => true,
                        'size' => "'Y','N'",
                        'after' => 'from'
                    ]
                ),
                new Column(
                    'notes',
                    [
                        'type' => Column::TYPE_TEXT,
                        'notNull' => false,
                        'after' => 'is_paid'
                    ]
                ),
            ],
            'indexes' => [
                new Index('PRIMARY', ['id'], 'PRIMARY'),
                new Index('fk_invoices_customers_1', ['for'], ''),
                new Index('fk_invoices_customers_2', ['from'], ''),
            ],
            'references' => [
                new Reference(
                    'fk_invoices_customers_1',
                    [
                        'referencedSchema' => 'invoice',
                        'referencedTable' => 'customers',
                        'columns' => ['for'],
                        'referencedColumns' => ['id'],
                        'onUpdate' => 'NO ACTION',
                        'onDelete' => 'NO ACTION'
                    ]
                ),
                new Reference(
                    'fk_invoices_customers_2',
                    [
                        'referencedSchema' => 'invoice',
                        'referencedTable' => 'customers',
                        'columns' => ['from'],
                        'referencedColumns' => ['id'],
                        'onUpdate' => 'NO ACTION',
                        'onDelete' => 'NO ACTION'
                    ]
                ),
            ],
            'options' => [
                'TABLE_TYPE' => 'BASE TABLE',
                'AUTO_INCREMENT' => '',
                'ENGINE' => 'InnoDB',
                'TABLE_COLLATION' => 'utf8mb4_0900_ai_ci',
            ],
        ]);
    }

    /**
     * Run the migrations
     *
     * @return void
     */
    public function up(): void
    {
    }

    /**
     * Reverse the migrations
     *
     * @return void
     */
    public function down(): void
    {
    }
}
