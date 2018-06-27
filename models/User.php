<?php

namespace app\models;
use yii\web\IdentityInterface;
use yii\web\UploadedFile;

/**
 * This is the model class for table "user".
 *
 * @property int $id
 * @property string $name
 * @property string $photo
 * @property string $login
 * @property string $password
 * @property int $position_id
 * @property string $start_date
 * @property int $salary
 *
 *
 * @property Hierarchy[] $hierarchies
 * @property Hierarchy[] $hierarchies0
 * @property Position $position
 */
class User extends \yii\db\ActiveRecord implements IdentityInterface
{


    public $pass;
    public $chief;
    public $imageFile;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'position_id', 'start_date', 'salary', 'position_id'], 'required'],
            [['login'], 'unique'],
            [['position_id', 'salary'], 'integer'],
            [['name', 'password', 'photo'], 'string', 'max' => 100],
            [['login', 'pass'], 'string', 'max' => 15],
            [['position_id'], 'exist', 'skipOnError' => true, 'targetClass' => Position::className(), 'targetAttribute' => ['position_id' => 'id']],
            [['Chief', 'start_date'], 'safe'],
            [['imageFile'], 'file', 'extensions' => 'png, jpg'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'position_id' => 'Position ID',
            'start_date' => 'Start Date',
            'salary' => 'Salary',
            'pass' => 'Password'
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHierarchies()
    {
        return $this->hasMany(Hierarchy::className(), ['chief_user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHierarchies0()
    {
        return $this->hasMany(Hierarchy::className(), ['subordinate_user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPosition()
    {
        return $this->hasOne(Position::className(), ['id' => 'position_id']);
    }

    public function getPositionName()
    {
        return Position::find()
            ->select('position')
            ->where('id = '.$this->position_id)
            ->asArray()
            ->one()['position'];
    }

    public function getChiefName()
    {
        $chief_id = Hierarchy::getChiefId($this->id);

        if($chief_id != NULL) {
            return User::find()
                ->select('name')
                ->where('id = ' . Hierarchy::getChiefId($this->id))
                ->asArray()
                ->one()['name'];
        }else{
            return '----';
        }
    }

    /**
     * @param $password
     * @return string
     */
    public static function encrypt($password)
    {
        return md5($password);
    }

    /**
     * @return string
     */
    protected function upload()
    {
        if ($this->validate()) {
            $path = 'img/' . $this->imageFile->baseName . '.' . $this->imageFile->extension;

            $this->imageFile->saveAs($path);

            return '/web/' . $path;
        } else {
            return '';
        }
    }

    public function uploadImage()
    {
        $this->imageFile = UploadedFile::getInstance($this, 'imageFile');

        if($this->imageFile != null) {
            $this->photo = $this->upload();
            $this->imageFile = null;
        }
    }

    public static function findByLogin($login)
    {
        return User::find()
            ->where(['login' => $login])
            ->one();
    }

    public static function findIdentity($id)
    {
        return User::find()
            ->where(['id' => $id])
            ->one();
    }

    public static function findIdentityByAccessToken($token, $type = null)
    {
        return false;
    }

    /**
     * @return int|string
     */
    public function getId()
    {
        return $this->id;
    }

    public function getAuthKey()
    {
        return false;
    }

    public function validateAuthKey($authKey)
    {
        return false;
    }

    /**
     * @return array
     */
    public static function getUsersList()
    {
        $users_src = User::find()
            ->select('user.id, user.name, position.position')
            ->innerJoin('position', 'user.position_id = position.id')
            ->orderBy('name')
            ->asArray()
            ->all();

        if($users_src != null){

            foreach ($users_src as $key => $val){
                $users[$val['id']] = $val['name'] . ' (' . $val['position'] . ')';
            }
        }else{
            $users = [];
        }

        return $users;
    }
}
