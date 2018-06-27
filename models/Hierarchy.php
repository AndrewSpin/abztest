<?php

namespace app\models;

/**
 * This is the model class for table "hierarchy".
 *
 * @property int $id
 * @property int $chief_user_id
 * @property int $subordinate_user_id
 *
 * @property User $chiefUser
 * @property User $subordinateUser
 */
class Hierarchy extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'hierarchy';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['chief_user_id', 'subordinate_user_id'], 'integer'],
            [['chief_user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['chief_user_id' => 'id']],
            [['subordinate_user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['subordinate_user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'chief_user_id' => 'Chief User ID',
            'subordinate_user_id' => 'Subordinate User ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getChiefUser()
    {
        return $this->hasOne(User::className(), ['id' => 'chief_user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSubordinateUser()
    {
        return $this->hasOne(User::className(), ['id' => 'subordinate_user_id']);
    }

    public static function getChiefId($user_id)
    {
        return Hierarchy::find()
            ->select('chief_user_id')
            ->where('subordinate_user_id = ' . $user_id)
            ->asArray()
            ->one()['chief_user_id'];
    }
}
