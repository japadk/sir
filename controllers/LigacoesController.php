<?php

namespace app\controllers;

use Yii;
use app\models\Ligacoes;
use app\models\LigacaoCsvForm;
use app\models\LigacoesSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\data\ActiveDataProvider;

/**
 * LigacoesController implements the CRUD actions for Ligacoes model.
 */
class LigacoesController extends Controller {

    /**
     * Lists all Ligacoes models.
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

        if ($this->verify(Yii::$app->params['both'])) {
            $searchModel = new LigacoesSearch();
            $queryParams = Yii::$app->request->queryParams;
            $user = Yii::$app->user->getIdentity();
            if (!$user->is_admin) {
                $queryParams['LigacoesSearch']['id_usuario'] = $user->id;
                $queryParams['admin'] = 0;
            }else{
                $queryParams['admin'] = $user->id;
            }

            $dataProvider = $searchModel->search($queryParams);

            return $this->render('index', [
                        'dataProvider' => $dataProvider,
                        'searchModel' => $searchModel,
            ]);
        }
    }
    
    public function actionRetornar($id){
        
        if ($this->verify(Yii::$app->params['both'])) {
            $model = $this->findModel($id);

            if ($model->load(Yii::$app->request->post())) {
                
                $model->retorno = $model->data;
                date_default_timezone_set('America/Sao_Paulo');
                $time = time();
                $model->data = date('Y:m:d', $time);
                $model->horario = date('H:i:s', $time);
                
                if($model->save()){
                    return $this->redirect(['view', 'id' => $model->id]);
                }else{
                    return $this->render('retornar', [
                            'model' => $model,
                ]);
                }
                
                
            } else {
                return $this->render('retornar', [
                            'model' => $model,
                ]);
            }
        }
        
        
    }

    private function getSearchQuery($model){
        $query = new \yii\db\Query();

                $query->select('ligacoes.id as lid,usuario.id, usuario.nome,data,horario,ddd,telefone,cnpj,rasao_social,responsavel,email,retorno,status,data_retorno,horario_retorno,observacoes,ligacoes.id_usuario')
                        ->from('ligacoes')
                        ->innerJoin('usuario', 'usuario.id = ligacoes.id_usuario')
                        ->innerJoin('supervisa', 'supervisa.id_usuario = ligacoes.id_usuario')
                        ->andFilterWhere(['like', 'usuario.nome', $model->nome])
                        ->andFilterWhere(['like', 'ddd', $model->ddd])
                        ->andFilterWhere(['like', 'horario', $model->horario])
                        ->andFilterWhere(['like', 'data', $model->data])
                        ->andFilterWhere(['like', 'telefone', $model->telefone])
                        ->andFilterWhere(['like', 'cnpj', $model->cnpj])
                        ->andFilterWhere(['like', 'rasao_social', $model->rasao_social])
                        ->andFilterWhere(['like', 'responsavel', $model->responsavel])
                        ->andFilterWhere(['like', 'email', $model->email])
                        ->andFilterWhere(['like', 'retorno', $model->retorno])
                        ->andFilterWhere(['like', 'status', $model->status])
                        ->andFilterWhere(['like', 'data_retorno', $model->data_retorno])
                        ->andFilterWhere(['like', 'horario_retorno', $model->horario_retorno]);
                if (!Yii::$app->user->getIdentity()->is_admin) {
                    $query->andWhere('usuario.id = ' . Yii::$app->user->getIdentity()->id);
                }else{
                    $query->andWhere('supervisa.id_supervisor = ' . Yii::$app->user->getIdentity()->id);
                }
                
                $query->orderBy('ligacoes.id DESC');

                return $query;
    }
    public function actionSearch() {
        if ($this->verify(Yii::$app->params['both'])) {

            $model = new LigacaoCsvForm();
            if ($model->load(Yii::$app->request->post())) {
                
                $dataProvider = new ActiveDataProvider([
                    'query' => $this->getSearchQuery($model),
                ]);


                return $this->render('csv', [
                            'dataProvider' => $dataProvider,
                            'model' => $model,
                    'what'=>'search',
                ]);
            } else {
                return $this->render('csv', [
                            'model' => $model,
                    'what'=>'search',
                ]);
            }
        }
    }

    /**
     * Displays a single Ligacoes model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id) {
        if ($this->verify(Yii::$app->params['both'])) {
            return $this->render('view', [
                        'model' => $this->findModel($id),
            ]);
        }
    }

    /**
     * Creates a new Ligacoes model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        if ($this->verify(Yii::$app->params['user'])) {
            $model = new Ligacoes();

            if ($model->load(Yii::$app->request->post())) {
                date_default_timezone_set('America/Sao_Paulo');
                $time = time();
                $model->data = date('Y:m:d', $time);
                $model->horario = date('H:i:s', $time);
                $model->id_usuario = Yii::$app->user->getIdentity()->id;

                if ($model->save()) {
                    return $this->redirect(['view', 'id' => $model->id]);
                } else {
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
     * Updates an existing Ligacoes model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id) {
        if ($this->verify(Yii::$app->params['both'])) {
            $model = $this->findModel($id);

            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            } else {
                return $this->render('update', [
                            'model' => $model,
                ]);
            }
        }
    }

    /**
     * Deletes an existing Ligacoes model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
//    public function actionDelete($id) {
//        $this->findModel($id)->delete();
//
//        return $this->redirect(['index']);
//    }

    public function actionCsv() {
        if ($this->verify(Yii::$app->params['both'])) {
            $model = new LigacaoCsvForm();
            if ($model->load(Yii::$app->request->post())) {
                
                $query = $this->getSearchQuery($model);
                $result = $query->all();
                $csv = new \app\models\CsvWritter('Relatorio.csv');
                $csv->addCollumns(['Vendedor', 'Data', "Horario", 'DDD', 'Telefone', 'CNPJ', "Rasao Social", 'Responsavel', 'E-mail', 'Retorno de', 'Status','Data Retorno','Horario Retorno', "Observacoes"]);

                foreach ($result as $linha) {
                    $csv->addCellData($linha['nome']);
                    $csv->addCellData($linha['data']);
                    $csv->addCellData($linha['horario']);
                    $csv->addCellData($linha['ddd']);
                    $csv->addCellData($linha['telefone']);
                    $csv->addCellData($linha['cnpj']);
                    $csv->addCellData($linha['rasao_social']);
                    $csv->addCellData($linha['responsavel']);
                    $csv->addCellData($linha['email']);
                    $csv->addCellData($linha['retorno']);
                    $csv->addCellData($linha['status']);
                    $csv->addCellData($linha['data_retorno']);
                    $csv->addCellData($linha['horario_retorno']);

		    $temp = str_replace(["\r\n","\r","\n"], ". ", $linha['observacoes']);

                    $csv->addCellData($temp);
                }
                $csv->save();
                Yii::$app->response->sendFile('Relatorio.csv');
            } else {

                return $this->render('csv', ['model' => $model,'what'=>'csv',]);
            }
        }
    }

    /**
     * Finds the Ligacoes model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Ligacoes the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = Ligacoes::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
