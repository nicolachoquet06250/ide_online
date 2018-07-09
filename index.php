<?php

require_once 'autoload.php';

FileFactory::instenciate('./index.html')->create();
FileFactory::instenciate('./test/index.html')->create();
FileFactory::instenciate('./test/lol/index.html')->create();
