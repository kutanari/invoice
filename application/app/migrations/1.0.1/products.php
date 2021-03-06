<?php

use Phalcon\Db\Column;
use Phalcon\Db\Exception;
use Phalcon\Db\Index;
use Phalcon\Db\Reference;
use Phalcon\Migrations\Mvc\Model\Migration;

/**
 * Class ProductsMigration_101
 */
class ProductsMigration_101 extends Migration
{
    /**
     * Define the table structure
     *
     * @return void
     * @throws Exception
     */
    public function morph(): void
    {
        $this->morphTable('products', [
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
                    'name',
                    [
                        'type' => Column::TYPE_VARCHAR,
                        'notNull' => true,
                        'size' => 255,
                        'after' => 'id'
                    ]
                ),
                new Column(
                    'product_type_id',
                    [
                        'type' => Column::TYPE_INTEGER,
                        'notNull' => true,
                        'size' => 1,
                        'after' => 'name'
                    ]
                ),
                new Column(
                    'unit_price',
                    [
                        'type' => Column::TYPE_DECIMAL,
                        'notNull' => true,
                        'size' => 10,
                        'scale' => 2,
                        'after' => 'product_type_id'
                    ]
                ),
                new Column(
                    'notes',
                    [
                        'type' => Column::TYPE_TEXT,
                        'notNull' => false,
                        'after' => 'unit_price'
                    ]
                ),
            ],
            'indexes' => [
                new Index('PRIMARY', ['id'], 'PRIMARY'),
                new Index('fk_products_product_types_1', ['product_type_id'], ''),
            ],
            'references' => [
                new Reference(
                    'fk_products_product_types_1',
                    [
                        'referencedSchema' => 'invoice',
                        'referencedTable' => 'product_types',
                        'columns' => ['product_type_id'],
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
            "products",
            [
                'name' => 'Mobile App Demo Day',
                'product_type_id' => 2,
                'unit_price' => 1000000,
            ]
        );

        self::$connection->insertAsDict(
            "products",
            [
                'name' => 'Web App Demo Day',
                'product_type_id' => 2,
                'unit_price' => 1200000,
            ]
        );

        self::$connection->insertAsDict(
            "products",
            [
                'name' => 'Web App Development',
                'product_type_id' => 1,
                'unit_price' => 12000000,
            ]
        );

        self::$connection->insertAsDict(
            "products",
            [
                'name' => 'Mobile App Development Android',
                'product_type_id' => 1,
                'unit_price' => 9500000,
            ]
        );

        self::$connection->insertAsDict(
            "products",
            [
                'name' => 'Mobile App Development iOS',
                'product_type_id' => 1,
                'unit_price' => 11000000,
            ]
        );

        self::$connection->insertAsDict(
            "products",
            [
                'name' => 'Training Day',
                'product_type_id' => 2,
                'unit_price' => 10000000,
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
