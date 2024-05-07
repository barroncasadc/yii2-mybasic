<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Genero;

/**
 * GeneroSearch represents the model behind the search form of `app\models\Genero`.
 */
class GeneroSearch extends Genero
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['gene_codigo', 'gene_habilitado'], 'integer'],
            [['gene_uuid', 'gene_nome', 'gene_data_criacao', 'gene_data_alteracao'], 'safe'],
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
        $query = Genero::find();

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
            'gene_codigo' => $this->gene_codigo,
            'gene_habilitado' => $this->gene_habilitado,
            'gene_data_criacao' => $this->gene_data_criacao,
            'gene_data_alteracao' => $this->gene_data_alteracao,
        ]);

        $query->andFilterWhere(['like', 'gene_uuid', $this->gene_uuid])
            ->andFilterWhere(['like', 'gene_nome', $this->gene_nome]);

        return $dataProvider;
    }
}
