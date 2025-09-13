<?php
$plainPassword = "password";
$hash = password_hash($plainPassword, PASSWORD_BCRYPT);
echo $hash;