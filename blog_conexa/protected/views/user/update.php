<?php
$this->menu=array(
	array('label'=>'Ver dados', 'url'=>array('view', 'id'=>$model->id)),
);
?>

<h2>Atualizando os dados</h2>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>