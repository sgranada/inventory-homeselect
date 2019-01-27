<?php

use yii\helpers\Html;
use yii\widgets\LinkPager;

$this->title = 'Inventario';
?>
<!-- Page Heading -->
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">
            Registro de inventario
        </h1>
        <ol class="breadcrumb">
            <li>
                <span><?= Html::a('Inicio', ['index']) ?></span>
            </li>
            <li class="active">
              Registro de inventario
            </li>
        </ol>
    </div>

</div>

<div class="row">
    <div class="col-lg-12">
        <h2>Listado de registros</h2>
        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Nombre de producto</th>
                        <th>Categoría del producto</th>
                        <th>Acción</th>
                        <th>Cantidad</th>
                        <th>Total en Stock</th>
                    </tr>
                </thead>
                <tbody>

                  <?php if (count($registers) > 0): ?>
                    <?php foreach ($registers as $register): ?>
                        <tr>
                            <td><?php echo $register->id; ?></td>
                            <td><?php echo $register->product->name; ?></td>
                            <td><?php echo $register->product->category->name; ?></td>
                            <td>
                              <?php if($register->action): ?>
                                <span class="badge progress-bar-success"><?php echo 'Agregó a Stock'; ?></span>
                              <?php else: ?>
                                <span class="badge progress-bar-danger"><?php echo 'Descontó de Stock'; ?></span>
                              <?php endif; ?>
                            </td>
                            <td><?php echo $register->amount; ?></td>
                            <td><?php echo $register->stock; ?></td>
                        </tr>
                      <?php endforeach; ?>
                      <?php else: ?>
                        <tr>
                            <td colspan="6">No hay registros</td>
                        </tr>
                      <?php endif; ?>

                </tbody>
            </table>
            <?php
             // display pagination
             echo LinkPager::widget([
                'pagination' => $pagination,
             ]);
          ?>

        </div>
    </div>
</div>
