<?php
header("Cache-Control: no-cache, must-revalidate");
header("Expires: 0");
header("Content-Type: application/json; charset=utf-8");

require_once "../src/routes/api.php";