<?php

namespace app\modules\friends\controllers;

use yii\web\Controller;
use app\modules\friends\models\Friends as Friends;
use Yii;

/**
 * Default controller for the `friends` module
 */
class DefaultController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        /*$config = ['query' => UserC::find()];
        $userDataProvider = new \yii\data\ActiveDataProvider($config);
        return $this->render('index', ['userProvider' => $userDataProvider]);*/
        
        if (  Yii::$app->user->isGuest ) { 
            return $this->goHome();
        }
        return $this->render('index');
    }
    
    public function actionAddFriend($id)
    {
        $friendsItem = new Friends();
        $friendsItem->setAttribute('initiator_id', Yii::$app->user->id);
        $friendsItem->setAttribute('initiated_id', $id);
        $friendsItem->save();
        return $this->render('index');
    }
    
    /**
     * 
     * @param Integer $id
     */
    public function actionDeleteFriend($id)
    {
        Friends::deleteFriend($id);
        return $this->render('index');
    }
}
