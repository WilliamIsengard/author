<?php
namespace Wisengard\Author;

require_once(dirname(__DIR__, 1) . "/Classes/autoload.php");
//require_once("\Users\willi\Desktop\bootcamp\git\author\php\Classes\Author.php");

use Ramsey\Uuid\Uuid;

$author = new \Wisengard\Author\Author("Uuid", "www.google.com", "abcdefghijklmnopqrstuvwxyzabcdef", "test@test.com", "abcdefghijklmnopqrstuvwxyzabcdefabcdefghijklmnopqrstuvwxyzabcdefabcdefghijklmnopqrstuvwxyzabcdefg", "Testuser");

//require_once("autoload.php");
//require_once(dirname(__DIR__, 3) . "\Classes\Author.php");