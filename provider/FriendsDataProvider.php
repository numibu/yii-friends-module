<?php namespace app\modules\friends\provider;

use Yii;
use app\modules\friends\models\UserC as UserC;

class FriendsDataProvider extends \yii\data\ArrayDataProvider{
    
    /**
     * @var UserC 
     */
    public $user;
    
    /**
     * Constructor
     * @param array $config
     * @param integer $userId
     */
    public function __construct($config = array(), $userId = null ) 
    {
        $this->user = ($userId !== null) ? 
                UserC::findIdentity( $userId ):
                UserC::findIdentity( Yii::$app->user->id );
        
        parent::__construct($config);
    }
    
    /**
     * Initialisation an array of friends
     */
    public function init()
    {
        $this->allModels = [];
        $x = $this->user->friends->queryAll();
        foreach ( $x as $friend ) {
            if ( (int)$friend['initiator_id'] === $this->user->id ) {
                $initiated = UserC::findIdentity( $friend['initiated_id'] );
                $this->allModels[$initiated->id] = [
                            'id' => $initiated->id,
                            'Name' => $initiated->username,
                            'Email' =>  $initiated->email
                        ];
            }
        }
    }
}
