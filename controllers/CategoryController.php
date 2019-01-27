<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\web\Response;
use app\models\Category;
use yii\data\Pagination;

class CategoryController extends Controller {

  /**
   * Allows listing the categories
   */
  public function actionIndex() {
      $query =  Category::find()->orderBy('id DESC');;
      $count = $query->count();
      $pagination = new Pagination(['totalCount' => $count, 'defaultPageSize' => 8]);
      $categories = $query->offset($pagination->offset)->limit($pagination->limit)->all();

      return $this->render('index', [
        'categories' => $categories,
        'pagination' => $pagination
      ]);
  }

  /**
   * Create a category
   */
  public function actionNew() {
      $category = new Category();

      $formData = Yii::$app->request->post();
      if ($category->load($formData)) {
        $name = strtolower($category->name);
        $slug = str_replace(' ', '', $name);
        $category->slug = $slug;
        $findCategory = Category::find()->where(['slug' => $category->slug])->one();
        if ($findCategory) {
          Yii::$app->getSession()->setFlash('error', 'Esta categoría ya existe');
        } else {
          if ($category->save()) {
            Yii::$app->getSession()->setFlash('success', 'Se ha creado una nueva categoría');
            return $this->redirect(['index']);
          } else {
            Yii::$app->getSession()->setFlash('error', 'No se pudo crear la categoría');
          }
        }
      }
      return $this->render('new', [
        'category' => $category
      ]);
  }

  /**
   * Show a category
   */
  public function actionShow($id) {
      $category = Category::findOne($id);
      if (!$category) {
        return $this->redirect(['index']);
      }
      return $this->render('show', [
        'category' => $category
      ]);
  }


  /**
   * Edit a category
   */
  public function actionEdit($id) {
    $category = Category::findOne($id);
    if (!$category) {
      return $this->redirect(['index']);
    }

    if ($category->load(Yii::$app->request->post())) {
      $name = strtolower($category->name);
      $slug = str_replace(' ', '', $name);
      $category->slug = $slug;
      $findCategory = Category::find()->where(['slug' => $category->slug])->one();
      if ($findCategory) {
        Yii::$app->getSession()->setFlash('error', 'Esta categoría ya existe');
      } else {
        if ($category->save()) {
          Yii::$app->getSession()->setFlash('success', 'Se ha actualizado esta categoría');
          return $this->redirect(['index']);
        }
      }
    }

    return $this->render('edit', array('category' => $category));
  }

  /**
   * Delete a category
   */
  public function actionDelete() {

    if (Yii::$app->request->isAjax) {
      $data = Yii::$app->request->post();
      $idCategory = explode(":", $data['idCategory']);

      if ($idCategory && $idCategory[0]) {

        $result = Category::find()
        -> rightJoin('product', 'product.category_id = category.id')
        ->where(['=', 'category.id', $idCategory[0]])
        ->one();

        $isSuccess = false;

        if (!$result) {
          $isSuccess = true;
          $category = Category::findOne($idCategory[0]);
          $category->delete();
        }
      }


      Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
      return [
          'success' => $isSuccess,
      ];
    }
  }

}
