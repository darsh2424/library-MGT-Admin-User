<?php
require 'session.php';
if((!($_SESSION['login']==true)) && (!($_SESSION['name']=='admin')))
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
    <style>
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
        .req_table{
            padding:20px 70px;
        }
        .req_table table{
            /* background-color:gray; */
            /* border-spacing:5px; */
            box-shadow: rgba(0, 0, 0, 0.25) 0px 54px 55px, rgba(0, 0, 0, 0.12) 0px -12px 30px, rgba(0, 0, 0, 0.12) 0px 4px 6px, rgba(0, 0, 0, 0.17) 0px 12px 13px, rgba(0, 0, 0, 0.09) 0px -3px 5px;
            border:none;

        }
        .req_table table td{
            padding:10px;
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
        .table{
            /* border:1px solid black; */
            text-align:center;
            font-size:1.4rem;
            padding:30px;
            font-weight:600;
            font-family:ebrima;
            
           
        }
         .table select{
            font-size:1.4rem;
            background:#b3b5ba;
            font-weight:400;
            font-family:ebrima;
            
        }
        .table select:focus{
            box-shadow: 5px 5px #888888;
        }
        .table button{
            border:none;
            height:45px;
            width:100px;
            background: #003aba;
            color:white;
            font-weight:600;
            border-radius:5px;
            box-shadow: rgb(38, 57, 77) 0px 20px 40px -10px;
            transition: transform 0.5s;
        }
        .table button:hover{
            background: #90EE90;
            color:black;
            /* transition: all 0.5s ease-out; */
            transform: translateX(15px);
        }
    </style>
</head>
<body>

    <div class='main'>
    <div class='title'>Student Report</div><hr>

        <form method='post' action='' class='table'>
        Select College:
        <select name='college'>
            <?php
                echo "<option disabled hidden selected>--SELECTED ANY--</option>";
                $result=mysqli_query($cn,'select distinct(college) from profile');
                while($row=mysqli_fetch_row($result))
                {
                    echo "<option>$row[0]</option>";
                }
            ?>
        </select>
        Select Class:
        <select name='class'>
            <?php
                echo "<option disabled hidden selected>--SELECTED ANY--</option>";
                $result=mysqli_query($cn,'select distinct(class) from profile');
                while($row=mysqli_fetch_row($result))
                {
                    echo "<option>$row[0]</option>";
                }
            ?>
        </select>
        <button name='submit'>SUBMIT</button>
        </form>
    </div>
    <?php
    if(isset($_POST['submit']))
    {
        // $college=$_POST['college'];
        // $class=$_POST['class'];
        if( (isset($_POST['college'])) && (!(isset($_POST['class']))) )
        {
            $college=$_POST['college'];
            // echo $college;
            $count=mysqli_num_rows(mysqli_query($cn,"select * from profile where college='$college'"));
            if($count>0)
            {
                echo "<form method='post' action='' class='req_table'>";
                echo "<table border='1'>";
                echo "<tr class='req_tr' align='center'> <td>Library ID</td><td>Student Name</td><td>Enrollment No. </td><td>CLASS</td><td>College</td><td>Requested Book</td><td>Issued Book</td><td>Return Request Book</td><td>Returned Books</td></tr>";
                $qry=mysqli_query($cn,"select * from profile where college='$college'");
                while($data=mysqli_fetch_row($qry))
                {
                    echo "<tr><td>$data[0]</td><td>$data[1]</td><td>$data[2]</td><td>$data[4]</td><td>$data[6]</td><td>$data[7]</td><td>$data[8]</td><td>$data[9]</td><td>$data[10]</td></tr>";
                }
                echo "</table></form>";
            }
            else
            {
                echo "<div style='width:100%;height:100px;background-color:#EEFFC1;padding:10px 30px;'><p>------ No Students Found --------</p></div>";
               
            }
        }
        elseif( (isset($_POST['college'])) && (isset($_POST['class'])) )
        {
            $college=$_POST['college'];
            $class=$_POST['class'];
            $count=mysqli_num_rows(mysqli_query($cn,"select * from profile where college='$college' and class='$class'"));
            if($count>0)
            {
            echo "<div class='form-enroll'>";
                echo "<form method='post' action='' class='table'>";
                echo "Select Enroll: ";
                echo "<select name='enroll'>";
                echo "<option disabled hidden selected>--SELECTED ANY--</option>";
                $result1=mysqli_query($cn,"select enroll from profile where college='$college' and class='$class'");
                while($data=mysqli_fetch_row($result1))
                {
                    echo "<option>$data[0]</option>";
                }               
                echo "</select>";
                echo "&nbsp;&nbsp;&nbsp;<button name='report'>REPORT</button>"; 
                echo "</form>";
            echo "</div>";

                echo "<form method='post' action='' class='req_table'>";
                echo "<table border='1'>";
                echo "<tr class='req_tr' align='center'> <td>Library ID</td><td>Student Name</td><td>Enrollment No. </td><td>CLASS</td><td>College</td><td>Requested Book</td><td>Issued Book</td><td>Return Request Book</td><td>Returned Books</td></tr>";
                $qry=mysqli_query($cn,"select * from profile where college='$college' and class='$class'");
                while($data=mysqli_fetch_row($qry))
                {
                    echo "<tr><td>$data[0]</td><td>$data[1]</td><td>$data[2]</td><td>$data[4]</td><td>$data[6]</td><td>$data[7]</td><td>$data[8]</td><td>$data[9]</td><td>$data[10]</td></tr>";
                }
                echo "</table></form>";
            // echo $college.$class;
                
            }
            else
            {
                echo "<div style='width:100%;height:100px;background-color:#EEFFC1;padding:10px 30px;'><p>------ No Students Found --------</p></div>";
               
            }
        }
        else
        {
            echo "<div class='alert'><a href='' style='text-decoration:none;color:white;'>";
            echo "<span class='closebtn' onclick='close();'>&times;</span>";  
            echo "<strong>Warning!</strong> Please Select Any College!!";
            echo "</a></div>";
        }
    }
?>

<?php
    if(isset($_POST['report']))
    {
        $enroll=$_POST['enroll'];
        $count=mysqli_num_rows(mysqli_query($cn,"select * from profile where enroll='$enroll'"));
      if($count>0)
      {
        // $enroll=$_GET['enroll'];
        // $username=$_SESSION['name'];
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
            echo "<table class='req-table' style='margin-left:0px;'>";
            echo"<tr class='req-tr'><td>Reqest ID</td><td>Category Name</td><td>Book ID</td><td>Book Name</td><td>Book Author</td><td>Requested Date</td></tr>";
            $result=mysqli_query($cn,"select * from book_request where enroll=$enroll");
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
            echo "<div style='width:100%;height:100px;background-color:#EEFFC1;padding:10px 30px;'><p>------ NO REQUESTED BOOKS --------</p></div>";
            echo "<br><br><br><hr><br><br>";
        }



        if($issue_book>0)
        {
            echo "<div class='title'>Issued Books</div><br>";
            echo "<table class='req-table' style='margin-left:0px;'><tr class='req-tr'><td>Reqest ID</td><td>Category Name</td><td>Book ID</td><td>Book Name</td><td>Book Author</td><td>Issued Date</td><td>Expected Issued Date</td></tr>";
            $result=mysqli_query($cn,"select * from issue_book where enroll=$enroll");
        
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
            echo "<br><br><br><hr>";
        }




        if($pen_return_book>0)
        {
            echo "<div class='title'>Pending Return Books</div><br>";
            echo "<table class='req-table' style='margin-left:0px;'><tr class='req-tr'><td>Reqest ID</td><td>Category Name</td><td>Book ID</td><td>Book Name</td><td>Book Author</td><td>Return Request Date</td><td>Actual Returned Date</td></tr>";
            $result=mysqli_query($cn,"select * from return_book where enroll=$enroll and book_return_date is null");
        
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
            echo "<div style='width:100%;height:100px;background-color:#EEFFC1;padding:10px 30px;'><p>------ NO Pending Return Books --------</p></div>";
            echo "<br><br><br><hr>";
        }



        if($return_book>0)
        {
            echo "<div class='title'>Return Books</div><br>";
            echo "<table class='req-table' style='margin-left:0px;'><tr class='req-tr'><td>Reqest ID</td><td>Category Name</td><td>Book ID</td><td>Book Name</td><td>Book Author</td><td>Return Request Date</td><td>Actual Returned Date</td></tr>";
            $result=mysqli_query($cn,"select * from return_book where enroll=$enroll and book_return_date is not null");
        
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
            echo "<br><br><br><hr>";
        }

      }
      else
      {
        echo "<div style='width:100%;height:100px;background-color:#EEFFC1;padding:10px 30px;'><p>------ No Students Found --------</p></div>";
      }
    }
?>


</body>
</html>