<?php

namespace app\models;

use yii\db\ActiveRecord;

/**
* Category Product
*/
class Product extends ActiveRecord {

  private $id;
  private $name;
  private $slug;
  private $stock;

  public function rules() {
    return [
      [['name', 'slug'], 'required'],
      [['category_id'], 'integer'],
    ];
  }

   public function getCategory() {
     return $this->hasOne(Category::className(), array('id' => 'category_id'));
  }
}
