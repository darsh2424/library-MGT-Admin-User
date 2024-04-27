<?php
require 'session.php';
if(!($_SESSION['login']==true))
{
	header("location:http://localhost/library/");
}


    $cn=mysqli_connect("localhost","root","","library");
    // $result=mysqli_query($cn,"select * from book_category");

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="books.css" type="text/css">
    <style>
        td{
            padding:10px;
            /* width:2000px; */
            /* border:1px solid black; */
        }
    </style>
</head>
<body>
    <div class='title'>Results....</div>
    <a href='home1.php'><img src="img/back.png" style="height:35px;width:35px;color:white;margin-left:1270px;"></a>
<?php
    if(isset($_POST['searchbtn']))
    {
        $data=$_POST['search'];
        
        $qry=mysqli_query($cn,"select * from book_info where book_name like '$data%' or book_author like '$data%'");
        $cnt=mysqli_num_rows($qry);

        $qry1=mysqli_query($cn,"select * from ebook_info where ebook_title like '$data%' or ebook_author like '$data%'");
        $cnt1=mysqli_num_rows($qry1);

        if($cnt>0)
        {
         echo "<div class='title'>BOOKS</div>";
        while($bookdata=mysqli_fetch_row($qry))
        {
            $link='user_book_request.php?book_id='.$bookdata[0].'&cat_name='.$bookdata[3];
            echo "<table id='$bookdata[1]' style='padding:10px;width:200px;height:400px;float:left;'>";
            echo "<tr><td height='60%' colspan='2' align='center'><a href='$link'><img src='$bookdata[5]' height='300px' width='200px'></a></td></tr>";
            echo "<tr><td valign='top' align='right'><span style='font-size: 10px;letter-spacing: 0.1em;'>BOOK NAME: </span></td><td valign='top'><span style='font-size: 15px;letter-spacing: 0.1em;'>$bookdata[1]</span></td></tr><td valign='top' align='right'><span style='font-size: 15px;letter-spacing: 0.1em;'>BOOK Author: </span></td><td valign='top'><span style='font-size: 15px;letter-spacing: 0.1em;'>$bookdata[2]</span></td></tr></table>";
        
        }
        }
        if($cnt1>0)
        {
            echo "<br clear='left'><div class='title'>E-BOOKS</div>";
            while($val=mysqli_fetch_assoc($qry1))
            {

                $title=$val['ebook_title'];
                $author=$val['ebook_author'];
                $ebook_img=$val['ebook_img'];
                $link=$val['ebook_path'];
    
                echo "<table  class='cat-table' style='float:left;'>";
                echo "<tr><td class='comic-image'><a href='$link' target='_blank'><img src='$ebook_img' height='100' width='100'></a></td></tr>";
                echo "<tr><td style='text-align:center;padding:0px;font-size:1.2rem;font-family:ebrima;'>$title</tr>";
                // echo "<tr><td>$author</tr>";
                echo "</table>";            
            }
        }

    }

    
?>
</body>
</html>