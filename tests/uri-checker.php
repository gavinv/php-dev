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
  <link rel="stylesheet" type="text/css" href="../css/styles.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
</head>
<body>
  <div id="main" class="container">
    <div class="content">
      <p>Class Webpage returns a boolean based on two given URLs, which can be entered into the fields below.</p>
      <ul>
        <li>Returns true if $requestedUrl is the same as $myUrl.</li>
        <li>Returns true if $requestedUrl is located in the same section as $myUrl, but only if $myUrl is a landing page.</li>
        <li>Returns true if $myUrl is the landing page of a parent section to $requestedUrl.</li>
        <li>Assumes the variables $myUrl and $requestedUrl contain valid absolute URL paths as strings.</li>
        <li>Assumes that a root, section, or subsection landing page always has "index.html" for its filename, and that any other page does not.</li>
      </ul>
      <p>This code is part of a public GitHub repository, and is viewable on these pages:</p>
      <ul>
        <li><a target="_blank" href="https://github.com/gavinv/php-dev/blob/master/src/Webpage.php">
          Webpage class
        </a></li>
        <li><a target="_blank" href="https://github.com/gavinv/php-dev/blob/master/index.php">
          index.php
        </a></li>
      </ul>
    </div>
    <hr>
    <div class="container col-2">
      <div id="form">
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
      </div>
      <div class="output-box">
        <?php if (isset($myUrl) && isset($requestedUrl) && isset($showHighlight)) : ?>
          <p>
            $showHightlight(<span class='entered-values'>'<?php echo $myUrl ?>'</span>
            <span style="color: #b13030;">&&</span>
            <span class='entered-values'>'<?php echo $requestedUrl ?>'</span>);
          </p>
          <h2>> <?php echo ($showHighlight) ? 'true' : 'false'; ?></h2>
        <?php else: ?>
          <span style="color: #bbb;">Your output will display here.</span>
        <?php endif; ?>
      </div>
    </div>
  </div>
</body>
</html>