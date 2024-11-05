<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%reward}}`.
 */
class m241105_071905_create_reward_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    final public function safeUp()
    {
        $this->createTable('{{%reward}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer(),
            'gift_id' => $this->integer(),
            'created_at' => $this->integer(),
        ]);

        $this->addForeignKey(
            'fk-reward-user_id',
            '{{%reward}}',
            'user_id',
            '{{%user}}',
            'id',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk-reward-gift_id',
            '{{%reward}}',
            'gift_id',
            '{{%gift}}',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    final public function safeDown()
    {
        $this->dropForeignKey('fk-reward-gift_id', '{{%reward}}');
        $this->dropForeignKey('fk-reward-user_id', '{{%reward}}');
        $this->dropTable('{{%reward}}');
    }
}
