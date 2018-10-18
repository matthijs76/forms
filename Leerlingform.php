<!DOCTYPE HTML>  
<html>
<head>
<style>
body {
    width: 100%;
    margin: 0;
    display: flex;
    text-align: center;
    font-family: 'Roboto', sans-serif;

}
.error {
    color: #FF0000;
    }
.container {
    width: 100%;        
}
p {
    background-color: blue;
    padding: 15px;
}
h2 {
    background-color: red;
    padding-top: 20px;
}
form {
    background-color: grey;
    padding: 20px;
    
}

</style>
<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
<title>Gegevens leerling</title>
</head>
<body>  

<?php
// define variables and set to empty values
$nameErr = $emailErr = $genderErr = $lastnameErr = "";
$name = $email = $gender = $comment = $lastname = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (empty($_POST["name"])) {
    $nameErr = "Uw naam is verplicht!";
  } else {
    $name = test_input($_POST["name"]);
    // check if name only contains letters and whitespace
    if (!preg_match("/^[a-zA-Z ]*$/",$name)) {
      $nameErr = "U kunt alleen letters en spaties gebruiken"; 
    }
  }
  
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["lastname"])) {
      $lastnameErr = "Uw achternaam is verplicht!";
    } else {
      $lastname = test_input($_POST["lastname"]);
      // check if name only contains letters and whitespace
      if (!preg_match("/^[a-zA-Z ]*$/",$lastname)) {
        $lastnameErr = "U kunt alleen letters en spaties gebruiken"; 
      }
    }
  if (empty($_POST["email"])) {
    $emailErr = "Email is verplicht";
  } else {
    $email = test_input($_POST["email"]);
    // check if e-mail address is well-formed
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $emailErr = "Ongeldig email formaat"; 
    }
  }
    
  

  if (empty($_POST["comment"])) {
    $comment = "";
  } else {
    $comment = test_input($_POST["comment"]);
  }
}

  if (empty($_POST["gender"])) {
    $genderErr = "Geslacht is verplicht";
  } else {
    $gender = test_input($_POST["gender"]);
  }
}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
?>
<div class="container">
<h1>Leerling administratie</h1>
<h2>Vul uw gegevens in</h2>
<p><span class="error">* verplicht veld</span></p>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">  
  Naam:<br> <input type="text" name="name" value="<?php echo $name;?>">
  <span class="error">* <?php echo $nameErr;?></span>
  <br><br>  
  Achternaam:<br> <input type="text" name="lastname" value="<?php echo $lastname;?>">
  <span class="error">* <?php echo $lastnameErr;?></span>
  <br><br>
  E-mail:<br> <input type="text" name="email" value="<?php echo $email;?>">
  <span class="error">* <?php echo $emailErr;?></span>
  <br><br>
  Adres, postcode en woonplaats:<br> <textarea name="comment" rows="5" cols="40"><?php echo $comment;?></textarea>
  <br><br>
  Geslacht:
  <input type="radio" name="gender" <?php if (isset($gender) && $gender=="female") echo "checked";?> value="Vrouw">Meisje
  <input type="radio" name="gender" <?php if (isset($gender) && $gender=="male") echo "checked";?> value="man">Jongen
  <input type="radio" name="gender" <?php if (isset($gender) && $gender=="other") echo "checked";?> value="Anders">Anders  
  <span class="error">* <?php echo $genderErr;?></span>
  <br><br>
  <input type="submit" name="submit" value="Voer in">  
</form>

<?php
echo "<h2>Check uw gegevens:</h2>";
echo $name;
echo "<br>";
echo $lastname;
echo "<br>";
echo $email;
echo "<br>";
echo $comment;
echo "<br>";
echo $gender;
?>
</div>
</body>
</html>