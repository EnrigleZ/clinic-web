<?php

    $servername = "localhost";
	$username = "clinic";
	$password = "fred1111";
	$dbname = "clinic";

    $conn = new mysqli($servername, $username, $password, $dbname);
    
    $sql_str = "SELECT recipe.*, name, mobile, address FROM recipe, patient WHERE recipe.rid ={$_GET['rid']} AND patient.id = recipe.pid;";
    $result_sql = $conn->query($sql_str);
    
    if (!($row = $result_sql->fetch_assoc())) {
        echo "WRONG RECIPE";
    }
    //echo $sql_str;
    
    if ($row['mobile'] == "") $row['mobile'] = "手机暂无";
    if ($row['address'] == "") $row['address'] = "地址暂无";
?>
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
    <div class="navbar navbar-fixed-top">
        <div class="navbar-inner">
            <div class="container">
                <a class="btn btn-navbar" data-toggle="collapse" data-target=".navbar-inverse-collapse">
                    <i class="icon-reorder shaded"></i>
                </a>
                <a class="brand" href="index.php">诊所病历管理</a>
                <div class="nav-collapse collapse navbar-inverse-collapse">
                    <ul class="nav pull-right">
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" style="color:red">遇到问题了？
                                <b class="caret"></b>
                            </a>
                            <ul class="dropdown-menu">
                                <li class="nav-header">不直接的帮助</li>
                                <li>
                                    <a href="test.php">操作示例</a>
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
                <div class="span12" style="width:100%">
                    <div class="content">
                        <div class="module">
							<div class="module-head">
								<h3>病历详情 - <?php echo $row['name'];?></h3>
							</div>
							<div class="module-body">
                                <div class="module">
                                    <div class="module-head">
                                        患者信息
                                    </div>
                                    <div class="module-body">
                                        <dl class="dl-horizontal">
                                            <dt>姓名</dt>
                                            <dd>
                                                <?php echo $row['name'];?></dd>
                                            <dt>联系方式</dt>
                                            <dd>
                                                <?php echo $row['address'];?></dd>
                                            <dd>
                                                <?php echo $row['mobile'];?></dd>    
                                            <dt>日期</dt>
                                            <dd>
                                                <?php 
                                                    echo $row['treattime'].'&nbsp';
                                                    switch ($row['timedetail']) {
                                                        case 1: echo "早上"; break;
                                                        case 2: echo "下午"; break;
                                                        case 3: echo "晚上"; break;
                                                    }
                                                ?>
                                            </dd>
                                            <dt>收费</dt>
                                            <dd>
                                                <?php echo $row['price'];?></dd>
                                        </dl>
                                    </div>
                                </div>                            
                                <div class="module">
                                    <div class="module-head">
                                        症状
                                    </div>
                                    <div class="module-body">
                                        <?php echo $row['description']?>
                                    </div>
                                </div>
                                <div class="module">
                                    <div class="module-head">
                                        诊断
                                    </div>
                                    <div class="module-body">
                                        <?php echo $row['diagnosis']?>
                                    </div>
                                </div>
                                <div class="module">
                                    <div class="module-head">
                                        治疗
                                    </div>
                                    <div class="module-body">
                                        <?php echo $row['cure']?>
                                    </div>
                                </div>
                                <a class="btn btn-warning" href="test.php?rid='.$row['rid'].'">修改病历</a>
                                <a class="btn btn-danger" href="test.php?pid='.$row['pid'].'">删除病历</a>
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
            <b class="copyright">&copy; 2014 Edmin - EGrappler </b>All rights reserved.
            
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
<?php
$conn->close();
?>