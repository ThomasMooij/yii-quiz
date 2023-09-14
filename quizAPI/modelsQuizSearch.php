<?php

namespace app;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Quiz;

/**
 * modelsQuizSearch represents the model behind the search form of `app\models\Quiz`.
 */
class modelsQuizSearch extends Quiz
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'juiste_antwoord'], 'integer'],
            [['vraag', 'antwoord1', 'antwoord2', 'antwoord3', 'antwoord4'], 'safe'],
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
        $query = Quiz::find();

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
            'id' => $this->id,
            'juiste_antwoord' => $this->juiste_antwoord,
        ]);

        $query->andFilterWhere(['like', 'vraag', $this->vraag])
            ->andFilterWhere(['like', 'antwoord1', $this->antwoord1])
            ->andFilterWhere(['like', 'antwoord2', $this->antwoord2])
            ->andFilterWhere(['like', 'antwoord3', $this->antwoord3])
            ->andFilterWhere(['like', 'antwoord4', $this->antwoord4]);

        return $dataProvider;
    }
}
