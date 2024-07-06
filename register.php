<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Registration page</title>
        <link rel="stylesheet" type="text/css" href="log_style.css">
    </head>
    <body>
    <div class="container">
	<div class="screen">
		<div class="screen__content">
			<form class="login" action="register.php" method="post">
				<div class="login__field">
					<i class="login__icon fas fa-user"></i>
					<input type="text" class="login__input" name="uname" placeholder="User Name" required>
				</div>
				<div class="login__field">
					<i class="login__icon fas fa-user"></i>
					<input type="text" class="login__input" name="email" placeholder="Email" required>
				</div>
				<div class="login__field">
					<i class="login__icon fas fa-lock"></i>
					<input type="password" class="login__input" name="password" placeholder="Password" required>
				</div>
                <input type="submit" class="button login__submit" value="register">
                
                <i class="button__icon fas fa-chevron-right"></i>
				<!-- <button class="button login__submit">
					<span class="button__text">Register</span>
					
				</button> -->				
			</form>
			<div class="social-login">
            <img id='company_logo' src="header_img/header.png" alt="Logo" width="150px">
				<div class="social-icons">
					<a href="#" class="social-login__icon fab fa-instagram"></a>
					<a href="#" class="social-login__icon fab fa-facebook"></a>
					<a href="#" class="social-login__icon fab fa-twitter"></a>
				</div>
			</div>
		</div>
		<div class="screen__background">
			<span class="screen__background__shape screen__background__shape4"></span>
			<span class="screen__background__shape screen__background__shape3"></span>		
			<span class="screen__background__shape screen__background__shape2"></span>
			<span class="screen__background__shape screen__background__shape1"></span>
		</div>		
	</div>
</div>
        <!-- <h1>register</h1>
        <form action="register.php" method="post">
            <label for="uname">User name</label>
            <input type="text" name="uname" placeholder="User Name" required><br>
            <label for="password">Password</label>
            <input type="password" name="password" placeholder="Password" required><br>
            <label for="email">Email</label>
            <input type="email" name="email" placeholder="Email" required><br>
            <input type="submit" value="register">
        </form> -->
    </body>
</html>
<?php
$DATABASE_HOST = 'localhost';
$DATABASE_USER = 'root';
$DATABASE_PASS = '';
$DATABASE_NAME = 'movie';///database name >>>>>>>

$con = mysqli_connect($DATABASE_HOST,$DATABASE_USER,$DATABASE_PASS,$DATABASE_NAME);

if(mysqli_connect_error()){
    exit('Error connecting to the database' . mysqli_connect_error());
}
if(!isset($_POST['uname'],$_POST['password'],$_POST['email'])){
    exit('empty field(s)');
}
if(empty($_POST['uname'] || empty($_POST['password']) || empty($_POST['email']))){
    exit('values Empty');
}
if($stmt = $con->prepare('SELECT id, password From users WHERE user_name = ?')){
    $stmt->bind_param('s', $_POST['uname']);
    $stmt->execute();
    $stmt->store_result();

    if($stmt->num_rows>0){
        echo 'username already exists. try again';
    }
    else{
        if($stmt = $con->prepare('INSERT INTO users (user_name, password, email) VALUES (?, ?, ?)')){
            $password =$_POST['password'];
            $stmt->bind_param('sss', $_POST['uname'], $password, $_POST['email']);
            $stmt->execute();
            echo 'succesfully registered';
            header("location: index.php"); //<<<<<<<---------- ال home هناااا
        }
        else{
            echo 'Error Occurred';
        }
        $stmt->close();
    }
}
else{
    echo 'Error Occurred';
}
$con->close();
?>