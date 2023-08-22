<?php

use yii\db\Migration;

class m230816_090704_create_table_tbl_tag_post extends Migration
{
    public function safeUp()
    {
        $this->createTable(
            '{{%tbl_tag_post}}',
            [
                'id' => $this->primaryKey(),
                'post_id' => $this->integer()->notNull(),
                'tag_id' => $this->tinyInteger()->notNull(),
            ]
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
