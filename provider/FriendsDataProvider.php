<?php namespace app\modules\friends\provider;

use Yii;
use app\modules\friends\models\UserC as UserC;

class FriendsDataProvider extends \yii\data\ArrayDataProvider{
    
    /**
     *
     * @var UserC 
     */
    public $user;
    
    /**
     * 
     * @param array $config
     * @param integer $userId
     */
    public function __construct($config = array(), $userId = null ) {
        $this->user = $userId!==null ? 
                UserC::findIdentity( $userId ):
                UserC::findIdentity( Yii::$app->user->id );
        
        parent::__construct($config);
    }
    
    /**
     * 
     */
    public function init()
    {
        $this->allModels = [];
        
        foreach ( $this->user->friends as $friend ) {
            if ( (int)$friend['initiator_id'] === $this->id ) {
                
                $initiator = UserC::findIdentity( $friend['initiated_id'] );
                
                $friend = [
                            'id' => $initiator->id,
                            'Name' => $initiator->username,
                            'Email' =>  $initiator->email
                        ];
                
                $this->allModels[$initiator->id] = $friend;
            }
        }
       // var_dump($this->allModels);exit();
    }
}
