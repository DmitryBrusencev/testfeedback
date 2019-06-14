<?php use \yii\widgets\ActiveForm; ?>
<?php use yii\captcha\Captcha; ?>
<?php use yii\helpers\Html; ?>
<?php use yii\helpers\Url; ?>

<div class="row">
	<div class="col-lg-5">
		<?php $form = ActiveForm::begin(['id' => 'contact-form']); ?>
			<?= $form->field($model, 'name')->textInput(['autocomplete' => 'off']) ?>
			<?= $form->field($model, 'email') ?>
			<?= $form->field($model, 'message')->textarea(['rows' => 10, 'cols' => 7]) ?>
			<?= $form->field($model, 'capcha')->label("Решите уравнение: " . $model->first_number . " " . $model->operator . " " . $model->second_number ." = ") ?>
			<?= $form->field($model, 'first_number')->hiddenInput()->label(false) ?>
			<?= $form->field($model, 'second_number')->hiddenInput()->label(false) ?>
			<?= $form->field($model, 'operator')->hiddenInput()->label(false) ?>

			<div class="form-group">
            	<?= Html::submitButton('Отправить', ['class' => 'btn btn-primary', 'name' => 'contact-button']) ?>
            </div>
		<?php ActiveForm::end(); ?>
	</div>
</div>
