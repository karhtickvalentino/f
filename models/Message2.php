<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "message".
 *
 * @property string $id
 * @property string $sender_id
 * @property string $receiver_id
 * @property string $text
 * @property integer $is_new
 * @property integer $is_deleted_by_sender
 * @property integer $is_deleted_by_receiver
 * @property string $created_at
 */
class Message2 extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'message';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['sender_id', 'receiver_id', 'text', 'created_at'], 'required'],
            [['sender_id', 'receiver_id', 'is_new', 'is_deleted_by_sender', 'is_deleted_by_receiver'], 'integer'],
            [['created_at'], 'safe'],
            [['text'], 'string', 'max' => 1020],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'sender_id' => 'Sender ID',
            'receiver_id' => 'Receiver ID',
            'text' => 'Text',
            'is_new' => 'Is New',
            'is_deleted_by_sender' => 'Is Deleted By Sender',
            'is_deleted_by_receiver' => 'Is Deleted By Receiver',
            'created_at' => 'Created At',
        ];
    }
}
