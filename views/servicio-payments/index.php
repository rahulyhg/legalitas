<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ServicioPaymentsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Registro de Uso de Servicios';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="servicio-payments-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            ['attribute'=>'servicio','value'=>'fkService.nombre'],
            ['attribute'=>'cliente','value'=>'fkUsersCliente.nombres'],
            ['attribute'=>'fkPayments.fecha','value'=>function($model){
                return date('d/m/Y',$model->fkPayments->fecha);
            }],

            ['class' => 'yii\grid\ActionColumn',
            'template'=>'{view}'],
        ],
    ]); ?>
</div>
