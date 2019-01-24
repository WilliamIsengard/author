<?php
namespace Wisengard\Author;

require_once(dirname(__DIR__, 1) . "/Classes/Author.php");

$john = new Author("d441c4d8-efd0-4898-876a-1c39f94dc197", "www.google.com", "abcdefghijklmnopqrstuvwxyzabcdef", "test@test.com", "abcdefghijklmnopqrstuvwxyzabcdefabcdefghijklmnopqrstuvwxyzabcdefabcdefghijklmnopqrstuvwxyzabcdefg", "Testuser");

var_dump($john);
