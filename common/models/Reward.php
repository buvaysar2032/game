<?php

namespace common\models;

use common\components\export\ExportConfig;
use common\models\AppActiveRecord;
use common\modules\user\models\User;
use common\modules\user\Module;
use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveQuery;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "{{%reward}}".
 *
 * @property int           $id
 * @property int|null      $user_id
 * @property int|null      $gift_id
 * @property int|null      $created_at
 *
 * @property-read Gift     $gift
 * @property-read User     $user
 */
class Reward extends AppActiveRecord implements ExportConfig
{
    /**
     * {@inheritdoc}
     */
    public function behaviors(): array
    {
        return ArrayHelper::merge(parent::behaviors(), [
            'timestamp' => [
                'class' => TimestampBehavior::class,
                'updatedAtAttribute' => false,
            ]
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public static function tableName(): string
    {
        return '{{%reward}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules(): array
    {
        return [
            [['user_id', 'gift_id', 'created_at'], 'integer'],
            [['gift_id'], 'exist', 'skipOnError' => true, 'targetClass' => Gift::class, 'targetAttribute' => ['gift_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['user_id' => 'id']]
        ];
    }

    /**
     * {@inheritdoc}
     */
    final public function attributeLabels(): array
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'user_id' => Yii::t('app', 'User ID'),
            'gift_id' => Yii::t('app', 'Gift ID'),
            'created_at' => Yii::t('app', 'Created At'),
        ];
    }

    final public function getGift(): ActiveQuery
    {
        return $this->hasOne(Gift::class, ['id' => 'gift_id']);
    }

    final public function getUser(): ActiveQuery
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }

    public static function getColumns(): array
    {
        Module::initI18N();
        return [
            'id',
            'user_id',
            'gift_id',
            'created_at:datetime'
        ];
    }
}
