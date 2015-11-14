<?php
/* @var $this MainclientstableController */
/* @var $model Mainclientstable */

 $this->pageTitle = 'Карточка клиента';

$this->menu=array(
	array('label'=>'List Mainclientstable', 'url'=>array('index')),
	array('label'=>'Create Mainclientstable', 'url'=>array('create')),
	array('label'=>'View Mainclientstable', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Mainclientstable', 'url'=>array('admin')),
);
?>

<h2 style="margin-left: 9%"> Карточка <?php echo $model->name ." " .$model->familiy; ?></h2>

<?php echo $this->renderPartial('_form', array('model'=>$model, 'imgModel'=>$imgModel)); ?>
<script type="text/javascript">
    $(function() {

        $("#poleFileImg").change(function(){
            var idClient = <?php echo $model->id; ?>;
            var fd = new FormData();
            fd.append('id', idClient);
            fd.append('img', $('#poleFileImg')[0].files[0]);

            $.ajax({
                type: 'POST',
                url: 'index.php?r=mainclientstable/uploadFileImg',
                data: fd,
                processData: false,
                contentType: false,
                //dataType: "json",
                success: function(data) {
                    $('#imgFiles').append(data);
                },
                error: function(data) {
                    //console.log(data);
                }
            });

        });

    });
</script>