<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "chat".
 *
 * @property string $id
 * @property string $from
 * @property string $to
 * @property string $message
 * @property string $sent
 * @property string $recd
 */
class Chat extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'chat';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['message', 'sent'], 'required'],
            [['message'], 'string'],
            [['sent'], 'safe'],
            [['recd'], 'integer'],
            [['from', 'to'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'from' => 'From',
            'to' => 'To',
            'message' => 'Message',
            'sent' => 'Sent',
            'recd' => 'Recd',
        ];
    }
}
