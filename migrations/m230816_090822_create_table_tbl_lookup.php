<?php

use yii\db\Migration;

class m230816_090822_create_table_tbl_lookup extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable(
            '{{%tbl_lookup}}',
            [
                'id' => $this->tinyInteger()->notNull()->append('AUTO_INCREMENT PRIMARY KEY'),
                'name' => $this->string(20)->notNull(),
                'code' => $this->tinyInteger()->notNull(),
            ],
            $tableOptions
        );
    }

    public function safeDown()
    {
        $this->dropTable('{{%tbl_lookup}}');
    }
}
