<!DOCTYPE html>

<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>编辑患者信息</title>
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
    $type = 0;
    $type = $_GET['type'];
    if ($type == 1) {
        $result = $conn->query("select * from patient where id = {$_GET['pid']};");
        $row = $result->fetch_assoc();
    }
?>

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
                                编辑患者信息
                            </div>
                        </div>
                        <div class="module-body">
                        
                            <form class="form-horizontal row-fluid" method="post", action="editPatient_do.php?<?php echo "type={$_GET['type']}&id={$_GET['pid']}";?>">
                                <div class="control-group" style="display:inline-block">
                                    <label class="control-label" for="basicinput">姓名</label>
                                    <div class="controls">
                                        <input type="text" id="basicinput" name="name" placeholder="输入病历患者姓名...比如张三" class="span8" value="<?php echo $row['name'];?>">
                                        
                                    </div>
                                </div>
                                <div class="control-group" style="display:inline-block">
                                    <label class="control-label" style="width:50px" for="basicinput">年龄</label>
                                    <div class="controls" style="margin-left:60px">
                                        <input type="text" id="basicinput" name="age" placeholder="年龄" class="span3" value="<?php echo $row['age'];?>">
                                        <span class="help-inline" style="margin-left: 80px">姓名更改后，无需手动更改相关病历中的姓名</span>
                                    </div>
                                </div>
                                <div class="controls">
                                    <label class="radio inline">
                                        <input type="radio" name="gender" id="optionsRadios1" value="1" <?php if ($row['gender'] == 1) echo "checked";?>> 男
                                    </label>
                                    <label class="radio inline">
                                        <input type="radio" name="gender" id="optionsRadios2" value="2" <?php if ($row['gender'] == 0) echo "checked";?>> 女
                                    </label>
                                    
                                </div>
                                
                                <div class="control-group" >
                                    <label class="control-label" for="basicinput">住址</label>
                                    <div class="controls">
                                    <input type="text" class="span8"  id="basicinput" name="address" placeholder="输入住址" class="span12" value="<?php echo $row['address'];?>">
                                    </div>
                                </div>
                                <div class="control-group" >
                                    <label class="control-label" for="basicinput">电话</label>
                                    <div class="controls">
                                    <input type="text" class="span8"  id="basicinput" name="mobile" placeholder="输入联系电话" class="span12" value="<?php echo $row['mobile'];?>">
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label" for="basicinput">备注</label>
                                    <div class="controls">
                                        <textarea class="span8" rows="5" name="description" placeholder="写一下这人有啥要备注的，比如高血压，可不填"><?php echo $row['description'];?></textarea>
                                    </div>
                                </div>

                                <div class="control-group">
                                    <div class="controls">
                                        <button type="submit" class="btn btn-mini btn-success"><?php echo ($type == 1 ? "修改":"加入");?>患者信息</button>
                                    </div>
                                </div>
                            </form>
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

</body>