<?php

namespace app\controllers;

use Yii;
use app\models\Usuario;
use app\models\Supervisa;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * VendedorController implements the CRUD actions for Usuario model.
 */
class VendedorController extends Controller {

    /**
     * Lists all Usuario models.
     * @return mixed
     */
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

    public function actionIndex() {
        if ($this->verify(Yii::$app->params['admin'])) {

            $query = Usuario::find();
            $query->join('INNER JOIN', 'supervisa', 'supervisa.id_usuario = usuario.id');
            $query->andWhere('is_admin = false');
            $query->andWhere('supervisa.id_supervisor = ' . Yii::$app->user->getIdentity()->getId());

            $dataProvider = new ActiveDataProvider([
                'query' => $query,
            ]);

            return $this->render('index', [
                        'dataProvider' => $dataProvider,
            ]);
        }
    }

    /**
     * Creates a new Usuario model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        if ($this->verify(Yii::$app->params['admin'])) {
            $model = new Usuario();

            if ($model->load(Yii::$app->request->post())) {
                
                $exists = Usuario::find()->where(['usuario'=>$model->usuario]);
                

                if ($exists->one() == null) {

                    $model->senha = Yii::$app->security->generatePasswordHash($model->senha);
                    $model->authKey = Yii::$app->security->generateRandomString();
                    $model->is_admin = 0;
                    $model->ativo = 1;

                    $supervisiona = new Supervisa();

                    if ($model->save()) {

                        $supervisiona->id_usuario = $model->id;
                        $supervisiona->id_supervisor = Yii::$app->user->getIdentity()->getId();
                        $supervisiona->save();

                        return $this->redirect(['index']);
                    } else {
                        return $this->render('create', [
                                    'model' => $model,
                        ]);
                    }
                }else{
                    
                    $model->addError('usuario', 'Usuário ja existente');
                    return $this->render('create', [
                                    'model' => $model,
                        ]);
                    
                }
            } else {
                return $this->render('create', [
                            'model' => $model,
                ]);
            }
        }
    }

    /**
     * Updates an existing Usuario model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id) {
        if ($this->verify(Yii::$app->params['admin'])) {
            $model = $this->findModel($id);
//            $model->senha = null;

            if ($model->load(Yii::$app->request->post())) {

//                $model->senha = Yii::$app->security->generatePasswordHash($model->senha);
                if ($model->save()) {
                    return $this->redirect(['index']);
                } else {
                    return $this->render('update', [
                                'model' => $model,
                    ]);
                }
            } else {
                return $this->render('update', [
                            'model' => $model,
                ]);
            }
        }
    }

    public function actionSenhaVendedor($id) {
        if ($this->verify(Yii::$app->params['admin'])) {
            $model = new \app\models\SenhaForm();
            if ($model->load(Yii::$app->request->post()) && $model->validate()) {
                $user = Usuario::findIdentity($id);
                $user->senha = Yii::$app->security->generatePasswordHash($model->senha1);
                $user->save();
                return $this->redirect(['vendedor/index']);
            } else {
                return $this->render('senha', ['model' => $model]);
            }
        }
    }

    public function actionSenha() {
        if ($this->verify(Yii::$app->params['both'])) {
            $model = new \app\models\SenhaForm();
            if ($model->load(Yii::$app->request->post()) && $model->validate()) {
                $user = Usuario::findIdentity(Yii::$app->user->getIdentity()->id);
                $user->senha = Yii::$app->security->generatePasswordHash($model->senha1);
                $user->save();
                return $this->render('//site/inicio', ['message' => 'Senha alterada com sucesso.']);
            } else {
                return $this->render('senha', ['model' => $model]);
            }
        }
    }

    /**
     * Finds the Usuario model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Usuario the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = Usuario::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
