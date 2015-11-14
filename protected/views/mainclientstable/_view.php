<?php
/* @var $this MainclientstableController */
/* @var $data Mainclientstable */
?>

<div class="view">

    <div class="fio-sobite">
	<?php
	
	echo CHtml::link(CHtml::encode('№' .$data->id_dogovota), array('update', 'id'=>$data->id));
    echo "&nbsp";
	echo CHtml::encode($data->familiy ." " .$data->name ." " .$data->otchestvo);
	?>
	</div>
	<?php
    if($data->dataConsultacii == $dateClick && $data->pozvoniti == $dateClick){
    echo "<div class='icons-sobitia'><img class='icon_call' src='" .Yii::app()->request->baseUrl ."/images/icons/callicon.png'> <img class='icon_meet' src='" .Yii::app()->request->baseUrl ."/images/icons/meeting-icon.png'> в " .substr($data->timeConsultacii, 0, 5) ."</div>";
    }else{
    if($data->pozvoniti == $dateClick){
    echo "<div class='icons-sobitia'><img class='icon_call' src='" .Yii::app()->request->baseUrl ."/images/icons/callicon.png'></div>";
    }
    if($data->dataConsultacii == $dateClick){
    echo "<div class='icons-sobitia'><img class='icon_meet' src='" .Yii::app()->request->baseUrl ."/images/icons/meeting-icon.png'> в " .substr($data->timeConsultacii, 0, 5) ."</div>";
    }
    }

?>

</div>