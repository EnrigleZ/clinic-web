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
    <div class="navbar navbar-fixed-top">
        <div class="navbar-inner">
            <div class="container">
                <a class="btn btn-navbar" data-toggle="collapse" data-target=".navbar-inverse-collapse">
                    <i class="icon-reorder shaded"></i>
                </a>
                <a class="brand" href="index.php">诊所病历管理</a>

                    <ul class="nav pull-right">
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" style="color:red">遇到问题了？
                                <b class="caret"></b>
                            </a>
                            <ul class="dropdown-menu">
                                <li class="nav-header">不直接的帮助</li>
                                <li>
                                    <a href="demo.html">操作示例</a>
                                </li>
                                <li class="divider"></li>
                                <li class="nav-header">直接的帮助</li>
                                <li>
                                    <a href="#">联系你儿子</a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="index.php">返回首页</a>
                        </li>
                        <li class="nav-user dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <img src="images/user.png" class="nav-avatar" />
                                <b class="caret"></b>
                            </a>
                            <ul class="dropdown-menu">
                                <li>
                                    <a href="#">Your Profile</a>
                                </li>
                                <li>
                                    <a href="#">Edit Profile</a>
                                </li>
                                <li>
                                    <a href="#">Account Settings</a>
                                </li>
                                <li class="divider"></li>
                                <li>
                                    <a href="#">Logout</a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
                <!-- /.nav-collapse -->
            </div>
        </div>
        <!-- /navbar-inner -->
    </div>
    <!-- /navbar -->
    <div class="wrapper">
        <div class="container">
            <div class="row">

                <!--/.span3-->
                <div class="span12">
                    <div class="content">
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
                                                                <small class="muted">'.$row['mobile'].'</small>
                                                            </p>
                                                            <div class="media-option btn-group shaded-icon">
                                                                <a class="btn btn-mini btn-info" href="test.php?name='.$row['name'].'">此人全部病历</a>
                                                                <a class="btn btn-mini btn-success" href="editPatient.php?name='.$row['name'].'">修改资料</a>
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
    <div class="footer">
        <div class="container">
            <b class="copyright">&copy; 2014 Edmin - EGrappler </b>All rights reserved. More Templates
            <a href="http://www.cssmoban.com/" target="_blank" title="模板之家">模板之家</a> - Collect from
            <a href="http://www.cssmoban.com/" title="网页模板" target="_blank">网页模板</a>
        </div>
    </div>
    <script src="scripts/jquery-1.9.1.min.js" type="text/javascript"></script>
    <script src="scripts/jquery-ui-1.10.1.custom.min.js" type="text/javascript"></script>
    <script src="bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <script src="scripts/flot/jquery.flot.js" type="text/javascript"></script>
    <script src="scripts/flot/jquery.flot.resize.js" type="text/javascript"></script>
    <script src="scripts/datatables/jquery.dataTables.js" type="text/javascript"></script>
    <script src="scripts/common.js" type="text/javascript"></script>

</body>