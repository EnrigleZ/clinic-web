<!DOCTYPE html>
<?php
    $servername = "localhost";
    $username = "clinic";
    $password = "fred1111";
    $dbname = "clinic";

    $conn = new mysqli($servername, $username, $password, $dbname);
    $result = $conn->query("select * from patient;");
?>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>全部患者信息</title>
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
                <?php
                    if (!empty($_GET["action"]) && !empty($_GET["result"])) {
                        if ($_GET["action"] == "add") $action = "添加";
                        else if ($_GET["action"] == "modify") $action = "修改";
                        else $action = "exit";
                        if ($action != "exit" && $_GET["result"] == 1) {
                            echo '<div class="alert alert-success">
                                        <button type="button" class="close" data-dismiss="alert">×</button>
                                        <strong>'.$action.'成功！</strong>可以在下方列表中检查
                                    </div>';
                        }
                    }
                ?>
                <div class="span12">
                    <div style="margin-bottom: 30px">
                        <a class="btn-box span3" href="editPatient.php?type=0">
                            <i class="icon-edit"></i>
                            <b>加入新患者</b>
                        </a>
                    </div>
                </div>
                
                <div class="span12">
                    <div >
                       
                        <div class="module">
                            <div class="module-head">
                                <h3>
                                    患者列表</h3>
                            </div>
                            <div class="module-body table">
                                <table cellpadding="0" cellspacing="0" border="0" class="datatable-1 table table-bordered table-striped	 display" width="100%">
                                    <thead>
                                        <tr>
                                            <th>
                                                患者信息
                                            </th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                    <?php
                                    while ($row = $result->fetch_assoc()) {
                                        if ($row['description'] == "") $row['description'] = "无";
                                        if ($row['mobile'] == "") $row['mobile'] = "无";
                                        if ($row['address'] == "") $row['address'] = "无";
                                        if ($row['age'] == "") $row['age'] = "无";
                                        echo 
                                        '<tr class="gradeA">
                                            <td class="span6">
                                                <div class="media user">
                                                    <a class="media-avatar pull-left" href="#">
                                                        <img src="images/user.png">
                                                    </a>
                                                    <div class="span2">
                                                        <div class="media-body">
                                                            <h3 class="media-title">
                                                                '.$row["name"].'</h3>
                                                            <p>
                                                                <small class="muted">手机：'.$row['mobile'].'</small>
                                                            </p>
                                                            <p>
                                                                <small class="muted">年龄：'.$row['age'].'</small>
                                                            </p>
                                                            <div class="media-option btn-group shaded-icon">
                                                                <a class="btn btn-mini btn-info" href="allPatientRecipe.php?pid='.$row['id'].'">此人全部病历</a>
                                                                <a class="btn btn-mini btn-success" href="editPatient.php?type=1&pid='.$row['id'].'">修改资料</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="span2">
                                                        <dl>
                                                            <dt>联系地址</dt>
                                                            <dd>'.$row['address'].'</dd>
                                                            <br>
                                                            <dt>备注</dt>
                                                            <dd>'.$row['description'].'</dd>
                                                        </dl>
                                                    </div>
                                                </div>

                                            </td>

                                        </tr>';
                                    }
                                    ?>
                                    </tbody>


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
    <script src="scripts/style.js" type="text/javascript"></script>
</body>