<?php

namespace app\controllers;

use Yii;

use yii\web\Controller;

use app\models\Feedback;
use app\models\FeedbackForm;
use app\models\FeedbackSearch;
use yii\web\HttpException;

class ProfileController extends Controller {

	public function actionFeedback () {

		$model = new FeedbackForm();

		if ( Yii::$app->request->post('FeedbackForm') ) {

			$model->attributes = Yii::$app->request->post('FeedbackForm');

			if ( $model->validate() && $model->validCapchaRes( 'capcha', Yii::$app->request->post('FeedbackForm') ) ) {

				if ( $this->check_feedback_interval() ) {

					if ( $model->save_feedback() ) {

						$session = Yii::$app->session;

						$session->set('last_feedback', time());


						$data = array();

						if ( $this->sendEmail( 'feedback', $model->email, 'Обратная связь', $data ) ) {

							$data['userEmail'] = $model->email;

							$this->sendEmail( 'feedback', Yii::$app->params['copyEmailToAdmin'], 'Обратная связь', $data );

							Yii::$app->session->setFlash('success', 'Спасибо! Ваше сообщение принято!');

							return $this->refresh();

						} else {

							Yii::$app->session->setFlash('error', 'Не удалось отправить письмо на почту!');
							Yii::error('Ошибка отправки письма.');

							return $this->refresh();

						}
							

					}

				} else {

					Yii::$app->session->setFlash('error', 'Слишком много сообщений! Вы можете отправлять сообщения раз в 2 минуты!');
					Yii::error('Ошибка отправки сообщения.');

					return $this->refresh();

				}

			}

		}

		return $this->render('index', [
			'model'		=> $model,
		]);

	}

	public function check_feedback_interval () {

		$session = Yii::$app->session;

		if ($session->has('language')) {

			return true;

		}

		$last_message_time = $session->get('last_feedback');

		$now_time = time();

		$interval = floor(abs($now_time - $last_message_time) / 60);

		if ( $interval >= 2 ) {

			return true;

		} else {

			return false;

		}

	}

	public function actionFeedbackHistory ( $email = '' ) {
		
		if ( empty($email) || !$this->checkToEmail( $email ) ) {

			throw new HttpException(404, 'User ' . $email . ' not found');

		}

		$searchModel = new FeedbackSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('history', [
            'searchModel' 	=> $searchModel,
            'dataProvider' 	=> $dataProvider,
            'email'			=> $email,
        ]);

	}

	public function checkToEmail ( $email ) {

		$feedback = Feedback::findOne(['email' => $email]);

		return ($feedback) ? true : false;

	}

	public function sendEmail ( $tmpl, $email, $subject, $data = array() ) {

		return Yii::$app->mailer->compose($tmpl, ['data' => $data])
			->setFrom([Yii::$app->params['supportEmail'] => 'Metra Skam'])
			->setTo($email)
			->setSubject($subject)
			->send();

	}

}