<?php
require 'session.php';
if(!($_SESSION['login']==true))
{
	header("location:http://localhost/library/");
}


    $cn=mysqli_connect("localhost","root","","library");

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="books.css">
    <title>Document</title>
</head>
<style>
        ::-webkit-scrollbar {
            display: none;
        }
        body{
            overflow-x:hidden;
        }
</style>
<body>
<div id="container" style='z-index:1;position:absolute;'>
<a href='home1.php'><img src="img/back.png" style="height:35px;width:35px;color:white;margin-left:1270px;"></a>
 <form method="post" action="">
    <?php
        $show_book=$_GET['cat_name'];


            echo "<div id='$show_book'>";
            echo "<span class='title'>$show_book</span><span style='margin-left:90%'></span><hr>";
            $book=mysqli_query($cn,"select * from book_info where c_name='$show_book'");
                
                while($bookdata=mysqli_fetch_row($book))
                {
                    $link='user_book_request.php?book_id='.$bookdata[0].'&cat_name='.$bookdata[3];
                    echo "<table id='$bookdata[1]' style='padding:10px;width:400px;height:400px;float:left;'>";
                    echo "<tr><td height='60%' colspan='2' align='center'><a href='$link'><img src='$bookdata[5]' height='300px' width='200px'></a></td></tr>";
                    echo "<tr><td valign='top' align='center'><span style='font-size: 20px;letter-spacing: 0.1em;'>$bookdata[1]</span></td></tr></table>";
                }
            echo "</div>";

    ?>
 </form>
</div>
</body>
</html>