<?php

require 'src/Webpage.php';

$webpage = new Webpage($_SERVER['REQUEST_URI']);

echo $webpage->showHighlight();

?>

// $myUrl value $requestedUrl value return value
"/section/index.html" "/section/page.html" true
"/section/page.html" "/section/other-page.html" false
"/section/index.html" "/section/subsection/index.html" true
"/section/index.html" "/section/subsection/page.html" true
"/section/subsection/index.html" "/section/other/index.html" false //