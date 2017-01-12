<?php
namespace app\modules\friends\models;

use common\models\User as User;
use app\modules\friends\models\Friends as Friends;


class UserC extends User {

    /**
     * This Method returns The created DB command instance. 
     * To selects a friends of user.
     * @return yii\db\Command     
     */
    public function getFriends()
    {  
        $result = (new \yii\db\Query())
                ->select(['f.initiator_id', 'f.initiated_id'])
                ->from(Friends::tableName() . ' as f')
                ->join('INNER JOIN', Friends::tableName() . ' as f2','f.initiator_id = f2.initiated_id AND f2.initiator_id = f.initiated_id' )
                ->where('f.initiator_id <> f2.initiator_id')
                ->andWhere( "f.initiator_id = $this->id OR f2.initiator_id = $this->id" )
                ->createCommand()/*->queryAll()*/;

        return $result;
    }
    
    /**
     * This Method returns the created DB command instance. 
     * To selects a candidates of user.
     * @return yii\db\Command     
     */
    public function getCandidate()
    {
        /** SELECT DISTINCT f.initiator_id, f.initiated_id FROM friends as f
            INNER JOIN friends as f2 ON  f.initiated_id = f2.initiated_id 
            WHERE NOT EXISTS (SELECT initiator_id FROM friends 
            WHERE initiator_id = f.initiated_id AND initiated_id = f.initiator_id)
            AND f2.initiated_id = 4 AND f.initiated_id = 4*/
        $result = (new \yii\db\Query())
                ->select(['f.initiator_id', 'f.initiated_id'])
                ->distinct()
                ->from(Friends::tableName() . ' as f')
                ->join('INNER JOIN', Friends::tableName() . ' as f2','f.initiated_id = f2.initiated_id' )
                ->where('NOT EXISTS 
                        (SELECT initiator_id FROM friends 
                        WHERE initiator_id = f.initiated_id 
                        AND initiated_id = f.initiator_id)')
                ->andWhere( "f2.initiated_id = $this->id AND f.initiated_id = $this->id" )
                ->createCommand()/*->queryAll()*/;
        
        return $result;
    }
}
