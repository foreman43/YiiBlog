<?php

use yii\db\Migration;

class m230816_090822_create_table_tbl_lookup extends Migration
{
    public function safeUp()
    {
        $this->createTable(
            '{{%tbl_lookup}}',
            [
                'id' => $this->tinyInteger()->notNull()->append('AUTO_INCREMENT PRIMARY KEY'),
                'name' => $this->string(20)->notNull(),
                'code' => $this->tinyInteger()->notNull(),
            ]
        );

        $this->insert('{{%tbl_lookup}}', [
            'id' => 1,
            'name' => 'Опубликовано',
            'code' => 1
        ]);

        $this->insert('{{%tbl_lookup}}', [
            'id' => 2,
            'name' => 'Архив',
            'code' => 2
        ]);
    }

    public function safeDown()
    {
        $this->dropTable('{{%tbl_lookup}}');
    }
}
