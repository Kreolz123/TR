<?
$item = $dft['formFields'];
?>
<div class="book-edit well-">

	<p><a href="?page=books&oper=add" class="btn btn-danger" role="button">Add</a></p>

<?if ($dft['id']): ?>
	<p>Редактирование</p>
	<p> <?=$dft['id']?></p>
<?endif; ?>

	<form method="post">
	
		<div class="col-sm-12">
			<div class="form-group"><?$field = 'title'?>
				<label for="<?=$field?>">Название:</label>
				<input type="text" class="form-control" id="<?=$field?>" name="<?=$field?>" value="<?=htmlspecialchars($item[$field])?>">
			</div>
		</div>
		
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
				<div class="item-tpl"><!--
					<div class="item">
						<input type="hidden" name="authors[]" value="#value#">
						<span class="name">#name#</span>
						<span class="glyphicon glyphicon-remove-sign but-remove"></span>
					</div>-->
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
	
<?if ($dft['msg']): ?>
	<br>
	<div class="alert alert-warning">
<?	foreach ($dft['msg'] as $msg): ?>
		<p><?=$msg?></p>
<?	endforeach; ?>
	</div>
<?endif; ?>
	
</div>
