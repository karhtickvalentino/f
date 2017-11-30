<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "work_type".
 *
 * @property integer $work_type_id
 * @property string $name
 * @property string $description
 */
class WorkType extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'work_type';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['description'], 'string'],
            [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'work_type_id' => 'Work Type ID',
            'name' => 'Name',
            'description' => 'Description',
        ];
    }
}
