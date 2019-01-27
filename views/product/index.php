<?php

use yii\helpers\Html;
use yii\widgets\LinkPager;
use yii\helpers\Url;

$this->title = 'Productos';
?>
<!-- Page Heading -->
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">
            Productos
            <span><?= Html::a('Nuevo Producto', ['new'], ['class' => 'btn btn-primary pull-right']) ?></span>
        </h1>
        <ol class="breadcrumb">
            <li>
                <span><?= Html::a('Inicio', ['index']) ?></span>
            </li>
            <li class="active">
              Productos
            </li>
        </ol>
    </div>

</div>

<div class="row">
    <div class="col-lg-12">
        <h2>Listado de Productos</h2>
        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Nombre</th>
                        <th>Categoría</th>
                        <th>Cantidad en Bodega</th>
                        <th>Opciones</th>
                    </tr>
                </thead>
                <tbody>

                  <?php if (count($products) > 0): ?>
                    <?php foreach ($products as $product): ?>
                        <tr>
                            <td><?php echo $product->id; ?></td>
                            <td><?php echo $product->name; ?></td>
                            <td><?php echo $product->category->name; ?></td>
                            <td>
                              <?php if (isset($product->stock)): ?>
                                <?php echo $product->stock; ?>
                              <?php else:?>
                                <?php echo 'N/A'?>
                              <?php endif; ?>
                            </td>
                            <td>
                                <span><?= Html::a('Ver', ['show', 'id' => $product->id], ['class' => 'label label-primary']) ?></span>
                                <span><?= Html::a('Editar', ['edit', 'id' => $product->id], ['class' => 'label label-default']) ?></span>
                                <span><?= Html::a('Registrar inventario', ['register', 'id' => $product->id], ['class' => 'label label-info']) ?></span>
                                <?php if (!isset($product->stock)): ?>
                                  <span><?= Html::a('Eliminar', null, ['class' => 'label label-danger deleteProduct', 'data-id-product' => $product->id]) ?></span>
                               <?php endif; ?>
                            </td>
                        </tr>
                      <?php endforeach; ?>
                      <?php else: ?>
                        <tr>
                            <td colspan="5">No hay productos</td>
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

<?php
$url = Url::toRoute('delete');
$csrf = Yii::$app->request->getCsrfToken();
$script = <<< JS


$(".deleteProduct").click(function() {
  var idProduct = $(this).data( "id-product" );

  if (confirm("¿Desea eliminar este producto?")) {
    $.ajax({
       url: '$url',
       type: 'post',
       data: {
                 idProduct: idProduct,
                 _csrf : '$csrf'
             },
       success: function (data) {
          if (data.success) {
            alert('Producto eliminado con éxito');
            location.reload();
          } else {
            alert('No se pudo eliminar el producto');
          }
       }
  });


  }

});


JS;

$this->registerJs($script);
