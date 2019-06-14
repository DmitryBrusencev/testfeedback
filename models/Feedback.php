<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "feedback".
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string $message
 * @property string $created_at
 * @property string $feedback_ip
 * @property string $created_time
 */
class Feedback extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'feedback';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'email', 'message', 'created_at', 'feedback_ip'], 'required'],
            [['message'], 'string'],
            [['created_at', 'created_time'], 'safe'],
            [['name', 'email'], 'string', 'max' => 80],
            [['feedback_ip'], 'string', 'max' => 20],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Имя',
            'email' => 'Email',
            'message' => 'Сообщение пользователя',
            'created_at' => 'Создано',
            'feedback_ip' => 'IP',
            'created_time' => 'Created Time',
        ];
    }
}
