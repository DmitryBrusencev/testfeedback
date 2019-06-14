<?php use yii\helpers\Url; ?>
<?php use Yii; ?>
<?php use yii\helpers\Html; ?>

<table style="width:100%;">
	<tbody>
		<tr>
			<td>
				<h2>Спасибо за ваше обращение!</h2>
				<p>Ваше сообщение принято и вскоре будет обработанно администратором сайта! Вскоре с вами свяжутся.</p> 

				<?php if ( !empty( $data['userEmail'] ) ) : ?>
					<hr>
					<?= Html::a('История сообщений пользователя', 
						Yii::$app->urlManager->createAbsoluteUrl(['feedback-history', 'email' => $data['userEmail']])
					)?>
				<?php endif; ?>
			</td>
		</tr>
	</tbody>
</table>