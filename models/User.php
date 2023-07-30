<?php

namespace app\models;

use Yii;
use yii\web\IdentityInterface;

/**
 * This is the model class for table "tbl_user".
 *
 * @property int $id
 * @property string $username
 * @property string $password
 * @property string $salt
 * * @property string $email
 * @property string $auth_key
 * @property string $access_token
 *
 * @property Comment[] $Comments
 */
class User extends \yii\db\ActiveRecord implements IdentityInterface
{
    /**
     * {@inheritdoc}
     */
    public static function tableName(): string
    {
        return 'tbl_user';
    }

    /**
     * {@inheritdoc}
     */
    public function rules(): array
    {
        return [
            [['username', 'password', 'salt', 'email', 'auth_key', 'access_token'], 'required'],
            [['username'], 'string', 'min' => 3, 'max' => 20],
            [['password', 'salt'], 'string', 'max' => 255],
            [['email'], 'string', 'max' => 25],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels(): array
    {
        return [
            'id' => 'ID',
            'username' => 'Username',
            'password' => 'Password',
            'salt' => 'Salt',
            'email' => 'Email',
        ];
    }

    /**
     * Gets query for [[TblComments]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getComments()
    {
        return $this->hasMany(Comment::class, ['author_id' => 'id']);
    }

    public static function findIdentity($id)
    {
        return self::findOne($id);
    }

    public static function findIdentityByAccessToken($token, $type = null)
    {
        return self::find()->where(['access_token'=>$token])->one();
    }

    public static function findIdentityByUsername(string $username): User
    {
        return self::findOne(['username'=>$username]);
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getAuthKey(): string
    {
        return $this->auth_key;
    }

    public function validateAuthKey($authKey): bool
    {
        return $this->auth_key === $authKey;
    }

    public function validatePassword($password): bool
    {
        return Yii::$app->security->validatePassword($password, $this->password);
    }

    public function avaliableUsername($username)
    {
        return self::findOne(['username' => $username])->cache(3600) === null;
    }
}
