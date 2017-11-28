
<!DOCTYPE html>
<html lang="ru">
<head>
	<title></title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

	<script src="ajax.js"></script>
</head>
<body>

	<div class="container">

		<h1>Список проектов</h1>
		
		<form method="post">
			<div class="form-group">
				<label for="search">Поиск:</label>
				<input type="text" class="form-control" id="search" name="search" value="<?= $search ?>">
			</div>
			<button id="butSubmit" type="submit" class="btn btn-default" name="submit" value="submit">Найти</button>
		</form>
		
		<div class="content">
			<?= $content ?>
		</div>

	</div>	
	
</body>
</html>


<?foreach ($items as $key => $item): ?>
    <div class="col-sm-3">
        <h2><?= $key ?></h2>
        <?	foreach ($item as $item2): ?>
            <h3><?= $item2['name'] ?></h3>
            <div><b>Телефон: </b><?= $item2['phone'] ?></div>
            <div><b>Дата:</b> <?= date("d-m-Y", $item2['date']) ?></div>
            <div><b>Пользователь: </b><?= $item2['user_name'] ?></div>
        <?	endforeach ?>
    </div>
<?endforeach ?>