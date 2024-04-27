<?php
require 'assets/session.php';
if(!($_SESSION['login']==true))
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
    <title>ADMIN LIBRARY</title>
    <link rel="stylesheet" href="style.css" type="text/css">
</head>
<body>
<style>
::-webkit-scrollbar {
    display: none;
}
</style>
    <script src="https://kit.fontawesome.com/b99e675b6e.js"></script>

<div class="wrapper">
    <div class="sidebar">
        <h2>Admin<br> LIbrary</h2>
        <ul>
            <li><a href="http://localhost/library/assets/home1.php" target="content-display"><i class="fas fa-book"></i>Library</a></li>
            <li><a href="http://localhost/library/assets/addbook.php" target="content-display"><i class="fas fa-book"></i>Add Book</a></li>
            <li><a href="http://localhost/library/assets/addstud.php" target="content-display"><i class="fas fa-solid fa-user-plus"></i>Add Student</a></li>
            <li><a href="http://localhost/library/assets/admin_book_request.php" target="content-display"><i class="fas fa-backward"></i>Book Requests</a></li>
            <li><a href="http://localhost/library/assets/return_book_admin.php" target="content-display"><i class="fas fa-solid fa-file-import"></i>Return Book <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Request</a></li>
            <li><a href="http://localhost/library/assets/bookreport.php" target="content-display"><i class="fas fa-book"></i>Book Report</a></li>

            <li><a href="http://localhost/library/assets/studreport.php" target="content-display"><i class="fas fa-solid fa-file"></i>Student Report</a></li>
            
            <!-- <li><a href="http://localhost/library/assets/issuereport.php" target="content-display"><i class="fas fa-solid fa-file-export"></i>Issue Report</a></li> -->
        </ul>
        <div class="social_media">
          <a href="https://www.facebook.com/CVMUniversity/"><i class="fab fa-facebook-f"></i></a>
          <a href="https://www.cvmu.edu.in/"><i class="fas fa-globe"></i></i></a>
          <a href="https://instagram.com/cvmu.university?igshid=YmMyMTA2M2Y="><i class="fab fa-instagram"></i></a>
      </div>
    </div>
    <div class="main_content">
        <div class="header">
            Welcome Admin!! Have a nice day.
                <div style="margin-left:97%;margin-top:-18px;">
                    <a href="assets/logout.php"><img src="assets/img/log-out.png" style="height:50px;width:50px;color:white;"></a>
                </div>
        </div>  
        <iframe src="http://localhost/library/assets/home1.php" height="1400px" width="1316px" name="content-display">
        </iframe>
    </div>
</div>
</body>
</html>