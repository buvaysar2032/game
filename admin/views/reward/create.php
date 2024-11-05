<?php

use common\components\helpers\UserUrl;
use common\models\RewardSearch;
use yii\bootstrap5\Html;

/**
 * @var $this  yii\web\View
 * @var $model common\models\Reward
 */

$this->title = Yii::t('app', 'Create Reward');
$this->params['breadcrumbs'][] = [
    'label' => Yii::t('app', 'Rewards'),
    'url' => UserUrl::setFilters(RewardSearch::class)
];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="reward-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', ['model' => $model, 'isCreate' => true]) ?>

</div>
