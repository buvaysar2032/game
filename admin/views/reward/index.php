<?php

use admin\components\GroupedActionColumn;
use admin\components\widgets\gridView\Column;
use admin\components\widgets\gridView\ColumnDate;
use admin\components\widgets\gridView\ColumnSelect2;
use admin\modules\rbac\components\RbacHtml;
use admin\widgets\sortableGridView\SortableGridView;
use common\components\export\ExportMenu;
use common\models\Gift;
use common\models\Reward;
use kartik\grid\SerialColumn;
use yii\helpers\Url;

/**
 * @var $this         yii\web\View
 * @var $searchModel  common\models\RewardSearch
 * @var $dataProvider yii\data\ActiveDataProvider
 * @var $model        common\models\Reward
 */

$this->title = Yii::t('app', 'Rewards');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="reward-index">

    <h1><?= RbacHtml::encode($this->title) ?></h1>

    <div>
        <?php
        // RbacHtml::a(Yii::t('app', 'Create Reward'), ['create'], ['class' => 'btn btn-success']);
        // $this->render('_create_modal', ['model' => $model]);
        ?>

        <div class="col-auto mr-auto">
            <?= ExportMenu::widget([
                'id' => 'users-export-menu',
                'dataProvider' => $dataProvider,
                'staticConfig' => Reward::class,
                'filename' => 'rewards_' . date('d-m-Y_H-i-s'),
                'batchSize' => 100,
            ]) ?>
        </div>
    </div>

    <?= SortableGridView::widget([
        'dataProvider' => $dataProvider,
        'pjax' => true,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => SerialColumn::class],

            Column::widget(),
            ColumnSelect2::widget([
                'attr' => 'user_id',
                'viewAttr' => 'user.username',
                'pathLink' => 'user/user',
                'editable' => false,
                'placeholder' => Yii::t('app', 'Search...'),
                'ajaxSearchConfig' => [
                    'url' => Url::to(['/user/user/list']),
                    'searchModel' => $searchModel
                ]
            ]),
            ColumnSelect2::widget(['attr' => 'gift_id', 'items' => Gift::getNamesList(), 'hideSearch' => true]),
            ColumnDate::widget(['attr' => 'created_at', 'searchModel' => $searchModel, 'editable' => false]),

            // ['class' => GroupedActionColumn::class]
        ]
    ]) ?>
</div>
