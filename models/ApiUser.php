<?php

namespace humhub\modules\api\models;
use Yii;

/**
 * This is the model class for table "api_user".
 *
 * @property integer $id
 * @property string $client
 * @property string $api_key
 * @property boolean $active
 */
class ApiUser extends \yii\db\ActiveRecord 
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'api_user';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['client', 'api_key'], 'required'],
            [['active'], 'boolean'],
            [['client'], 'string', 'max' => 255],
            [['api_key'], 'string', 'max' => 32]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'client' => 'Client',
            'api_key' => 'Api Key',
            'active' => 'Active',
        ];
    }

    public function getId()
    {
        return $this->id;
    }

    public static function findIdentityByAccessToken($token, $type = null)
    {
        return static::findOne(['api_key' => $token, 'active' => 1]);
    }

    public function getAuthKey()
    {
        return $this->api_key;
    }
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }
    
    public static function findIdentity($id)
    {
        return static::findOne($id);
    }
}
