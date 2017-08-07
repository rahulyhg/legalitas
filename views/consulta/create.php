<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Consulta */

$this->title = 'Realizar Consulta';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="consulta-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>