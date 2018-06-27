<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var array $position
 * @var array $users
 * @var \app\models\User $model
 */


$this->title = 'Edit user';
?>
<div class="site-index">

    <div class="body-content">

        <div class="row">
            <div class="col-lg-12">
                <?php if(Yii::$app->session->getFlash('error')): ?>
                    <div class="alert alert-danger" role="alert">
                        <?= Yii::$app->session->getFlash('error'); ?>
                    </div>

                <?php elseif (Yii::$app->session->getFlash('success')): ?>
                    <div class="alert alert-success" role="alert">
                        <?=Yii::$app->session->getFlash('success'); ?>
                    </div>
                <?php endif; ?>
            </div>
            <div class="col-md-4">
                <?php
                $form = ActiveForm::begin([
                    'options' => ['class' => 'form-horizontal'],
                ])
                ?>

                <?= $form->field($model, 'name') ?>
                <?= $form->field($model, 'position_id')->dropDownList($position) ?>
                <?= $form->field($model, 'chief')->dropDownList($users) ?>

                <?= $form->field($model, 'salary') ?>
                <?= $form->field($model, 'login') ?>
                <?= $form->field($model, 'pass') ?>
                <?= $form->field($model, 'start_date')->widget(\yii\jui\DatePicker::classname(), [
                    'language' => 'ru-Ru',
                    'dateFormat' => 'yyyy-MM-dd',
                    'clientOptions' => [
                        'yearRange' => '1956:2019',
                        'changeMonth' => 'true',
                        'changeYear' => 'true',
                        'firstDay' => '1',
                    ]
                ]);?>
            </div>

            <div class="col-md-6">
                <br/>
                <?php if ($model->photo != NULL): ?>
                    <img style="width: 100%;" src="<?= \yii\helpers\Url::to($model->photo) ?>" alt="user">
                    <br/>
                    <br/>
                <?php endif; ?>
                <?= $form->field($model, 'imageFile')->fileInput() ?>
            </div>

            <div class="form-group">
                <div class="col-lg-offset-1 col-lg-11">
                    <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
                </div>
            </div>
            <?php ActiveForm::end() ?>
        </div>
    </div>
</div>
