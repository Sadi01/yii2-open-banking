<?php

use yii\db\Migration;

class m240526_100020_create_table_howdy_ob_request_log extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable(
            '{{%ob_request_log}}',
            [
                'id' => $this->primaryKey(),
                'client_id' => $this->integer()->notNull(),
                'service_type' => $this->integer()->notNull(),
                'status' => $this->integer()->notNull(),
                'message' => $this->string(100),
                'transaction_id' => $this->string(30),
                'url' => $this->string()->notNull(),
                'method' => $this->string(5)->notNull(),
                'headers' => $this->json()->notNull(),
                'data' => $this->json()->notNull(),
                'response' => $this->json(),
                'created_at' => $this->integer()->notNull(),
                'created_by' => $this->integer()->notNull(),
            ],
            $tableOptions
        );
    }

    public function safeDown()
    {
        $this->dropTable('{{%ob_request_log}}');
    }
}
