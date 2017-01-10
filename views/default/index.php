<?php
/**
 * 
 */

use app\modules\friends\widget\friendsList\FriendsList as FriendsList;
/*
$users = \app\modules\friends\models\UserC::find()->with('friendsx')->all();
$asd = $users[2]->friendsx;
$x=123;*/
?>
<div class="friends-default-index hidden">
    <h1><?= $this->context->action->uniqueId ?></h1>
    <p>
        This is the view content for action "<?= $this->context->action->id ?>".
        The action belongs to the controller "<?= get_class($this->context) ?>"
        in the "<?= $this->context->module->id ?>" module.
    </p>
    <p>
        You may customize this page by editing the following file:<br>
        <code><?= __FILE__ ?></code>
    </p>
</div>     
    <?= FriendsList::widget(); ?>
