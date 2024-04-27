<?php
require 'assets/session.php';
if($_SESSION['name']=='admin' || (!($_SESSION['login']==true)))
{
	header("location:http://localhost/library/");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>

    <link rel="icon" href="assets/img/books.png" type="image/x-icon">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HACKATHON</title>
    <link rel="stylesheet" href="style.css" type="text/css">
    <style>

        /* ::-webkit-scrollbar {
            display: none;
        } */
        .user-data td{
            padding:5px;
        }
        .profile:hover{
                text-decoration:underline;
                color:black;
        }
.footer{
   background-color:  #003aba;
   position: fixed;
   bottom: 0; left:0; right:0;
   border-top: var(--border);
   text-align: center;
   font-size: 1rem;
   color:white;
   padding:1rem;
}

.footer a{
   color:white;
 text-decoration:underline;
}
    </style>
    <script>
            function fun()
            {
                document.getElementById('user-card').style="visiblity:visible;position:absolute;z-index:2;margin-top:-10%;margin-left:70%;border-radius:15px;width:450px;padding:10px;background-color:#003aba;color:white;";
            }
            function fun1()
            {
                // location.reload();
                document.getElementById('user-card').style="visiblity:hidden;position:absolute;z-index:2;margin-left:150%;border:1px solid black;width:450px;padding:10px;";
            }           
    </script>
</head>
<body style="overflow-x:hidden;">
    <script src="https://kit.fontawesome.com/b99e675b6e.js"></script>

<div class="wrapper">
    <div class="sidebar">
        <h2>User<br> Library</h2>
        <ul>
            <li><a href="http://localhost/library/assets/home1.php" target="content-display"><i class="fas fa-book"></i>Library</a></li>
            <li><a href="http://localhost/library/assets/profile.php" target="content-display"><i class="fas fa-user"></i>Profile</a></li>
            <li><a href="http://localhost/library/assets/account.php" target="content-display"><i class="fas fa-address-card"></i>Account</a></li>
            <li><a href="http://localhost/library/assets/return_request_user.php" target="content-display"><i class="fas fa-backward"></i>Return Book</a></li>
            <li><a href="http://localhost/library/assets/ebook_home.php" target="content-display"><i class="fas fa-book"></i>Ebook</a></li>
            <li><a href="http://localhost/library/assets/podcast.php" target="content-display"><i class="fas fa-podcast"></i>Podcast</a></li>   
            <li><a href="http://localhost/library/assets/audiobook.php" target="content-display"><i class="fas fa-headphones"></i>AudioBook</a></li>      
        </ul> 
        <div class="social_media">
          <a href="https://www.facebook.com/CVMUniversity/"><i class="fab fa-facebook-f"></i></a>
          <a href="https://www.cvmu.edu.in/"><i class="fas fa-globe"></i></i></a>
          <a href="https://instagram.com/cvmu.university?igshid=YmMyMTA2M2Y="><i class="fab fa-instagram"></i></a>
      </div>
    </div>  
    <div class="main_content">
        <div class="header" style="width:1400px;">Welcome!! <?php echo $_SESSION["name"] ?> Have a nice day.

            
                <table class="profile" style="margin-left:85%;margin-top:-18px;letter-spacing: 0.9px;cursor:pointer;"> 
                <tr>
                
                    <td><a onclick="fun();"><i class="fas fa-user"></a></td>
                    <td><a onclick="fun();"><?php echo $_SESSION["name"] ?></a></td>
                </tr>

            </table>

        </div> 

        <iframe src="http://localhost/library/assets/home1.php" height="700%" width="1400px" style="overflow:scroll" name="content-display">
        </iframe>
    </div>
</div>
<div id="user-card" class="user-card" style="visibility:hidden;">
                <?php
                     $cn=mysqli_connect("localhost","root","","library");
                    if($cn)
                    {
                        $name=$_SESSION["name"];
                        $qry=mysqli_query($cn,"select * from login where username='$name'");
                        $data=mysqli_fetch_assoc($qry);
                        $enroll=$data['enroll'];
                        $username=$data['username'];
                    }
                    else
                    {
                        echo "<script>alert('Server Not Responding...............')</script>";
                    }
                ?> 
        <table>
            <tr>
                <td style="font-size:1.3rem;">User Profile</td><td colspan="2" align="right"><a href="assets/logout.php"><img src="assets/img/log-out.png" style="height:35px;width:35px;color:white;"></a>&nbsp;&nbsp;&nbsp;<img src="assets/img/x-button.png" onclick="fun1();" style="height:35px;width:35px;color:white;cursor:pointer;"></td>
            </tr>
            <tr>
                <td><img src="assets/img/user.png" width="100" height="100"></td>
                   <td> <table class="user-data" width="300px" style="padding:10px;">
                            <tr>
                                <td width="40%">Enroll. No. :</td>
                                <td><?php echo $enroll; ?></td>
                            </tr>
                            <tr>
                                <td>Username:</td>
                                <td><?php echo $username; ?></td>
                            </tr>
                        </table> 
                    </td> 
            </tr>
            <!-- <tr>
                <td align="right" colspan="2"><a href="/assets/logout.php"><img src="log-out.png" style="height:35px;width:35px;color:white;"></a></td>
            </tr> -->
        </table>
</div>
<footer class="footer">
  	Developed By <a href='https://www.linkedin.com/in/utkarshrajputt/'>Utkarsh Rajput</a> | <a href='https://www.linkedin.com/in/darshparikh11/'>Darsh Parikh</a> | <a href='https://www.linkedin.com/in/diya-patel-1aa182239/'>Diya Patel</a> | Aman  
</footer>
</body>
</html>