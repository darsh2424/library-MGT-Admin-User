<?php
require 'session.php';
if(!($_SESSION['login']==true))
{
	header("location:http://localhost/library/");
}
    // $enroll=$_SESSION['enroll'];
    $cn=mysqli_connect("localhost","root","","library");


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="books.css">
    <!-- <meta http-equiv="refresh" content="3"> -->
    <style>
        <?php
            if(!(isset($_GET['full'])))
            {
                echo "body{overflow-y:hidden}";

            }
        ?>

        .req_table{
            padding:0px 70px;
        }
        .req_table table{
            /* background-color:gray; */
            /* border-spacing:5px; */
            box-shadow: rgba(0, 0, 0, 0.25) 0px 54px 55px, rgba(0, 0, 0, 0.12) 0px -12px 30px, rgba(0, 0, 0, 0.12) 0px 4px 6px, rgba(0, 0, 0, 0.17) 0px 12px 13px, rgba(0, 0, 0, 0.09) 0px -3px 5px;
            border:none;

        }
        .req_table table td{
            padding:20px;
            /* box-shadow: rgba(0, 0, 0, 0.45) 0px 25px 20px -20px; */
            border:none;
            border-right:1px solid black;
            font-size:1rem;
            font-weight:500;
            font-family:ebrima;
            align-items:center;
        }
        .req_table .req_tr td{
            border-bottom:1px solid black;
            font-size:1.1rem;
            font-weight:600;
            font-family:ebrima;
            background: #003aba;
            color:white;
        }
        .req_table table .last_td{
            border-right:none;
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
</head>
<body>
<?php
        if(isset($_POST['accept']))
        {         
            $issue_date=date('Y-m-d');
                $day=date('d');
                $month=date('m');
                $year=date('Y');

                $day=$day+7;
                $expected_return_date_timestamp=mktime(0,0,0,$month,$day,$year);
            
            $expected_return_date=date('Y-m-d',$expected_return_date_timestamp);
            
            $req_id=$_POST['accept'];
            $result=mysqli_query($cn,"select * from book_request where req_id=$req_id");
            $data=mysqli_fetch_row($result);
            
            $insert=mysqli_query($cn,"insert into issue_book values($data[0],$data[1],'$data[2]',$data[3],'$data[4]','$data[5]','$data[6]','$issue_date','$expected_return_date')");

            if($insert)
            {
                $c_name=$data[5];
                $add_cat=mysqli_fetch_row(mysqli_query($cn,"select * from book_category where c_name='$c_name'"));
                $issue_book_cnt=$add_cat[4];
                $issue_book_cnt=$issue_book_cnt+1;
                $update_cat=mysqli_query($cn,"update book_category set most_issue_book=$issue_book_cnt where c_name='$c_name'");


                $curr_date=date('Y-m-d');
                $fine=mysqli_fetch_row(mysqli_query($cn,"select * from issue_book where req_id=$req_id"));
                $fine_insert=mysqli_query($cn,"insert into fine values($fine[1],$fine[0],'$fine[7]','$fine[8]','$curr_date',0)");

                $del=mysqli_query($cn,"delete from book_request where req_id='$req_id'");  
                    $update_copies=mysqli_fetch_assoc(mysqli_query($cn,"select * from book_info where book_id=$data[3]"));
                    $count=$update_copies['copies'];
                    $count=$count-1;

                    $id=mysqli_fetch_row(mysqli_query($cn,"select * from issue_book where req_id=$req_id"));
                    $enroll=$id[1];
                    $update=mysqli_query($cn,"update book_info set copies=$count where book_id='$id[3]'");

                    $row=mysqli_fetch_assoc(mysqli_query($cn,"select * from profile where enroll=$enroll"));
                    $cnt_issue=$row['issued_books'];
                    $cnt_pen=$row['pending_request_books'];

                    $cnt_issue=$cnt_issue+1;
                    $cnt_pen=$cnt_pen-1;

                    $update_profile=mysqli_query($cn,"update profile set pending_request_books=$cnt_pen,issued_books=$cnt_issue where enroll=$enroll");
                if($update and $update_profile)
                {
                    echo "<div class='alert success'><a href='' style='text-decoration:none;color:white;'>";
                    echo "<span class='closebtn' onclick='close();'>&times;</span>";  
                    echo "<strong>Success!</strong> Book Issued....";
                    echo "</a></div>";
                    // echo "<script>alert('Book Issued....');</script>";
                    

                }
                // header('refresh:0');
            }

            
        }
        if(isset($_POST['reject']))
        {
            $req_id=$_POST['reject'];

            $id=mysqli_fetch_row(mysqli_query($cn,"select * from book_request where req_id=$req_id"));
            $enroll=$id[1];

            $del=mysqli_query($cn,"delete from book_request where req_id='$req_id'");
            $row=mysqli_fetch_assoc(mysqli_query($cn,"select * from profile where enroll=$enroll"));
            $cnt_pen=$row['pending_request_books'];

            $cnt_pen=$cnt_pen-1;

            $update_profile=mysqli_query($cn,"update profile set pending_request_books=$cnt_pen where enroll=$enroll");
            if($del and $update_profile)
            {
                echo "<div class='alert'><a href='' style='text-decoration:none;color:white;'>";
                echo "<span class='closebtn' onclick='close();'>&times;</span>";  
                echo "<strong>Warning!</strong> Book Request Denied..";
                echo "</a></div>";
            }  
            // header('refresh:0');
        }

        
    ?>

    <?php
        if($cn)
        {
            echo "<div class='title' style='margin-left:450px;'>Book Requests</div><br><br>";
            $request=mysqli_query($cn,"select * from book_request");
            $row_count=mysqli_num_rows($request);
            if($row_count>0)
            {
                echo "<form method='post' action='' class='req_table'>";
                echo "<table border='1'>";
                echo "<tr class='req_tr' align='center'> <td>Request ID</td><td>Enrollment No.</td><td>Username</td><td>Book ID</td><td>Book Name</td><td>Book Category</td><td>Book Author</td><td>Approval</td><td class='last_td'>Denial</td></tr>";

                $request=mysqli_query($cn,"select * from book_request");

                if($row_count>13)
                {
                    if(isset($_GET['full']))
                    {
                        echo "<a href='http://localhost/library/admin.php'>Click Here...</a>";
                        
                    }
                    else
                    {
                        echo "<div style='padding:20px;margin-left:800px;'>To view all book requests <a href='admin_book_request.php?full=yes' target='_top' onclick='fun();'>Click Here..</a><div>";
                        $request=mysqli_query($cn,"select * from book_request limit 13");
                    }
                }

                while($data=mysqli_fetch_row($request))
                {
                    echo "<tr><td>$data[0]</td><td>$data[1]</td><td>$data[2]</td><td>$data[3]</td><td>$data[4]</td><td>$data[5]</td><td>$data[6]</td><td><button name='accept' value='$data[0]'>Accept</button></td><td class='last_td'><button name='reject' value='$data[0]' style='background: #f44336;'>Reject</button></td></tr>";
                }
                echo "</table></form>";
            }
            else
            {
                echo "<div style='width:100%;height:100px;background-color:#EEFFC1;padding:10px 30px;'><p>------ THERE IS NO REQUESTS --------</p></div>";
            }


        }
        else
        {
            echo "<script>Window.alert('Server Not Responding.....');</script>";
        }
    ?>
 
</body>
</html>