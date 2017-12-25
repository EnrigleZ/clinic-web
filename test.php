<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test page</title>
    <link rel="shortcut icon" href="images/icon.png">
    <link type="text/css" href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link type="text/css" href="bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet">
    <link type="text/css" href="css/theme.css" rel="stylesheet">
    <link type="text/css" href="images/icons/css/font-awesome.css" rel="stylesheet">
    <link type="text/css" href='http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600' rel='stylesheet'>
</head>

<?php
    $servername = "localhost";
	$username = "clinic";
	$password = "fred1111";
	$dbname = "clinic";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if (!isset($_GET['info'])) echo "信息修改等功能  维护中=-=";
?>
