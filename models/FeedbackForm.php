<?php

namespace app\models;

use Yii;
use yii\base\Model;

use app\models\Feedback;

class FeedbackForm extends Model {

	public $name;
	public $email;
	public $message;
	public $capcha;
	public $first_number;
	public $second_number;
	public $operator;
	public $capcha_label;
	public $capcha_result;

	function __construct () {

		parent::__construct();

		$this->first_number 		= $this->getRandNumber();

		$this->second_number 		= $this->getRandNumber();
	    
		$this->operator 			= $this->getRandOperator();

	}

	public function rules () {

		return [
			// Правила валидации обязательных полей
			[['email','name','message','capcha'],'required','message'=>'Обязательное поле!'],
			
			// Правила валидации поля email: должно быть в формате email
			['email','email','message'=>'Не верный формат E-mail адреса!'],

			// Правила валидации для сообщения от пользователя
			['message', 'string', 'max' => '4000', 'tooLong' => 'Не более 4000 символов!'],

			// Правила валидации для поля name
			['name', 'string', 'max' => '80', 'tooLong' => 'Не более 80 символов!'],

		];

	}

	public function attributeLabels()
    {
        return [
            'email' 		=> 'E-mail адрес',
            'name'			=> 'Ваше Имя',
            'massage'		=> 'Ваше сообщение',
            'capcha'		=> 'asd'
        ];
    }

    public function validCapchaRes ( $attribute, $params ) {

    	$capcha_result = $this->getCapchaResult( $params['first_number'], $params['operator'], $params['second_number'] );

    	if ( !$this->hasErrors() ) {

    		if ( $capcha_result != $this->capcha ) {

    			$this->addError($attribute, 'Неверный ответ!');

    		} else {

    			return true;

    		}

    	}

    }

    public function getRandNumber () {

		return rand(1,29);

	}

	public function getRandOperator () {

		$operators = ['+','-'];

		$rand_key = array_rand( $operators );

		return $operators[$rand_key];

	}

	public function getCapchaResult ( $first_number, $operator, $second_number ) {

		switch ( $operator ) {
			case '-':
				return $first_number - $second_number;

				break;
			case '+':
				return $first_number + $second_number;

				break;

			default:
				return 0;

				break;
		}

	}

	public function save_feedback () {

		$feedback = new Feedback();

		$feedback->name 			= $this->name;
		$feedback->email 			= $this->email;
		$feedback->message 			= $this->message;
		$feedback->created_at 		= date("Y-m-d");
		$feedback->feedback_ip 		= Yii::$app->request->userIP;
		$feedback->created_time		= time();

		return $feedback->save();

	}

}