<?php

namespace app\models;

use yii\base\Model;
use Yii;
use yii\helpers\VarDumper;

class RegisterForm extends Model
{
    public string $username = '';
    public string $email = '';
    public string $password = '';
    public string $passwordRepeat = '';


    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [['username', 'email', 'password','passwordRepeat'], 'required'],
            ['username', 'string', 'min' => 3, 'max' => 20],
            ['email', 'email'],
            ['password', 'string', 'min' => 5, 'max' => 255],
            ['username', 'validateName'],
            ['passwordRepeat', 'compare', 'compareAttribute' => 'password']
        ];
    }

    public function register(): bool
    {
        $user = new User();
        $user->username = $this->username;
        $user->password = Yii::$app->security->generatePasswordHash($this->password);
        $user->salt = Yii::$app->security->generateRandomString();
        $user->auth_key = Yii::$app->security->generateRandomString();
        $user->access_token = Yii::$app->security->generateRandomString();
        $user->email = $this->email;

        if($user->save())
        {
            Yii::$app->user->login($user, 0);
            return true;
        }
        else
        {
            Yii::error('User not saved in DB.'.VarDumper::dump($user->errors));
            return false;
        }
    }

    public function validateName($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $user = $this->getUser();

            if (!$user || !$user->avaliableUsername($this->username)) {
                $this->addError($attribute, 'This user is already exist.');
            }
        }
    }

    public function getUser()
    {
        return User::findIdentityByUsername($this->username);
    }
}