<?php
/* @var $this MainclientstableController */
/* @var $model Mainclientstable */
/* @var $form CActiveForm */
?>

<!--Окрывающееся окно с картинкой-->

<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.fancybox-1.3.4.pack.js"></script>
<link href="<?php echo Yii::app()->request->baseUrl; ?>/css/jquery.fancybox-1.3.4.css" rel="stylesheet" />
<script type="text/javascript">
    $(function() {
        $("a.lightImg").fancybox({
            'autoScale' : false

        });
    });
</script>

<div class="form createClientCard">

<?php 

$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(

		'id'=>'mainclientstable-form',
		'type'=>'horizontal',
		'enableAjaxValidation'=>false,
        'htmlOptions'=>array('onsubmit'=>'changeFormatData()'),

)); ?>

	<p class="note">Поля помеченные <span class="required">*</span> обязательны для заполнения.</p>
<div class="blockDataClient">
	<?php echo $form->errorSummary($model); ?>


	<div class="row">
		<?php echo $form->textFieldRow($model,'familiy',array('style'=>'width: 100%; height: 1.2em')); ?>

	</div>

	<div class="row">
		<?php echo $form->textFieldRow($model,'name',array('style'=>'width: 100%; height: 1.2em')); ?>

	</div>

	<div class="row">
		<?php echo $form->textFieldRow($model,'otchestvo',array('style'=>'width: 100%; height: 1.2em')); ?>

	</div>
	<div class="row client">
		<?php echo $form->textFieldRow($model,'id_dogovota',array('style'=>'width: 100%; height: 1.2em')); ?>

	</div>
	<div class="row client">
		<?php echo $form->datepickerRow($model,'dateDogovora', array('prepend'=>'<i class="icon-calendar"></i>')); ?>

	</div>

	<div class="row">
        <?php echo $form->textFieldRow($model,'telefon',array('style'=>'width: 100%; height: 1.2em')); ?>

	</div>
	<div class="row client">
		<?php echo $form->textFieldRow($model,'clientOplatil',array('style'=>'width: 100%; height: 1.2em')); ?>

	</div>
	<div class="row client">
		<?php echo $form->textFieldRow($model,'clientDolzhen',array('style'=>'width: 100%; height: 1.2em')); ?>

	</div>

	<div class="row dogovorY_N">
		<?php echo $form->checkBoxRow($model,'dogovorStatus'); ?>
	</div>

</div>
<div class="blockDataClient">
	

	<div class="row">
        <?php echo $form->textFieldRow($model,'agent',array('style'=>'width: 100%; height: 1.2em')); ?>
	</div>
	
	<div class="row client">
		<?php echo $form->textFieldRow($model,'adress',array('style'=>'width: 100%; height: 1.2em')); ?>

	</div>

	<div class="row client">
		<?php echo $form->datepickerRow($model,'dateRozhdenia', array('prepend'=>'<i class="icon-calendar"></i>')); ?>

	</div>
	<div class="row client">
		<?php echo $form->dropDownListRow($model,'statusClient', array('Статус не установлен', 'Договор заключен', 'Проходит обследование', 'Получил военный билет', 'Судимся с военкоматом', 'Подали жалобу в вышестоящую комиссию', 'Пошел в военкомат', 'Проходит обследование', 'Создает историю болезни', 'Подписали "В" на медкомиссии', 'Снят с обзвона', 'Агент')); ?>
		
	</div>
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
	<div id="filesHistory">
        <label>Файлы</label><img src="<?php echo Yii::app()->baseUrl; ?>/images/icons/add-new-imgs.png" id="botton_get_files">
        <div id="poleFile"><input id="poleFileImg" type="file" form="getFiles" name="poleFileImg" size="1"></div>
        <div id="imgFiles">
                <?php
                if($imgModel){
                    foreach($imgModel as $img){
                        echo '<div class="img_block" id="'.substr($img->img_name, 0, -4).'"><img src="' .Yii::app()->baseUrl .'/images/icons/icon_img_file_client.png" title="'.$img->name_doc.'"><div class="img_name"><a class="lightImg" title="'.$img->name_doc.'" href="'.Yii::app()->baseUrl.'/images/blockdatas/'.$img->id_client.'/'.$img->img_name.'" data-lightbox="'.substr($img->img_name, 0, -4).'" >'.substr($img->name_doc, 0, 28);
                        if(strlen($img->name_doc)>29){
                            echo '...';
                        }
                        echo '</a></div>';
                        echo '<div class="img_delete"><a href="#" onclick="deleteFile(\''.$img->img_name.'\', '.$img->id_client.')"><img src="' .Yii::app()->baseUrl .'/images/icons/img_delete.png"></a></div>';
                        echo '</div>';
                    }
                }
                ?>
        </div>
        <div id="fileClient"></div>

	</div>
    <div class="textHistory">
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

<form name="getFiles" method="post" action="#" id="formGetFiles">
</form>

