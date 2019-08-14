<?php
// $this->breadcrumbs=array(
// 	'Users'=>array('index'),
// 	$model->id,
// );

$this->menu=array(
	// array('label'=>'List User', 'url'=>array('index')),
	// array('label'=>'Create User', 'url'=>array('create')),
	
	// array('label'=>'Atualizar dados: id='.$model->id, 'url'=>array('update', 'id'=>$model->id,'name'=>$model->username)),
	array('label'=>'Atualizar dados', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Apagar conta', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Você tem certeza que deseja apagar a sua conta?')),
	// array('label'=>'Manage User', 'url'=>array('admin')),
	array('label' => 'Logout', 'url' => array('/site/logout'))
);
?>

<h2>Seus dados</h2>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'username',
		'password',
		'email',
	),
)); ?>
