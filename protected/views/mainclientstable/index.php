<?php
/* @var $this MainclientstableController */
/* @var $dataProvider CActiveDataProvider */

$this->pageTitle = 'Главная';
$this->menu=array(
	array('label'=>'Create Mainclientstable', 'url'=>array('create')),
	array('label'=>'Manage Mainclientstable', 'url'=>array('admin')),
);
?>
 

<!--
подгружаем скрипты для работы календаря и правильного формата даты при передаче ее в запрос
-->

<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery-ui.js"></script>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/changeDateJS.js"></script>



<div id="datepicker" class="calendar_checkdate"></div>
<div class="clientsCartHead"><div><h4>Клиенты с договором</h4></div><div><h4>Потенциальные клиенты</h4></div></div>
<div id="cartsClient">
<?php $this->renderPartial('_viewCartsToDate', array('dataProvider'=>$dataProvider, 'dateClick'=>$dateClick)); ?>
<?php $this->renderPartial('_viewCartsPotenToDate', array('dataProviderPoten'=>$dataProviderPoten, 'dateClick'=>$dateClick)); ?>
<?php $this->renderPartial('_viewCartsAgentToDate', array('dataProviderAgent'=>$dataProviderAgent, 'dateClick'=>$dateClick)); ?>
</div>


<script type="text/javascript" charset="utf-8">
/**Меняем: 
* надписи в календаре на русские
* формат выводимой даты
* при нажатии на нужную дату она вызывает AJAX запрос для поиска карточек 
**/
$(function() {
$( "#datepicker" ).datepicker(
{
			//changeMonth: true,
			//changeYear: true,

			yearRange: "2013:2048",
			firstDay: 1, 

			  dateFormat: "yy-mm-dd",
              defaultDate: "<?php echo $dateClick; ?>",
			  dayNamesMin: ['Вс', 'Пн', 'Вт', 'Ср', 'Чт', 'Пт', 'Сб'],
			  dayNames: ["Воскресенье", "Понедельник", "Вторник", "Среда", "Четверг", "Пятница", "Суббота", "Воскресенье"],
			  dayNamesShort: ["Вск", "Пнд", "Втр", "Срд", "Чтв", "Птн", "Суб", "Вск"],
			  dayNamesMin: ["Вс", "Пн", "Вт", "Ср", "Чт", "Пт", "Сб", "Вс"],
			  monthNames: ["Январь", "Февраль", "Март", "Апрель", "Май", "Июнь", "Июль", "Август", "Сентябрь", "Октябрь", "Ноябрь", "Декабрь"],
			  monthNamesShort: ["Янв", "Фев", "Мар", "Апр", "Май", "Июн", "Июл", "Авг", "Сен", "Окт", "Ноя", "Дек"],
			  onSelect: function() { 
				var dateAsObject = $(this).datepicker( 'getDate' ); //the getDate method
				var dateFormat = dateAsObject.format("yyyy-mm-dd");
				
				jQuery.ajax({
					dataType: 'html',
					type: 'POST',
					url: 'index.php?r=mainclientstable/viewCartsToOtherDate',
					data: {'dateClick': dateFormat},
					cache: false,
					success: function(html){
						$('#cartsClient').html(html);
						
					}
				});
			   }
		  }
);


});
</script>