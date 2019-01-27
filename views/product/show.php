<?php

use yii\helpers\Html;

$this->title = 'Productos';
?>
<!-- Page Heading -->
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">
            Detalle
            <span><?= Html::a('Lista de productos', ['index'], ['class' => 'btn btn-default pull-right']) ?></span>
        </h1>
        <ol class="breadcrumb">
            <li>

                <span><?= Html::a('Inicio', ['index']) ?></span>
            </li>
            <li>
              <span><?= Html::a('Listado de productos', ['index']) ?></span>
            </li>
            <li class="active">
                Ver Producto
            </li>
        </ol>
    </div>

</div>
<!-- /.row -->

<div class="row">
    <div class="col-lg-6">
        <div class="form-group">
            <label>Nombre del producto: </label>
            <p><?php echo $product->name ?></p>
        </div>
        <div class="form-group">
            <label>Nombre de la categoría: </label>
            <p><?php echo $product->category->name ?></p>
        </div>
        <div class="form-group">
            <label>Cantidad en Bodega: </label>
            <p>
              <?php if (isset($product->stock)): ?>
              <?php echo $product->stock; ?>
            <?php else:?>
              <?php echo 'N/A'?>
            <?php endif; ?>
          </p>
        </div>
    </div>
    <div class="col-lg-12">
      <span><?= Html::a('Editar', ['edit', 'id' => $product->id], ['class' => 'btn btn-primary btn-sm']) ?></span>
    </div>
</div>

<!-- /.row -->
