<h2>Тестовое задание</h2>
<p>Сделать на Yii2 возможность только зарегистрированным пользователям просматривать, удалять, редактировать записи в таблице "books"</p>

<table class="table">
	<tr>
		<td>
			<h4>|books|</h4>
			<ul>
				<li>id</li>
				<li>name</li>
				<li>date_create (дата создания записи)</li>
				<li>date_update (дата обновления записи)</li>
				<li>preview (путь к картинке превью книги)</li>
				<li>date (дата выхода книги)</li>
				<li>author_id (ид автора в таблице авторы)</li>
			</ul>
		</td>
		<td>
			<h4>|authors|</h4>
			<ul>
				<li>id</li>
				<li>firstname (имя автора)</li>
				<li>lastname (фамилия автора)</li>
			</ul>
		</td>
	</tr>
</table>
<p>В итоге страница управления книгами должна выглядеть так:</p>
<img src="images/tz.png" class="img" alt="Тех задание">