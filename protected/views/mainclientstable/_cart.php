<?php
/* @var $this MainclientstableController */
/* @var $data Mainclientstable */
?>
<?php // echo CHtml::link(CHtml::encode($data->familiy ." " .$data->name ." " .$data->otchestvo ." - Созвониться: " .$data->pozvoniti), array('update', 'id'=>$data->id)); ?>
<tr class="tr
 <?php

    // Выводим имена для строк. в зависимости от статуса клиента
    echo ($data->statusClient==3) ? " bilet-vidan" : "";
    if($data->statusClient >= 1 && $data->statusClient!=3){echo "dogovor-zakluchen";}
    if($data->statusClient >= 1 && $data->statusClient!=3 && $data->statusClient!=8 ){echo " dogovor-zakluchen";}
	if($data->statusClient==10) {echo " calloff" ;}
    
	echo (date("m-d", strtotime($data->dateRozhdenia)) == date('m-d')) ? " birthday" : '';
?>
"
id="<?php echo "tr-" .$data->id; ?>">
<!--statusClient <div class="view">-->
<td>
	<?php echo CHtml::encode($data->familiy ." " .$data->name ." " .$data->otchestvo); ?>
</td>
<td><?php echo CHtml::link(CHtml::image(Yii::app()->baseUrl .'/images/icons/cart_edit.png', '', array("class" => "edit-cart", "title" => "Редактировать")), array('update', 'id'=>$data->id));?></td>
<td><?php echo CHtml::encode($data->id_dogovota);?></td>
<td><?php
    if($data->dateDogovora!='0000-00-00'){
        echo CHtml::encode(date_format(date_create($data->dateDogovora), 'd.m.Y'));
    }

    ?>
</td>
    <!--//echo CHtml::encode(date_format(date_create($data->dateDogovora), 'd.m.Y'));-->

<td><?php
    if($data->posledniyContact!='0000-00-00'){
        echo CHtml::encode(date_format(date_create($data->posledniyContact), 'd.m.Y'));
    }
    ?>
</td>
<td><?php
    if($data->pozvoniti!='0000-00-00'){
        echo CHtml::encode(date_format(date_create($data->pozvoniti), 'd.m.Y'));
    }
    ?>
</td>
<td><?php echo CHtml::encode($data->telefon);?></td>
<td class="history_td" id="history_client_<?php echo $data->id; ?>"><?php echo mb_substr(nl2br($data->commentHistory), 0, 80, 'UTF-8');?></td>
<td><?php echo mb_substr($data->agent, 0, 15, 'UTF-8');?></td>
<td class="delete_icon"><?php echo CHtml::link(CHtml::image(Yii::app()->baseUrl .'/images/icons/delete.png', '', array("class" => "delete-cart", "title" => "Удалить")), $url='#', array('submit'=>array('delete','id'=>$data->id),'confirm'=>'Вы уверены, что хотите удалить карточку безвозвратно?'));?></td>


</tr>

	
	<?php //echo CHtml::encode($data->statusClient); ?>
	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('adress')); ?>:</b>
	<?php echo CHtml::encode($data->adress); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('telefon')); ?>:</b>
	<?php echo CHtml::encode($data->telefon); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('dateRozhdenia')); ?>:</b>
	<?php echo CHtml::encode($data->dateRozhdenia); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('dogovorStatus')); ?>:</b>
	<?php echo CHtml::encode($data->dogovorStatus); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('posledniyContact')); ?>:</b>
	<?php echo CHtml::encode($data->posledniyContact); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('pozvoniti')); ?>:</b>
	<?php echo CHtml::encode($data->pozvoniti); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('statusClient')); ?>:</b>
	<?php echo CHtml::encode($data->statusClient); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('commentHistory')); ?>:</b>
	<?php echo CHtml::encode($data->commentHistory); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('dataConsultacii')); ?>:</b>
	<?php echo CHtml::encode($data->dataConsultacii); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('timeConsultacii')); ?>:</b>
	<?php echo CHtml::encode($data->timeConsultacii); ?>
	<br />

	*/ ?>



<!--</div>-->