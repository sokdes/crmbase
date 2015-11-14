<?php
/* @var $this StatusclientController */
/* @var $model Statusclient */

$this->breadcrumbs=array(
	'Statusclients'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Statusclient', 'url'=>array('index')),
	array('label'=>'Manage Statusclient', 'url'=>array('admin')),
);
?>

<h1>Create Statusclient</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>