<?php

function getRowInfo($_row, $_str_info)
{
    if (empty($_row[$_str_info])) return "<br>";
    else return $_row[$_str_info];
}

$valid_flag = 1;
$title = "全部病历记录";
// 判断是否存在该 patient
if (!isset($_GET["pid"]) || $_GET["pid"] == "") {
    $valid_flag = 0;
    echo "Missing parameter 'pid' - -<br>";
}
else {
    $servername = "localhost";
    $username = "clinic";
    $password = "fred1111";
    $dbname = "clinic";
    $conn = new mysqli($servername, $username, $password, $dbname);

    $patient_name = "";

    // 判断是否存在 patient with THE pid;
    $result_check = $conn->query("SELECT * FROM patient WHERE id = {$_GET['pid']};");
    if ($result_check->num_rows == 0) {
        $valid_flag = 0;
    }
    else {
        $row = $result_check->fetch_assoc();    // row记录patient的patient表基本信息
        $patient_name = $row['name'];
        $title = $patient_name."的病历本";
        $detail_sql_str = "SELECT   COUNT(*) AS count_recipe, 
                                    MIN(treattime) AS first_treattime, 
                                    SUM(price) AS total_price, 
                                    SUM(price_paid) AS total_paid
                            FROM patient, recipe
                            WHERE pid = {$_GET['pid']} AND pid = id
                            GROUP BY pid;";
        $detail_count_recipe = "";
        $detail_first_treattime = "";
        $detail_total_price = "";
        $detail_total_paid = "";
        $detial_result = $conn->query($detail_sql_str);

        if ($detial_result->num_rows == 1) {
            $detail_row = $detial_result->fetch_assoc();
            $detail_count_recipe = getRowInfo($detail_row, 'count_recipe');
            $detail_first_treattime = getRowInfo($detail_row, 'first_treattime');
            $detail_total_price = getRowInfo($detail_row, 'total_price');
            $detail_total_paid = getRowInfo($detail_row, 'total_paid');
        }
    }
}
$sql_str = "SELECT * FROM recipe WHERE pid = {$_GET['pid']};";
$result_recipe = $conn->query($sql_str);

//echo "Total record: ".$result_recipe->num_rows;
?>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title; ?></title>
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
                <div class="module" id="recipe_abstract">
                    <div class="module-head">
                        <h3>患者信息</h3>
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
                                                echo getRowInfo($row, "description");
                                            ?>
                                        </dd>
                                        <br><br>
                                        <dt>
                                            <a class="btn btn-mini btn-success" href="editPatient.php?type=1&pid=<?php echo $row['id'];?>">修改资料</a>
                                        </dt>
                                    </dl>
                                </div>
                            </div>

                            <div class="span6">
                                <div class="row-fluid">
                                    <dl class="dl-horizontal">
                                        <dt>首次就诊日期</dt>
                                        <dd>
                                            <?php 
                                                echo $detail_first_treattime;
                                            ?>
                                        </dd>
                                        
                                        <dt>全部应收金额</dt>
                                        <dd>
                                            <?php 
                                                echo $detail_total_price;
                                            ?>
                                        </dd>
                                        <dt>全部已收金额</dt>
                                        <dd>
                                            <?php
                                                echo $detail_total_paid;
                                            ?>
                                        </dd>
                                        
                                    </dl>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                </div>
                <div class="module">
                    <div class="module-head">
                        <h3>
                            <?php echo $patient_name."的病历列表";?></h3>
                    </div>
                    <div class="module-body table">
                        <table cellpadding="0" cellspacing="0" border="0" class="datatable-1 table table-bordered table-striped	 display" width="100%" id="recipeAbstractTable">
                            <thead>
                                <tr>
                                    <th>
                                        就诊时间
                                    </th>
                                    <th>
                                        症状
                                    </th>
                                    <th>   
                                        诊断
                                    </th>
                                    <th>
                                        应收/已收
                                    </th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                            //  就诊时间 诊断 症状 操作
                                while ($row = $result_recipe->fetch_assoc()) {
                                    $detail = "";
                                    switch ($row['timedetail']) {
                                        case 1: $detail = "[1.上午]"; break;
                                        case 2: $detail = "[2.下午]"; break;
                                        case 3: $detail = "[3.晚上]"; break;
                                        default: $detail = "";
                                    }
                                    echo '<tr class="gradeA">
                                            <td>
                                                '.$row["treattime"]."   ".$detail.'
                                            </td>
    
                                            <td>
                                                '.$row["description"].'
                                            </td>

                                            <td>
                                                '.$row["diagnosis"].'
                                            </td>
                                        
                                            <td>
                                                '.$row['price'].' / '.$row['price_paid'].'
                                            </td>

                                            <td>
                                                <a class="btn btn-warning" href="recipeDetail.php?rid='.$row['rid'].'">详情/编辑</a>
                                            </td>
                                        </tr>';
                                }
                            ?>
                            </tbody>

                            <tfoot>
                                <tr>
                                    <th>
                                        就诊时间
                                    </th>
                                    <th>
                                        症状
                                    </th>
                                    <th>
                                        诊断
                                    </th>
                                    <th>
                                        应收/已收
                                    </th>
                                    <th></th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!--/.container-->
    </div>
    <!--/.wrapper-->
    <script src="scripts/jquery-1.9.1.min.js" type="text/javascript"></script>
    <script src="scripts/jquery-ui-1.10.1.custom.min.js" type="text/javascript"></script>
    <script src="bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <script src="scripts/datatables/jquery.dataTables.js" type="text/javascript"></script>
    <script src="scripts/allPatientRecipe.js" type="text/javascript"></script>
    <script src="scripts/style.js"></script>
</body>