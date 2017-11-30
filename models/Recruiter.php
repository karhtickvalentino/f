<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "recruiter".
 *
 * @property integer $recruiter_id
 * @property string $name
 * @property string $company_name
 * @property string $email_id
 *
 * @property Job[] $jobs
 */
class Recruiter extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'recruiter';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'company_name', 'email_id'], 'required'],
            ['designation','safe'],
            [['name', 'company_name', 'email_id'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'recruiter_id' => 'Recruiter ID',
            'name' => 'Name',
            'company_name' => 'Company Name',
            'email_id' => 'Email ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getJobs()
    {
        return $this->hasMany(Job::className(), ['recruiter_id' => 'recruiter_id']);
    }
}
