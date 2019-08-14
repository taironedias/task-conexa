<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'post-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'texto'); ?>
		<?php echo $form->textField($model,'texto',array('size'=>60,'maxlength'=>500)); ?>
		<?php echo $form->error($model,'texto'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'autor'); ?>
		<?php echo $form->textField($model,'autor',array('size'=>60,'maxlength'=>128)); ?>
		<?php echo $form->error($model,'autor'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'titulo'); ?>
		<?php echo $form->textField($model,'titulo',array('size'=>60,'maxlength'=>128)); ?>
		<?php echo $form->error($model,'titulo'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'dataPost'); ?>
		<?php echo $form->textField($model,'dataPost'); ?>
		<?php echo $form->error($model,'dataPost'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'idUser'); ?>
		<?php echo $form->textField($model,'idUser'); ?>
		<?php echo $form->error($model,'idUser'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'idCategoria'); ?>
		<?php echo $form->textField($model,'idCategoria'); ?>
		<?php echo $form->error($model,'idCategoria'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->