<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%gift}}`.
 */
class m241105_070646_create_gift_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    final public function safeUp()
    {
        $this->createTable('{{%gift}}', [
            'id' => $this->primaryKey(),
            'cashback_amount' => $this->integer(),
            'drop_chance' => $this->integer(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    final public function safeDown()
    {
        $this->dropTable('{{%gift}}');
    }
}
