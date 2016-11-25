<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;

use app\models\Order;
use yii\data\ActiveDataProvider;
use yii\web\NotFoundHttpException;

/**
 * OrderController implements the CRUD actions for Order model.
 */
class OrderController
    extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['index', 'view', 'create', 'update', 'delete', 'saloon', 'kitchen'],
                'rules' => [
                    [
                        'actions' => ['index', 'view'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                    [
                        'actions' => ['create', 'saloon'],
                        'allow' => true,
                        'roles' => ['waiter'],
                    ],
                    [
                        'actions' => ['update', 'kitchen'],
                        'allow' => true,
                        'roles' => ['cook'],
                    ],
                    [
                        'actions' => ['delete'],
                        'allow' => true,
                        'roles' => ['admin'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Order models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Order::find()
                ->orderBy('id DESC')
                ->joinWith('owner'),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Order model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Order model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Order();
        $model->owner_id = Yii::$app->user->id;
        $model->condition = 'new';

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['saloon']);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Order model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $model->estimated_time = date("Y-m-d H:i", strtotime($model->estimated_time ?: 'now'));

        if ($model->load(Yii::$app->request->post())) {
            if ($model->estimated_time && $model->condition != 'ready')
                $model->condition = 'pending';
            $model->save();

            return \Yii::$app->user->can('admin') ?
                $this->redirect(['index']) :
                $this->redirect(['kitchen']);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Order model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Order model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Order the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Order::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }



    /**
     * Displays saloon page.
     *
     * @return string
     */
    public function actionSaloon()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Order::find()
                ->orderBy('id DESC')
                ->joinWith('owner'),
        ]);

        return $this->render('saloon', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays kitchen page.
     *
     * @return string
     */
    public function actionKitchen()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Order::find()
                ->where('`condition` != \'ready\'')
                ->orderBy('id DESC')
                ->joinWith('owner'),
        ]);

        return $this->render('kitchen', [
            'dataProvider' => $dataProvider,
        ]);
    }
}
