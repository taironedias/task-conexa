<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'post-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Os campos com <span class="required">*</span> são obrigatórios.</p>
	
	<?php echo $form->errorSummary($model); ?>
	
	<div class="row">
		<?php echo $form->labelEx($model,'autor'); ?>
		<?php echo $form->textField($model,'autor',array('size'=>40,'maxlength'=>128)); ?>
		<?php echo $form->error($model,'autor'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'titulo'); ?>
		<?php echo $form->textField($model,'titulo',array('size'=>40,'maxlength'=>128)); ?>
		<?php echo $form->error($model,'titulo'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'texto'); ?>
		<?php echo $form->textArea($model,'texto',array('maxlength'=>500,'rows'=>6, 'cols'=>60, 'placeholder'=>'Máximo 500 caracteres')); ?>
		<?php echo $form->error($model,'texto'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'idCategoria'); ?>
		<?php echo $form->dropDownList($model, 'idCategoria', CHtml::listData(Categoria::model()->findAll(), 'id', 'name'), array('empty'=>$model->idCategoria));?>
		<?php echo $form->error($model,'idCategoria'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Criar Post' : 'Atualizar'); ?>
	</div>

	<p><center><font color="red"><?php echo $permissionUpdate; ?></font></center></p>

<?php $this->endWidget(); ?>

</div><!-- form -->