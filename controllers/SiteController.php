<?php

namespace app\controllers;

use app\models\Hierarchy;
use app\models\Position;
use app\models\User;
use app\models\UserSearch;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;

class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {

        $searchModel = new UserSearch();

        $dataProvider = $searchModel->search(Yii::$app->request->get());

        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'searchModel' => $searchModel,
        ]);
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * @return string
     * @throws NotFoundHttpException
     */
    public function actionEdit()
    {
        if(Yii::$app->request->get('id') == null){
           throw new NotFoundHttpException('Page not found');
        }

        /**
         * @var User $user
         */
        $user = User::find()
            ->where(['id' => Yii::$app->request->get('id')])
            ->one();

        $user->chief = Hierarchy::getChiefId($user->id);

        if(Yii::$app->request->post('User') != null){
            $user->load(Yii::$app->request->post());
            $user->uploadImage();

            Hierarchy::setNewChief($user->id, Yii::$app->request->post('User')['chief']);
            $user->chief = Yii::$app->request->post('User')['chief'];

            if(Yii::$app->request->post('User')['pass'] != null){
                $user->password = User::encrypt($user->pass);
            }

            if($user->save()){
                Yii::$app->session->setFlash('success', 'Data changed');
            }else{
                $error_str = '';
                foreach ($user->errors as $error){
                    $error_str .= $error[0] . "<br />";
                }
                Yii::$app->session->setFlash('error', $error_str);
            }
        }

        return $this->render('edit', [
            'model' => $user,
            'position' => Position::getPositionList(),
            'users' => array_merge(['' => 'Please select'], User::getUsersList()),
        ]);
    }

    public function actionNewUser()
    {

        if(Yii::$app->request->isPost) {

            $user = new User();

            $user->load(Yii::$app->request->post());
            $user->uploadImage();

            if($user->save()){
                Hierarchy::setNewChief($user->id, Yii::$app->request->post('User')['chief']);
                Yii::$app->session->setFlash('success', 'User is added');
            }else{
                $error_str = '';
                foreach ($user->errors as $error){
                    $error_str .= $error[0] . "<br />";
                }
                Yii::$app->session->setFlash('error', $error_str);
            }
        }

        return $this->render('edit', [
            'model' => new User(),
            'position' => Position::getPositionList(),
            'users' => User::getUsersList(),
        ]);
    }
}
