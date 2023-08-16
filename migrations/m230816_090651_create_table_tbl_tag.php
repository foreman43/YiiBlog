<?php

use yii\db\Migration;

class m230816_090651_create_table_tbl_tag extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable(
            '{{%tbl_tag}}',
            [
                'id' => $this->tinyInteger()->notNull()->append('AUTO_INCREMENT PRIMARY KEY'),
                'name' => $this->string(20)->notNull(),
                'frequency' => $this->integer()->notNull(),
            ],
            $tableOptions
        );
    }

    public function safeDown()
    {
        $this->dropTable('{{%tbl_tag}}');
    }
}
