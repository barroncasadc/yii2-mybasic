<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Especie;

/**
 * EspecieSearch represents the model behind the search form of `app\models\Especie`.
 */
class EspecieSearch extends Especie
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['espe_codigo', 'fami_codigo', 'gene_codigo', 'espe_habilitado'], 'integer'],
            [['espe_uuid', 'espe_nome', 'espe_data_criacao', 'espe_data_alteracao'], 'safe'],
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
        $query = Especie::find();

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
            'espe_codigo' => $this->espe_codigo,
            'fami_codigo' => $this->fami_codigo,
            'gene_codigo' => $this->gene_codigo,
            'espe_habilitado' => $this->espe_habilitado,
            'espe_data_criacao' => $this->espe_data_criacao,
            'espe_data_alteracao' => $this->espe_data_alteracao,
        ]);

        $query->andFilterWhere(['like', 'espe_uuid', $this->espe_uuid])
            ->andFilterWhere(['like', 'espe_nome', $this->espe_nome]);

        return $dataProvider;
    }
}
