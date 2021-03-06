<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\web\View;

/* @var $this yii\web\View */
/* @var $model app\models\PerfilAbogado */
/* @var $form yii\widgets\ActiveForm */
$const = require(__DIR__ . '/../../config/constants.php');

$categorias = $const['categories'];
?>

<div class="perfil-abogado-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype'=>'multipart/form-data']]); ?>

                <div class="row">
                    <div class="col-md-6">
                        <?= $form->field($model, 'nombres')->textInput() ?>
                    </div>
                    <div class="col-md-6">
                        <?= $form->field($model, 'apellidos')->textInput() ?>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <?= $form->field($model, 'documento_identidad')->textInput()->widget(\yii\widgets\MaskedInput::className(), ['mask' => '999-9999999-9',])  ?>
                    </div>
                    <div class="col-md-6">
                        <?= $form->field($model, 'telefono_oficina')->textInput()->widget(\yii\widgets\MaskedInput::className(), ['mask' => '9999999999',]) ?>
                    </div>
                    <!--<div class="col-md-6">
                        <?= $form->field($model, 'foto_documento_identidad')->fileInput() ?>
                    </div>-->
                </div>
                <div class="row">
                    
                    <div class="col-md-6">
                        <?= $form->field($model, 'celular')->textInput()->widget(\yii\widgets\MaskedInput::className(), ['mask' => '9999999999',] ) ?>
                    </div>
                </div>

                    <div class="row">
                        
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <?= $form->field($model, 'fk_nacionalidad')->dropDownList(ArrayHelper::map($nacionalidad,'id','nombre'),
                            ['prompt'=> 'Seleccione su nacionalidad','onchange'=>'habilitar_campo(this,"#abogadoform-provincia")']) ?>
                        </div>
                        <div class="col-md-4">
                            <label>Provincia</label>
                            <?= Html::dropDownList('provincia',$model->fkMunicipio->fk_provincia,ArrayHelper::map($provincia, 'id', 'nombre'), 
                             ['prompt'=>'Seleccione la provincia','class'=>'form-control','id'=>'provincia', 'onchange'=>'cargar_municipio(this,"#perfilusuario-fk_municipio");habilitar_campo(this,"#perfilusuario-fk_municipio");']) ?>
                        </div>
                        <div class="col-md-4">
                            <?= $form->field($model, 'fk_municipio')->dropDownList(ArrayHelper::map($municipio,'id','nombre'),
                            ['prompt'=>'Seleccione el municipio','disabled'=>True]) ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <?= $form->field($model, 'categoria')->dropDownList($categorias,
                        ['prompt'=>'Seleccione una categoría']) ?>
                    </div>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Actualizar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>
<div class="panel-group">
  <div class="panel panel-default">
    <div class="panel-heading">
      <h4 class="panel-title">
        <a data-toggle="collapse" class="glyphicon glyphicon-chevron-right" href="#cambiar"> Cambiar Contraseña</a>
      </h4>
    </div>
    <div id="cambiar" class="panel-collapse collapse">
      <ul class="list-group">
        <li class="list-group-item">
          <?php $form = ActiveForm::begin([
          'action' => ['perfil-usuario/change-password', 'id'=> Yii::$app->user->id],
          'method' => 'post',
          ]); ?>
            <?= $form->field($changed_pass, 'old_password')->passwordInput() ?>
            <?= $form->field($changed_pass, 'password')->passwordInput() ?>
            <?= $form->field($changed_pass, 'confirm_password')->passwordInput() ?>
     
            <div class="form-group">
                <?= Html::submitButton('Cambiar', ['class' => 'btn btn-primary']) ?>
            </div>
        <?php ActiveForm::end(); ?>
        </li>
      </ul>
    </div>
  </div>
</div>
<?php 
    if ($plan){
?>
            <h3>
                Plan actual: 
                <?= $plan->nombre ?>
                <?php if ($iguala_user->slim){ echo "- slim"; } ?>
                <?php if ($iguala_user->med =="1"){ echo "- med"; } ?>
                <?php if ($iguala_user->plus =="1"){ echo "- plus"; } ?>
                </h3>
            <div class="form-group">
                <?= Html::a('Cancelar subscripción', ['/perfil-usuario/unsubscribe'], [
    'class' => 'btn btn-warning',
    'data' => ['confirm' => 'Seguro que desea Cancelar su subscripción de "'.$plan->nombre.'"? ', 'method' => 'post',],
]) ?>
            </div>
<?php 
    }
?>

</div>
<?php
    $this->registerJs(
        "var municipio = ".\yii\helpers\Json::htmlEncode($municipio).";",
        View::POS_HEAD,'municipio'
    );
    $script = <<< JS
    if($('#provincia').val()!=""){
        $('#perfilusuario-fk_municipio').removeAttr('disabled');
    }
    $('form').on('keyup keypress', function(e) {
        var keyCode = e.keyCode || e.which;
        if (keyCode === 13) { 
            e.preventDefault();
            return false;
        }
    });
JS;

    $this->registerJs($script);
?>