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

    // type:
    //      0: add new; 1: edit
    
    if (!empty($_GET['type'])) $type = $_GET['type'];
    if ($type == 1) {
        $result = $conn->query("select * from patient where id = {$_GET['pid']};");
        $row = $result->fetch_assoc();
    }
?>

<body>
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
                        
                            <form class="form-horizontal row-fluid" method="post", action="editPatient_do.php?<?php if ($type == 1) echo "type={$_GET['type']}&pid={$_GET['pid']}";?>">
                                
                                <div class="control-group">
                                    <label class="control-label" for="basicinput">姓名</label>
                                    <div class="controls">
                                        <input type="text" id="basicinput" name="name" placeholder="输入病历患者姓名...比如张三" class="span8" value="<?php if ($type == 1)  echo $row['name'];?>">
                                    </div>                                    
                                </div>

                                <!-- <div class="controls"  style="display:inline-block">
                                    
                                </div> -->

                                <div class="control-group">
                                    <label class="control-label" for="basicinput">年龄</label>
                                    <div class="controls">
                                        <input type="text" id="basicinput" name="age" placeholder="年龄" class="span3" value="<?php if ($type == 1)  echo $row['age'];?>">


                                        <!--Gender-->
                                        <span class="">
                                            <label class="radio inline">
                                                <input type="radio" name="gender" id="optionsRadios1" value="1" <?php if ($type == 1 && $row['gender'] == 1) echo "checked";?>> 男
                                            </label>
                                            <label class="radio inline">
                                                <input type="radio" name="gender" id="optionsRadios2" value="2" <?php if ($type == 1 && $row['gender'] == 0) echo "checked";?>> 女
                                            </label>
                                        </span>
                                    </div>
                                </div>

                                
                                <div class="control-group" >
                                    <label class="control-label" for="basicinput">住址</label>
                                    <div class="controls">
                                    <input type="text" class="span8"  id="basicinput" name="address" placeholder="输入住址" class="span12" value="<?php  if ($type == 1) echo $row['address'];?>">
                                    </div>
                                </div>
                                <div class="control-group" >
                                    <label class="control-label" for="basicinput">电话</label>
                                    <div class="controls">
                                    <input type="text" class="span8"  id="basicinput" name="mobile" placeholder="输入联系电话" class="span12" value="<?php if ($type == 1)  echo $row['mobile'];?>">
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label" for="basicinput">备注</label>
                                    <div class="controls">
                                        <textarea class="span8" rows="5" name="description" placeholder="写一下这人有啥要备注的，比如高血压，可不填"><?php if ($type == 1)  echo $row['description'];?></textarea>
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
    
    <script src="scripts/jquery-1.9.1.min.js" type="text/javascript"></script>
    <script src="scripts/jquery-ui-1.10.1.custom.min.js" type="text/javascript"></script>
    <script src="bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <script src="scripts/datatables/jquery.dataTables.js" type="text/javascript"></script>
    <script src="scripts/common.js" type="text/javascript"></script>
    <script src="scripts/style.js"></script>
</body>