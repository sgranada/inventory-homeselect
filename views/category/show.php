<?php

use yii\helpers\Html;

$this->title = 'Categorías';
?>
<!-- Page Heading -->
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">
            Detalle
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
                Ver categoría
            </li>
        </ol>
    </div>

</div>
<!-- /.row -->

<div class="row">
    <div class="col-lg-6">
        <div class="form-group">
            <label>Nombre de la categoría: </label> <?php echo $category->name ?>
        </div>
    </div>
    <div class="col-lg-12">
      <span><?= Html::a('Editar', ['edit', 'id' => $category->id], ['class' => 'btn btn-primary btn-sm']) ?></span>
    </div>
</div>

<!-- /.row -->
