<?php
  $passfile = fopen("pass", "r") or die("Unable to rechive password!");
  $pass = fread($passfile, filesize("pass"));
  $conn = mysqli_connect("cp01.nordicway.dk", "jemfixne_webpage", $pass, "jemfixne_public");
  if (!$conn) die("Connection failed: " . mysqli_error($conn));
