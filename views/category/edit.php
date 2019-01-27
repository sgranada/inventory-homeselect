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
            Actualizar
            <span><?= Html::a('Lista de categorías', ['index'], ['class' => 'btn btn-default pull-right']) ?></span>
        </h1>
        <ol class="breadcrumb">
            <li>

                <span><?= Html::a('Inicio', ['index']) ?></span>
            </li>
            <li>
              <span><?= Html::a('Listado de categorías', ['index']) ?></span>
            </li>
            <li class="active">
                Actualizar categoría
            </li>
        </ol>
    </div>

</div>

<div class="row">
  <?php $form = ActiveForm::begin(); ?>
    <div class="col-lg-6">
        <div class="form-group">
            <?= $form->field($category, 'name')->label('Nombre de Categoría') ?>
        </div>
    </div>

    <div class="col-lg-12">
      <?= Html::submitButton('Actualizar categoría', ['class' => 'btn btn-primary']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>
