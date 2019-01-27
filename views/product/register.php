<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\bootstrap\ActiveForm;
use app\models\Category;

$this->title = 'Productos';
?>
<!-- Page Heading -->
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">
            Registrar inventario - <?php echo $product->name ?>
        </h1>
        <ol class="breadcrumb">
            <li>
                <span><?= Html::a('Inicio', ['index']) ?></span>
            </li>
            <li>
              <span><?= Html::a('Listado de productos', ['index']) ?></span>
            </li>
            <li class="active">
                Registro de inventario
            </li>
        </ol>
    </div>

</div>
<!-- /.row -->
<div class="row">
  <?php $form = ActiveForm::begin(); ?>
    <div class="col-lg-6">
      <div class="form-group">
          <?= $form->field($register, 'action')->dropDownList(['1' => 'Agregar', '0' => 'Descontar'])->label('Acción'); ?>
      </div>
      <div class="form-group">
          <?= $form->field($register, 'amount')->textInput(['class' => 'form-control number'])->label('Cantidad a registrar') ?>
      </div>
    </div>

    <div class="col-lg-12">
      <?= Html::submitButton('Registrar', ['class' => 'btn btn-primary']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>

<?php
$script = <<< JS

$(".number").keypress(function (e) {
  if ((e.which >=48 && e.which <= 57)||e.which == 8||e.which == 9||e.which == 0||e.which==45||e.which==47) {
  return true;
  }
  else{
  return false;
  }

});

JS;

$this->registerJs($script);
