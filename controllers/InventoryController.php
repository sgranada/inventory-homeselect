<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\web\Response;
use app\models\Inventory;
use app\models\Product;
use yii\data\Pagination;

class InventoryController extends Controller {

  /**
   * Allows to list inventory records
   */
  public function actionIndex() {
      $query =  Inventory::find()->joinWith('product')->orderBy('inventory.id DESC');
      $count = $query->count();
      $pagination = new Pagination(['totalCount' => $count, 'defaultPageSize' => 8]);
      $registers = $query->offset($pagination->offset)->limit($pagination->limit)->all();
      return $this->render('index', [
        'registers' => $registers,
        'pagination' => $pagination
      ]);
  }
}
