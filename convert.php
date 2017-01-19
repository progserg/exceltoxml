<?php
//подключаем библиотеку PHPExcel
require_once(__DIR__ . '/Classes/PHPExcel/IOFactory.php');
//присваиваем переменной путь к файлу
$xlsxFile = $_FILES['xlsxFile']['tmp_name'];
//если файл существует - преобразовываем
if (file_exists($xlsxFile)) {
	// Открываем файл
	$xlsx = PHPExcel_IOFactory::load($xlsxFile);
	// Устанавливаем индекс активного листа
	$xlsx->setActiveSheetIndex(0);
	// Получаем активный лист
	$sheet = $xlsx->getActiveSheet();

	//создаем объект класса XMLWriter
	$xml = new XMLWriter();
	$xml->openMemory();
	//пишем заголовок файла XML
	$xml->startDocument();
	//ссоздание корневого элемента
	$xml->startElement('products');
	//читаем построчно, начиная со второй строки, так как формат записи входного файла известен, а заголовки нам не нужны
	for ($i = 2; $i <= $sheet->getHighestRow(); $i++) {
		$xml->startElement('product');

		$nColumn = PHPExcel_Cell::columnIndexFromString(
			$sheet->getHighestColumn());
		//читаем ячейки в строке
		for ($j = 0; $j < $nColumn; $j++) {
			$value = $sheet->getCellByColumnAndRow($j, $i)->getValue();
			//выбираем какую ветку XML записать, и пишем полученное выше значение ячейки
			switch ($j) {
				case 0:
					$xml->writeElement("name", $value);
					break;
				case 1:
					$xml->writeElement("width", $value);
					break;
				case 2:
					$xml->writeElement("height", $value);
					break;
				case 3:
					$xml->writeElement("long", $value);
					break;
			}
		}
		//закрываем текущий элемент
		$xml->endElement();
	}
	$xml->endElement();
	//пишем результат работы в файл
	$XMLFile = date('H_i_s').'.xml';
	if (file_put_contents(__DIR__.'/converted_files/' . $XMLFile, $xml->outputMemory())) {
		//перенаправляем на главную страницу и передаем параметры..
		header("Location: http://". $_SERVER['HTTP_HOST'] ."/index.php?convert=done&XMLFile=".$XMLFile);
		exit;
	}
	else
	{
		echo "не удалось записать файл!";
	}

}
