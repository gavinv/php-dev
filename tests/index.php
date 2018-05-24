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
    $data['myUrl'] = Input::getString('myUrl');
    $data['requestedUrl'] = Input::getString('requestedUrl');
  }
  return $data;
}

extract(pageController());
?>
<html>
<head>
  <title>Technical Skills #1 – Gavin Vaught</title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
</head>
<body>
  <br>
  <form method="post">
    <fieldset>
      <label for="myUrl">myUrl:</label>
      <input type="text" value="<?php echo isset($myUrl) ? $myUrl : $_SERVER['REQUEST_URI'] ?>" name="myUrl" id="myUrl">
    </fieldset>
    <fieldset>
      <label for="requestedUrl">requestedUrl:</label>
      <input autofocus type="text" <?php echo isset($_POST['requestedUrl']) ? 'value="'.$requestedUrl.'"' : ''; ?> placeholder="eg: /section/page.php" name="requestedUrl" id="requestedUrl">
    </fieldset>
    <fieldset>
      <button name="submit" type="submit" id="contact-submit" data-submit="...Sending">Submit</button>
    </fieldset>
  </form>
  <?php if (isset($myUrl) && isset($requestedUrl) && isset($showHighlight)) : ?>
    <p>Testing ('<?php echo $myUrl ?>' && '<?php echo $requestedUrl ?>')...</p>
    <script>
      setTimeout(function(){
        $('p').append('<h3>$showHightlight = <?php echo $showHighlight; ?></h3>')
      },3);
    </script>
<?php endif; ?>

</body>
</html>