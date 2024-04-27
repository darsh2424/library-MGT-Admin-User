<?php
    require 'assets/session.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Library</title>
 
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;600&display=swap" rel="stylesheet">
    <!--Stylesheet-->
    <style media="screen">
      *,
*:before,
*:after{
    padding: 0;
    margin: 0;
    box-sizing: border-box;
}
body{
    /* background-color: rgb(67, 192, 223); */
    background: url('assets/img/canva1.jpg');
    background-repeat: no-repeat;
    background-attachment: fixed;
    background-size: cover;
}
.log-user{
    margin-left:125px;
    margin-top:-28px;
}

.background{
    width: 430px;
    height: 520px;
    position: absolute;
    transform: translate(-50%,-50%);
    left: 50%;
    top: 50%;
}
.background .shape{
    height: 200px;
    width: 200px;
    position: absolute;
    border-radius: 50%;
}
form{
    height: 520px;
    width: 400px;
    background-color: rgba(255,255,255,0.13);
    position: absolute;
    transform: translate(-50%,-50%);
    top: 50%;
    left: 75%;
    border-radius: 20px;
    /* backdrop-filter: blur(5px); */
    border: 2px solid rgba(255,255,255,0.1);
    box-shadow: 0 0 40px rgba(8,7,16,0.6);
    padding: 50px 35px;
}
form *{
    font-family: 'Poppins',sans-serif;
    color: #ffffff;
    letter-spacing: 0.5px;
    outline: none;
    border: none;
}
form h3{
    font-size: 32px;
    font-weight: 500;
    line-height: 42px;
    text-align: center;
}

label{
    display: block;
    margin-top: 30px;
    font-size: 16px;
    font-weight: 500;
    color: black;
}
input{
    color: black;
    display: block;
    height: 50px;
    width: 100%;
    background-color: rgba(255,255,255,0.07);
    border-radius: 3px;
    padding: 0 10px;
    margin-top: 8px;
    font-size: 14px;
    font-weight: 500;
    border: 1px solid #004AAD;
}
::placeholder{
    color: #004AAD;
}
button{
    margin-top: 50px;
    width: 60%;
    background-color: #004AAD;
    color: white;
    padding: 15px 0;
    font-size: 18px;
    font-weight: 600;
    border-radius: 5px;
    cursor: pointer;
    border: 1px solid #004AAD;
}
button:hover{
    background-color: #FF5A5A;
    color: white;
}
button:focus{
    background-color: #FF5A5A;
    color: white;
}
h1{
    color: white;
}

.cvmu{
    margin-left:300px;
    margin-top:50px;
}

    </style>
</head>

<body>
    <!-- <img src="assets/img/cvmu.png" class="cvmu"> -->
    <table style="margin-left:15%;margin-top:5%;border-spacing:5px;border:1px solid black;">
        <tr>
            <td colspan="2"><h3>Demo User Credentials</h3></td>
        </tr>
        <tr>
            <td>Username-2021001407</td>
            <td> | Password-12345</td>
        </tr>
        <tr>
            <td colspan="2"><h3>Demo Admin Credentials</h3></td>
        </tr>
        <tr>
            <td>Username-admin</td>
            <td> | Password-admin</td>
        </tr>
    </table>

<?php

	if(isset($_POST['login']))
	{
		$username=$_POST['username'];
		$password=$_POST['password'];
		
		$cn=mysqli_connect("localhost","root","","library");
		if($cn)
		{
			$check=mysqli_query($cn,"select * from login where enroll='$username'");
			$check_row=mysqli_num_rows($check);
			$match=mysqli_fetch_assoc($check);
			if($check_row==0)
			{
				echo "<script>alert('username or email does not exist');</script>";
			}	
			else
			{
				if($password!=$match["password"])
				{
					echo "<script>alert('Wrong Password!!');</script>";
				}
				else
				{
                    if($username=='admin')
                    {
                        $_SESSION["login"]=true;
                        $_SESSION["enroll"]=$match["enroll"];
                        $_SESSION["name"]=$match["username"];
                        header("location:http://localhost/library/admin.php");
                    }
                    else
                    {
                        $_SESSION["login"]=true;
                        $_SESSION["enroll"]=$match["enroll"];
                        $_SESSION["name"]=$match["username"];
                        header("location:http://localhost/library/dashboard.php");            
                    }

					// $_SESSION["login"]=true;
					// $_SESSION["auth"]=$match["auth"];
					// $_SESSION["name"]=$match["username"];
					// header("location:http://localhost/library/dashboard.html");
				}
               
			}
		}
		else
		{
			echo "<script>alert('Error in Connection to server!!');</script>";
		}

	}
?>

    <div class="background">
        <div class="shape"></div>
        <div class="shape"></div>
    </div>
    <form method="post" action="">
    <img class="log-user" src="assets/img/reading-book.png" width="70" height="70">
        <h3 style="color:#004AAD;font-family: 'Roboto', sans-serif;font-weight:500;font-size:2.5rem;">Welcome</h3>

        <label for="username">ID</label>
        <input type="text" placeholder="Your ID here.." id="username" name="username">

        <label for="password">Password</label>
        <input type="password" placeholder="Your password here.." id="password" name="password">

        <center><button type="submit" name="login">Log In</button></center>
        
    </form>
</body>
</html>
