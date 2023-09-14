<?php

namespace app\controllers;

use Yii;
use app\models\Quiz;
use yii\web\Controller;
use app\modelsQuizSearch;
use yii\filters\VerbFilter;
use yii\web\NotFoundHttpException;

/**
 * QuizController implements the CRUD actions for Quiz model.
 */
class QuizController extends Controller
{
    
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                    'class' => '\yii\filters\Cors',
                    'cors' => [
                    'Origin' => ['*'],
                    'Access-Control-Request-Method' => ['GET', 'POST'],
                    'Access-Control-Request-Headers' => ['*'],
                ],
                ],
            ]
        );
        }
        
        public static function allowedDomains()
        {
        return [
            // '*',                        // star allows all domains
            'http://localhost:3000',
            'http://test2.example.com',
        ];
        }  

    /**
     * Lists all Quiz models.
     * 
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new modelsQuizSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Quiz model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Quiz model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Quiz();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Quiz model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Quiz model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Quiz model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Quiz the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Quiz::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }    
    public function actionApiGet() {

        $sql = "select vraag, antwoord1, antwoord2, antwoord3, antwoord4, juiste_antwoord from quiz";
        $result = Yii::$app->db->createCommand($sql)->queryAll();
    
        $output = [];
        foreach ($result as $elem) {
            array_push( $output,
                [   'questionText' => $elem['vraag'],
                    'answerOptions' =>
                    [
                        ['answerText'=>$elem['antwoord1'],'isCorrect'=>( $elem['juiste_antwoord'] == 1 ? 1 : 0) ],
                        ['answerText'=>$elem['antwoord2'],'isCorrect'=>( $elem['juiste_antwoord'] == 2 ? 1 : 0) ],
                        ['answerText'=>$elem['antwoord3'],'isCorrect'=>( $elem['juiste_antwoord'] == 3 ? 1 : 0) ],
                        ['answerText'=>$elem['antwoord4'],'isCorrect'=>( $elem['juiste_antwoord'] == 4 ? 1 : 0) ],
                    ]
                ] );
        }
    
        return json_encode($output);
    }
    

}
