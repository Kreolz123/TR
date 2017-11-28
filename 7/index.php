<?php
header("Content-Type: text/html; charset=utf-8");
?>
<?
$books = array(
	array(
		'title' => 'Книга первая',
		'authors' => array(
			'Автор',
			'Автор1',
		)
	),
	array(
		'title' => 'Книга вторая',
		'authors' => array(
			'Автор1',
			'Автор2',
		)
	),
	array(
		'title' => 'Книга третья',
		'authors' => array(
			'Автор1',
			'Автор2',
		)
	),
);

?>
<style>
table {
	border-collapse: collapse;
}
td, th {
	border: 1px solid black;
}
</style>

<table>
	<tr>
		<th>Название книги</th>
		<th>Авторы</th>
	</tr>
    <?foreach ($books as $item): ?>
        <tr>
            <td><?= $item['title'] ?></td>
            <td>
                <?	foreach ($item['authors'] as $item2): ?>
                    <?= $item2 ?><br>
                <?	endforeach ?>
            </td>
        </tr>
    <?endforeach ?>
</table>