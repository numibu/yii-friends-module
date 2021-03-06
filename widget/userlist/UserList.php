<?php 
namespace app\modules\friends\widget\userlist;

use Yii;
use yii\base\Widget;
use app\modules\friends\models\UserC;
use app\modules\friends\provider\CandidateDataProvider;
use app\modules\friends\models\Friends;
use yii\helpers\Html;


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
     * Render user list
     */
    public function run() {
        $config = ['query' => UserC::find()];
        $userDataProvider = new \yii\data\ActiveDataProvider($config);
        return $this->render('index', [
                                        'userProvider' => $userDataProvider,
                                        'widgetInstance' => $this
                                    ]);
    }
    
    /**
     * This method returning a template for button actions
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
    
    /**
     * This method returning a template for 'add-friend' button
     * @return string 
     */
    public function addFriendButton()
    { 
        $friendsArray = $this->friendsList->allModels;
        $candidate = $this->candidate;
        
        return 
        
        function($url, $model ) use ( $friendsArray, $candidate ) {
            
            $friends = Friends::findOne( ['initiated_id' => $model->id, 'initiator_id' => Yii::$app->user->id] );
                    
            switch (true){
                
                case ( Yii::$app->user->id === $model->id ) :return '';
                case ( array_key_exists( $model->id, $friendsArray ) ) :return '';
                case ( array_key_exists( $model->id, $candidate ) ) :return '';
                case ( $friends instanceof Friends ) : return '';
                
                default: 
                     return Html::a(
                        '<span class="glyphicon glyphicon-plus"></span>',
                    $url);
            }                  
        };
    }

    /**
     * This method returning a template for 'delete-friend' button
     * @return string 
     */
    public function deleteFriendButton()
    {
        $friendsArray = $this->friendsList->allModels; 
        
        return  function($url, $model) use ($friendsArray){
            if (array_key_exists( $model->id, $friendsArray )){
                return Html::a(
                    '<span class="glyphicon glyphicon-minus"></span>', 
                $url);
            }
            return '';
        };
    }
}
