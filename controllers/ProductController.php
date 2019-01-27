<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\web\Response;
use app\models\Inventory;
use app\models\Product;
use yii\data\Pagination;

class ProductController extends Controller {

  /**
   * Allows listing the products
   */
  public function actionIndex() {
      $query =  Product::find()->joinWith('category')->orderBy('product.id DESC');
      $count = $query->count();
      $pagination = new Pagination(['totalCount' => $count, 'defaultPageSize' => 8]);
      $products = $query->offset($pagination->offset)->limit($pagination->limit)->all();
      return $this->render('index', [
        'products' => $products,
        'pagination' => $pagination
      ]);
  }

  /**
   * Create a product
   */
  public function actionNew() {
      $product = new Product();

      $formData = Yii::$app->request->post();
      if ($product->load($formData)) {
        $name = strtolower($product->name);
        $slug = str_replace(' ', '', $name);
        $product->slug = $slug;
        $findProduct = Product::find()->where(['slug' => $product->slug, 'category_id' => $product->category_id])->one();
        if ($findProduct) {
          Yii::$app->getSession()->setFlash('error', 'Este producto ya existe');
        } else {
          if ($product->save()) {
            Yii::$app->getSession()->setFlash('success', 'Se ha creado un nuevo producto');
            return $this->redirect(['index']);
          } else {
            Yii::$app->getSession()->setFlash('error', 'No se pudo crear el producto');
          }
        }
      }
      return $this->render('new', [
        'product' => $product
      ]);
  }

  /**
   * Show a product
   */
  public function actionShow($id) {
      $product = Product::findOne($id);
      if (!$product) {
        return $this->redirect(['index']);
      }
      return $this->render('show', [
        'product' => $product
      ]);
  }


  /**
   * Edit a product
   */
  public function actionEdit($id) {
    $product = Product::findOne($id);
    if (!$product) {
      return $this->redirect(['index']);
    }

    if ($product->load(Yii::$app->request->post())) {
      $name = strtolower($product->name);
      $slug = str_replace(' ', '', $name);
      $product->slug = $slug;
      $findProduct = Product::find()->where(['slug' => $product->slug, 'category_id' => $product->category_id])->one();
      if ($findProduct) {
        Yii::$app->getSession()->setFlash('error', 'Este producto ya existe');
      } else {
        if ($product->save()) {
          Yii::$app->getSession()->setFlash('success', 'Se ha actualizado este producto');
          return $this->redirect(['index']);
        }
      }
    }

    return $this->render('edit', array('product' => $product));
  }

  /**
   * Create an inventory record
   */
  public function actionRegister($id) {
    $product = Product::findOne($id);
    $register = new Inventory();
    if (!$product) {
      return $this->redirect(['index']);
    }

    $formData = Yii::$app->request->post();
    if ($register->load($formData)) {
      if ($register->amount > 0) {
        $currentStock = $product->stock >= 0 ? $product->stock : 0;
        if ($register->action) {
          // Agrega al inventario
          $product->stock += $register->amount;
          $product->save(); // Actualiza el producto
          $register->product_id = $product->id;
          $register->stock = $product->stock;
          $register->save();

          Yii::$app->getSession()->setFlash('success', 'Se agregó satisfactoriamente al inventario');
          return $this->redirect(['index']);
        } else { // Descontar al inventario
          if ($register->amount <= $currentStock) {
            $product->stock -= $register->amount;
            $product->save(); // Actualiza el producto
            $register->product_id = $product->id;
            $register->stock = $product->stock;
            $register->save();
            Yii::$app->getSession()->setFlash('success', 'Se descontó satisfactoriamente del inventario');
            return $this->redirect(['index']);
          } else {
            Yii::$app->getSession()->setFlash('error', 'El valor supera la cantidad en Stock');
          }
        }
      } else {
        Yii::$app->getSession()->setFlash('error', 'El valor debe ser mayor a cero');
      }
    }

    return $this->render('register', [
      'product' => $product,
      'register' => $register
    ]);
  }

  /**
   * Delete a product
   */
  public function actionDelete() {
    if (Yii::$app->request->isAjax) {
      $data = Yii::$app->request->post();
      $idProduct = explode(":", $data['idProduct']);

      if ($idProduct && $idProduct[0]) {

        $product = Product::findOne($idProduct[0]);

        $isSuccess = false;

        if ($product && !isset($product->stock)) {
          $isSuccess = true;
          $product->delete();
        }
      }

      Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
      return [
          'success' => $isSuccess,
      ];
    }
  }

}
