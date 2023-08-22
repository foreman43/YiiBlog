<?php

use yii\db\Migration;

class m230816_090802_create_table_tbl_comment extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable(
            '{{%tbl_comment}}',
            [
                'id' => $this->primaryKey(),
                'content' => $this->string(256)->notNull(),
                'approved' => $this->boolean()->defaultValue(0),
                'created_at' => $this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP'),
                'post_id' => $this->integer()->notNull(),
                'author_id' => $this->integer()->notNull(),
            ],
            $tableOptions
        );

        $this->createIndex('author_id', '{{%tbl_comment}}', ['author_id']);
        $this->createIndex('post_id', '{{%tbl_comment}}', ['post_id']);

        $this->addForeignKey(
            'tbl_comment_ibfk_1',
            '{{%tbl_comment}}',
            ['post_id'],
            '{{%tbl_post}}',
            ['id'],
            'RESTRICT',
            'CASCADE'
        );
        $this->addForeignKey(
            'tbl_comment_ibfk_2',
            '{{%tbl_comment}}',
            ['author_id'],
            '{{%tbl_user}}',
            ['id'],
            'CASCADE',
            'CASCADE'
        );
    }

    public function safeDown()
    {
        $this->dropTable('{{%tbl_comment}}');
    }
}
