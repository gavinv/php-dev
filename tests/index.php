<?php

require '../src/Webpage.php';
require '../vendor/autoload.php';
require '../src/Input.php';

function pageController() {
  $data = [];
  $errors = [];
  if (Input::isPost()) {
    $webpage = new Webpage(Input::getString('myUrl'));
    $data['showHighlight'] = $webpage->showHighlight(Input::getString('requestedUrl'));
  }
  return $data;
}

extract(pageController());
?>
<html>
<head>
  <title>Technical Skills #1 – Gavin Vaught</title>
</head>
<body>
  <br>
  <form method="post">
    <fieldset>
      <label for="myUrl">myUrl:</label>
      <input type="text" value="<?php echo $_SERVER['REQUEST_URI']; ?>" name="myUrl" id="myUrl">
    </fieldset>
    <fieldset>
      <label for="requestedUrl">requestedUrl:</label>
      <input autofocus type="text" placeholder="/section/page.php" name="requestedUrl" id="requestedUrl">
    </fieldset>
    <fieldset>
      <button name="submit" type="submit" id="contact-submit" data-submit="...Sending">Submit</button>
    </fieldset>
  </form>
  <h3><?php echo $showHighlight ?? ''; ?></h3>

</body>
</html>