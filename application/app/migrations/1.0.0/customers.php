<?php

use Phalcon\Db\Column;
use Phalcon\Db\Exception;
use Phalcon\Db\Index;
use Phalcon\Db\Reference;
use Phalcon\Migrations\Mvc\Model\Migration;

/**
 * Class CustomersMigration_101
 */
class CustomersMigration_100 extends Migration
{
    /**
     * Define the table structure
     *
     * @return void
     * @throws Exception
     */
    public function morph(): void
    {
        $this->morphTable('customers', [
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
                    'address',
                    [
                        'type' => Column::TYPE_TEXT,
                        'notNull' => true,
                        'after' => 'name'
                    ]
                ),
                new Column(
                    'country_code',
                    [
                        'type' => Column::TYPE_VARCHAR,
                        'notNull' => true,
                        'size' => 8,
                        'after' => 'address'
                    ]
                ),
                new Column(
                    'city',
                    [
                        'type' => Column::TYPE_VARCHAR,
                        'notNull' => true,
                        'size' => 255,
                        'after' => 'country_code'
                    ]
                ),
                new Column(
                    'postcode',
                    [
                        'type' => Column::TYPE_VARCHAR,
                        'notNull' => true,
                        'size' => 16,
                        'after' => 'city'
                    ]
                ),
                new Column(
                    'notes',
                    [
                        'type' => Column::TYPE_TEXT,
                        'notNull' => false,
                        'after' => 'postcode'
                    ]
                ),
            ],
            'indexes' => [
                new Index('PRIMARY', ['id'], 'PRIMARY'),
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
            "customers",
            [    
                'name' => 'Cecilia Chapman',
                'address' => '711-2880 Nulla St. Mankato',
                'country_code' => 'us',
                'city' => 'Mississippi',
                'postcode' => '96522'
            ]
        );

        self::$connection->insertAsDict(
            "customers",
            [
                'name' => 'Sutarman',
                'address' => 'Jl. Sudirman, 1A',
                'country_code' => 'id',
                'city' => 'Jakarta',
                'postcode' => '23433'
            ]
        );

        self::$connection->insertAsDict(
            "customers",
            [
                'name' => 'Lie Wei',
                'address' => 'Zhi Chun Lu Han Rong Jia Yuan 1hao Lou 307',
                'country_code' => 'cn',
                'city' => 'Beijing',
                'postcode' => '130638'
            ]
        );

        self::$connection->insertAsDict(
            "customers",
            [    
                'name' => 'Anna Chapman',
                'address' => '12 st. Fernandes, New Mexico',
                'country_code' => 'us',
                'city' => 'Florida',
                'postcode' => '96522'
            ]
        );

        self::$connection->insertAsDict(
            "customers",
            [
                'name' => 'Gunawan',
                'address' => 'Jl. Gatot Subroto, 22',
                'country_code' => 'id',
                'city' => 'Bandung',
                'postcode' => '23454'
            ]
        );

        self::$connection->insertAsDict(
            "customers",
            [
                'name' => 'Xinxin',
                'address' => 'Zhi Jia Yuan Lou 123',
                'country_code' => 'cn',
                'city' => 'Wuhan',
                'postcode' => '234234'
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
