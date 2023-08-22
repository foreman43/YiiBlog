<?php

use yii\db\Migration;

class m230816_090651_create_table_tbl_tag extends Migration
{
    public function safeUp()
    {

        $this->createTable(
            '{{%tbl_tag}}',
            [
                'id' => $this->tinyInteger()->notNull()->append('AUTO_INCREMENT PRIMARY KEY'),
                'name' => $this->string(20)->notNull(),
            ]
        );
    }

    public function safeDown()
    {
        $this->dropTable('{{%tbl_tag}}');
    }
}
