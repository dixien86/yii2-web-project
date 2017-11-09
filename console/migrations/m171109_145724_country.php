<?php

use yii\db\Schema;
use yii\db\Migration;

class m171109_145724_country extends Migration
{

    public function init()
    {
        $this->db = 'db';
        parent::init();
    }

    public function safeUp()
    {
        $tableOptions = 'ENGINE=InnoDB';

        $this->createTable(
            '{{%country}}',
            [
                'code'=> $this->char(2)->notNull(),
                'name'=> $this->char(52)->notNull(),
                'population'=> $this->integer(11)->notNull()->defaultValue(0),
            ],$tableOptions
        );
        $this->addPrimaryKey('pk_on_country','{{%country}}',['code']);

    }

    public function safeDown()
    {
    $this->dropPrimaryKey('pk_on_country','{{%country}}');
        $this->dropTable('{{%country}}');
    }
}
