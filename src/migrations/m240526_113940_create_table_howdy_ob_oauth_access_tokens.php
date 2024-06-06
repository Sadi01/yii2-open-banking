<?php

use yii\db\Migration;

class m240526_113940_create_table_howdy_ob_oauth_access_tokens extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable(
            '{{%ob_oauth_access_tokens}}',
            [
                'id' => $this->primaryKey(),
                'access_token' => $this->string(2048)->notNull(),
                'client_id' => $this->string(32)->notNull(),
                'expires' => $this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP'),
                'scope' => $this->string(2000),
                'user_id' => $this->integer()->notNull(),
                'add_on' => $this->json()->defaultExpression('(JSON_OBJECT())'),
            ],
            $tableOptions
        );

        $this->createIndex('client_id', '{{%ob_oauth_access_tokens}}', ['client_id']);
        $this->createIndex('user_id', '{{%ob_oauth_access_tokens}}', ['user_id']);

        $this->addForeignKey(
            'howdy_ob_oauth_access_tokens_ibfk_1',
            '{{%ob_oauth_access_tokens}}',
            ['user_id'],
            '{{%user}}',
            ['id'],
            'CASCADE',
            'CASCADE'
        );
    }

    public function safeDown()
    {
        $this->dropTable('{{%ob_oauth_access_tokens}}');
    }
}
