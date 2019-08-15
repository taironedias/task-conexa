<?php
$this->menu=array(
	array('label'=>'Ver Posts', 'url'=>array('index')),
	array('label'=>'Criar Post', 'url'=>array('create')),
);
?>

<h1>Atualizar Post</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model, 'permissionUpdate'=>$permissionUpdate)); ?>