<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "job".
 *
 * @property integer $job_id
 * @property integer $recruiter_id
 * @property string $title
 * @property string $description
 * @property integer $experience_minimum
 * @property integer $experience_maximun
 * @property integer $salary
 * @property string $location
 * @property string $industry
 * @property string $created_on
 *
 * @property Recruiter $recruiter
 */
class Job extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'job';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['job_id', 'recruiter_id', 'title', 'description', 'experience_minimum', 'experience_maximun', 'salary', 'location', 'industry'], 'required'],
            [['job_id', 'recruiter_id', 'experience_minimum', 'experience_maximun', 'salary'], 'integer'],
            [['description'], 'string'],
            [['created_on'], 'safe'],
            [['title', 'location'], 'string', 'max' => 255],
            [['industry'], 'string', 'max' => 2555],
            [['recruiter_id'], 'exist', 'skipOnError' => true, 'targetClass' => Recruiter::className(), 'targetAttribute' => ['recruiter_id' => 'recruiter_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'job_id' => 'Job ID',
            'recruiter_id' => 'Recruiter ID',
            'title' => 'Title',
            'description' => 'Description',
            'experience_minimum' => 'Experience Minimum',
            'experience_maximun' => 'Experience Maximun',
            'salary' => 'Salary',
            'location' => 'Location',
            'industry' => 'Industry',
            'created_on' => 'Created On',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRecruiter()
    {
        return $this->hasOne(Recruiter::className(), ['recruiter_id' => 'recruiter_id']);
    }
}
