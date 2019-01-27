<?php

namespace app\models;

use yii\db\ActiveRecord;

/**
* Category Inventory
*/
class Inventory extends ActiveRecord {

  private $id;
  private $action;
  private $amount;
  private $stock;

  public function rules() {
    return [
      [['action', 'amount'], 'required']
    ];
  }

  public function getProduct() {
    return $this->hasOne(Product::className(), array('id' => 'product_id'));
  }

}
