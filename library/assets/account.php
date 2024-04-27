<?php
require 'session.php';
if(!($_SESSION['login']==true))
{
	header("location:http://localhost/library/");
}
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
        ::-webkit-scrollbar {
            display: none;
        }

        body{
            overflow-x:hidden;
        }
        .req-table{
            padding:20px;
            margin-left:100px;

        }
        .req-table{
            /* background-color:gray; */
            /* border-spacing:5px; */
            box-shadow: rgba(0, 0, 0, 0.25) 0px 54px 55px, rgba(0, 0, 0, 0.12) 0px -12px 30px, rgba(0, 0, 0, 0.12) 0px 4px 6px, rgba(0, 0, 0, 0.17) 0px 12px 13px, rgba(0, 0, 0, 0.09) 0px -3px 5px;
            border:none;

        }
        .req-table  td{
            padding:20px;
            /* box-shadow: rgba(0, 0, 0, 0.45) 0px 25px 20px -20px; */
            border:none;
            border-right:1px solid black;
            font-size:1rem;
            font-weight:500;
            font-family:ebrima;
            align-items:center;
        }
        .req-table .req-tr td{
            border-bottom:1px solid black;
            font-size:1.1rem;
            font-weight:600;
            font-family:ebrima;
            background: #003aba;
            color:white;
        }
        .req-table  .last_td{
            border-right:none;
        }
        .req-table  button{
            border:none;
            height:45px;
            width:90px;
            background: #90EE90;
            font-weight:600;
            border-radius:5px;
            box-shadow: rgb(38, 57, 77) 0px 20px 40px -10px;
            transition: transform 0.5s;
        }
        .req-table button:hover{
            background: #FF5A5A;
            color:white;
            /* transition: all 0.5s ease-out; */
            transform: translateY(5px);
        }
        .title{
            margin-left:20px;
        }
    </style>
