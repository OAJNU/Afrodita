<?php

      header("Expires: Tue, 03 Jul 2001 06:00:00 GMT");

      header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");

      header("Cache-Control: no-store, no-cache, must-revalidate");

      header("Cache-Control: post-check=0, pre-check=0", false);

      header("Pragma: no-cache");
session_start();
function randomText($length) {
    $pattern = "1234567890abcdefghijklmnopqrstuvwxyz";
    for($i=0;$i<$length;$i++) {
      $key .= $pattern{rand(0,35)};
    }
    return $key;
}
$_SESSION['tmptxt'] = randomText(8);
$captcha = imagecreatefromgif("bgcaptcha.gif");
$colText = imagecolorallocate($captcha, 255, 0, 0);
imagestring($captcha, 5, 30, 25, $_SESSION['tmptxt'], $colText);

header("Content-type: image/gif");
imagegif($captcha);
exit;
?>