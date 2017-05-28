<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Ligacoes;

/**
 * LigacoesSearch represents the model behind the search form about `app\models\Ligacoes`.
 */
class LigacoesSearch extends Ligacoes {

    /**
     * @inheritdoc
     */
    public function attributes() {
        // add related fields to searchable attributes
        return array_merge(parent::attributes(), ['usuario.nome']);
    }

    public function rules() {
        return [
            [['id', 'id_usuario'], 'integer'],
            [['data', 'horario', 'ddd', 'telefone', 'cnpj', 'rasao_social', 'responsavel', 'email', 'retorno','status','data_retorno','horario_retorno', 'observacoes', 'usuario.nome'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios() {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params) {
//        var_dump($params);
        $query = Ligacoes::find();
        
        $query->joinWith(['usuario']);
        
        if($params['admin'] != 0){
            $query->join('INNER JOIN','supervisa','supervisa.id_usuario = ligacoes.id_usuario');
            $query->andWhere('supervisa.id_supervisor = ' . $params['admin']);
        }
        
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        $dataProvider->sort->attributes['usuario.nome'] = [
            // The tables are the ones our relation are configured to
            // in my case they are prefixed with "tbl_"
            'asc' => ['usuario.nome' => SORT_ASC],
            'desc' => ['usuario.nome' => SORT_DESC],
        ];
        
        $dataProvider->sort->attributes['retorno'] = [
            // The tables are the ones our relation are configured to
            // in my case they are prefixed with "tbl_"
            'asc' => ['retorno' => SORT_ASC],
            'desc' => ['retorno' => SORT_DESC],
        ];
        
        $dataProvider->sort->attributes['data_retorno'] = [
            // The tables are the ones our relation are configured to
            // in my case they are prefixed with "tbl_"
            'asc' => ['data_retorno' => SORT_ASC],
            'desc' => ['data_retorno' => SORT_DESC],
        ];
        
        $dataProvider->sort->attributes['horario_retorno'] = [
            // The tables are the ones our relation are configured to
            // in my case they are prefixed with "tbl_"
            'asc' => ['horario_retorno' => SORT_ASC],
            'desc' => ['horario_retorno' => SORT_DESC],
        ];


        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'id_usuario' => $this->id_usuario,
//            'data' => $this->data,
//            'horario' => $this->horario,
        ]);

        $query->andFilterWhere(['like', 'ddd', $this->ddd])
                ->andFilterWhere(['like', 'horario', $this->horario])
                ->andFilterWhere(['like', 'data', $this->data])
                ->andFilterWhere(['like', 'telefone', $this->telefone])
                ->andFilterWhere(['like', 'cnpj', $this->cnpj])
                ->andFilterWhere(['like', 'rasao_social', $this->rasao_social])
                ->andFilterWhere(['like', 'responsavel', $this->responsavel])
                ->andFilterWhere(['like', 'email', $this->email])
                ->andFilterWhere(['like', 'status', $this->status])
                ->andFilterWhere(['like', 'data_retorno', $this->data_retorno])
                ->andFilterWhere(['like', 'horario_retorno', $this->horario_retorno])
                ->andFilterWhere(['like', 'observacoes', $this->observacoes])
                ->andFilterWhere(['like', 'retorno', $this->retorno])
                ->andFilterWhere(['like', 'usuario.nome', $this->getAttribute('usuario.nome')]);
        
        $query->orderBy('id DESC');

        return $dataProvider;
    }

}
