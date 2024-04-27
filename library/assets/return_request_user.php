<?php
require 'session.php';
if(!($_SESSION['login']==true))
{
	header("location:http://localhost/library/");
}
    $cn=mysqli_connect('localhost','root','','library');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel='stylesheet' href='books.css' type='text/css'>
    <style>
        
        .req_table{
            padding:50px;
        }
        .req_table table{
            /* background-color:gray; */
            /* border-spacing:5px; */
            margin-left:-40px;
            box-shadow: rgba(0, 0, 0, 0.25) 0px 54px 55px, rgba(0, 0, 0, 0.12) 0px -12px 30px, rgba(0, 0, 0, 0.12) 0px 4px 6px, rgba(0, 0, 0, 0.17) 0px 12px 13px, rgba(0, 0, 0, 0.09) 0px -3px 5px;
            border:none;

        }
        .req_table table td{
            padding:10px;
            /* box-shadow: rgba(0, 0, 0, 0.45) 0px 25px 20px -20px; */
            border:none;
            border-right:1px solid black;
            font-size:1.2rem;
            font-weight:500;
            font-family:ebrima;
            /* align-items:center; */
        }
        .req_table .req_tr td{
            border-bottom:1px solid black;
            font-size:1.1rem;
            font-weight:600;
            font-family:ebrima;
            background: #003aba;
            color:white;
        }
        .req_table table button{
            border:none;
            height:45px;
            width:90px;
            background: #90EE90;
            font-weight:600;
            border-radius:5px;
            box-shadow: rgb(38, 57, 77) 0px 20px 40px -10px;
            transition: transform 0.5s;
        }
        .req_table table button:hover{
            background: #FF5A5A;
            color:white;
            /* transition: all 0.5s ease-out; */
            transform: translateY(5px);
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

        
    </style>
    <title>Document</title>
</head>
<body>
<?php
        if(isset($_POST['request']))
        {
            $req_id=$_POST['request'];
            $req_date=date('Y-m-d');

            $check=mysqli_num_rows(mysqli_query($cn,"select * from return_book where req_id=$req_id"));
            if($check>0)
            {
                echo "<div class='alert'><a href='' style='text-decoration:none;color:white;'>";
                echo "<span class='closebtn' onclick='close();'>&times;</span>";  
                echo "<strong>Warning!</strong> Your Book Return Request Is Already Submitted!! Wait Untill Admin Accept It!!";
                echo "</a></div>";
                // echo "<script>alert('Your Book Return Request Is Already Submitted!! Wait Untill Admin Accept It!!');</script>";
            }
            else
            {
                $result=mysqli_query($cn,"select * from issue_book where req_id=$req_id");
                $data=mysqli_fetch_row($result);
                
                //echo $data[0].$data[1].$data[2].$data[3].$data[4].$data[5].$data[6].$req_date;
                $insert=mysqli_query($cn,"insert into return_book values($data[0],$data[1],'$data[2]',$data[3],'$data[4]','$data[5]','$data[6]','$req_date',NULL)");

                if($insert)
                {
                    $enroll=$_SESSION['enroll'];
                    $update_pen_return=mysqli_fetch_assoc(mysqli_query($cn,"select * from profile where enroll=$enroll"));
                    $cnt=$update_pen_return['pending_returned_books'];
                    $cnt=$cnt+1;

                    $update_cnt=mysqli_query($cn,"update profile set pending_returned_books=$cnt where enroll=$enroll");
                    if($update_cnt)
                    {   
                        echo "<div class='alert success'><a href='' style='text-decoration:none;color:white;'>";
                        echo "<span class='closebtn' onclick='close();'>&times;</span>";  
                        echo "<strong>Success!</strong> Book Requested Successfully..";
                        echo "</a></div>";
                        // echo "<script>alert('Book Return Request Submitted!!');</script>";
                    }
                }
            }
        }
    ?>

    <?php 
                $enroll=$_SESSION['enroll'];
                $issue_book=mysqli_num_rows(mysqli_query($cn,"select * from issue_book where enroll=$enroll"));
                if($issue_book>0)
                {
                    echo "<form class='req_table' method='post' action=''>";
                    echo "<div class='title' style='margin-left:480px;'>Return Books</div><br>";
                    echo "<table><tr class='req_tr' ><td>Reqest<br> ID</td><td>Category Name</td><td>Book<br> ID</td><td>Book Name</td><td>Book Author</td><td>Issued Date</td><td>Expected<br>Returned Date</td><td>Late Return <br>Fine</td><td style='border:none;'>Return</td></tr>";
                    $result=mysqli_query($cn,"select * from issue_book where enroll=$enroll");
                
                    foreach ($result as $issue_row)
                    {
                        $req_id=$issue_row['req_id'];
                        $fine=mysqli_fetch_assoc(mysqli_query($cn,"select total_fine from fine where req_id=$req_id"));
                        $total_fine=$fine['total_fine'];
                        // echo $total_fine;
                        echo "<tr>";
             ?>
                           <td><?= $issue_row['req_id']; ?></td>
                           <td><?= $issue_row['c_name']; ?></td>
                           <td><?= $issue_row['book_id']; ?></td>
                           <td><?= $issue_row['book_name']; ?></td>
                           <td><?= $issue_row['book_author']; ?></td>
                           <td><?= $issue_row['issued_date']; ?></td>
                           <td><?= $issue_row['expected_return_date']; ?></td>
                           <?php echo "<td>$total_fine</td>"; ?>
                           <td style='border:none;'><button name='request' value='<?=$req_id?>'>REQUEST</button></td>
        
        
            <?php
                        echo "</tr>";
                    }  
                    echo "</table></form";
                    echo "<hr>";
                }
                else
                {
                    echo "<div class='title'>Return Books</div><br>";
                    echo "<div style='width:100%;height:100px;background-color:#EEFFC1;position:fixed;'><p style='margin-left:80px;margin-top:30px;'>------ NO Issued Books --------</p></div>";
                    echo "<br><br><br><br><br><br><hr>";
                }
    ?>

 
</body>
</html>