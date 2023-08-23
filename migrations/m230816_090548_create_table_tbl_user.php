<?php

use yii\db\Migration;

class m230816_090548_create_table_tbl_user extends Migration
{
    public function safeUp()
    {
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
            ]
        );

        $this->insert('{{%tbl_user}}', [
            'id' => 1,
            'username' => 'admin',
            'password' => Yii::$app->security->generatePasswordHash('admin'),
            'salt' => Yii::$app->security->generateRandomString(),
            'email' => 'admin@gmail.com',
            'auth_key' => Yii::$app->security->generateRandomString(),
            'access_token' => Yii::$app->security->generateRandomString()
        ]);

        $this->insert('{{%tbl_user}}', [
            'username' => 'demo',
            'password' => Yii::$app->security->generatePasswordHash('demo'),
            'salt' => Yii::$app->security->generateRandomString(),
            'email' => 'demo@gmail.com',
            'auth_key' => Yii::$app->security->generateRandomString(),
            'access_token' => Yii::$app->security->generateRandomString()
        ]);
    }

    public function safeDown()
    {
        $this->dropTable('{{%tbl_user}}');
    }
}
