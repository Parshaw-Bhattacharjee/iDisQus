<?php
session_start();
echo "Logging Out...";

session_destroy();
header("Location: /iDisQus")
?>