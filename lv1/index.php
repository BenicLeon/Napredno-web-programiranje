<?php
require_once 'Scraper.php';
require_once 'DiplomskiRadovi.php';

$radovi = new DiplomskiRadovi();
$radovi->create(); 
$radovi->save();   
$radovi->read();