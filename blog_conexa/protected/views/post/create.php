<?php
$this->menu=array(
	array('label'=>'Ver Posts', 'url'=>array('index')),
);
?>

<h1>Criar Post</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model,'permissionUpdate'=>$permissionUpdate)); ?>