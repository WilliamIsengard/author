<?php
namespace Wisengard\Author;

require_once(dirname(__DIR__, 2) . "\php\Classes\autoload.php");

use Ramsey\Uuid\Uuid;

$author = new \Wisengard\Author\Author(Uuid, "www.google.com", "abcdefghijklmnopqrstuvwxyzabcdef", "test@test.com", "abcdefghijklmnopqrstuvwxyzabcdefabcdefghijklmnopqrstuvwxyzabcdefabcdefghijklmnopqrstuvwxyzabcdefg", "Testuser");

//require_once("autoload.php");
//require_once(dirname(__DIR__, 3) . "\Classes\Author.php");