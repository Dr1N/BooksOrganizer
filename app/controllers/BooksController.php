<?php

namespace app\controllers;

use Yii;
use app\models\Books;
use app\models\Authors;
use app\models\SearchForm;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;
use yii\web\UploadedFile;

use app\components\SessionAction;

/**
 * BooksController implements the CRUD actions for Books model.
 */
class BooksController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                    'view' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all Books models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchForm = new SearchForm();
        $authors = Authors::getAuthorsForDropDownList();
        
        Yii::$app->session->set('absoluteUrl', Yii::$app->request->absoluteUrl);
        if(Yii::$app->request->isPost && $searchForm->validate())
        {
            $searchForm->load(Yii::$app->request->post());
            Yii::$app->session->set('searchForm', $searchForm);
        }
        else if(Yii::$app->session->has('searchForm'))
        {
        	$searchForm = Yii::$app->session->get('searchForm');
        }

        $query = $searchForm->getSearchQuery();
        $dataProvider = new ActiveDataProvider([
            'query' => $query->with('author'),
            'pagination' => 
            [
                'pagesize' => 10,
            ],
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'searchForm' => $searchForm,
            'authors' => $authors,
        ]);
    }

    /**
     * Displays a single Books model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->renderPartial('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Updates an existing Books model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $authors = Authors::getAuthorsForDropDownList();
        $model = $this->findModel($id);
        
        //Request from form

        if(Yii::$app->request->isPost)
        {
            $model->load(Yii::$app->request->post());
            $model->cover = UploadedFile::getInstance($model, 'cover');
            if($model->save())
            {
                $absoluteUrl = (Yii::$app->session->has('absoluteUrl')) ? 
                    Yii::$app->session->get('absoluteUrl') : 
                    Yii::$app->urlManager->createUrl("books");

                return $this->redirect($absoluteUrl);
            }
        }
        
        //Render update form
        
        return $this->render('update', [
            'model' => $model, 
            'authors' => $authors,
        ]);
    }

    /**
     * Deletes an existing Books model.
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
     * Finds the Books model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Books the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Books::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('Запрашиваемая странца не существует.');
        }
    }
}