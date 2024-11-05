<?php

use yii\db\Migration;

/**
 * Class m241105_074911_add_last_attempt_reset_to_user_table
 */
class m241105_074911_add_last_attempt_reset_to_user_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%user}}', 'last_attempt_reset', $this->integer());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%user}}', 'last_attempt_reset');
    }
}
