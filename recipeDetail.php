<?php

    /* function getRowInfo

        get information from SQL-query result
    */
    function getRowInfo($_row, $_str_info)
    {
        if (empty($_row[$_str_info])) return "<br>";
        else return $_row[$_str_info];
    }

    $servername = "localhost";
	$username = "clinic";
	$password = "fred1111";
	$dbname = "clinic";

    $conn = new mysqli($servername, $username, $password, $dbname);
    
    $sql_str = "SELECT recipe.*, patient.*, recipe.description AS rdes, patient.description AS pdes 
                FROM recipe, patient 
                WHERE recipe.rid ={$_GET['rid']} AND patient.id = recipe.pid;";
    $result_sql = $conn->query($sql_str);
    
    if (!($row = $result_sql->fetch_assoc())) {
        echo "WRONG RECIPE";
    }
    //echo $sql_str;

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
                                <div class="module" id="recipe_abstract">
                                    <div class="module-head">
                                        患者信息
                                    </div>
                                    <div class="module-body">
                                        <div class="btn-box-row row-fluid">
                                            <div class="span6">
                                                <div class="row-fluid">
                                                    <dl class="dl-horizontal">
                                                        <dt>姓名</dt>
                                                        <dd>
                                                            <?php echo getRowInfo($row,"name");?></dd>
                                                        <dt>性别</dt>
                                                        <dd>
                                                            <?php 
                                                                if ($gender = getRowInfo($row, "gender") != "<br>") echo $gender == 1 ? "男" : "女";
                                                                else echo "<br>";   
                                                            ?></dd>
                                                        <dt>年龄</dt>
                                                        <dd>
                                                            <?php echo getRowInfo($row, "age"); ?></dd>
                                                        <dt>联系方式</dt>
                                                        <dd>
                                                            <?php echo getRowInfo($row, "address");?></dd>
                                                        <dd>
                                                            <?php echo getRowInfo($row, "mobile");?></dd>    
                                                        <dt>患者备注</dt>
                                                        <dd>
                                                            <?php 
                                                                echo getRowInfo($row, "pdes");
                                                            ?>
                                                        </dd>
                                                    </dl>
                                                </div>
                                            </div>

                                            <div class="span6">
                                                <div class="row-fluid">
                                                    <dl class="dl-horizontal">
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
                                                        
                                                        <dt>应收金额</dt>
                                                        <dd>
                                                            <?php 
                                                                $price = getRowInfo($row, "price");     
                                                                echo $price;
                                                            ?>
                                                        </dd>
                                                        <dt>已收金额</dt>
                                                        <dd>
                                                            <?php
                                                                $price_paid = getRowInfo($row, "price_paid");
                                                                echo getRowInfo($row, "price_paid")
                                                            ?>
                                                        </dd>
                                                        <dt style="margin-top: 10px;">
                                                            <?php 
                                                                if ($price != "<br>" && $price <= $price_paid) {
                                                                    echo "金额结清";
                                                                }
                                                                else if ($price == "<br>" || $price_paid == "<br>") {
                                                                    echo '<span style="color: blue;">金额填写不完整</span>';
                                                                }
                                                                else echo '<span style="color:red">欠钱</span>';
                                                            ?>
                                                        </dt>
                                                    </dl>
                                                </div>
                                            </div>
                                        </div>
                                        
                                    </div>
                                </div>                            
                                <div class="module">
                                    <div class="module-head">
                                        症状
                                    </div>
                                    <div class="module-body">
                                        <?php echo $row['rdes']?>
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
                                <a class="btn btn-danger" href="deleteRecipe_do.php?rid=<?php echo $row['rid']?>">删除病历</a>
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