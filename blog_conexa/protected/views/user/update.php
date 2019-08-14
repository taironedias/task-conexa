<?php
// $this->breadcrumbs=array(
// 	'Users'=>array('index'),
// 	$model->id=>array('view','id'=>$model->id),
// 	'Update',
// );	

$this->menu=array(
	// array('label'=>'List User', 'url'=>array('index')),
	// array('label'=>'Create User', 'url'=>array('create')),
	array('label'=>'Ver dados', 'url'=>array('view', 'id'=>$model->id)),
	// array('label'=>'Manage User', 'url'=>array('admin')),
);
?>

<h2>Atualizando os dados</h2>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>