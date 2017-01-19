<?php
//указывает браузеру что файл нужно скачать, а не открыть
$XMLFile = $_GET['XMLFile'];
header("Content-Type: application/xml");
header("Content-Disposition: attachment; filename=\"".$XMLFile."\";" );
readfile(__DIR__.'/converted_files/' . "$XMLFile");
exit();