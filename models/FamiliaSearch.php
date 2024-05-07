<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Familia;

/**
 * FamiliaSearch represents the model behind the search form of `app\models\Familia`.
 */
class FamiliaSearch extends Familia
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['fami_codigo', 'fami_habilitado'], 'integer'],
            [['fami_uuid', 'fami_nome', 'fami_data_criacao', 'fami_data_alteracao'], 'safe'],
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
        $query = Familia::find();

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
            'fami_codigo' => $this->fami_codigo,
            'fami_habilitado' => $this->fami_habilitado,
            'fami_data_criacao' => $this->fami_data_criacao,
            'fami_data_alteracao' => $this->fami_data_alteracao,
        ]);

        $query->andFilterWhere(['like', 'fami_uuid', $this->fami_uuid])
            ->andFilterWhere(['like', 'fami_nome', $this->fami_nome]);

        return $dataProvider;
    }
}
