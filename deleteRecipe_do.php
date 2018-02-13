<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <link rel="shortcut icon" href="images/icon.png">
	<link type="text/css" href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<link type="text/css" href="bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet">
	<link type="text/css" href="css/theme.css" rel="stylesheet">
	<link type="text/css" href="images/icons/css/font-awesome.css" rel="stylesheet">
    <link type="text/css" href='http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600' rel='stylesheet'>
    <title>正在删除病历...</title>
</head>

<?php 
/*
    If 'pid' exists in POST, delete all recipes of that patient.
    If 'rid' exists in POST, delete that recipe.
*/
    
$servername = "localhost";
$username = "clinic";
$password = "fred1111";
$dbname = "clinic";

$conn = new mysqli($servername, $username, $password, $dbname);
if (isset($_GET["rid"]) && $_GET["rid"] != "") {
    $sql_str = "DELETE FROM recipe WHERE rid = {$_GET['rid']};";
    $conn->query($sql_str);
    echo $sql_str;
    $url_to = "Location: index.php?flag=1&action=delete";
    header($url_to); 
}
?>