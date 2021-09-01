<?php
	require '../includes/config.php';
	if(isset($_POST['submit'])){
		$logins = mysqli_query($connection, "SELECT * from users WHERE login='". $_POST['login'] ."'");
		$mails = mysqli_query($connection, "SELECT * from users WHERE email='". $_POST['email'] ."'");
		$tels = mysqli_query($connection, "SELECT * from users WHERE telephone='". $_POST['tel'] ."'");
		if(mysqli_num_rows($logins) != 0){
			$msg = "<span style='color:red; font-weight: bold;'>Такой логин уже существует!</span>";	
			$_POST['login'] = null;
		}
		else if(mysqli_num_rows($mails) != 0){
			$msg = "<span style='color:red; font-weight: bold'>Такая почта уже привязана!</span>";	
			$_POST['mails'] = null;
		}
		else if(mysqli_num_rows($tels) != 0){
			$msg = "<span style='color:red; font-weight: bold'>Такой телефон уже привязан!</span>";
			$_POST['telephone'] = null;
		}
		else{
			mysqli_query($connection, "INSERT INTO `users` (`id`, `login`, `password`, `email`, `telephone`) VALUES (NULL, '".$_POST['login']."', '".$_POST['password']."', '".$_POST['email']."', '". $_POST['tel'] ."');");			
			$msg = "<span style='color:green; font-weight: bold'>Успешная регистрация!</span>";
			setcookie("email", $_POST['email'], time() + 3600*24);
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
		<div class="reg-form">
			<div class="form-head">
				<h3 class="form-title">
					Регистрация
				</h3>
			</div>
			<?php
				echo $msg;
			?>
			<form method="POST" action="http://verifwindow/registration/registrarion.php">
				<input type="text" name="login" class="login" minlength="3" maxlength="128" placeholder="Логин" required>
				<input type="tel" name="tel" class="tel" pattern="+375[0-9]{9}" placeholder="Телефон в формате 375ххххххххх" required>
				<input type="email" name="email" placeholder="E-mail" required>
				<input type="password" name="password" class="password" minlength="8" maxlength="30" placeholder="Пароль" required>
				<input type="submit" name="submit" class="submit" value="Зарегистрироваться">
				<a href="../autorize/autorize.php" class="autorize">
					Уже есть аккаунт
				</a>
			</form>
		</div>
	</body>
	<script src="../script.js"></script>
</html>