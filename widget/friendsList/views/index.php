<?php

/**
 * This view of FriendsList. app\modules\friends\widget\friendsList\view\index.php
 */

/* @var $this yii\web\View */

/* @var $widgetInstance app\modules\friends\widget\friendsList\FriendsList */

use yii\helpers\Html;
use app\modules\friends\widget\userlist\UserList;

?>
    
<div>      
    <div class="tabs">

        <input id="tab1" type="radio" name="tabs" checked>
        <label for="tab1" title="Your friends">Friends</label>

        <input id="tab2" type="radio" name="tabs">
        <label for="tab2" title="Friend Ph.D.">+Friends</label>
        
        <input id="tab3" type="radio" name="tabs">
        <label for="tab3" title="All active users">All active users</label>


        <section id="content1">

<?= yii\grid\GridView::widget([
    'dataProvider' => $widgetInstance->friends,
    'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'Name',
            'Email',

            [
                'class' => 'yii\grid\ActionColumn',
                'header' => 'Actions',
                'template' => '{delete-friend}',
                'buttons' => [
                    'delete-friend' => function($url, $model){
                        return Html::a(
                        '<span class="glyphicon glyphicon-minus"></span>', 
                        $url);
                    }
                ],
            ]
    ],
]); ?>

        </section> 
        <section id="content2">

<?= yii\grid\GridView::widget([
    'dataProvider' => $widgetInstance->candidates,
    'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
 
            'Name',
            'Email',
 
            [
                'class' => 'yii\grid\ActionColumn',
                'header' => 'Actions',
                'template' => '{add-friend} {remove-friend}',
                'buttons' => [
                    'add-friend' => function($url, $model){
                        return Html::a(
                        '<span class="glyphicon glyphicon-plus"></span>',
                        $url); //'addfriend/'.$model['id']);
                    },
                    'remove-friend' => function($url, $model){
                         return Html::a(
                        '<span class="glyphicon glyphicon-minus"></span>', 
                        $url);
                    }
                ],
            ],
    ],
]); ?>
        </section> 
        
        <section id="content3">
    <?php  echo UserList::widget([
                'friendsList' => $widgetInstance->friends,
                'candidate' => $widgetInstance->candidates
            ]); ?>
        </section>
    </div>
</div>

<style>
    div.tabs section{
        display: none;  
    }
</style>
