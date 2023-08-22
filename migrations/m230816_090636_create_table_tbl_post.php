<?php

use yii\db\Migration;

class m230816_090636_create_table_tbl_post extends Migration
{
    public function safeUp()
    {
        $this->createTable(
            '{{%tbl_post}}',
            [
                'id' => $this->primaryKey(),
                'title' => $this->string(128)->notNull(),
                'content' => $this->text()->notNull(),
                'status' => $this->tinyInteger()->defaultValue('1'),
                'created_at' => $this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP'),
                'updated_at' => $this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP'),
            ]
        );
    }

    public function safeDown()
    {
        $this->dropTable('{{%tbl_post}}');
    }
}
