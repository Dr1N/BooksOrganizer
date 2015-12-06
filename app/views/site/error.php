<?php  
	/* @var $exception yii\web\View */
?>

<p class="alert alert-danger">
	Что-то пошло не так. Извините. Можете даже посмотреть на стек вызовов ;)
	<?php if(!empty($exception)): ?>
		<pre>
			<?= $exception ?>
		</pre>
	<?php endif ?>
</p>