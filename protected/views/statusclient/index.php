<?php
/* @var $this StatusclientController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Statusclients',
);

$this->menu=array(
	array('label'=>'Create Statusclient', 'url'=>array('create')),
	array('label'=>'Manage Statusclient', 'url'=>array('admin')),
);
?>

<h1>Statusclients</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
