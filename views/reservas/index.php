<?php

use yii\helpers\Html;
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
        $dias = [
            'mon' => 'Lunes',
            'tue' => 'Martes',
            'wed' => 'Miércoles',
            'thu' => 'Jueves',
            'fri' => 'Viernes',
        ];

        $horas = [
            '10:00',
            '11:00',
            '12:00',
            '13:00',
            '14:00',
            '15:00',
            '16:00',
            '17:00',
            '18:00',
            '19:00',
        ];
        $diaSemana = date('N');
        $dateTime = new DateTime();
        $dateTime->sub(new DateInterval("P{$diaSemana}D"));

    ?>

    <table>
        <tr>
            <?php foreach ($dias as $key => $value): ?>
                <td style='padding:20px'><?= $value ?></td>
            <?php endforeach; ?>
        </tr>

        <?php foreach ($horas as $key => $value): ?>
            <tr>
                <?php for ($i = 0; $i < 5; $i++): $dateTime->add(new DateInterval('P1D'))?>
                    <td data-dia="<?= $dateTime->format('Y-m-d') ?>" style='padding:20px'><?= $value ?></td>
                <?php endfor; ?>
            </tr>
            <?php $dateTime->sub(new DateInterval('P5D')) ?>
        <?php endforeach; ?>
    </table>


</div>
