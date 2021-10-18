<?php

use Phalcon\Db\Column;
use Phalcon\Db\Exception;
use Phalcon\Db\Index;
use Phalcon\Db\Reference;
use Phalcon\Migrations\Mvc\Model\Migration;

/**
 * Class InvoiceDetailsMigration_101
 */
class InvoiceDetailsMigration_102 extends Migration
{
    /**
     * Define the table structure
     *
     * @return void
     * @throws Exception
     */
    public function morph(): void
    {
        $this->morphTable('invoice_details', [
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
                    'invoice_id',
                    [
                        'type' => Column::TYPE_INTEGER,
                        'notNull' => true,
                        'size' => 1,
                        'after' => 'id'
                    ]
                ),
                new Column(
                    'product_id',
                    [
                        'type' => Column::TYPE_INTEGER,
                        'notNull' => true,
                        'size' => 1,
                        'after' => 'invoice_id'
                    ]
                ),
                new Column(
                    'quantity',
                    [
                        'type' => Column::TYPE_INTEGER,
                        'notNull' => true,
                        'size' => 1,
                        'after' => 'product_id'
                    ]
                ),
                new Column(
                    'notes',
                    [
                        'type' => Column::TYPE_TEXT,
                        'notNull' => false,
                        'after' => 'quantity'
                    ]
                ),
            ],
            'indexes' => [
                new Index('PRIMARY', ['id'], 'PRIMARY'),
                new Index('fk_invoice_details_products_1', ['product_id'], ''),
                new Index('fk_invoice_details_invoices_1', ['invoice_id'], ''),
            ],
            'references' => [
                new Reference(
                    'fk_invoice_details_invoices_1',
                    [
                        'referencedSchema' => 'invoice',
                        'referencedTable' => 'invoices',
                        'columns' => ['invoice_id'],
                        'referencedColumns' => ['id'],
                        'onUpdate' => 'NO ACTION',
                        'onDelete' => 'NO ACTION'
                    ]
                ),
                new Reference(
                    'fk_invoice_details_products_1',
                    [
                        'referencedSchema' => 'invoice',
                        'referencedTable' => 'products',
                        'columns' => ['product_id'],
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
        self::$connection->insertAsDict(
            "invoice_details",
            [
                'invoice_id' => 1,
                'product_id' => 1,
                'quantity' => 3,
            ]
        );

        self::$connection->insertAsDict(
            "invoice_details",
            [
                'invoice_id' => 1,
                'product_id' => 4,
                'quantity' => 1,
            ]
        );

        self::$connection->insertAsDict(
            "invoice_details",
            [
                'invoice_id' => 1,
                'product_id' => 5,
                'quantity' => 1,
            ]
        );

        self::$connection->insertAsDict(
            "invoice_details",
            [
                'invoice_id' => 1,
                'product_id' => 6,
                'quantity' => 2,
            ]
        );

        self::$connection->insertAsDict(
            "invoice_details",
            [
                'invoice_id' => 2,
                'product_id' => 2,
                'quantity' => 2,
            ]
        );

        self::$connection->insertAsDict(
            "invoice_details",
            [
                'invoice_id' => 2,
                'product_id' => 6,
                'quantity' => 1,
            ]
        );

        self::$connection->insertAsDict(
            "invoice_details",
            [
                'invoice_id' => 2,
                'product_id' => 3,
                'quantity' => 1,
            ]
        );

        self::$connection->insertAsDict(
            "invoice_details",
            [
                'invoice_id' => 3,
                'product_id' => 1,
                'quantity' => 1,
            ]
        );

        self::$connection->insertAsDict(
            "invoice_details",
            [
                'invoice_id' => 3,
                'product_id' => 4,
                'quantity' => 1,
            ]
        );
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
