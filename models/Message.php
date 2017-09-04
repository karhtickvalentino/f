<?php
namespace app\models;

//...

class Message extends \bubasuma\simplechat\db\Message
{
    /**
     * @inheritDoc
     */
    // public function fields()
    // {
    //     return [
    //         //...
    //         'text',
    //         'date' => 'created_at',
    //         //...
    //     ];
    // }
     public function fields()
    {
        return [
            'senderId' => 'sender_id',
            'text',
             'date' => //function ($model) {
            //     return static::formatDate($model['created_at'])[1];
            'created_at',
            //},
             'when' => //function ($model) {
            //     return static::formatDate($model['created_at'])[0];
            //},
            'created_at'
        ];
    }

    public static function formatDate($value)
    {
        $today = date_create()->setTime(0, 0, 0);
        $date = date_create($value)->setTime(0, 0, 0);
        if ($today == $date) {
            $label = 'Today';
        } elseif ($today->getTimestamp() - $date->getTimestamp() == 24 * 60 * 60) {
            $label = 'Yesterday';
        } elseif ($today->format('W') == $date->format('W') && $today->format('Y') == $date->format('Y')) {
            $label = \Yii::$app->formatter->asDate($value, 'php:l');
        } elseif ($today->format('Y') == $date->format('Y')) {
            $label = \Yii::$app->formatter->asDate($value, 'php:d F');
        } else {
            $label = \Yii::$app->formatter->asDate($value, 'medium');
        }
        $formatted = \Yii::$app->formatter->asTime($value, 'short');
        return [$label, $formatted];
    }

}