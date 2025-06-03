<?php

session_start(); // start or continue session
session_unset(); // deletes all temporary data from the session
session_destroy(); // terminates the session
header("Location: index.php");
exit();

?>