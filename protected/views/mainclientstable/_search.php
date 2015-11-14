<?php
/* @var $this MainclientstableController */
/* @var $model Mainclientstable */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'id'); ?>
		<?php echo $form->textField($model,'id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'id_dogovota'); ?>
		<?php echo $form->textArea($model,'id_dogovota',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'familiy'); ?>
		<?php echo $form->textArea($model,'familiy',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'name'); ?>
		<?php echo $form->textArea($model,'name',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'otchestvo'); ?>
		<?php echo $form->textArea($model,'otchestvo',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'dateDogovora'); ?>
		<?php echo $form->textField($model,'dateDogovora'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'agent'); ?>
		<?php echo $form->textArea($model,'agent',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'adress'); ?>
		<?php echo $form->textArea($model,'adress',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'telefon'); ?>
		<?php echo $form->textArea($model,'telefon',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'dateRozhdenia'); ?>
		<?php echo $form->textField($model,'dateRozhdenia'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'dogovorStatus'); ?>
		<?php echo $form->textField($model,'dogovorStatus'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'posledniyContact'); ?>
		<?php echo $form->textField($model,'posledniyContact'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'pozvoniti'); ?>
		<?php echo $form->textField($model,'pozvoniti'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'statusClient'); ?>
		<?php echo $form->textField($model,'statusClient'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'commentHistory'); ?>
		<?php echo $form->textArea($model,'commentHistory',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'dataConsultacii'); ?>
		<?php echo $form->textField($model,'dataConsultacii'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'timeConsultacii'); ?>
		<?php echo $form->textField($model,'timeConsultacii'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->