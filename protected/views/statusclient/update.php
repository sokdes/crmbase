<?php
/* @var $this StatusclientController */
/* @var $model Statusclient */

$this->breadcrumbs=array(
	'Statusclients'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Statusclient', 'url'=>array('index')),
	array('label'=>'Create Statusclient', 'url'=>array('create')),
	array('label'=>'View Statusclient', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Statusclient', 'url'=>array('admin')),
);
?>

<h1>Update Statusclient <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>