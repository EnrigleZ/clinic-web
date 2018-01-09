<!DOCTYPE html>
<?php

    $servername = "localhost";
	$username = "clinic";
	$password = "fred1111";
	$dbname = "clinic";

    $conn = new mysqli($servername, $username, $password, $dbname);
    
    $sql_str = "call displayall();";
    $result_sql = $conn->query($sql_str);

    function getCntFromTable($arg_sql_str) {
        $res = (new mysqli("localhost", "clinic", "fred1111", "clinic"))->query($arg_sql_str)->fetch_assoc();
        return $res['cnt'];
    }

    $recipt_cnt = getCntFromTable("select count(*) as cnt from recipe;");
    $patient_cnt = getCntFromTable("select count(*) as cnt from patient;");
?>
<html lang="en">

<head>

    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>诊所病历管理</title>
        <link rel="shortcut icon" href="images/icon.png">
        <link type="text/css" href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link type="text/css" href="bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet">
        <link type="text/css" href="css/theme.css" rel="stylesheet">
        <link type="text/css" href="images/icons/css/font-awesome.css" rel="stylesheet">
        <link type="text/css" href='http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600' rel='stylesheet'>
    </head>

    <body>

        <div class="wrapper">
            <div class="container">
                <div class="row">
                    <!--/.span3-->
                    <div class="span12" style="width:100%">
                        <div class="content">
                            <div class="btn-controls">
                                <div class="btn-box-row row-fluid">
                                    <a href="addRecipe.php" class="btn-box big span4">
                                        <i class="icon-ambulance"></i>
                                        <b>
                                            <?php
                                               echo $recipt_cnt;
                                            ?>
                                        </b>
                                        <p class="text-muted">
                                            添加病历</p>
                                    </a>
                                    <a href="allPatient.php" class="btn-box big span4">
                                        <i class="icon-user"></i>
                                        <b>
                                            <?php
                                                echo $patient_cnt;
                                            ?>
                                        </b>
                                        <p class="text-muted">
                                            查看患者</p>
                                    </a>
                                    <a href="#" class="btn-box big span4">
                                        <i class="icon-money"></i>
                                        <b>待定</b>
                                        <p class="text-muted">
                                            待定</p>
                                    </a>
                                </div>

                            </div>
                            <!--/#btn-controls-->
                            <div class="module">
                                <div class="module-head">
                                    <h3>
                                        病历列表</h3>
                                </div>
                                <div class="module-body table">
                                    <table cellpadding="0" cellspacing="0" border="0" class="datatable-1 table table-bordered table-striped	 display" width="100%" id="recipeAbstractTable">
                                        <thead>
                                            <tr>
                                                <th>
                                                    姓名
                                                </th>
                                                <th>
                                                    就诊时间
                                                </th>

                                                <th>
                                                    诊断
                                                </th>
                                                <th>
                                                    操作
                                                </th>

                                            </tr>
                                        </thead>

                                        <tbody>
                                <?php
                                    while ($row = $result_sql->fetch_assoc()) {
                                        $detail = "";
                                        switch ($row['timedetail']) {
                                            case 1: $detail = "[1.上午]"; break;
                                            case 2: $detail = "[2.下午]"; break;
                                            case 3: $detail = "[3.晚上]"; break;
                                            default: $detail = "";
                                        }
                                        echo '<tr class="gradeA">
                                                <td>
                                                    '. $row["name"].'
                                                </td>
                                                <td>
                                                    '.$row["treattime"]."   ".$detail.'
                                                </td>

                                                <td>
                                                    '.$row["diagnosis"].'
                                                </td>
                                                
                                                <td>
                                                <a class="btn btn-warning" href="recipeDetail.php?rid='.$row['rid'].'">查看病历详情</a>
                                                <a class="btn btn-info" href="test.php?pid='.$row['pid'].'">此人全部病历</a>
                                                </td>
                                            </tr>';
                                    }
                                ?>
                                        </tbody>

                                        <tfoot>
                                            <tr>
                                                <th>
                                                    姓名
                                                </th>
                                                <th>
                                                    就诊时间
                                                </th>

                                                <th>
                                                    诊断
                                                </th>
                                                <th></th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <!--/.content-->
                    </div>
                    <!--/.span9-->
                </div>
            </div>
            <!--/.container-->
        </div>
        <!--/.wrapper-->
        <script src="scripts/jquery-1.9.1.min.js" type="text/javascript"></script>
        <script src="scripts/jquery-ui-1.10.1.custom.min.js" type="text/javascript"></script>
        <script src="bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="scripts/datatables/jquery.dataTables.js" type="text/javascript"></script>
        <script src="scripts/common.js" type="text/javascript"></script>
        <script src="scripts/style.js"></script>
    </body>
<?php
    $conn->close();
?>