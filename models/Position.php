<?php

namespace app\models;

/**
 * This is the model class for table "position".
 *
 * @property int $id
 * @property string $position
 *
 * @property User[] $users
 */
class Position extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'position';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['position'], 'string', 'max' => 15],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'position' => 'Position',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsers()
    {
        return $this->hasMany(User::className(), ['position_id' => 'id']);
    }

    /**
     * @return array
     */
    public static function getPositionList()
    {
        $position_src = Position::find()->asArray()->all();

        if($position_src != null){

            foreach ($position_src as $key => $val){
                $position[$val['id']] = $val['position'];
            }
        }else{
            $position = [];
        }

        return $position;
    }
}
