<!DOCTYPE html>

<html>
<head>
  <title>One page site</title>
  <link rel="stylesheet" type="text/css" href="style.css">
  <link href='http://fonts.googleapis.com/css?family=Dancing+Script:400,700' rel='stylesheet' type='text/css'>
  <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>
  <link href='http://fonts.googleapis.com/css?family=Merienda:400,700' rel='stylesheet' type='text/css'>
  <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.js" type="text/javascript"></script>
  <script src="http://maps.googleapis.com/maps/api/js"></script>
  <script type="text/javascript" src="script.js"></script>
</head>

<body>
<?php
// define variables and set to empty values
$nameErr = $emailErr = "";
$name = $email = $comment = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
   if (empty($_POST["name"])) {
     $nameErr = "Numele este necesar";
   } else {
     $name = test_input($_POST["name"]);
     // check if name only contains letters and whitespace
     if (!preg_match("/^[a-zA-Z ]*$/",$name)) {
       $nameErr = "Doar litere si spatii suntpermise";
     }
   }
  
   if (empty($_POST["email"])) {
     $emailErr = "Email-lul este necesar";
   } else {
     $email = test_input($_POST["email"]);
     // check if e-mail address is well-formed
     if (!preg_match("^[a-zA-Z0-9_.-]+@[a-zA-Z0-9-]+.[a-zA-Z0-9-.]+$",$email)) {
       $emailErr = "Email format incorect";
     }
   }

   if (empty($_POST["comment"])) {
     $comment = "";
   } else {
     $comment = test_input($_POST["comment"]);
   }
  
  if ( ($nameErr == "") && ($emailErr == "") ) {
    $file_data ="";
    function get_client_ip() {
      $ipaddress = '';
    if (getenv('HTTP_CLIENT_IP'))
        $ipaddress = getenv('HTTP_CLIENT_IP');
    else if(getenv('HTTP_X_FORWARDED_FOR'))
        $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
    else if(getenv('HTTP_X_FORWARDED'))
        $ipaddress = getenv('HTTP_X_FORWARDED');
    else if(getenv('HTTP_FORWARDED_FOR'))
        $ipaddress = getenv('HTTP_FORWARDED_FOR');
    else if(getenv('HTTP_FORWARDED'))
       $ipaddress = getenv('HTTP_FORWARDED');
    else if(getenv('REMOTE_ADDR'))
        $ipaddress = getenv('REMOTE_ADDR');
    else
        $ipaddress = 'UNKNOWN';
    return $ipaddress;
    };
    $file_data .="Name:";
    $file_data .= $name;
    $file_data .="\r\n";
    $file_data .="E-mail:";
    $file_data .= $email;
    $file_data .="\r\n";
    $file_data .="Mesaj:";
    $file_data .= $comment;
    $file_data .="\r\n";
    $file_data .="IP:";
    $file_data .= get_client_ip();
    $file_data .="\r\n";
    $file_data .="*-----------------------------------*";
    $file_data .="\r\n";

    $file_data .= file_get_contents('file.txt');
    file_put_contents('file.txt', $file_data);
  
  }
}

function test_input($data) {
   $data = trim($data);
   $data = stripslashes($data);
   $data = htmlspecialchars($data);
   return $data;
}

?>
<div class="errors">
  <div class="errors-info">
    <div class="close"><a href="#contacte">X</a></div>
    <div>Ati comis erori la indeplinirea formularului</div>
    <ul>
    <li class="error-name"><?php echo $nameErr; ?></li>
    <li class="error-mail"><?php echo $emailErr; ?></li>
    </ul>
  </div>
</div>
  <div class="header header-outer-wrapper">
    <div class="header-inner-wrapper clearfix">
      <div class="logo">
        <a href="index.php">
          <div class="logo-text">
            <div class="name">Dr.Jacote Ina</div>
            <div class="line"></div>
            <div class="profession">Obstetrician-Ginecolog</div>
          </div>
        </a>
      </div>
      <div class="nah_image">
        <img src="./images/obstetrics2.jpg" alt="image">
      </div>
      <div class="main-menu-wrapper">
          <ul class="main-menu clearfix">
            <li class="menu-item">
              <a href="#about_us" >
                Despre noi
              </a>
            </li>
            <li class="menu-item">
              <a href="#ginecologie" >
                Ginecologie
              </a>
            </li>
            <li class="menu-item">
              <a href="#obstetrica" >
                Obstetrica
              </a>
            </li>
            <li class="menu-item">
              <a href="#contacte" >
                Contacte
              </a>
            </li>
          </ul>
      </div>
    </div>
  </div>

  <div class="container-outer-wrapper">
    <div class="container">
      <div id="about_us" class="about_us-container clearfix" name="about_us">
        <?php include 'slider.html'; ?>
      </div>
      <div id="ginecologie" class="ginecologie-container clearfix" name="ginecologie">
        <?php include 'ginecologie.php'; ?>
      </div>
      <div id="obstetrica" class="obstetrica-container clearfix">
        <?php include 'obstetrica.php'; ?>
        
      </div>
      <div id="contacte" class="contacte-container clearfix">
        <div class="contacte-inner-wrapper">
          <div id="map" style="height: 300px; width:600px;"></div>
          <div class="form">
            <div class="trigger">Vreti sa ne scrieti un mesaj?</div>
            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"> 
              <div class="name">
                <input type="text" size="60" name="name" placeholder="Nume">
              </div>
              <div class="email">
                <input type="email" name="mail" size="60" placeholder="E-mail">
              </div>
              <div class="textarea">
                <textarea name="comment" rows="10" cols="45" placeholder="Mesaj"></textarea>
              </div>
              <div class="submit">
                <input type="submit" name="submit" value="Trimite">
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
  
  <div class="footer-outer-wrapper">
    <div class="footer-inner-wrapper">
      <div class="footer">
        <ul class="footer-menu clearfix">
          <li class="menu-item">
            <a href="#about_us" >
              About us
            </a>
          </li>
          <li class="menu-item">
            <a href="#ginecologie" >
              Ginecologie
            </a>
          </li>
          <li class="menu-item">
            <a href="#obstetrica" >
              Obstetrica
            </a>
          </li>
          <li class="menu-item">
            <a href="#contacte" >
              Contacte
            </a>
          </li>
        </ul>
      </div>
    </div>
  </div>

</body>
</html>