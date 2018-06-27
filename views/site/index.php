<?php


use yii\grid\GridView;
/* @var $this yii\web\View */

$this->title = 'My Yii Application';
?>
<div class="site-index">

    <div class="body-content">

        <div class="row">
            <?php if (Yii::$app->session->getFlash('success')): ?>
                <div class="alert alert-success" role="alert">
                    <?= Yii::$app->session->getFlash('success'); ?>
                </div>
            <?php endif; ?>
            <h2>Users List</h2>

            <?php if (!Yii::$app->user->isGuest): ?>
                <div style="text-align: right">
                    <a class="btn btn-primary" href="<?= \yii\helpers\Url::toRoute('/site/new-user') ?>">New user</a>
                </div>
            <?php endif; ?>

            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
                    'name',
                    [
                        'attribute' => 'Position',
                        'format'    => 'raw',
                        'value'     => function ($dataProvider) {
                           return $dataProvider->getPositionName();
                        },
                    ],
                    [
                        'attribute' => 'Chief',
                        'format'    => 'raw',
                        'value'     => function ($dataProvider) {
                            return $dataProvider->getChiefName();
                        },
                    ],
                    'start_date',
                    'salary',
                    [
                        'attribute' => 'Photo',
                        'format'    => 'raw',
                        'value'     => function ($dataProvider) {
                            if($dataProvider->photo != NULL) {
                                return '<img style="width: 75px" src="' . \yii\helpers\Url::to( $dataProvider->photo) . '" />';
                            }
                            else{
                                return '----';
                            }
                        },
                    ],

                    [
                        'attribute' => '',
                        'format'    => 'raw',
                        'value'     => function ($dataProvider) {
                            return '<a href="' .\yii\helpers\Url::toRoute(['/site/edit', 'id' => $dataProvider->id]) . '">edit</a>';
                        },
                        'visible' => !Yii::$app->user->isGuest,
                    ],
                ],
            ]);
            ?>
        </div>
    </div>
</div>
