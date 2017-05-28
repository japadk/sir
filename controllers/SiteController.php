<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;

//use app\models\ContactForm;

class SiteController extends Controller {

    public function verify($user) {

        if (Yii::$app->user->isGuest) {
            return $this->redirect(['site/index']);
        } elseif (!$user === Yii::$app->params['both']) {
            if (Yii::$app->user->getIdentity()->is_admin !== $user) {
                $this->render('//site/error', ['name' => 'Usuário não autenticado', 'message' => 'Você não tem permissão para acessar esta página.']);
                return 0;
            }
        }
        return 1;
    }

    public function actions() {
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

    public function actionIndex() {
        if (!\Yii::$app->user->isGuest) {
            return $this->redirect(['inicio']);
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->redirect(['inicio']);
        } else {
            return $this->render('index', [
                        'model' => $model,
            ]);
        }
        return $this->render('index');
    }

    public function actionInicio() {
        if ($this->verify(Yii::$app->params['both'])) {
            return $this->render('inicio');
        }
    }


    public function actionLogout() {
        Yii::$app->user->logout();

        return $this->goHome();
    }

}
