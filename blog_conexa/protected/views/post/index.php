<head>
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/custom.css" />
</head>
<?php
$this->breadcrumbs=array(
	'Posts',
);

$this->menu=array(
	array('label'=>'Create Post', 'url'=>array('create')),
	array('label'=>'Manage Post', 'url'=>array('admin')),
);
?>

<h1>Posts</h1>

<!-- <div class="card">
  <img src="https://www.w3schools.com/howto/img_avatar.png" alt="Avatar" style="width:50%">
  <div class="container">
    <h4><b>John Doe</b></h4> 
    <p>Architect & Engineer</p> 
  </div>
</div> -->

<?php 
// echo $dataProvider->model->id; 
foreach($dataProvider->data as $data) {
	// echo '<h1> #'. $data->titulo .'</h1><br>';
	echo '	<div class="card">
				<p class="cardHeader">Por <font color="black">'. $data->autor .'</font> | '. $data->dataPost .'</p>
				<h4 class="cardTitle"><b>'. $data->titulo .'</b></h4>
				<p class="cardText">'. $data->texto .'</p>
				<div class="cardFooter">
					<p class="cardHeader">Comentários: </p>
					<a>'. CHtml::link('Leia mais...', ['post/view&id='. $data->id]) .'</a>
				</div>
			</div>'
			;
	}
?>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
