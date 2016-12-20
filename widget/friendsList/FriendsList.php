<?php namespace app\modules\friends\widget\friendsList;

use yii\base\Widget as Widget;
use app\modules\friends\models\UserC as UserC;
use app\modules\friends\provider\CandidateDataProvider as Candidate;
use app\modules\friends\provider\WidgetAssets as WidgetAssets;

Class FriendsList extends Widget
{
    /**
     *
     * @var Integer 
     */
    public $userId;
    
    /**
     *
     * @var UserC 
     */
    public $user;
    
    /**
     *
     * @var ArrayDataProvider 
     */
    public $friends;
    
    /**
     *
     * @var app\modules\friends\dataProvider\CandidateDataProvider 
     */
    public $candidates;
    
    /**
     *
     * @var array 
     */
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
        
        if ( $this->candidates === null || !$this->candidates instanceof Candidate){
            $this->candidates = new Candidate();
        }
        
        $assets = new WidgetAssets();
        $assets->register($this->view);
    }
    
    public function run() 
    {
        return $this->render( 'index', [ 'widgetInstance' => $this ] );
    }
    
    public function addError($config)
    {
        if ( is_array($config) && count($config) === 1 ) {
            $this->_errors[] = $config;
            return;
        }
        new \InvalidArgumentException();
    }

}
