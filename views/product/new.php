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
            Nuevo
        </h1>
        <ol class="breadcrumb">
            <li>
                <span><?= Html::a('Inicio', ['index']) ?></span>
            </li>
            <li>
              <span><?= Html::a('Listado de productos', ['index']) ?></span>
            </li>
            <li class="active">
                Nuevo Producto
            </li>
        </ol>
    </div>

</div>
<!-- /.row -->
<div class="row">
  <?php $form = ActiveForm::begin(); ?>
    <div class="col-lg-6">
        <div class="form-group">
            <?= $form->field($product, 'name')->textInput(['autofocus' => true])->label('Nombre del Producto') ?>
        </div>

        <div class="form-group">
            <?= $form->field($product, 'category_id')->dropDownList(
              ArrayHelper::map(Category::find()->all(), 'id', 'name'))->label('Categoría'); ?>
        </div>
    </div>

    <div class="col-lg-12">
      <?= Html::submitButton('Crear producto', ['class' => 'btn btn-primary']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>
