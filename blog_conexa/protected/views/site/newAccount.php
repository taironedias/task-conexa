<?php
/* @var $this SiteController */
/* @var $model LoginForm */
/* @var $form CActiveForm  */

$this->pageTitle = Yii::app()->name . ' - NewAccount';

?>

<h1>Criar uma conta</h1>

<div class="form">
	<?php $form = $this->beginWidget('CActiveForm', array(
		'id' => 'new-account-form',
		'enableClientValidation' => true,
		'clientOptions' => array(
			'validateOnSubmit' => true,
		),
	)); ?>

	<p class="note">Os campos com <span class="required">*</span> são obrigatórios.</p>

	<div class="row">
		<?php echo $form->labelEx($model, 'username'); ?>
		<?php echo $form->textField($model, 'username'); ?>
		<?php echo $form->error($model, 'username'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model, 'email'); ?>
		<?php echo $form->textField($model, 'email'); ?>
		<?php echo $form->error($model, 'email'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model, 'password'); ?>
		<?php echo $form->passwordField($model, 'password'); ?>
		<?php echo $form->error($model, 'password'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model, 'confirmPassword'); ?>
		<?php echo $form->passwordField($model, 'confirmPassword'); ?>
		<?php echo $form->error($model, 'confirmPassword'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Criar conta'); ?>
	</div>

	<?php $this->endWidget(); ?>
</div><!-- form -->