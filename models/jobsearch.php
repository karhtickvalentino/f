<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Job;

/**
 * jobsearch represents the model behind the search form about `app\models\Job`.
 */
class Jobsearch extends Job
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['job_id', 'recruiter_id', 'experience_minimum', 'experience_maximun', 'salary'], 'integer'],
            [['title', 'description', 'location', 'industry', 'created_on'], 'safe'],
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
        $query = Job::find();

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
            'job_id' => $this->job_id,
            'recruiter_id' => $this->recruiter_id,
            'experience_minimum' => $this->experience_minimum,
            'experience_maximun' => $this->experience_maximun,
            'salary' => $this->salary,
            'created_on' => $this->created_on,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'location', $this->location])
            ->andFilterWhere(['like', 'industry', $this->industry]);

        return $dataProvider;
    }
}
