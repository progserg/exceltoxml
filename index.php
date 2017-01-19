<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>XlsxToXML</title>
</head>
<body>
<?php
if (!empty($_GET['convert'])) {
	if ($_GET['convert'] == 'done') {
		?>
		<div>
			<!--даем ссылку на скачивание полученного файла-->
			<a href="downloadFile.php?XMLFile=<?php echo $_GET['XMLFile'];?>">скачать XML</a>
			<br/>
			<br/>
			<a href="/index.php">На главную</a>
		</div>
		<?php
	}
} else {
	?>
	<!--форма открытия файла-->
	<form enctype="multipart/form-data" action="/convert.php" method="POST">
		Выбрать файл: <input name="xlsxFile" type="file"/>
		<br>
		<br>
		<input type="submit" value="Преобразовать"/>
	</form>
	<?php
}
?>

</body>
</html>