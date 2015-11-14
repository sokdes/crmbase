<?php
/* @var $this SiteController */
/* @var $error array */

$this->pageTitle='Ошибка - Страница не найдена';

?>

<h2>Ошибка <?php echo $code; ?></h2>

<div class="error">
<?php echo CHtml::encode($message); ?>
</div>