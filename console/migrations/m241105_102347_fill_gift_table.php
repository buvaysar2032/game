<?php

use yii\db\Migration;

/**
 * Class m241105_102347_fill_gift_table
 */
class m241105_102347_fill_gift_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->batchInsert('gift', ['cashback_amount', 'drop_chance'], [
            [10.00, 50],
            [20.00, 30],
            [30.00, 15],
            [50.00, 5],
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->delete('gift', ['cashback_amount' => [10.00, 20.00, 30.00, 50.00]]);
    }
}
