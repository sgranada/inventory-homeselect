<?php

namespace app\models;

use yii\db\ActiveRecord;

/**
* Category table
*/
class Category extends ActiveRecord {

  private $id;
  private $name;
  private $slug;

  public function rules() {
    return [
      [['name'], 'required']
    ];
  }

  public function getProducts() {
    return $this->hasMany(Product::className(), array('category_id' => 'id'));
  }

}
