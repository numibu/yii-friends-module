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
        if (  Yii::$app->user->isGuest ) { 
            return $this->goHome();
        }
        return $this->render('index');
    }
    
    /**
     * View membership of user(id)
     * @param integer $id
     */
    public function actionView($id)
    {
        // Your implementation of the functional
        return $this->render('index');
    }
    
    /**
     * Action adding new friend or candidate.
     * @param type $id - userID for new friend.
     * @return String - rendered of view temlate. 
     */
    public function actionAddFriend($id)
    {
        $friendsItem = new Friends();
        $friendsItem->setAttribute('initiator_id', Yii::$app->user->id);
        $friendsItem->setAttribute('initiated_id', $id);
        $friendsItem->save();
        return $this->render('index');
    }
    
    /**
     * Action deleting new friend or candidate.
     * @param Integer $id  - userID for delete friend.
     * @return String - rendered of view temlate. 
     */
    public function actionDeleteFriend($id)
    {
        Friends::deleteFriend($id);
        return $this->render('index');
    }
}
