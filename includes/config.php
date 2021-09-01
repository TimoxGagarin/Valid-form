<?php
	$config = array(
		'db' => array(
			'server' => 'localhost',
			'username' => 'root',
			'password' => 'root',
			'db' => 'usersinfo'
		)
	);
	$connection = mysqli_connect(
		$config['db']['server'],
		$config['db']['username'],
		$config['db']['password'],
		$config['db']['db']
	);
	if($connection == false){
		echo "Не удалось подключиться к базе данных<br>";
		echo mysqli_connect_error();
		exit();
	}
?>