</head>
<body>

    <?php
        $cn=mysqli_connect('localhost','root','','library');
        $enroll=$_SESSION['enroll'];
        $username=$_SESSION['name'];
        $row=mysqli_fetch_row(mysqli_query($cn,"select * from profile where enroll=$enroll"));
        $req_book=$row[7];
        $issue_book=$row[8];
        $pen_return_book=$row[9];
        $return_book=$row[10];
    ?>
    <?php
        if($req_book>0)
        {
            
            echo "<div class='title'>Requested Books</div><br>";
            $cnt=mysqli_num_rows(mysqli_query($cn,"select * from book_request where enroll=$enroll"));
            if($cnt>3)
            {
                $link='fullaccount.php?enroll='.$enroll;
                echo "<div style='margin-left:700px;padding:10px;'>You have requested for more than 3 books, <a href='$link' target='_blank'>Click Here...</a> For Full Details</div>";
            }
            echo "<table class='req-table' style='margin-left:10px;width:1250px;'>";
            echo"<tr class='req-tr'><td>Reqest ID</td><td>Category Name</td><td>Book ID</td><td>Book Name</td><td>Book Author</td><td>Requested Date</td></tr>";
            $result=mysqli_query($cn,"select * from book_request where enroll=$enroll order by book_req_date desc limit 3");
            $cnt=mysqli_num_rows(mysqli_query($cn,"select * from book_request where enroll=$enroll"));
            
            foreach ($result as $req_row)
            {
                echo "<tr>";
     ?>
                   <td><?= $req_row['req_id']; ?></td>
                   <td><?= $req_row['c_name']; ?></td>
                   <td><?= $req_row['book_id']; ?></td>
                   <td><?= $req_row['book_name']; ?></td>
                   <td><?= $req_row['book_author']; ?></td>
                   <td><?= $req_row['book_req_date']; ?></td>


    <?php
                echo "</tr>";
            }  
            echo "</table>";
            echo " <br><br>";
        }
        else
        {
            echo "<div class='title'>Requested Books</div><br>";
            echo "<div style='width:100%;height:100px;background-color:#EEFFC1;position:fixed;'><p style='margin-left:80px;margin-top:30px;'>------ NO REQUESTED BOOKS --------</p></div>";
            echo "<br><br><br><br><br><br><hr><br><br>";
        }



        if($issue_book>0)
        {
            echo "<div class='title'>Issued Books</div><br>";

            $cnt=mysqli_num_rows(mysqli_query($cn,"select * from issue_book where enroll=$enroll"));
            if($cnt>3)
            {
                $link='fullaccount.php?enroll='.$enroll;
                echo "<div style='margin-left:700px;padding:10px;'>You have issued more than 3 books, <a href='$link' target='_blank'>Click Here...</a> For Full Details</div>";
            }

            echo "<table class='req-table' style='margin-left:0px;'><tr class='req-tr'><td>Reqest ID</td><td>Category Name</td><td>Book ID</td><td>Book Name</td><td>Book Author</td><td>Issued Date</td><td>Expected Return Date</td></tr>";
            $result=mysqli_query($cn,"select * from issue_book where enroll=$enroll order by issued_date desc limit 3");
        
            foreach ($result as $issue_row)
            {
                echo "<tr>";
     ?>
                   <td><?= $issue_row['req_id']; ?></td>
                   <td><?= $issue_row['c_name']; ?></td>
                   <td><?= $issue_row['book_id']; ?></td>
                   <td><?= $issue_row['book_name']; ?></td>
                   <td><?= $issue_row['book_author']; ?></td>
                   <td><?= $issue_row['issued_date']; ?></td>
                   <td><?= $issue_row['expected_return_date']; ?></td>


    <?php
                echo "</tr>";
            }  
            echo "</table>";
            echo "<br><br><br>";
        }
        else
        {
            echo "<div class='title'>Issued Books</div><br>";
            echo "<div style='width:100%;height:100px;background-color:#EEFFC1;padding:10px 30px;'><p>------ NO Issued Books --------</p></div>";
            echo "<br><br><hr>";
        }




        if($pen_return_book>0)
        {
            echo "<div class='title'>Pending Return Books</div><br>";
            $cnt=mysqli_num_rows(mysqli_query($cn,"select * from return_book where enroll=$enroll and book_return_date is null"));
            if($cnt>3)
            {
                $link='fullaccount.php?enroll='.$enroll;
                echo "<div style='margin-left:700px;padding:10px;'>You have made more than 3 books return request , <a href='$link' target='_blank'>Click Here...</a> For Full Details</div>";
            }
            echo "<table class='req-table' style='margin-left:0px;'><tr class='req-tr'><td>Reqest ID</td><td>Category Name</td><td>Book ID</td><td>Book Name</td><td>Book Author</td><td>Return Request Date</td><td>Actual Returned Date</td></tr>";
            $result=mysqli_query($cn,"select * from return_book where enroll=$enroll and book_return_date is null order by return_request_date desc limit 3");
        
            foreach ($result as $pen_return_row)
            {
                echo "<tr>";
     ?>
                   <td><?= $pen_return_row['req_id']; ?></td>
                   <td><?= $pen_return_row['c_name']; ?></td>
                   <td><?= $pen_return_row['book_id']; ?></td>
                   <td><?= $pen_return_row['book_name']; ?></td>
                   <td><?= $pen_return_row['book_author']; ?></td>
                   <td><?= $pen_return_row['return_request_date']; ?></td>
                   <td align='center'> - </td>
    <?php
                echo "</tr>";
            }  
            echo "</table>";
            echo "<br><br><br>";
        }
        else
        {
            echo "<div class='title'>Pending Return Books</div><br>";
            echo "<div style='width:100%;height:75px;background-color:#EEFFC1;padding:10px 30px;'><p>------ NO Pending Return Books --------</p></div>";
            echo "<br><hr>";
        }



        if($return_book>0)
        {
            echo "<div class='title'>Return Books</div><br>";
            $cnt=mysqli_num_rows(mysqli_query($cn,"select * from return_book where enroll=$enroll and book_return_date is not null"));
            if($cnt>3)
            {
                $link='fullaccount.php?enroll='.$enroll;
                echo "<div style='margin-left:700px;padding:10px;'>You have returned for more than 3 books, <a href='$link' target='_blank'>Click Here...</a> For Full Details</div>";
            }
            echo "<table class='req-table' style='margin-left:0px;'><tr class='req-tr'><td>Reqest ID</td><td>Category Name</td><td>Book ID</td><td>Book Name</td><td>Book Author</td><td>Return Request Date</td><td>Actual Returned Date</td></tr>";
            $result=mysqli_query($cn,"select * from return_book where enroll=$enroll and book_return_date is not null order by book_return_date desc limit 3");
        
            foreach ($result as $return_row)
            {
                echo "<tr>";
     ?>
                   <td><?= $return_row['req_id']; ?></td>
                   <td><?= $return_row['c_name']; ?></td>
                   <td><?= $return_row['book_id']; ?></td>
                   <td><?= $return_row['book_name']; ?></td>
                   <td><?= $return_row['book_author']; ?></td>
                   <td><?= $return_row['return_request_date']; ?></td>
                   <td> <?= $return_row['book_return_date']; ?> </td>
    <?php
                echo "</tr>";
            }  
            echo "</table>";
            echo "";
        }
        else
        {
            echo "<div class='title'>Return Books</div><br>";
            echo "<div style='width:100%;height:100px;background-color:#EEFFC1;padding:10px 30px;'><p>------ NO Returned Books --------</p></div>";
            // echo "<br><br><br><br><br><br><hr>";
        }

    ?>

</body>
</html>