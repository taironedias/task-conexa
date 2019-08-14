<head>
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/custom.css" />
</head>
<?php
$this->breadcrumbs=array(
	'Posts'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Post', 'url'=>array('index')),
	array('label'=>'Create Post', 'url'=>array('create')),
	array('label'=>'Update Post', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Post', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Post', 'url'=>array('admin')),
);
?>


<?php

	echo 	'<div>
				<h1><b>'. $model->titulo .'</b></h1>
				<p>Por <font color="black">'. $model->autor .'</font> | '. $model->dataPost .' ('. $categoria->name .')</p>
				<p class="viewText">'. $model->texto .'</p>
			</div>'
			;

?>

<p>Comentários:</p>
<?php 
	foreach($comentarios as $comment) {
		echo 	'<div>
					<h4 style="margin:0%;"><font color="#FD940C">'. $comment["username"] .'</font> disse:</h4>
					<p><span class="viewComment">"'. $comment["texto"] .'"</span></p>
				</div>'
				;
	}
?>


