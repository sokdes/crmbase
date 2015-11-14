<?php
/* @var $this MainclientstableController */
/* @var $model Mainclientstable */

$this->pageTitle = 'Новый клиент';
$this->menu=array(
	array('label'=>'Главная', 'url'=>array('index')),
	array('label'=>'Manage Mainclientstable', 'url'=>array('admin')),
);
?>

<h2 style="margin-left: 9%">Добавление нового клиента</h2>

<?php 
	// Блок оповещения о дейсвиях
	$this->widget('bootstrap.widgets.TbAlert', array(
    'block'=>true, // display a larger alert block?
    'fade'=>true, // use transitions?
    'closeText'=>'&times;', // close link text - if set to false, no close link is displayed
    'alerts'=>array( // configurations per alert type
        // success, info, warning, error or danger
        'success'=>array('block'=>true, 'fade'=>true, 'closeText'=>'&times;'),
        'error'=>array('block'=>true, 'fade'=>true, 'closeText'=>'&times;'),
    ),
)); ?>
<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>

<script type="text/javascript">
    $(function() {
        $("#poleFileImg").css({"display":"none"});
        $("#formGetFiles").css({"display":"none"});
        $("#botton_get_files").css({"display":"none"});
        $("#imgFiles").css({
                            'background': '#fff',
                            'border':'1px solid #C5C5C5'
                            });

    });
</script>