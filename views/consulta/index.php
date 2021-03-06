<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ConsultaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Consultas';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="consulta-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_search',['model'=>$searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            //'fk_cliente',
            ['attribute'=>'cliente','value'=>function($model){ return $model->fkCliente->nombres.' '.$model->fkCliente->apellidos; }],
            ['attribute'=>'servicio','value'=>function($model){ return $model->fkServicio->nombre; }],
            //'fk_servicio',
            //'fk_abogado_asignado',
            ['attribute'=>'abogado_asignado','value'=>function($model){ 
                return ($model->fk_abogado_asignado !='' ? 
                    $model->fkAbogadoAsignado->nombres.' '.$model->fkAbogadoAsignado->apellidos:
                    $model->fk_abogado_asignado
                ); 
            }],
            'pregunta:ntext',
            // 'imagen',
            ['attribute'=>'finalizado','value'=>function($model){ return $model->finalizado ? "Si":"No";},
            'filter'=>array("0"=>"No","1"=>"Si"),],
            //'finalizado',
            ['attribute'=>'creado_en','value'=>function($model){
                return date('d-m-Y H:i:s',$model->creado_en);
            }],
            //'creado_en',
            ['attribute'=>'fecha_fin','value'=>function($model){
                return date('d-m-Y',strtotime($model->fecha_fin));
            }],
            //'fecha_fin',

            ['class' => 'yii\grid\ActionColumn',
                'template' => '{asignar}',
                'buttons' => [
                    'asignar' => function($url,$model)
                    {
                        return Html::a(
                        '<span class="glyphicon glyphicon-refresh"></span>',
                        ['asignar','id'=>$model->id]);
                    }
                ],
            ],
        ],
    ]); ?>
</div>
