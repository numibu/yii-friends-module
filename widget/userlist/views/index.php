<?php
/**
 * This view of UserList. app\modules\friends\widget\userlist\view\index.php
 * @var $widgetInstance app\modules\friends\widget\userlist\UserList
*/

use yii\helpers\Html as Html;
use yii\helpers\Url as Url;

?>
<div>
    <?= yii\grid\GridView::widget([
    'dataProvider' => $userProvider,
    'columns' => [
        ['class' => 'yii\grid\SerialColumn'],

        'username',
        'email',

        [
            'class' => 'yii\grid\ActionColumn',
            'header' => 'Actions',
            'template' => $widgetInstance->getButtonTemplate(),
            'buttons' => [
                'delete-friend' => $widgetInstance->deleteFriendButton(),
                        
                'view' => function( $url, $model ){
                    if ( Yii::$app->user->id === $model->id ) {
                        return Html::a(
                            '<span class="glyphicon glyphicon-eye-open"></span>', 
                            Url::toRoute( 'view/' . $model->id )
                            );
                    } 
                    return '';
                },
                        
                'add-friend' => $widgetInstance->addFriendButton(),
                        
                        
                'login' => function($url,$model){
                     return Html::a(
'<span class="glyphicon glyphicon-user"></span><span>login</span>', $url);
                     
                }
            ],
        ],
    ],
    ]); ?>
</div>