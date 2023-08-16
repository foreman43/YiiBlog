<?php

use yii\db\Migration;

class m230816_090548_create_table_tbl_user extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable(
            '{{%tbl_user}}',
            [
                'id' => $this->primaryKey(),
                'username' => $this->string(20)->notNull(),
                'password' => $this->string()->notNull(),
                'salt' => $this->string()->notNull(),
                'email' => $this->string(25)->notNull(),
                'auth_key' => $this->string()->notNull(),
                'access_token' => $this->string()->notNull(),
            ],
            $tableOptions
        );
    }

    public function safeDown()
    {
        $this->dropTable('{{%tbl_user}}');
    }
}
