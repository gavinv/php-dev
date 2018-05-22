<?php

require '../src/Webpage.php';
require '../vendor/autoload.php';

$webpage = new Webpage($_SERVER['REQUEST_URI']);

echo $webpage->showHighlight();

?>
<html>
  <head>
    <title>Gavin Vaught</title>
  </head>
  <body>
    <br>
    {# $myUrl value $requestedUrl value return value
    "/section/index.html" "/section/page.html" true
    "/section/page.html" "/section/other-page.html" false
    "/section/index.html" "/section/subsection/index.html" true
    "/section/index.html" "/section/subsection/page.html" true
    "/section/subsection/index.html" "/section/other/index.html" false  #}
  </body>
</html>