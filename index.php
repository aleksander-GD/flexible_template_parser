<?php 
/**
 * @author Aleksander G. Duszkiewicz
 */

include("Parser.php");

$parser = new Parser("template.html");

$parser->addValueToPlaceholder("email", "aldus17@student.sdu.dk");
$parser->addValueToPlaceholder("username", "aldus17");
$parser->addValueToPlaceholder("phone", "12345678");

echo $parser->parseTemplate();

unset($parser);