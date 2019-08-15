<head>
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/custom.css" />
</head>
<?php
$this->menu=array(
	array('label'=>'Criar Post', 'url'=>array('create')),
);
?>

<h1>Posts</h1>

<?php
	$cont=1;
	echo 'Categorias: ';
	foreach($model as $nameCategory) {
		echo '<a>'. CHtml::link($nameCategory->name, ['post/index&id='. $nameCategory->id]) .'</a>';
		if($cont<count($model))
			echo ', ';
		else
			echo ' ';
		$cont+=1;
	}
?>


<?php 
	$cont=0;
	foreach($dataProvider->data as $data) {
		$cont+=1;
		echo '	<div class="card">
					<p class="cardHeader">Por <font color="black">'. $data->autor .'</font> | '. $data->dataPost .'</p>
					<h4 class="cardTitle"><b>'. $data->titulo .'</b></h4>
					<p class="cardText">'. $data->texto .'</p>
					<div class="cardFooter">
						<p class="cardHeader">Comentários: '. Yii::app()->db->createCommand('SELECT COUNT(*) FROM Comentario WHERE idPost=:id')->queryScalar(array(':id'=>$data->id)) .'</p>
						<a>'. CHtml::link('Leia mais...', ['post/view&id='. $data->id]) .'</a>
					</div>
				</div>';
		// Uma forma de exibir apenas 10 posts na tela, como extensão poderia ter feito paginação
		if($cont >= 10) break;
	}
?>
