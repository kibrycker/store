<?php

namespace app\controllers;

use Yii;
use app\models\Category;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\components\Translite;
use yii\web\UploadedFile;
use yii\helpers\Html;
use yii\helpers\Url;

/**
 * CategoryController implements the CRUD actions for Category model.
 */
class CategoryController extends Controller
{
    public $layout = '@app/views/layouts/main-admin.php';

    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Category models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Category::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Category model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Category model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        /*$is_admin = $is_moderator = 0;
        if(!Yii::$app->user->isGuest) {
            $user = User::findOne([Yii::$app->user->identity->id]);
            $is_admin = $user->is_admin;
            $is_moderator = $user->is_moderator;
        }
        if($is_moderator == 0 || $is_moderator == 0) {
            throw new HttpException(404 ,'Данная страница недоступна');
        }*/

        $model = new Category();
        if($model->load(Yii::$app->request->post())) {
            $model->logo = UploadedFile::getInstance($model, 'logo');
            //$file = false;
            //echo '<br /><br /><br /><br /><pre>';var_dump($model->logo, $model->logo->baseName, $model->logo->tempName);echo '</pre>';
            if($model->logo) {
                //$path = Yii::getAlias('@webroot/uploads/documents/');
                //$model->logo->saveAs($path . $file);
                $type = pathinfo($model->logo->tempName, PATHINFO_EXTENSION);
                $data = file_get_contents($model->logo->tempName);
                $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
                //$file = $model->logo->baseName . '.' . $model->logo->extension;
                $model->logo = $base64;
            }/**/

            $model->name = Html::encode(Yii::$app->request->post('Category')['name']);
            //$model->symbolik_name = Html::decode(Translite::getTranslite(Yii::$app->request->post('Category')['name']));
            $model->description = Html::decode(Yii::$app->request->post('Category')['description']);
            $model->status = Html::decode(Yii::$app->request->post('Category')['status']);
            //$model->user_create = Yii::$app->user->identity->id;
            //$model->date_created = date('Y-m-d H:i:s');
            //echo '<pre>';var_dump($model, Yii::$app->request->post());echo '</pre>';
            if($model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            } else {
                var_dump($model->errors);
            }
        }

        return $this->render('create', [
            'model' => $model,
        ]);

        /*if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);*/
    }

    /**
     * Updates an existing Category model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $model_logo = $model->logo;

        echo '<pre>';var_dump($model->logo);echo '</pre>';
        if($model->load(Yii::$app->request->post())) {
            $logo = UploadedFile::getInstance($model, 'logo');
            //$file = false;
            echo '<pre>';var_dump($logo);echo '</pre>';
            if($logo || !is_null($logo)) {
                //$path = Yii::getAlias('@webroot/uploads/documents/');
                //$model->logo->saveAs($path . $file);
                $type = pathinfo($logo->tempName, PATHINFO_EXTENSION);
                $data = file_get_contents($logo->tempName);
                $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
                //$file = $model->logo->baseName . '.' . $model->logo->extension;
                $model->logo = $base64;
            }/**/ else {
                $model->logo = $model_logo;
            }

            //require_once $_SERVER['DOCUMENT_ROOT']. '/components/Translite.php';
            $model->name = Html::encode(Yii::$app->request->post('Category')['name']);
            $model->symbolik_name = Html::decode(Yii::$app->request->post('Category')['symbolik_name']);
            $model->description = Html::decode(Yii::$app->request->post('Category')['description']);
            $model->status = Html::decode(Yii::$app->request->post('Category')['status']);
            //$model->user_create = Yii::$app->user->identity->id;
            //$model->date_created = date('Y-m-d H:i:s');
            //echo '<pre>';var_dump($model, Yii::$app->request->post());echo '</pre>';
            if($model->save()) {
                //return $this->redirect(['view', 'id' => $model->id]);
            } else {
                var_dump($model->errors);
            }/**/
        }
        /*if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }*/

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Category model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Category model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Category the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Category::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
