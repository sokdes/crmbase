<?php $this->widget('zii.widgets.CListView', array(

    'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
	'summaryText'=>"",
	'emptyText'=>'На сегодня клиентов нет',
    'viewData'=>array('dateClick'=>$dateClick), // передаем дату которую выбрал пользователь

));
//echo $dateClick;
?>