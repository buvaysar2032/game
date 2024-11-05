<?php

use yii\db\Migration;

/**
 * Class m241105_071357_add_attempts_count_to_user_table
 */
class m241105_071357_add_attempts_count_to_user_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%user}}', 'attempts_count', $this->integer()->defaultValue(0)); // Добавление счетчика попыток
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%user}}', 'attempts_count');
    }
}
