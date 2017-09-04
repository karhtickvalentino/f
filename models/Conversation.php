<?php
namespace app\models;

//use app\models\User;
//use webvimark\modules\UserManagement\models\User;
use bubasuma\simplechat\models\User;

class Conversation extends \bubasuma\simplechat\db\Conversation
{
    public function getContact()
    {
       // print_r(User::className());exit;
        return $this->hasOne(User::className(), ['id' => 'contact_id']);
    }
    
    /**
     * @inheritDoc
     */
    protected static function baseQuery($userId)
    {
        return parent::baseQuery($userId) ->with(['contact.profile']);
    }
    
    /**
     * @inheritDoc
     */
    public function fields()
    {
        return [
            //...
            'contact' => function ($model) {
                return $model['contact'];
            },
            'deleteUrl',
            'readUrl',
            'unreadUrl',
            //...
        ];
    }
}