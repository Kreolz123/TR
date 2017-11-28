<??>
<p><a href="?page=books&oper=add" class="btn btn-danger" role="button">Add</a></p>

<?if (!$dft['items']): ?>
<p>Нет данных</p>
<? else: ?>

<div class="filter row">
	<div class="title">Фильтр по авторам: <span class="open-close<?= ($dft['authors']) ? ' open' : '' ?>"><?= ($dft['authors']) ? '-' : '+' ?></span></div>

	<form class="<?= ($dft['authors']) ? ' open' : '' ?>" method="post">

		<div class="col-sm-3">
			<div class="authors">
				<div class="title">Авторы:</div>
				<div class="items">
				<?foreach ($dft['authors'] as $item2): ?>
					<div class="item">
						<input type="hidden" name="authors[]" value="<?= $item2['id'] ?>">
						<span class="name"><?= $item2['name'] ?></span>
						<span class="glyphicon glyphicon-remove-sign but-remove"></span>
					</div>
				<?endforeach ?>
				</div>
				<div class="item-tpl">
					<div class="item">
						<input type="hidden" name="authors[]" value="#value#">
						<span class="name">#name#</span>
						<span class="glyphicon glyphicon-remove-sign but-remove"></span>
					</div>
				</div>
			</div>
			
			<button type="submit" class="btn btn-default" name="submit" value="submit">Submit</button>
		</div>

		<div class="col-sm-9">
			<div class="title">Двойной клик - добавить автора</div>
			<select class="form-control sel-authors" size="30">
			<?foreach ($dft['authorItems'] as $item2): ?>
				<option value="<?= $item2['id'] ?>"><?= $item2['name'] ?></option>
			<?endforeach ?>
			</select>
		</div>
	</form>
	
</div>

<table class="table table-custom">
<?	foreach ($dft['items'] as $item): ?>
	<tr>
		<td><?= $item['id'] ?></td>
		<td><?=$item['title']?></td>
		<td>
<?		foreach ($item['authors'] as $item2): ?>
			<?= $item2['name'] ?><br>
<?		endforeach ?>
		</td>
		<td>
			<a href="?page=books&oper=edit&id=<?= $item['id'] ?>"><span class="glyphicon glyphicon-pencil"></span></a>
			<span style="padding-left: 50px"></span>
			<a href="?page=books&oper=remove&id=<?= $item['id'] ?>"><span class="glyphicon glyphicon-remove"></span></a>
		</td>
	</tr>
<?	endforeach;?>
</table>
<?endif ?>