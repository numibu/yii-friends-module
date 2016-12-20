<?php 
namespace app\modules\friends\widget\userlist;

use yii\base\Widget as Widget;
use app\modules\friends\models\UserC as UserC;
use app\modules\friends\provider\CandidateDataProvider;

class UserList extends Widget 
{
    /**
     * 
     * @var UserC  
     */
    public $user;
    
    /**
    *
    * @var ArrayDataProvider $candidate
    */
    public $candidate;
    /**
     *
     * @var ArrayDataProvider $friendsList
     */
    public $friendsList;
    
    /**
     * 
     */
    public function init() {
        parent::init();
        
        if ( $this->friendsList->allModels === null) { 
            $this->friendsList->allModels = [];
        }
        
        if ( $this->user === null && !\Yii::$app->user->isGuest ) {
            $this->user = \Yii::$app->user;
        }elseif ( !$this->user instanceof UserC ) {
            $this->user = null;
        }
        
        if ($this->candidate !== null) {
            $candidate = new CandidateDataProvider();
            $candidate->init($this->candidate);
            $this->candidate = $candidate->allModels;
        }
        
    }
    
    /**
     * 
     */
    public function run() {
        $config = ['query' => UserC::find()];
        $userDataProvider = new \yii\data\ActiveDataProvider($config);
        return $this->render('index', [
                                        'userProvider' => $userDataProvider,
                                        'widgetInstance' => $this,
                                        'friendsArray' => $this->friendsList->allModels,
                                        'candidate' => $this->candidate
                                    ]);
    }
    
    /**
     * this method returning a template for button actions
     * @return string 
     */
    public function getButtonTemplate()
    {
        if (\Yii::$app->user->isGuest) {
            return '{login}';
        }else{
            return '{view} {add-friend} {delete-friend}';
        }
    }

}
