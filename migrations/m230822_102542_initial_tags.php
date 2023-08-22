<?php

use yii\db\Migration;

/**
 * Class m230822_102542_initial_tags
 */
class m230822_102542_initial_tags extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->insert('{{%tbl_tag}}', [
            'name' => 'Общее'
        ]);

        $this->insert('{{%tbl_tag}}', [
            'name' => 'Тест'
        ]);

        $this->insert('{{%tbl_tag}}', [
            'name' => 'Тест 2'
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->delete('{{%tbl_tag}}', [
            'name' => 'Общее'
        ]);

        $this->delete('{{%tbl_tag}}', [
            'name' => 'Тест'
        ]);

        $this->delete('{{%tbl_tag}}', [
            'name' => 'Тест 2'
        ]);
    }
}
