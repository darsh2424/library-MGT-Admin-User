<?php
require 'session.php';
if(!($_SESSION['login']==true))
{
	header("location:http://localhost/library/");
    
}
if($_SESSION['name']=='admin')
{
    echo "<div class='alert'><a href='' style='text-decoration:none;color:white;'>";
    echo "<span class='closebtn' onclick='close();'>&times;</span>";  
    echo "<strong>Warning!</strong> Your Cant Request From Admin ID!!";
    echo "</a></div>";
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

    <style>
        body{
            overflow-x:hidden;
        }
          #form-data{
            border:none;
            border-spacing:30px;
            /* width:500px; */
            /* background-color:#003aba; */
            font-size:1.2rem;
            /* border-radius:5px; */
            font-family:ebrima;
         }
         
         #form-data td{
            border:none;
            cursor: default;
         }

         #form-data td input[type='text']{
            border:none;
            font-size:1.2rem;
            font-family:ebrima;
            cursor: default;
            background:none;
            /* background-color:#003aba; */
         }

                  

        .btn-req{
            margin-left:90%;
            height:45px;
            width:100px;
            font-size:1rem;
            margin-bottom:10px;
            border:none;
            cursor:pointer;
            background-color: #d12935;
            color: white;
        }
        .btn-req:hover{
            
            background-color:white;
            color:black;
        }
        .alert{
        padding: 20px;
        background-color: #f44336;
        color: white;
        opacity: 1;
        transition: opacity 0.6s;
        margin-bottom: 15px;
        z-index:2;
        margin:0px 0px;
        width:1265px;
        animation-name:alert;
        animation-duration: 2s;
        }
        @keyframes alert {
            from{opacity:0;}
            to:{opacity:1;}
        }
        
        .alert.success {background-color: #04AA6D;}


        .closebtn {
        margin-left: 15px;
        color: white;
        font-weight: bold;
        float: right;
        font-size: 22px;
        line-height: 20px;
        cursor: pointer;
        transition: 0.3s;
        }

        .closebtn:hover{
        color: black;
        }

        ::-webkit-scrollbar {
            display: none;
        }

    </style>
</head>
<body>
    <!-- Book REQUEST  -->
    <?php
            if(isset($_POST['request']))
            {
                $req_book_date=date('Y-m-d');

                $enroll=$_SESSION['enroll'];
                $username=$_SESSION['name'];
                $bid=$_POST['book_id'];
                $bname=$_POST['book_name'];
                $book_cat=$_POST['book_cat'];
                $bauthor=$_POST['book_author'];

                $rows=mysqli_num_rows(mysqli_query($cn,"select * from book_request where enroll=$enroll and book_id=$bid"));
                if($rows>1)
                {
                    echo "<div class='alert'><a href='' style='text-decoration:none;color:white;'>";
                    echo "<span class='closebtn' onclick='close();'>&times;</span>";  
                    echo "<strong>Warning!</strong> You Can Request Same Book Only Two Times!! Wait Untill Admin Respond!!";
                    echo "</a></div>";
                }
                else
                {
                    $request=mysqli_query($cn,"insert into book_request(enroll,username,book_id,book_name,c_name,book_author,book_req_date) values($enroll,'$username',$bid,'$bname','$book_cat','$bauthor','$req_book_date')");
                    
                    $add_data=mysqli_fetch_row(mysqli_query($cn,"select * from book_info where book_id=$bid"));
                    $c_name=$add_data[3];
                    $add_cat=mysqli_fetch_row(mysqli_query($cn,"select * from book_category where c_name='$c_name'"));
                    $req_book_cnt=$add_cat[3];
                    $req_book_cnt=$req_book_cnt+1;
                    $update_cat=mysqli_query($cn,"update book_category set most_req_book=$req_book_cnt where c_name='$c_name'");



                    $book_req=mysqli_fetch_row(mysqli_query($cn,"select most_req_book from book_info where book_id=$bid"));
                    $cnt=$book_req[0];
                    $cnt=$cnt+1;
                    $update_req_cnt=mysqli_query($cn,"update book_info set most_req_book=$cnt where book_id=$bid");
                    



                    $row=mysqli_fetch_assoc(mysqli_query($cn,"select * from profile where enroll=$enroll"));
                    $cnt=$row['pending_request_books'];
                    $cnt=$cnt+1;

                    $update=mysqli_query($cn,"update profile set pending_request_books=$cnt where enroll=$enroll");
                  if($request and $update )
                    {
                        
                        echo "<div class='alert success'><a href='' style='text-decoration:none;color:white;'>";
                        echo "<span class='closebtn' onclick='close();'>&times;</span>";  
                        echo "<strong>Success!</strong> Book Requested Successfully..";
                        echo "</a></div>";
                       // echo "<script>window.alert('Book Requested Successfully..')</script>";
                    }
                }


            }
    ?>
<div class='content' style='z-index:1;position:absolute'>
<?php

if($cn)
{
    $form_data=$_GET['book_id'];
    $book_form_data=mysqli_query($cn,"select * from book_info where book_id='$form_data'");
    $book_row=mysqli_fetch_row($book_form_data);
 
    $bookcopy=$book_row[6];
    $location='book_list.php?cat_name='.$book_row[3]; 
    echo "<a href='$location'><img src='img/back.png' style='height:35px;width:35px;color:white;margin-left:1270px;'></a>";   
    echo "<h1 align='center'>Request Book</h1>";           
    echo "<img src='$book_row[5]' width='300' height='400' align='left' style='padding:0px 10px;'>";
    echo "<table border='1' id='form-data'>";
    echo "<form method='post' action=''>";


    
    echo "<tr><td align='center'>Book Name:</td>";
    echo "<td><input type='text' name='book_name' value='$book_row[1]' readonly></td></tr>";
    echo "<tr><td align='center'>Book Author:</td>";
    echo "<td><input type='text' name='book_author' value='$book_row[2]' readonly></td></tr>";
    echo "<tr><td align='center'>Publication Year:</td>";
    echo "<td><input type='text' name='book_pub_year' value='$book_row[4]' readonly></td></tr>";
    echo "<tr><td align='center'>Category:</td>";
    echo "<td><input type='text' name='book_cat' value='$book_row[3]' readonly></td></tr>";
    echo "<tr><td align='center'>Price:</td>";
    echo "<td><input type='text' name='book_cat' value='$book_row[7]' readonly></td></tr>";
    if($bookcopy==0)
    {
        echo "<tr><td align='center'>Copies:</td>";
        echo "<td><input type='text' name='book_copy' value='Not Available Now' readonly></td></tr>";
    }
    else
    {
        echo "<tr><td align='center'>Copies:</td>";
        echo "<td><input type='text' name='book_copy' value='$bookcopy' readonly></td></tr>";
        echo "<tr><td colspan='2'><button name='request' class='btn-req'>REQUEST</button></td></tr>";
    }

    echo "<tr style='visibility:hidden;'><td><input type='text' name='book_id' value='$book_row[0]' readonly><input type='text' name='book_cat' value='$book_row[3]' readonly></td></tr>";
    

    
    echo "</table>";
    echo "</form>";
}
?>

    <?php
        $show_book=$_GET['cat_name'];
            echo "<div id='$show_book' style='margin-top:20px;'>";
            echo "<span class='title'>$show_book</span><span style='margin-left:90%'></span><hr>";
            $book=mysqli_query($cn,"select * from book_info where c_name='$show_book'");
                
                while($bookdata=mysqli_fetch_row($book))
                {
                    if(!($bookdata[0]==$form_data))
                    {
                        $link='user_book_request.php?book_id='.$bookdata[0].'&cat_name='.$bookdata[3];
                        echo "<table id='$bookdata[1]' style='padding:10px;width:400px;height:400px;float:left;'>";
                        echo "<tr><td height='60%' colspan='2' align='center'><a href='$link'><img src='$bookdata[5]' height='300px' width='200px'></a></td></tr>";
                        echo "<tr><td valign='top' align='center'><span style='font-size: 20px;letter-spacing: 0.1em;'>$bookdata[1]</span></td></tr></table>";
                    }

                }
            echo "</div>";

    ?>
</div>

</body>
</html>