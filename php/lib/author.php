<?php
namespace Wisengard\Author;

require_once("../Classes/autoload.php");
require_once(dirname(__DIR__, 2) . "/php/Classes/autoload.php");

use Ramsey\Uuid\Uuid;

$john = new Author("d441c4d8-efd0-4898-876a-1c39f94dc197", "www.google.com", "abcdefghijklmnopqrstuvwxyzabcdef", "test@test.com", "abcdefghijklmnopqrstuvwxyzabcdefabcdefghijklmnopqrstuvwxyzabcdefabcdefghijklmnopqrstuvwxyzabcdefg", "Testuser");

echo "__toString($john)";