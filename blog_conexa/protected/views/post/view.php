<head>
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/custom.css" />
</head>
<?php
$teste = "123";
$this->menu = array(
	array('label' => 'Ver Posts', 'url' => array('index')),
	array('label' => 'Criar Post', 'url' => array('create')),
	array(
		'label' => 'Atualizar Post', 
		'url' => array(
			'update', 
			'id' => $model->id
		),
		'visible' => $model->idUser == Yii::app()->user->id
	),
);
?>


<?php
echo 	'<div>
			<h1><b>' . $model->titulo . '</b></h1>
			<p>Por <font color="black">' . $model->autor . '</font> | ' . $model->dataPost . ' (' . $categoria->name . ')</p>
			<p class="viewText">' . $model->texto . '</p>
		</div>';

?>

<p>Comentários:</p>
<?php
foreach ($comentarios as $comment) {
	echo 	'<div>
					<h4 style="margin:0%;"><font color="#FD940C">' . $comment["username"] . '</font> disse:</h4>
					<p><span class="viewComment">"' . $comment["texto"] . '"</span></p>
				</div>';
}
?>

<div class="form">
	<?php $form = $this->beginWidget('CActiveForm', array(
		'id' => 'comentario-form',
		'enableAjaxValidation' => false,
	)); ?>

	<div class="row">
		<?php echo $form->textArea($modelComment, 'texto', array('maxlength' => 500, 'rows' => 6, 'cols' => 40, 'placeholder' => 'Digite seu comentário')); ?>
		<?php echo $form->error($modelComment, 'texto'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Enviar comentário', $htmlOptions); ?>
	</div>

	<?php $this->endWidget(); ?>
</div>