<?php

use yii\db\Migration;

class m230816_090704_create_table_tbl_tag_post extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable(
            '{{%tbl_tag_post}}',
            [
                'id' => $this->primaryKey(),
                'post_id' => $this->integer()->notNull(),
                'tag_id' => $this->tinyInteger()->notNull(),
            ],
            $tableOptions
        );

        $this->createIndex('tag_id', '{{%tbl_tag_post}}', ['tag_id']);
        $this->createIndex('post_id', '{{%tbl_tag_post}}', ['post_id']);

        $this->addForeignKey(
            'tbl_tag_post_ibfk_1',
            '{{%tbl_tag_post}}',
            ['post_id'],
            '{{%tbl_post}}',
            ['id'],
            'CASCADE',
            'CASCADE'
        );
        $this->addForeignKey(
            'tbl_tag_post_ibfk_2',
            '{{%tbl_tag_post}}',
            ['tag_id'],
            '{{%tbl_tag}}',
            ['id'],
            'CASCADE',
            'CASCADE'
        );
    }

    public function safeDown()
    {
        $this->dropTable('{{%tbl_tag_post}}');
    }
}
