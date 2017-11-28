<?

?>
<?if (!$dft['items']): ?>
<p>Нет данных</p>
<? else: ?>
<p><a href="?page=authors&oper=add" class="btn btn-danger" role="button">Add</a></p>

<table class="table table-custom">
<?	foreach ($dft['items'] as $item): ?>
	<tr>
		<td><?= $item['id'] ?></td>
		<td><?=$item['name']?></td>
		<td>
			<a href="?page=authors&oper=edit&id=<?= $item['id'] ?>"><span class="glyphicon glyphicon-pencil"></span></a>
			<span style="padding-left: 50px"></span>
			<a href="?page=authors&oper=remove&id=<?= $item['id'] ?>"><span class="glyphicon glyphicon-remove"></span></a>
		</td>
	</tr>
<?	endforeach;?>
</table>
<?endif ?>