<?php

use yii\helpers\Html;
use yii\widgets\LinkPager;
use yii\helpers\Url;

$this->title = 'Categorías';
?>
<!-- Page Heading -->
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">
            Categoría de Productos
            <span><?= Html::a('Nueva Categoría', ['new'], ['class' => 'btn btn-primary pull-right']) ?></span>
        </h1>
        <ol class="breadcrumb">
            <li>
                <span><?= Html::a('Inicio', ['index']) ?></span>
            </li>
            <li class="active">
              Categoría de Productos
            </li>
        </ol>
    </div>

</div>

<div class="row">
    <div class="col-lg-6">
        <h2>Listado de Categorías</h2>
        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Nombre</th>
                        <th>Opciones</th>
                    </tr>
                </thead>
                <tbody>

                  <?php if (count($categories) > 0): ?>
                    <?php foreach ($categories as $category): ?>
                        <tr>
                            <td><?php echo $category->id; ?></td>
                            <td><?php echo $category->name; ?></td>
                            <td>
                                <span><?= Html::a('Ver', ['show', 'id' => $category->id], ['class' => 'label label-default']) ?></span>
                                <span><?= Html::a('Editar', ['edit', 'id' => $category->id], ['class' => 'label label-primary']) ?></span>
                                <span><?= Html::a('Eliminar', null, ['class' => 'label label-danger deleteCategory', 'data-id-category' => $category->id]) ?></span>
                            </td>
                        </tr>
                      <?php endforeach; ?>
                      <?php else: ?>
                        <tr>
                            <td colspan="3">No hay categorías</td>
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


$(".deleteCategory").click(function() {
  var idCategory = $(this).data( "id-category" );

  if (confirm("¿Desea eliminar esta categoría?")) {
    $.ajax({
       url: '$url',
       type: 'post',
       data: {
                 idCategory: idCategory,
                 _csrf : '$csrf'
             },
       success: function (data) {
          if (data.success) {
            alert('Categoría eliminada con éxito');
            location.reload();
          } else {
            alert('No se pudo eliminar la categoría');
          }
       }
  });


  }

});


JS;

$this->registerJs($script);

?>
