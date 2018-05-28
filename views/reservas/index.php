<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\grid\GridView;
use DateTime;
use DateInterval;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ReservasSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Reservas';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="reservas-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?php
    // var_dump($reservas);
    // die();
        $dias = [
            'mon' => 'Lunes',
            'tue' => 'Martes',
            'wed' => 'Miércoles',
            'thu' => 'Jueves',
            'fri' => 'Viernes',
        ];

        $reservasUser = [];
        $reservasOtrosUser = [];

        foreach ($reservas as $value) {
            if ($value['usuario_id'] == Yii::$app->user->id) {
                $reservasUser[] = $value['fecha'];
            } else {
                $reservasOtrosUser[] = $value['fecha'];
            }

        }

        $diaSemana = date('N');
        $dateTime = new DateTime();
        $dateTime->sub(new DateInterval("P{$diaSemana}D"));
        $dateTime->setTime(10,00);
    ?>

    <table>
        <tr>
            <?php foreach ($dias as $key => $value): ?>
                <td style='padding:20px'><?= $value ?></td>
            <?php endforeach; ?>
        </tr>

        <?php for ($i = 0; $i < 10; $i++): ?>
            <tr>
                <?php for ($j = 0; $j < 5; $j++): $dateTime->add(new DateInterval('P1D'))?>
                    <td data-dia="<?= ($fechaHora = $dateTime->format('Y-m-d H:i:s')) ?>" style='padding:20px'>
                        <?= $hora = ($dateTime->format('H:i')) ?>

                        <?php if (in_array($fechaHora, $reservasUser)): ?>
                            <p>TU RESERVA</p>
                            <?= Html::beginForm(['reservas/delete']); ?>

                            <?= Html::activeHiddenInput($model, 'dia', ['value' => $dateTime->format('Y-m-d')]) ?>

                            <?= Html::activeHiddenInput($model, 'hora', ['value' => $hora]) ?>

                            <?= Html::activeHiddenInput($model, 'usuario_id', ['value' => Yii::$app->user->id]) ?>

                            <div class="form-group">
                                <?= Html::submitButton('Cancelar', ['class' => 'btn btn-danger']) ?>
                            </div>

                            <?= Html::endForm() ?>
                        <?php else: ?>
                            <?php if (in_array($fechaHora, $reservasOtrosUser)): ?>
                                <p>reservada</p>
                            <?php else: ?>
                                <?= Html::beginForm(['reservas/create'], 'post'); ?>

                                <?= Html::activeHiddenInput($model, 'dia', ['value' => $dateTime->format('Y-m-d')]) ?>

                                <?= Html::activeHiddenInput($model, 'hora', ['value' => $hora]) ?>

                                <?= Html::activeHiddenInput($model, 'usuario_id', ['value' => Yii::$app->user->id]) ?>

                                <div class="form-group">
                                    <?= Html::submitButton('Reservar', ['class' => 'btn btn-success']) ?>
                                </div>

                                <?= Html::endForm() ?>
                            <?php endif; ?>
                        <?php endif; ?>
                    </td>
                <?php endfor; ?>
            </tr>
            <?php $dateTime->add(new DateInterval('PT1H')) ?>
            <?php $dateTime->sub(new DateInterval('P5D')) ?>
        <?php endfor; ?>
    </table>


</div>
