<?php

use yii\db\Schema;
use yii\db\Migration;

class m171109_150001_countryDataInsert extends Migration
{

    public function init()
    {
        $this->db = 'db';
        parent::init();
    }

    public function safeUp()
    {
        $this->batchInsert('{{%country}}',
                           ["code", "name", "population"],
                            [
    [
        'code' => 'AU',
        'name' => 'Australia',
        'population' => '18886000',
    ],
    [
        'code' => 'BR',
        'name' => 'Brazil',
        'population' => '170115000',
    ],
    [
        'code' => 'CA',
        'name' => 'Canada',
        'population' => '1147000',
    ],
    [
        'code' => 'CN',
        'name' => 'China',
        'population' => '1277558000',
    ],
    [
        'code' => 'DE',
        'name' => 'Germany',
        'population' => '82164700',
    ],
    [
        'code' => 'FR',
        'name' => 'France',
        'population' => '59225700',
    ],
    [
        'code' => 'GB',
        'name' => 'United Kingdom',
        'population' => '59623400',
    ],
    [
        'code' => 'IN',
        'name' => 'India',
        'population' => '1013662000',
    ],
    [
        'code' => 'RU',
        'name' => 'Russia',
        'population' => '146934000',
    ],
    [
        'code' => 'US',
        'name' => 'United States',
        'population' => '278357000',
    ],
]
        );
    }

    public function safeDown()
    {
        //$this->truncateTable('{{%country}} CASCADE');
    }
}
