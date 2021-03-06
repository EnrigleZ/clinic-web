﻿<?php
	$insertFlag = 0;
	
	$lastName = "";
	$lastDescription = "";
	date_default_timezone_set("PRC");
	
	$lastTimedetail = "";
	$lastPrice = "";
	
	if (isset($_GET["add"]) && $_GET["add"] == 1) {
		$servername = "localhost";
		$username = "clinic";
		$password = "fred1111";
		$dbname = "clinic";

		if (isset($_POST["name"]) && isset($_POST["name"]) && $_POST["name"] != "" && $_POST["description"] != "") {
		// 判断是否表单有效：姓名 & 症状

			$conn = new mysqli($servername, $username, $password, $dbname);

			if (!isset($_POST['timedetail'])) $_POST['timedetail'] = 0;
			if ($_POST['treattime'] == "") {
				$_POST['treattime'] = date("Y-m-d", time());
				$_POST['timedetail'] = 0;
			}
			if ($_POST['price'] == "") $_POST['price'] = 0;
			
			(new mysqli($servername, $username, $password, $dbname))->query("call checkName('".$_POST['name']."')");

			$sql_str = "INSERT INTO recipe(pid, treattime, timedetail, description, price, diagnosis, cure, price_paid)
						SELECT id, '".$_POST['treattime']."',".$_POST['timedetail'].",'".
						$_POST['description']."',".$_POST['price'].",'".$_POST['diagnosis']."','".
						$_POST['cure']."', ".$_POST["price_paid"]." 
						FROM patient WHERE name = '".$_POST['name']."';";
			//echo $sql_str;

			if ($conn->query($sql_str)) $insertFlag = 1;
			else $insertFlag = -1;

			//echo $sql_str;
			//echo $conn->affected_rows;
		}
		else if ((isset($_POST["name"]) && isset($_POST["name"])) && ($_POST["name"] != "" || $_POST["description"] != "")) {
			$insertFlag = 2;	//信息不完全，有一个没填
		}
	}	
?>

<html lang="en">


<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>添加病历记录</title>
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

				<div class="span12">
					<div class="content">

						<div class="module">
							<div class="module-head">
								<h3>添加病历信息</h3>
							</div>
							<div class="module-body">
								<div>
									<!--div class="alert">
										<button type="button" class="close" data-dismiss="alert">×</button>
										<strong>Warning!</strong> Something fishy here!
									</div>
									<div class="alert alert-error">
										<button type="button" class="close" data-dismiss="alert">×</button>
										<strong>Oh snap!</strong> Whats wrong with you? 
									</div-->
								<?php
								switch ($insertFlag) {
									case 1:
										echo '<div class="alert alert-success">
												<button type="button" class="close" data-dismiss="alert">×</button>
												<strong>添加成功！</strong> 可以继续添加或者返回主页面
											</div>';
										break;
									case 2:
									echo '<div class="alert alert-error">
											<button type="button" class="close" data-dismiss="alert">×</button>
											<strong>添加失败！</strong>检查是不是有信息没有填，比如姓名、病历记录。 
										</div>';
									break;
									case -1:
										echo '<div class="alert alert-error">
												<button type="button" class="close" data-dismiss="alert">×</button>
												<strong>出错了！</strong>检查一下病历信息是不是含有特殊标点，还有问题的话可以咨询你儿子。 
											</div>';
										break;
									default: break;
								}
								?>
								</div>
								<br />
							<?php
								if ($insertFlag == 2 || $insertFlag == -1) {
									$lastName = $_POST["name"];
									$lastDescription = $_POST["description"];
									$lastTreattime = $_POST["treattime"];
									$lastTimedetail = $_POST["timedetail"];
									$lastPrice = $_POST["price"];
									$lastDiagnosis = $_POST["diagnosis"];
									$lastCure = $_POST["cure"];
									$lastPricePaid = $_POST["price_paid"];
								}
								else {
									$lastName = "";
									$lastDescription = "";
									$lastTreattime = date("Y-m-d", time());
									$lastTimedetail = "";
									$lastPrice = "";
									$lastDiagnosis = "";
									$lastCure = "";
									$lastPricePaid = "";
								}
							?>
								<form class="form-horizontal row-fluid" method="post", action="addRecipe.php?add=1">
									<div class="control-group">
										<label class="control-label" for="basicinput">姓名</label>
										<div class="controls">
											<input type="text" id="basicinput" name="name" placeholder="输入病历患者姓名...比如张三" class="span8" value="<?php echo $lastName;?>">
											<span class="help-inline">姓名和症状不能空</span>
										</div>
									</div>

									<div class="control-group">
										<label class="control-label" for="basicinput">症状</label>
										<div class="controls">
											<textarea class="span8" rows="5" name="description" placeholder="写一下症状，比如他啥牙疼"><?php echo $lastDescription;?></textarea>
										</div>
									</div>

									<div class="control-group">
										<label class="control-label" for="basicinput">诊断</label>
										<div class="controls">
											<textarea class="span8" rows="5" name="diagnosis" placeholder="写一下判断是什么病"><?php echo $lastDiagnosis;?></textarea>
										</div>
									</div>

									<div class="control-group">
										<label class="control-label" for="basicinput">治疗</label>
										<div class="controls">
											<textarea class="span8" rows="5" name="cure" placeholder="写一下病历说明，拔了什么牙上了什么药"><?php echo $lastCure;?></textarea>
										</div>
									</div>

									<div class="control-group">
										<label class="control-label" for="basicinput">应收款项</label>
										<div class="controls">
											<div class="input-append">
												<input type="text" placeholder="要收多少钱" name="price" class="span8" value="<?php echo $lastPrice;?>">
												<span class="add-on">元</span>
											</div>
										</div>
									</div>

									<div class="control-group">
										<label class="control-label" for="basicinput">已收款项</label>
										<div class="controls">
											<div class="input-append">
												<input type="text" placeholder="已经收了多少钱" name="price_paid" class="span8" value="<?php echo $lastPricePaid;?>">
												<span class="add-on">元</span>
											</div>
										</div>
									</div>

									<div class="control-group">
										<label class="control-label" for="basicinput">就诊时间</label>
										<div class="controls">
											<input type="text" id="basicinput" name="treattime" placeholder="输入时间" class="span8" value="<?php echo $lastTreattime;?>" style="width:213px;">
										</div>

										<div class="controls">
											<label class="radio inline">
												<input type="radio" name="timedetail" id="optionsRadios1" value="1" <?php if ($lastTimedetail == 1) echo "checked";?>> 早上
											</label>
											<label class="radio inline">
												<input type="radio" name="timedetail" id="optionsRadios2" value="2" <?php if ($lastTimedetail == 2) echo "checked";?>> 下午
											</label>
											<label class="radio inline">
												<input type="radio" name="timedetail" id="optionsRadios3" value="3" <?php if ($lastTimedetail == 3) echo "checked";?>> 晚上
											</label>
										</div>
									</div>


									<div class="control-group">
										<div class="controls">
											<button type="submit" class="btn btn-mini btn-success">在我的服务器上保存病历</button>
										</div>
									</div>
								</form>
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
        <script src="scripts/style.js"></script>
</body>