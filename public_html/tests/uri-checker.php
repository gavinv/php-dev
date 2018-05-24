<?php
require __DIR__ . '/../../vendor/autoload.php';
require __DIR__ . '/../../src/Input.php';
require __DIR__ . '/../../src/Webpage.php';

function pageController() {
  $data = [];
  $errors = [];
  if (Input::isPost()) {
    $webpage = new Webpage(Input::getString('myUrl'));
    $data['showHighlight'] = $webpage->showHighlight(Input::getString('requestedUrl'));
    $data['myUrl'] = Input::getString('myUrl');
    $data['requestedUrl'] = Input::getString('requestedUrl');
  }
  $data['pageName'] = 'Technical Skills #1';
  return $data;
}
extract(pageController());
?>
<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <title><?php echo (isset($pageName)) ? $pageName.' – ' : '' ;?>Gavin Vaught</title>
  <!-- Favicon -->
  <link rel="shortcut icon" href="/favicon.ico?">
  <link rel="apple-touch-icon" sizes="180x180" href="/favicon/apple-touch-icon.png?">
  <link rel="icon" type="image/png" sizes="32x32" href="/favicon/favicon-32x32.png?">
  <link rel="icon" type="image/png" sizes="16x16" href="/favicon/favicon-16x16.png?">
  <link rel="manifest" href="/favicon/site.webmanifest?">
  <link rel="mask-icon" href="/favicon/safari-pinned-tab.svg?" color="#424242">
  <meta name="msapplication-TileColor" content="#bababa">
  <meta name="msapplication-TileImage" content="images/favicon/mstile-144x144.png?">
  <meta name="theme-color" content="#2e2e2e">
  
  <link rel="stylesheet" type="text/css" href="../css/styles.css">

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src='https://www.google.com/recaptcha/api.js'></script>
  <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/all.js" 
  integrity="sha384-xymdQtn1n3lH2wcu0qhcdaOpQwyoarkgLVxC/wZ5q7h9gHtxICrpcaSUfygqZGOe" 
  crossorigin="anonymous"></script>
</head>
<body>
  <div id="main" class="container">
    <div class="content">
      <h1>URI Checker</h1>
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
        <p class="show-method">
          $webpage->showHightlight(<span class='entered-values'>'<?php echo $myUrl ?>'</span>
          <span style="color: #b13030; font-weight: 600;">&&</span>
          <span class='entered-values'>'<?php echo $requestedUrl ?>'</span>);
        </p>
          <h2>> <?php echo ($showHighlight) ? 'true' : 'false'; ?></h2>
        <?php else: ?>
          <p class="show-method">
            $webpage->showHightlight(<span class='entered-values'>'$myUrl'</span>
            <span style="color: #b13030; font-weight: 600;">&&</span>
            <span class='entered-values'>'$requestedUrl'</span>);
          </p>
          <span style="color: #bbb;">Your output will display here.</span>
        <?php endif; ?>
      </div>
    </div>
  </div>
</body>
</html>