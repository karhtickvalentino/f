<?php

namespace app\module\recruiter\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\module\recruiter\models\Recruiter;

/**
 * Recruitersearch represents the model behind the search form about `app\module\recruiter\models\Recruiter`.
 */
class Recruitersearch extends Recruiter
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['recruiter_id'], 'integer'],
            [['name', 'company_name', 'email_id'], 'safe'],
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
        $query = Recruiter::find();

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
            'recruiter_id' => $this->recruiter_id,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'company_name', $this->company_name])
            ->andFilterWhere(['like', 'email_id', $this->email_id]);

        return $dataProvider;
    }
}
