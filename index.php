<?php

use arbo_gestion\factories\DirFactory;
use arbo_gestion\factories\FileFactory;

ini_set('display_errors', 'on');

require_once 'autoload.php';
header('Content-Type: application/json');

//FileFactory::instenciate('./'.$_GET['path'].'/'.$_GET['file'])->create();
//if(is_file('./'.$_GET['path'].'/'.$_GET['file'])) {
//    echo '{"status": true}';
//}
FileFactory::instenciate('./text/lol/page2.html')->create();
FileFactory::instenciate('./text/page1.html')->create();
/**
 * @var DirFactory $dir_factory
 */
$dir_factory = DirFactory::instence();
if(isset($argv)) {
    $arbo = $dir_factory->arboressence($argv[1], $argv[2]);
    var_dump($arbo);
}
else {
    $arbo = $dir_factory->arboressence($_GET['path'], $_GET['file']);
    echo json_encode($arbo);
}