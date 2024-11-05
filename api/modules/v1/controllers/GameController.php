<?php

namespace api\modules\v1\controllers;

use common\models\Gift;
use common\models\Reward;
use common\modules\user\models\User;
use Yii;

class GameController extends AppController
{
    public function actionIndex()
    {
        /** @var User $user */
        $user = Yii::$app->user->identity;

        if ($user->attempts_count <= 0) {
            return $this->returnError('Попыток не осталось');
        }

        $user->attempts_count--;
        $user->save();

        // Выбираем случайный подарок
        $gifts = Gift::find()->all();
        $selectedGift = $this->getRandomGift($gifts);

        // Сохраняем полученную награду
        $reward = new Reward();
        $reward->user_id = $user->id;
        $reward->gift_id = $selectedGift->id;
        $reward->created_at = time();
        $reward->save();

        return [
            'reward' => [
                'cashback_amount' => $selectedGift->cashback_amount,
                'drop_chance' => $selectedGift->drop_chance,
                'profile' => $user->profile, // кол-во доступных попыток и время до их восстановления
            ],
        ];

        //return $this->returnSuccess('Работает');
    }

    public function getRandomGift($gifts)
    {
        $totalChance = 0;
        foreach ($gifts as $gift) {
            $totalChance += $gift->drop_chance;
        }
        $random = mt_rand(1, $totalChance);
        $currentChance = 0;
        foreach ($gifts as $gift) {
            $currentChance += $gift->drop_chance;
            if ($random <= $currentChance) {
                return $gift;
            }
        }
        return null;
    }
}
