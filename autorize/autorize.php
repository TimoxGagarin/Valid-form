<?php
	require '../includes/config.php';
	if(isset($_POST['submit'])){
		$mail_pass = mysqli_query($connection, "SELECT * from users WHERE email='". $_POST['email'] ."' AND password='". $_POST['password'] ."'");
		if(mysqli_num_rows($mail_pass) == 0){
			$msg = "<span style='color:red; font-weight: bold'>Неверный пароль!</span>";	
			$_POST['password'] = null;
		}
		else{
			mysqli_query($connection, "SELECT * FROM `users` WHERE email='".$_POST['email']."';");			
			$msg = "<div style='margin-top: 10px; display: flex; justify-content: center'><span style='color:green; font-weight: bold;'>Успешная авторизация!</span></div>";
			setcookie("user_id", mysqli_fetch_assoc($mail_pass)['id'], time() + 3600*24);
			$_POST = null;	
		}
	}
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title>ValidForm</title>
		<link rel="stylesheet" href="../style.css">
	</head>
	<body>
		<div class="autorize-form">
			<div class="form-head">
				<h3 class="form-title">
					Авторизация
				</h3>
			</div>
			<?php
				echo $msg;
			?>
			<form method="post" action="http://verifwindow/autorize/autorize.php">
				<input type="email" name="email" placeholder="E-mail" required>
				<input type="password" name="password" class="password" placeholder="Пароль" required>
				<input type="submit" name="submit" class="submit" value="Авторизоваться">
			</form>
		</div>
	</body>
	<script src="../script.js"></script>
</html>