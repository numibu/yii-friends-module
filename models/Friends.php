<?php

namespace app\modules\friends\models;

use Yii;
use common\models\User;
use app\modules\friends\models\UserC;

/**
 * This is the model class for table "friends".
 *
 * @property integer $initiator_id
 * @property integer $initiated_id
 *
 * @property User $initiated
 * @property User $initiator
 */
class Friends extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'friends';
    }
    
    /**
     * Returning fiel name for primaryKey
     * @return array
     */
    public static function primaryKey() {
        parent::primaryKey();
        return ['initiator_id'];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['initiator_id', 'initiated_id'], 'required'],
            [['initiator_id', 'initiated_id'], 'integer'],
            [['initiated_id'], 'exist', 'skipOnError' => true, 'targetClass' => UserC::className(), 'targetAttribute' => ['initiated_id' => 'id']],
            [['initiator_id'], 'exist', 'skipOnError' => true, 'targetClass' => UserC::className(), 'targetAttribute' => ['initiator_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'initiator_id' => 'Initiator ID',
            'initiated_id' => 'Initiated ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInitiated()
    {
        return $this->hasOne(User::className(), ['id' => 'initiated_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInitiator()
    {
        return $this->hasOne(User::className(), ['id' => 'initiator_id']);
    }
    
    /**
     * Action deleting new friend or candidate.
     * @param type $friendId - userID for delete friend.
     */
    public static function deleteFriend($friendId) 
    {
        $initiator = self::find()->where([
                        'initiator_id' => $friendId,
                        'initiated_id' => Yii::$app->user->id 
                    ])->one();
        $initiated = self::find()->where([
                        'initiator_id' => Yii::$app->user->id,
                        'initiated_id' => $friendId
                    ])->one();
        
        if ( $initiator instanceof self ) { $initiator->delete(); }
        if ( $initiated instanceof self ) { $initiated->delete(); }
    }
}
