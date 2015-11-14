<?php 
 $this->pageTitle = 'Список всех клиентов';
?>
<div id="fullHistory"></div>
<div id="AllCarts">
<form action="index.php" method="GET" name="form" id="sort-all-carts">
    <input type="hidden" value="mainclientstable/allcart" name="r">
                <select name="sort" type="text" id="sort">
					<option value=0>Все</option>
					<option value=1>Договор заключен</option>
					<option value=2>Без договора</option>
					<option value=3>Проходит обследование</option>
					<option value=4>Получил военный билет</option>
					<option value=5>Судимся с военкоматом</option>
					<option value=6>Подали жалобу в вышестоящую комиссию</option>
					<option value=7>Пошел в военкомат</option>
					<option value=8>Проходит обследование</option>
					<option value=9>Создает историю болезни</option>
					<option value=10>Подписали "В" на медкомиссии</option>
                                        <option value=11>Снят с обзвона</option>
                                        <option value=12>Агент</option>
				</select>
				<input type="submit" value="Сортировать" class="btn btn-info">
		</form>
<table class="table table-bordered">
<tr>

<th>Ф.И.О.</th>
<th></th>
<th>№ договора</th>
<th>Дата договора</th>
<th>Дата посл. контакта</th>
<th>Позвонить</th>
<th>Телефон</th>
<th>История</th>
<th>Агент</th>
<th></th>

</tr>
<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_cart',
	'summaryText'=>"",
	'emptyText'=>'Карточек клиентов нет',
)); ?>
</table>
</div>

<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.tablecloth.js"></script>

<script type="text/javascript" charset="utf-8">



    (function($)
    {
        //Вид таблицы
        $("table").tablecloth({
          theme: "default",
          striped: true,
          sortable: true,
          condensed: true
        });

        // Вызов полной истории во всплавющем окне с затемнением фона

        $(".history_td").click(function(){
            var clickId = this.id.substr(15);


            //Вызов затемнения
            var docHeight = $(document).height();
            $("#overlay")
                .height(docHeight)
                .css({
                    "display": "block"
            });
            // Вызов полной истории
            jQuery.ajax({
                type: 'POST',
				url: 'index.php?r=mainclientstable/fullHistoryClient',
                data: {'idClient': clickId},
                cache: false,
                success: function(response){
                    $("#fullHistory").html(response);
                    $(".clientHistory").height(docHeight-250);
                    $("#fullHistory").css("display", "block");
                    window.fullH = 1;
                }
            });

        });

        $(".tr").click(function(){
            $('.tr').css({'border':'0px'});
            $(this).css({'border':'2px dotted #888'});
            $('.table-bordered').css({'border-collapse':'collapse'});
            console.log(this);
        });

        $(document).click( function(event){
            if( $(event.target).closest("#fullHistory").length)
                return;
            $("#fullHistory").css({"display": "none"});
            if(window.fullH){
                $('#overlay').fadeOut("slow");
                window.fullH = 0;
            }
            event.stopPropagation();
        });

    })(jQuery);
    </script>