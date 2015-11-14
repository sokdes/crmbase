<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProviderPoten,
	'itemView'=>'_view_poten',
	'summaryText'=>"",
	'emptyText'=>'На сегодня потенциальных клиентов нет',
    'viewData'=>array('dateClick'=>$dateClick), // передаем дату которую выбрал пользователь
)); 

//echo $dateClick;

?>
