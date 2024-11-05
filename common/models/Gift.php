<?php

namespace common\models;

use common\models\AppActiveRecord;
use Yii;
use yii\db\ActiveQuery;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "{{%gift}}".
 *
 * @property int           $id
 * @property int|null      $cashback_amount
 * @property int|null      $drop_chance
 *
 * @property-read Reward[] $rewards
 */
class Gift extends AppActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName(): string
    {
        return '{{%gift}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules(): array
    {
        return [
            [['cashback_amount', 'drop_chance'], 'integer']
        ];
    }

    /**
     * {@inheritdoc}
     */
    final public function attributeLabels(): array
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'cashback_amount' => Yii::t('app', 'Cashback Amount'),
            'drop_chance' => Yii::t('app', 'Drop Chance'),
        ];
    }

    final public function getRewards(): ActiveQuery
    {
        return $this->hasMany(Reward::class, ['gift_id' => 'id']);
    }

    public static function getNamesList(): array
    {
        return self::find()
            ->select(['CONCAT(cashback_amount, " кэшбэка")', 'id'])
            ->indexBy('id')
            ->column();
    }
}
