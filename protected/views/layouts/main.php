<?php /* @var $this Controller */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />

	<!-- blueprint CSS framework -->
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/screen.css" media="screen, projection" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/print.css" media="print" />
	<!--[if lt IE 8]>
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/ie.css" media="screen, projection" />
	<![endif]-->
	
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/form.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/tablecloth.css">


	
	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>

<body>
<div id="resSearch">Данных нет</div>
<div class="container" id="page">

	<div id="header">
		<?php
        if(!Yii::app()->user->isGuest){
           echo '<div id="searche">'
                .'<form method="post" name="form" onsubmit="return false;">'
                .'Поиск: <input name="search" type="text" id="search23">'
                .'</form>'
                .'</div>';
       } ?>
	</div><!-- header -->

	<div id="mainmenu">
		<?php

        $adminMenuItems = array(
            array('label'=>'<img src="'.Yii::app()->request->baseUrl.'/images/icons/mainmenu/aero_winflip_3d_mirror.png" />', 'url'=>array('/mainclientstable/index'), 'visible'=>!Yii::app()->user->isGuest),
            array('label'=>'<img src="'.Yii::app()->request->baseUrl.'/images/icons/mainmenu/windows_card_space_mirror.png" />', 'url'=>array('/mainclientstable/allcart'), 'visible'=>!Yii::app()->user->isGuest),
            array('label'=>'<img src="'.Yii::app()->request->baseUrl.'/images/icons/mainmenu/file_google_docs_mirror.png" />', 'url'=>array('/mainclientstable/createcart'), 'visible'=>!Yii::app()->user->isGuest),
            array('label'=>'<img src="'.Yii::app()->request->baseUrl.'/images/icons/mainmenu/calendar_mirror.png" />', 'url'=>array('calendar/index'), 'visible'=>!Yii::app()->user->isGuest),
            array('label'=>'', 'url'=>array('/site/login'), 'visible'=>Yii::app()->user->isGuest),
            array('label'=>'<img src="'.Yii::app()->request->baseUrl.'/images/icons/mainmenu/power_standby_mirror.png" />', 'url'=>array('/site/logout'),'visible'=>!Yii::app()->user->isGuest)
        );

        $this->widget('zii.widgets.CMenu', array(
            'items'=>$adminMenuItems,
            'encodeLabel' => false,
        ));

        /*
        $this->widget('zii.widgets.CMenu',array(
			'items'=>array(
				//array('label'=>'Домой', 'url'=>array('/site/index')),
				//array('label'=>'О нас', 'url'=>array('/site/page', 'view'=>'about')),
				//array('label'=>'Контакты', 'url'=>array('/site/contact')),
				array('label'=>'Карточки на сегодня', 'url'=>array('/mainclientstable/index'), 'visible'=>!Yii::app()->user->isGuest),
				array('label'=>'Список всех карточек', 'url'=>array('/mainclientstable/allcart'), 'visible'=>!Yii::app()->user->isGuest),
				array('label'=>'Создать новую карточку', 'url'=>array('/mainclientstable/createcart'), 'visible'=>!Yii::app()->user->isGuest),
				array('label'=>'Календарь', 'url'=>array('calendar/index'), 'visible'=>!Yii::app()->user->isGuest),
                array('label'=>'Вход', 'url'=>array('/site/login'), 'visible'=>Yii::app()->user->isGuest),
				array('label'=>'Выход ('.Yii::app()->user->name.')', 'url'=>array('/site/logout'), 'visible'=>!Yii::app()->user->isGuest)
			),
		));
        */ ?>
	</div><!-- mainmenu -->
	<?php if(isset($this->breadcrumbs)):?>
		<?php $this->widget('zii.widgets.CBreadcrumbs', array(
			'links'=>$this->breadcrumbs,
		)); ?><!-- breadcrumbs -->
	<?php endif?>

	<?php echo $content; ?>

	<div class="clear"></div>

	<div id="footer">
		
	</div><!-- footer -->

</div><!-- page -->

<script type="text/javascript">
    /*<![CDATA[*/
    (function($)
    {
        $('#search23').keyup(function(){
            var search = $("#search23").val();
                //alert(search);
            jQuery.ajax({
                type: 'POST',
                //url: 'http://localhost/businesstask/index.php?r=mainclientstable/ajax',
                url: 'index.php?r=mainclientstable/ajax',
                data: {'search3': search},
                cache: false,
                success: function(response){

                    $("#resSearch").css("display", "block");
                    //Вызов затемнения
                    var docHeight = $(document).height();

                    $("#resSearch").html(response);
                    $("#resSearch").css({
                        "border-width": "1px",
                        "padding": "10px 20px 30px 10px",
                        "margin-top": "4px",
                        "width": "87%",
                        "height": "75%"
                    });


                    $("#search23").css({"z-index": 5007});
                    var p = $("#search23").position();
                    $("#resSearch").css({"left": p.left+"px"});
                    console.log(p.left);

                }

            });
            if(search==''){$("#resSearch").css("display", "block");}

        });
        $('#page').click(function(){

            $('#search23').val('');
            $("#search23").css({"z-index": 4999});
            $("#resSearch").css("display", "none");


        });
    })(jQuery);
    /*]]>*/
</script>
<div id='overlay'></div>
</body>
</html>
