<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Categorías';
?>
<!-- Page Heading -->
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">
            Nueva
        </h1>
        <ol class="breadcrumb">
            <li>
                <span><?= Html::a('Inicio', ['index']) ?></span>
            </li>
            <li>
              <span><?= Html::a('Listado de categorías', ['index']) ?></span>
            </li>
            <li class="active">
                Nueva Categoría
            </li>
        </ol>
    </div>

</div>
<!-- /.row -->
<div class="row">
  <?php $form = ActiveForm::begin(); ?>
    <div class="col-lg-6">
        <div class="form-group">
            <?= $form->field($category, 'name')->textInput(['autofocus' => true])->label('Nombre de Categoría') ?>
        </div>
    </div>

    <div class="col-lg-12">
      <?= Html::submitButton('Crear categoría', ['class' => 'btn btn-primary']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>
