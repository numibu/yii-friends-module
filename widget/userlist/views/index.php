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
                'delete-friend' => function($url, $model) use ($friendsArray){
                    if (array_key_exists( $model->id, $friendsArray )){
                        return Html::a(
                            '<span class="glyphicon glyphicon-minus"></span>', 
                        $url);
                    }
                    return '';
                },
                'view' => function($url,$model){
                    if (Yii::$app->user->id === $model->id) {
                        return Html::a(
                            '<span class="glyphicon glyphicon-eye-open"></span>', 
                        Url::toRoute( 'view/' . $model->id) );
                    } 
                    return '';
                },
                'add-friend' => function($url, $model)  use ($friendsArray, $candidate){
                    if (Yii::$app->user->id === $model->id) {
                        return '';
                    }
                    if (array_key_exists( $model->id, $friendsArray ) ){
                        return '';
                    }
                    if (array_key_exists( $model->id, $candidate ) ){
                        return '';
                    }
                    return Html::a(
                        '<span class="glyphicon glyphicon-plus"></span>',
                    $url);
                },
                'login' => function($url,$model){
                     return Html::a(
'<span class="glyphicon glyphicon-user"></span><span>login</span>', $url);
                     
                }
            ],
        ],
    ],
    ]); ?>
</div>