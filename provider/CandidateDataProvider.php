<?php namespace app\modules\friends\provider;

use Yii;
use app\modules\friends\models\UserC as UserC;

class CandidateDataProvider extends \yii\data\ArrayDataProvider{
    
    /**
     *
     * @var UserC 
     */
    public $user;
    
    /**
     * 
     */
    public function init()
    {
        $this->allModels = [];
        
        if ( $this->user === null || !$this->user instanceof UserC){
            $this->user = UserC::findIdentity( Yii::$app->user->id );
        }
        
        foreach ($this->user->candidate as $candidate) {
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
