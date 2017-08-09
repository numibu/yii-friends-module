<?php namespace app\modules\friends\widget\friendsList;

use yii\base\Widget;
use app\modules\friends\models\UserC;
use app\modules\friends\provider\CandidateDataProvider;
use app\modules\friends\provider\FriendsDataProvider;
use app\modules\friends\assets\WidgetAssets;

Class FriendsList extends Widget
{   
    /**
     *
     * @var UserC 
     */
    public $user;
    
    /**
     *  friends array
     * @var app\modules\friends\dataProvider\FriendsDataProvider  
     */
    public $friends;
    
    /**
     * candidates to Friends array
     * @var app\modules\friends\dataProvider\CandidateDataProvider 
     */
    public $candidates;
    
    /**
     * 
     * @var array 
     *
    private $_errors;


    public function init()
    {
        parent::init();
        
        if ( (int)$this->id instanceof Integer ){
            $user = UserC::findIdentity((int)$this->id);
        }else{
            $user = UserC::findIdentity(\Yii::$app->user->id);
        }
        
        if ( $user instanceof UserC ){ 
            $this->user = $user; 
        }else{
            new \yii\base\UnknownPropertyException();
        }      
        
        if ( $this->candidates === null || !$this->candidates instanceof CandidateDataProvider) {
            $this->candidates = new CandidateDataProvider();
        }
        
        if ( $this->friends === null || !$this->friends instanceof FriendsDataProvider) {
            $this->friends = new FriendsDataProvider();
        }
        
        $assets = new WidgetAssets();
        $assets->register($this->view);
    }
    
    public function run() 
    {
        return $this->render( 'index', [ 'widgetInstance' => $this ] );
    }
    /*
    public function addError($config)
    {
        if ( is_array($config) && count($config) === 1 ) {
            $this->_errors[] = $config;
            return;
        }
        new \InvalidArgumentException();
    }*/

}
