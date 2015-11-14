<?php
/* @var $this MainclientstableController */
/* @var $model Mainclientstable */

$this->breadcrumbs=array(
	'Mainclientstables'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List Mainclientstable', 'url'=>array('index')),
	array('label'=>'Create Mainclientstable', 'url'=>array('create')),
	array('label'=>'Update Mainclientstable', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Mainclientstable', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Mainclientstable', 'url'=>array('admin')),
);
?>

<h1>View Mainclientstable #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'id_dogovota',
		'familiy',
		'name',
		'otchestvo',
		'dateDogovora',
		'agent',
		'adress',
		'telefon',
		'dateRozhdenia',
		'dogovorStatus',
		'posledniyContact',
		'pozvoniti',
		'statusClient',
		'commentHistory',
		'dataConsultacii',
		'timeConsultacii',
	),
)); ?>
