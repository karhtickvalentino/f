<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Candidate;

/**
 * Candidatesearch represents the model behind the search form about `app\models\Candidate`.
 */
class Candidatesearch extends Candidate
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['candidate_id', 'mobile_number', 'experience'], 'integer'],
            [['name', 'email_id', 'location', 'resume', 'skills'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
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
        $query = Candidate::find();

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
            'candidate_id' => $this->candidate_id,
            'mobile_number' => $this->mobile_number,
            'experience' => $this->experience,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'email_id', $this->email_id])
            ->andFilterWhere(['like', 'location', $this->location])
            ->andFilterWhere(['like', 'resume', $this->resume])
            ->andFilterWhere(['like', 'skills', $this->skills]);

        return $dataProvider;
    }
}
