<div class="agentCartHead"><div>.</div><div><h4>Агенты</h4></div></div>
<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProviderAgent,
	'itemView'=>'_view_poten',
	'summaryText'=>"",
	'emptyText'=>'На сегодня агентов нет',
    'viewData'=>array('dateClick'=>$dateClick), // передаем дату которую выбрал пользователь
)); 

//echo $dateClick;

?>
