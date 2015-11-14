<?php
/* @var $this MainclientstableController */
/* @var $model Mainclientstable */
/* @var $form CActiveForm */
?>

<div class="form createClientCard">

<?php 

$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(

		'id'=>'mainclientstable-form',
		'type'=>'horizontal',
		'enableAjaxValidation'=>false,

)); ?>

	<p class="note">Поля помеченные <span class="required">*</span> обязательны для заполнения.</p>
<div class="blockDataClient">
	<?php echo $form->errorSummary($model); ?>


	<div class="row">
		<?php echo $form->textFieldRow($model,'familiy',array('style'=>'width: 100%; height: 10px')); ?>

	</div>

	<div class="row">
		<?php echo $form->textFieldRow($model,'name',array('style'=>'width: 100%; height: 10px')); ?>

	</div>

	<div class="row">
		<?php echo $form->textFieldRow($model,'otchestvo',array('style'=>'width: 100%; height: 10px')); ?>

	</div>
	
	<div class="row">
		<?php echo $form->textFieldRow($model,'agent',array('style'=>'width: 100%; height: 10px')); ?>

	</div>
	<div class="row">
		<?php echo $form->textFieldRow($model,'telefon',array('style'=>'width: 100%; height: 10px')); ?>

	</div>
	<div class="row">
		<?php echo $form->checkBoxRow($model,'dogovorStatus'); ?>

	</div>

</div>
<div class="blockDataClient">
	

	
	
	<div class="row">
		<?php echo $form->datepickerRow($model,'posledniyContact', array('prepend'=>'<i class="icon-calendar"></i>')); ?>

	</div>

	<div class="row">
		<?php echo $form->datepickerRow($model,'pozvoniti', array('prepend'=>'<i class="icon-calendar"></i>')); ?>
		
	</div>

	<div class="row">
		<?php echo $form->datepickerRow($model,'dataConsultacii', array('append'=>'<i class="icon-remove" id="remove-date"></i>', 'prepend'=>'<i class="icon-calendar" ></i>')); ?>
		
	</div>

	<div class="row">
		<?php echo $form->timepickerRow($model,'timeConsultacii', array('id'=>'timeConsultac', 'prepend'=>'<i class="icon-time"></i>')); ?>
		
	</div>

</div>
<div class="commentClient">
	<div class="row">
		<?php echo $form->labelEx($model,'commentHistory'); ?>
		<?php echo $form->textArea($model,'commentHistory',array('rows'=>9, 'cols'=>50)); ?>
		
	</div>
</div>
	<div class="row buttons">
		
		<?php 
		$this->widget('zii.widgets.jui.CJuiButton',array(
			'buttonType'=>'submit',
			'name'=>'Submit',
			'caption'=>$model->isNewRecord ? 'Создать' : 'Сохранить',
			'htmlOptions'=>array('class'=>'btn btn-primary')
			));
		?>
		
	</div>
	
	<div class="button_cansel">
		<?php 
		$this->widget('zii.widgets.jui.CJuiButton',array(
			'buttonType'=>'button',
			'name'=>'Cansel',
			'caption'=>'Отмена',
			'onclick'=>'function(){window.location.href ="index.php?r=mainclientstable/index";}',
			'htmlOptions'=>array('class'=>'btn btn-inverse')
			));
		?>
	</div>

<?php $this->endWidget(); ?>



</div><!-- form -->
<script type="text/javascript">
    $(function() {

		$( "#Mainclientstable_dateRozhdenia").datepicker({
			//changeMonth: true,
			yearRange: "1983:2048",
			changeYear: true,
			firstDay: 1, 
			  dateFormat: "yy-mm-dd",
			  dayNamesMin: ['Вс', 'Пн', 'Вт', 'Ср', 'Чт', 'Пт', 'Сб'],
			  dayNames: ["Воскресенье", "Понедельник", "Вторник", "Среда", "Четверг", "Пятница", "Суббота", "Воскресенье"],
			  dayNamesShort: ["Вск", "Пнд", "Втр", "Срд", "Чтв", "Птн", "Суб", "Вск"],
			  dayNamesMin: ["Вс", "Пн", "Вт", "Ср", "Чт", "Пт", "Сб", "Вс"],
			  monthNames: ["Январь", "Февраль", "Март", "Апрель", "Май", "Июнь", "Июль", "Август", "Сентябрь", "Октябрь", "Ноябрь", "Декабрь"],
			  monthNamesShort: ["Янв", "Фев", "Мар", "Апр", "Май", "Июн", "Июл", "Авг", "Сен", "Окт", "Ноя", "Дек"]
			  
		  });
		 
		$( "#Mainclientstable_dateRozhdenia, #Mainclientstable_posledniyContact, #Mainclientstable_pozvoniti, #Mainclientstable_dataConsultacii, #Mainclientstable_dateDogovora " ).datepicker({
		  //changeMonth: true,
		  //changeYear: true,
		  firstDay: 1, 
		  dateFormat: "yy-mm-dd",
		  dayNamesMin: ['Вс', 'Пн', 'Вт', 'Ср', 'Чт', 'Пт', 'Сб'],
		  dayNames: ["Воскресенье", "Понедельник", "Вторник", "Среда", "Четверг", "Пятница", "Суббота", "Воскресенье"],
		  dayNamesShort: ["Вск", "Пнд", "Втр", "Срд", "Чтв", "Птн", "Суб", "Вск"],
		  dayNamesMin: ["Вс", "Пн", "Вт", "Ср", "Чт", "Пт", "Сб", "Вс"],
		  monthNames: ["Январь", "Февраль", "Март", "Апрель", "Май", "Июнь", "Июль", "Август", "Сентябрь", "Октябрь", "Ноябрь", "Декабрь"],
		  monthNamesShort: ["Янв", "Фев", "Мар", "Апр", "Май", "Июн", "Июл", "Авг", "Сен", "Окт", "Ноя", "Дек"]
		  
		  
		});
		
		$('#timeConsultac').timepicker({
			minuteStep: 15,
			modalBackdrop: false,
			showSeconds: false,
			showMeridian: false,
			defaultTime: false
		});
		$("#timeConsultac").removeClass();
		
		$("#remove-date").click(function(){
				$("#Mainclientstable_dataConsultacii").val('');
				$("#timeConsultac").val('');
		});
		
		$("#remove-time").click(function(){
				
		});
		
		var poliaDate = new Array('#Mainclientstable_dateDogovora', '#Mainclientstable_dateRozhdenia', '#Mainclientstable_posledniyContact', '#Mainclientstable_pozvoniti', '#Mainclientstable_dataConsultacii');
		
		for(i=0; i < poliaDate.length; i++)	{
			console.log(poliaDate.length+'  '+$(poliaDate[i]).val());
			if($(poliaDate[i]).val()=="0000-00-00"){
				$(poliaDate[i]).val('');
			}
			if($(poliaDate[4]).val() == '0000-00-00'){
				$('#timeConsultac').val('');
			}
		}
		
		
			
	});

	
</script>