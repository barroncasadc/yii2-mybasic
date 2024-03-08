<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Pessoa;

/**
 * PessoaSearch represents the model behind the search form of `app\models\Pessoa`.
 */
class PessoaSearch extends Pessoa
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['pess_codigo', 'peti_codigo', 'pess_habilitado'], 'integer'],
            [['pess_nome', 'pess_email', 'pess_senha', 'pess_token', 'pess_imagem', 'pess_data_criacao', 'pess_data_alteracao'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
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
    public function search($params)
    {
        $query = Pessoa::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'pess_codigo' => $this->pess_codigo,
            'peti_codigo' => $this->peti_codigo,
            'pess_habilitado' => $this->pess_habilitado,
            'pess_data_criacao' => $this->pess_data_criacao,
            'pess_data_alteracao' => $this->pess_data_alteracao,
        ]);

        $query->andFilterWhere(['like', 'pess_nome', $this->pess_nome])
            ->andFilterWhere(['like', 'pess_email', $this->pess_email])
            ->andFilterWhere(['like', 'pess_senha', $this->pess_senha])
            ->andFilterWhere(['like', 'pess_token', $this->pess_token])
            ->andFilterWhere(['like', 'pess_imagem', $this->pess_imagem]);

        return $dataProvider;
    }
}
