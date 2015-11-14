<?php
/* @var $this StatusclientController */
/* @var $model Statusclient */

$this->breadcrumbs=array(
	'Statusclients'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Statusclient', 'url'=>array('index')),
	array('label'=>'Create Statusclient', 'url'=>array('create')),
	array('label'=>'Update Statusclient', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Statusclient', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Statusclient', 'url'=>array('admin')),
);
?>

<h1>View Statusclient #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'idClient',
		'status',
	),
)); ?>
