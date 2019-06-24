<!DOCTYPE html>
<html lang="en">
<head>
	<title>Login Form</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->
	<link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animsition/css/animsition.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/daterangepicker/daterangepicker.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
<!--===============================================================================================-->
</head>
<body>

	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<div class="login100-form-title" style="background-image: url(images/bg-01.jpg);">
					<span class="login100-form-title-1">
						Submission 1
					</span>
				</div>

				<form class="login100-form validate-form" method="post" action="index-old.php" enctype="multipart/form-data">
					<div class="wrap-input100 validate-input m-b-26" data-validate="Username is required">
						<span class="label-input100">Username</span>
						<input class="input100" type="text" name="username" id="username" placeholder="Enter username">
						<span class="focus-input100"></span>
					</div>

					<div class="wrap-input100 validate-input m-b-26" data-validate="Username is required">
						<span class="label-input100">Full Name</span>
						<input class="input100" type="text" name="fullname" id="fullname" placeholder="Enter fullname">
						<span class="focus-input100"></span>
					</div>

					<div class="wrap-input100 validate-input m-b-26" data-validate="Username is required">
						<span class="label-input100">Job</span>
						<input class="input100" type="text" name="job" id="job" placeholder="Enter job">
						<span class="focus-input100"></span>
					</div>

					<div class="wrap-input100 validate-input m-b-26" data-validate="Username is required">
						<span class="label-input100">Departement</span>
						<input class="input100" type="text" name="departement" id="departement" placeholder="Enter departement">
						<span class="focus-input100"></span>
					</div>

					<div class="container-login100-form-btn">
						<button class="login100-form-btn" name="register">
							Register
						</button>
						<button class="login100-form-btn" name="show">
							Show
						</button>
					</div>
				</form>
			</div>
		</div>
	</div>

	<?php
    // $user = "cloudymous";
    // $pass = "*RmcDwn26#";
    // $db = "dicodingdb";

		// PHP Data Objects(PDO) Sample Code:
		try {
		    $conn = new PDO("sqlsrv:server = tcp:cloudymousappserv.database.windows.net,1433; Database = dicodingdb", "cloudymous", "*RmcDwn26#");
		    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		}
		catch (PDOException $e) {
		    print("Error connecting to SQL Server.");
		    die(print_r($e));
		}

		// SQL Server Extension Sample Code:
		$connectionInfo = array("UID" => "cloudymous@cloudymousappserv", "pwd" => "*RmcDwn26#", "Database" => "dicodingdb", "LoginTimeout" => 30, "Encrypt" => 1, "TrustServerCertificate" => 0);
		$serverName = "tcp:cloudymousappserv.database.windows.net,1433";
		$conn = sqlsrv_connect($serverName, $connectionInfo);

    if (isset($_POST['register'])) {
        try {
            $username = $_POST['username'];
            $fullname = $_POST['fullname'];
            $job = $_POST['job'];
            $departement = $_POST['departement'];
            // Insert data
            $sql_insert = "INSERT INTO registration (reg_username, reg_fullname, reg_job, reg_department)
                        VALUES (?,?,?,?)";
            $stmt = $conn->prepare($sql_insert);
            $stmt->bindValue(1, $username);
            $stmt->bindValue(2, $fullname);
            $stmt->bindValue(3, $job);
            $stmt->bindValue(4, $departement);
            $stmt->execute();
        } catch(Exception $e) {
            echo "Failed: " . $e;
        }
        echo "<h3>Your're registered!</h3>";
    } else if (isset($_POST['show'])) {
        try {
            $sql_select = "SELECT * FROM registration";
            $stmt = $conn->query($sql_select);
            $registrants = $stmt->fetchAll();
            if(count($registrants) > 0) {
                echo "<h2>People who are registered:</h2>";
                echo "<table>";
                echo "<tr><th>Username</th>";
                echo "<th>Fullname</th>";
                echo "<th>Job</th>";
                echo "<th>Departement</th></tr>";
                foreach($registrants as $registrant) {
                    echo "<tr><td>".$registrant['reg_username']."</td>";
										echo "</table>";
                    echo "<td>".$registrant['reg_fullname']."</td>";
                    echo "<td>".$registrant['reg_job']."</td>";
                    echo "<td>".$registrant['reg_department']."</td></tr>";
                }
            } else {
                echo "<h3>No one is currently registered.</h3>";
            }
        } catch(Exception $e) {
            echo "Failed: " . $e;
        }
    }
 ?>


<!--===============================================================================================-->
	<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/bootstrap/js/popper.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/daterangepicker/moment.min.js"></script>
	<script src="vendor/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
	<script src="vendor/countdowntime/countdowntime.js"></script>
<!--===============================================================================================-->
	<script src="js/main.js"></script>

</body>
</html>
