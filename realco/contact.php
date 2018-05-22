<?php
require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../src/Contact.php';

$oForm  = new Dominiquevienne\Honeypot\Form();
$oForm->timeCheck();
$honeypotInputs = $oForm->inputs();

?>
<html>
<head>
  <title>Contact – Real Estate Co</title>
  
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  
  <link rel="stylesheet" type="text/css" href="style.css">
  <script src='https://www.google.com/recaptcha/api.js'></script>
</head>

<body>
  <div id="page-wrap" class="container">
    <div id="contact">
      <h3>Real Estate Co.</h3>
      <h4>Contact us!</h4>
      <form method="post" action="Contact.php">
        <fieldset>
          <input type="text" placeholder="Your Name" name="name" id="name">
        </fieldset>
        <fieldset>
          <input type="email" placeholder="Your Email" name="email" id="email">
        </fieldset>
        <fieldset>
          <input type="address" placeholder="Address" name="address" id="address">
        </fieldset>
        <fieldset>
          <input type="tel" placeholder="Phone Number" name="phone" id="phone">
        </fieldset>
        <fieldset>
          <input type="text" placeholder="How did you head about us?" name="referral" id="referral">
        </fieldset>
        <fieldset id="budgetgroup">
          <label for="budget1">Budget</label>
          <input type="number" placeholder="Min" name="budget1" id="budget1">
          <input type="number" placeholder="Max" name="budget2" id="budget2">
        </fieldset>
        <?php echo $honeypotInputs ?>
        <div class="g-recaptcha" data-sitekey="<?php echo $siteKey; ?>"></div>
          <script type="text/javascript"
                src="https://www.google.com/recaptcha/api.js?hl=<?php echo $lang; ?>">
          </script>
          <br>
        <fieldset>
          <button name="submit" type="submit" id="contact-submit" data-submit="...Sending">Submit</button>
        </fieldset>
      </form>
    </div>
  </div>
</body>
</html>