</div><!-- form -->
<script type="text/javascript">

    function changeFormatData()
    {
        // Меняем формат дат на нужных нам "yy-mm-dd"
        //Сохраняем данные в переменные
        var datePoslVstr = $("#Mainclientstable_posledniyContact").val();
        var dateRozhden = $("#Mainclientstable_dateRozhdenia").val();
        var datePozvoniti = $("#Mainclientstable_pozvoniti").val();
        var dateConsultacii = $("#Mainclientstable_dataConsultacii").val();
        var dateDogovora = $("#Mainclientstable_dateDogovora").val();
        var date = new Array(datePoslVstr, dateRozhden, datePozvoniti, dateConsultacii, dateDogovora);
        var dateItog = new Array();

        //Меняем формат даты
        if(date[0]!=''){dateItog[0] = date[0].substr(-4,4)+'-'+date[0].substr(3,2)+'-'+date[0].substr(0,2);}else{dateItog[0] = ''}
        if(date[1]!=''){dateItog[1] = date[1].substr(-4,4)+'-'+date[1].substr(3,2)+'-'+date[1].substr(0,2);}else{dateItog[1] = ''}
        if(date[2]!=''){dateItog[2] = date[2].substr(-4,4)+'-'+date[2].substr(3,2)+'-'+date[2].substr(0,2);}else{dateItog[2] = ''}
        if(date[3]!=''){dateItog[3] = date[3].substr(-4,4)+'-'+date[3].substr(3,2)+'-'+date[3].substr(0,2);}else{dateItog[3] = ''}
        if(date[4]!=''){dateItog[4] = date[4].substr(-4,4)+'-'+date[4].substr(3,2)+'-'+date[4].substr(0,2);}else{dateItog[4] = ''}

        //Заменяем значения в полях на нужное по формату
        $("#Mainclientstable_posledniyContact").val(dateItog[0]);
        $("#Mainclientstable_dateRozhdenia").val(dateItog[1]);
        $("#Mainclientstable_pozvoniti").val(dateItog[2]);
        $("#Mainclientstable_dataConsultacii").val(dateItog[3]);
        $("#Mainclientstable_dateDogovora").val(dateItog[4]);

    }

    $(document).ready(function () {
        // Меняем формат дат на нужных нам "dd.mm.yy"
        //Сохраняем данные в переменные
        var datePoslVstr = $("#Mainclientstable_posledniyContact").val();
        var dateRozhden = $("#Mainclientstable_dateRozhdenia").val();
        var datePozvoniti = $("#Mainclientstable_pozvoniti").val();
        var dateConsultacii = $("#Mainclientstable_dataConsultacii").val();
        var dateDogovora = $("#Mainclientstable_dateDogovora").val();
        var date = new Array(datePoslVstr, dateRozhden, datePozvoniti, dateConsultacii, dateDogovora);
        var dateItog = new Array();

        //Меняем формат даты
        if(date[0]!=''){dateItog[0] = date[0].substr(-2,2)+'.'+date[0].substr(5,2)+'.'+date[0].substr(0,4);}else{dateItog[0] = ''}
        if(date[1]!=''){dateItog[1] = date[1].substr(-2,2)+'.'+date[1].substr(5,2)+'.'+date[1].substr(0,4);}else{dateItog[1] = ''}
        if(date[2]!=''){dateItog[2] = date[2].substr(-2,2)+'.'+date[2].substr(5,2)+'.'+date[2].substr(0,4);}else{dateItog[2] = ''}
        if(date[3]!=''){dateItog[3] = date[3].substr(-2,2)+'.'+date[3].substr(5,2)+'.'+date[3].substr(0,4);}else{dateItog[3] = ''}
        if(date[4]!=''){dateItog[4] = date[4].substr(-2,2)+'.'+date[4].substr(5,2)+'.'+date[4].substr(0,4);}else{dateItog[4] = ''}

        //Заменяем значения в полях на нужное по формату
        $("#Mainclientstable_posledniyContact").val(dateItog[0]);
        $("#Mainclientstable_dateRozhdenia").val(dateItog[1]);
        $("#Mainclientstable_pozvoniti").val(dateItog[2]);
        $("#Mainclientstable_dataConsultacii").val(dateItog[3]);
        $("#Mainclientstable_dateDogovora").val(dateItog[4]);
    });

    $(function() {

		$( "#Mainclientstable_dateRozhdenia").datepicker({ // С ограничением по году рождения
			//changeMonth: true,
			yearRange: "1983:2048",
			changeYear: true,
			firstDay: 1, 
			  //dateFormat: "yy-mm-dd",
			  dateFormat: "dd.mm.yy",
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
		  //dateFormat: "yy-mm-dd",
          dateFormat: "dd.mm.yy",
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

        //При нажатии на "Договор заключен"
        if(<?php echo $model->dogovorStatus; ?>){
            $(".client").css({"display":"block"});
            $("#Mainclientstable_dogovorStatus").css({"display":"none"});
            $("label.checkbox").text('Договор заключен');
        }else{

        }
        $("#Mainclientstable_dogovorStatus").change(function(){
            //Изменяем форму, открываем поля для заполнения
            $(".client").css({"display":"block"});
            //Запрещаем изменять значение чекбокса
           // $("#Mainclientstable_dogovorStatus").prop("disabled", true);
        });




		
		var poliaDate = new Array('#Mainclientstable_dateDogovora', '#Mainclientstable_dateRozhdenia', '#Mainclientstable_posledniyContact', '#Mainclientstable_pozvoniti', '#Mainclientstable_dataConsultacii');
		
		for(i=0; i < poliaDate.length; i++)	{
			//console.log(poliaDate.length+'  '+$(poliaDate[i]).val());
			if($(poliaDate[i]).val()=="00.00.0000"){
				$(poliaDate[i]).val('');
			}
			if($(poliaDate[4]).val() == '00.00.0000'){
				$('#timeConsultac').val('');
			}
		}
		
		
			
	});

    function deleteFile(id_img, id_client){

        if(confirm("Вы хотите удалить этот файл?") && id_img && id_client){
            $.ajax({

                type: 'POST',
                url: 'index.php?r=mainclientstable/deleteImgFiles',
                data: {"id_img":id_img, "id_client":id_client},
                cache: false,
                success: function(data) {
                    //$('#imgFiles').append(data);
                   // console.log(data);
                    $("#"+id_img.substr(-50,46)).remove()

                },
                error: function(data) {
                    //console.log(data);
                }
            });
        }
    }
	
</script>