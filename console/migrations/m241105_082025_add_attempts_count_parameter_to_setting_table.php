<?php

use yii\db\Migration;

/**
 * Class m241105_082025_add_attempts_count_parameter_to_setting_table
 */
class m241105_082025_add_attempts_count_parameter_to_setting_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->insert('{{%setting}}', [
            'parameter' => 'attempts_count',
            'value' => '3',
            'description' => 'Количество попыток',
            'type' => 'number'
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->delete('{{%setting}}', ['parameter' => 'attempts_count']);
    }
}
