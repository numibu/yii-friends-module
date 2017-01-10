<?php namespace app\modules\friends\provider;

use Yii;
use app\modules\friends\models\UserC as UserC;

class CandidateDataProvider extends \yii\data\ArrayDataProvider{
    
    /**
     * @var UserC 
     */
    public $user;
    
     /**
     * Constructor
     * @param array $config
     * @param integer $userId
     */
    public function __construct($config = array(), $userId = null ) {
        $this->user = ($userId !== null) ? 
                UserC::findIdentity( $userId ):
                UserC::findIdentity( Yii::$app->user->id );
        
        parent::__construct($config);
    }
    
    /**
     * Initialisation an array of candidates to Friends
     */
    public function init()
    {
        $this->allModels = [];
        $x = $this->user->candidate->queryAll();
        foreach ($x as $candidate) {
            $initiator = UserC::findIdentity( $candidate['initiator_id'] );
            $this->allModels[$initiator->id] =
                [
                    'id' => $initiator->id,
                    'Name' => $initiator->username,
                    'Email' =>  $initiator->email
                ];
        }
    }
}
