<?php
// define variables and set to empty values
$PrenomErr =$NomErr = $MailErr  = $MessageErr = "";
$Prenom = $Nom = $Mail = $Message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (empty($_POST["Prenom"])) {
    $PrenomErr = "Prenom is required";
  } else {
    $Prenom = test_input($_POST["Prenom"]);
	
    // check if Prenom only contains letters and whitespace
    if (!preg_match("/^[a-zA-Z ]*$/",$Prenom)) {
      $PrenomErr = "Only letters and white space allowed";
    }
  }
  
  if (empty($_POST["Nom"])) {
    $NomErr = "Nom is required";
  } else {
    $Nom = test_input($_POST["Nom"]);
  }
}
  if (empty($_POST["Mail"])) {
    $MailErr = "Mail is required";
  } else {
    $Mail = test_input($_POST["Mail"]);
    // check if Mail address is well-formed
    if (!filter_var($Mail, FILTER_VALIDATE_EMAIL)) {
      $MailErr = "Invalid Mail format";
    }
  }

  if (empty($_POST["Message"])) {
    $Message = "";
  } else {
    $Message = test_input($_POST["Message"]);
  }


function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

echo "<h2>Your Input:</h2>";
echo $Prenom;
echo "<br>";
echo $Nom;
echo "<br>";
echo $Mail;
echo "<br>";
echo $Message;

?>
