<?php
require __DIR__ . '/../../../vendor/autoload.php';
require __DIR__ . '/controller.php';

$oForm  = new Dominiquevienne\Honeypot\Form();
$oForm->timeCheck();
$honeypotInputs = $oForm->inputs();

extract(pageController($dbc));
?>
<html>
<head>
  <title>Contact – Real Estate Co.</title>
  
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  
  <link rel="stylesheet" type="text/css" href="../../css/styles.css">
  <script src='https://www.google.com/recaptcha/api.js'></script>
  <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/all.js" 
  integrity="sha384-xymdQtn1n3lH2wcu0qhcdaOpQwyoarkgLVxC/wZ5q7h9gHtxICrpcaSUfygqZGOe" 
  crossorigin="anonymous"></script>
</head>

<body>
  <div id="page-wrap" class="container">
    <div id="form" class="contact">
      <h4>Real Estate Co.</h4>
      <h3>Contact us!</h3>
      <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        <fieldset class="form-item <?= (isset($errors['name'])) ? 'has-error' : '' ?>">
          <label for="name">Your name:</label>
          <input type="text"  name="name" id="name">
          <small class="error"><?= (isset($errors['name'])) ? $errors['name'] : '' ?></small>
        </fieldset>
        <fieldset class="form-item <?= (isset($errors['email'])) ? 'has-error' : '' ?>">
          <label for="email">Your email:</label>
          <input type="email"  name="email" id="email">
          <small class="error"><?= (isset($errors['email'])) ? $errors['email'] : '' ?></small>
        </fieldset>
        <fieldset class="form-item <?= (isset($errors['address'])) ? 'has-error' : '' ?>">
          <label for="address">Your address:</label>
          <input type="address" name="address" id="address">
          <small class="error"><?= (isset($errors['address'])) ? $errors['address'] : '' ?></small>
        </fieldset>
        <fieldset class="form-item <?= (isset($errors['phone'])) ? 'has-error' : '' ?>">
          <label for="Phone Number">Phone Number:</label>
          <input type="tel"  name="phone" id="phone">
          <small class="error"><?= (isset($errors['phone'])) ? $errors['phone'] : '' ?></small>
        </fieldset>
        <fieldset class="form-item <?= (isset($errors['referral'])) ? 'has-error' : '' ?>">
          <label for="referral">How did you hear about us?</label>
          <select placeholder="How did you hear about us?" name="referral" id="referral">
          <option value="">-- select an option --</option>
          <option value="Facebook">Facebook</option>
          <option value="Twitter">Twitter</option>
          <option value="Craigslist">Craigslist</option>
          <option value="Friend">Friend</option>
          <option value="Radio">Radio</option>
          <option value="TV Ad">TV Ad</option>
          <option value="Newspaper">Newspaper</option>
          <option value="Other">Other</option>
          </select>
          <small class="error"><?= (isset($errors['referral'])) ? $errors['referral'] : '' ?></small>
        </fieldset>
        <fieldset class="form-item <?= (isset($errors['budget'])) ? 'has-error' : '' ?>">
          <label for="budgetgroup">Budget:</label>
          <div id="budgetgroup">
            <div>
              <label for="budget1">Min:</label>
              <input type="text" placeholder="$100,000" maxlength="10" name="budget1" id="budget1" oninput="searchContacts()"> 
              <small class="error"><?= (isset($errors['budget1'])) ? $errors['budget1'] : '' ?></small>
            </div>
            <div>
              <label for="budget1">Max:</label>
              <input type="text"  maxlength="10" placeholder="$1,500,000"name="budget2" id="budget2" oninput="searchContacts()">
              <small class="error"><?= (isset($errors['budget2'])) ? $errors['budget2'] : '' ?></small>
            </div>
          </div>
        </fieldset>
        <?php echo $honeypotInputs ?>
        <div class="g-recaptcha" data-sitekey=6LdGs1oUAAAAAH3FvnrfvpI3e7PUdDI1m6wfxQmi></div>
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