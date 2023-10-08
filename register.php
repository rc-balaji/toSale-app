<?php
require_once "dbconnection.php";
require_once "session.php";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {

    $fullname = $_POST['name'];
    $phn = $_POST['ph'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    if($password==$confirm_password){

    $qry = "INSERT INTO `users` (`email`, `name`, `pnumber`) VALUES ('$email', '$fullname', '$phn')";
    $run = mysqli_query($dbcon,$qry);
    
    if($run==true){

        $psqry = "INSERT INTO `login` (`email`, `password`, `u_id`) VALUES ('$email', '$password',LAST_INSERT_ID() )";
        $psrun = mysqli_query($dbcon,$psqry);
        ?>  <script>
            alert('Registration Successfully :)'); 
            window.open('index.php','_self');
            </script>
        <?php
    }
    }else{
        ?>  <script>
            alert('Password mismatched!!'); 
            </script>
        <?php
    }

}   
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Sign Up</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
        <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap');
*
{
	margin: 0;
	padding: 0;
	box-sizing: border-box;
  font-family: 'Poppins', sans-serif;
  color: white;
}
body 
{
	display: flex;
	justify-content: center;
	align-items: center;
	min-height: 100vh;
	flex-direction: column;
	background-image: url("bg.png");
            background-repeat: no-repeat;
            background-size: cover;
}
.box 
{
	position: relative;
	width: 380px;
	height: 420px;
	background: #1c1c1c;
	border-radius: 8px;
	overflow: hidden;
}
/* .box::before 
{
	content: '';
	z-index: 1;
	position: absolute;
	top: -50%;
	left: -50%;
	width: 380px;
	height: 420px;
	transform-origin: bottom right;
	background: linear-gradient(0deg,transparent,#45f3ff,#45f3ff);
	animation: animate 6s linear infinite;
}
.box::after 
{
	content: '';
	z-index: 1;
	position: absolute;
	top: -50%;
	left: -50%;
	width: 380px;
	height: 420px;
	transform-origin: bottom right;
	background: linear-gradient(0deg,transparent,#45f3ff,#45f3ff);
	animation: animate 6s linear infinite;
	animation-delay: -3s;
} */
@keyframes animate 
{
	0%
	{
		transform: rotate(0deg);
	}
	100%
	{
		transform: rotate(360deg);
	}
}
form 
{
	position: absolute;
	inset: 2px;
	background: #28292d;
	padding: 50px 40px;
	border-radius: 8px;
	z-index: 2;
	display: flex;
	flex-direction: column;
}
h2 
{
	color: #45f3ff;
	font-weight: 500;
	text-align: center;
	letter-spacing: 0.1em;
}
.inputBox 
{
	position: relative;
	width: 300px;
	margin-top: 35px;
}
.inputBox input 
{
	position: relative;
	width: 100%;
	padding: 20px 10px 10px;
	background: transparent;
	outline: none;
	box-shadow: none;
	border: none;
	color: #23242a;
	font-size: 1em;
	letter-spacing: 0.05em;
	transition: 0.5s;
	z-index: 10;
}
.inputBox span 
{
	position: absolute;
	left: 0;
	padding: 20px 0px 10px;
	pointer-events: none;
	font-size: 1em;
	color: #8f8f8f;
	letter-spacing: 0.05em;
	transition: 0.5s;
}
.inputBox input:valid ~ span,
.inputBox input:focus ~ span 
{
	color: #45f3ff;
	transform: translateX(0px) translateY(-34px);
	font-size: 0.75em;
}
.inputBox i 
{
	position: absolute;
	left: 0;
	bottom: 0;
	width: 100%;
	height: 2px;
	background: #45f3ff;
	border-radius: 4px;
	overflow: hidden;
	transition: 0.5s;
	pointer-events: none;
	z-index: 9;
}
.inputBox input:valid ~ i,
.inputBox input:focus ~ i 
{
	height: 44px;
}
.links 
{
	display: flex;
	justify-content: space-between;
}
.links a 
{
	margin: 10px 0;
	font-size: 0.75em;
	color: #8f8f8f;
	text-decoration: beige;
}
.links a:hover, 
.links a:nth-child(2)
{
	color: #45f3ff;
}
input[type="submit"]
{
	border: none;
	outline: none;
	padding: 11px;
	background: #45f3ff;
	cursor: pointer;
	border-radius: 4px;
	font-weight: 600;
	width: 100px;
	margin-top: 10px;
    
}
input[type="submit"]:active 
{
	opacity: 0.8;
}
h1{
	color: #45f3ff; 
	margin-bottom: 30px;
} 
    </style>
    </head>
    <body><br>
        <div style="height:700px;width:800px " class="box">
        
                    
                      <?php echo $success; ?>
                    <?php echo $error; ?> 
                    <form action="" method="post">
                    <h2 >Enter the details given below </h2>
                        <div class="form-group">
                            <label>Full Name</label>
                            <input type="text" name="name" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Phone Num.</label>
                            <input type="number" name="ph" class="form-control" required>
                        </div>    
                        <div class="form-group">
                            <label>Email Address</label>
                            <input type="email" name="email" class="form-control" required />
                        </div>    
                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" name="password" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Confirm Password</label>
                            <input type="password" name="confirm_password" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <input type="submit" name="submit"  value="Register">
                        </div>
                        <p>Already have an account? <a href="index.php" style="color: red;">Login here</a>.</p>
                    </form>
                </div>
            </div>
            </div>    
    </body>
</html>