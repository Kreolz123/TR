<?
$item = $dft['formFields'];
?>
<div class="well">

	<p><a href="?page=authors&oper=add" class="btn btn-danger" role="button">Add</a></p>

<?if ($dft['id']): ?>
	<p>Редактирование</p>
	<p><?=$dft['id']?></p>
<?endif; ?>

	<form method="post">

		<div class="form-group"><?$field = 'name'?>
			<label for="<?=$field?>">ФИО автора:</label>
			<input type="text" class="form-control" id="<?=$field?>" name="<?=$field?>" value="<?=htmlspecialchars($item[$field])?>">
		</div>
	
	  <button type="submit" class="btn btn-default" name="submit" value="submit">Submit</button>
	  
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
