<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <link rel="shortcut icon" href="images/icon.png">
	<link type="text/css" href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<link type="text/css" href="bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet">
	<link type="text/css" href="css/theme.css" rel="stylesheet">
	<link type="text/css" href="images/icons/css/font-awesome.css" rel="stylesheet">
    <link type="text/css" href='http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600' rel='stylesheet'>
    <title>正在修改数据库中...</title>
</head>

<?php
    if ($_POST['name'] == "") {
        echo "<h1>姓名未填写！</h1><br>";
        echo '<a class="btn btn-large btn-info" style="font-size:3rem;" onclick="window.history.back();">返回上一页</a>';
        return;
    }

    $servername = "localhost";
	$username = "clinic";
	$password = "fred1111";
	$dbname = "clinic";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($_POST['age'] == "") $_POST['age'] = 'null';
    if ($_POST['gender'] == "") $_POST['gender'] = 'null';

    if ($_GET['type'] == 1) {
        
        // check duplication of name
        $check_sql_str = "SELECT COUNT(*) AS is_dup FROM patient WHERE id <> {$_GET['pid']} AND name = '{$_POST['name']}'";
        $check_row = $conn->query($check_sql_str)->fetch_assoc();
        if ($check_row['is_dup'] != 0) {
            echo "<h1>姓名已存在</h1><br>";
            echo '<a class="btn btn-large btn-info" style="font-size:3rem;" onclick="window.history.back();">返回上一页</a>';
            return;
        }

        $sql_str = "UPDATE patient 
        SET name='{$_POST['name']}', age={$_POST['age']}, gender={$_POST['gender']},
        mobile='{$_POST['mobile']}', address='{$_POST['address']}', description='{$_POST['description']}'
        WHERE id={$_GET['pid']};
        ";
    }
    else {
        $sql_str = "INSERT INTO patient(name, age, gender, mobile, address, description) 
        VALUES('{$_POST['name']}', {$_POST['age']}, {$_POST['gender']},
        '{$_POST['mobile']}', '{$_POST['address']}', '{$_POST['description']}');
        ";
    }
 
    if ($conn->query($sql_str)) {
        $conn->close();
        //echo "done.";
        $url_to = "Location: allPatient.php?action=".($_GET['type'] == 1 ? "modify" : "add")."&result=1";
        echo $url_to;
        header($url_to); 
    }
    else {
        echo "<h1>添加失败！</h1><br>";
        echo '<a class="btn btn-large btn-info" style="font-size:3rem;" onclick="window.history.back();">返回上一页</a><br>';
        echo $sql_str;
    }
?>