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
    <style>
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
            transform: translateX(-15px);
        }
    </style>
    
</head>
<body>
    <div class='title'> Book Report </div>
    <form method="post" class="table" action="">
        Table Name:&nbsp;&nbsp;
        <select name='table'>
            <option disabled selected hidden>--SELECT ANY--</option>
            <option value='book_category'>Book Category</option>
            <option value='book_info'>Book Info</option>
            <option value='book_request'>Requested Books</option>
            <option value='issue_book'>Issued Books</option>
            <option value='return_book'>Returned Books</option>
        </select>&nbsp;&nbsp;
        Book Category:
        <select name='c_name'>
            <?php
                $cresult=mysqli_query($cn,"select distinct(c_name) from book_category");
                echo "<option disabled selected hidden>--SELECT ANY--</option>";
                    while($coption=mysqli_fetch_row($cresult))
                    {
                       echo "<option>$coption[0]</option>";
                    }
            ?>
        </select>&nbsp;&nbsp;
        &nbsp;&nbsp;&nbsp;&nbsp;
        <button name='submit'>SUBMIT</button>
    </form>
    <?php
if($cn)
{
    if(isset($_POST['submit']))
    {
        if(isset($_POST['table']) and (!(isset($_POST['c_name']))))
        {
            $table_name=$_POST['table'];
            
            






            
            
            
            // ONLY TABLE SELECTED

            if($table_name=='book_category')
            {
                $qry=mysqli_query($cn,"select c_name,most_req_book,most_issue_book from $table_name");
                $row_count=mysqli_num_rows($qry);
                if($row_count>0)
                {
                    echo "<form method='post' action='' class='req_table' style='margin-left:250px;'>";
                    echo "<table border='1'>";
                    echo "<tr class='req_tr' align='center'> <td>Category Name</td><td>Most Requested Books</td><td>Most Issued Books</td></tr>";
                    while($data=mysqli_fetch_row($qry))
                    {
                        echo "<tr><td>$data[0]</td><td>$data[1]</td><td>$data[2]</td></tr>";
                    }
                    echo "</table></form>";
                }
                else
                {
                    echo "<div style='width:100%;height:100px;background-color:#EEFFC1;padding:10px 30px;'><p>------ No Category Data Available  --------</p></div>";
                }
            }

            if($table_name=='book_info')
            {
                $qry=mysqli_query($cn,"select book_id,book_name,book_author,c_name,pub_year,copies,most_req_book,most_issue_book from $table_name order by most_req_book desc");
                $row_count=mysqli_num_rows($qry);
                if($row_count>0)
                {
                    echo "<form method='post' action='' class='req_table'>";
                    echo "<table border='1'>";
                    echo "<tr class='req_tr' align='center'> <td>Book ID</td><td>Book Name</td><td>Book Author</td><td>Category Name</td><td>Publication Year</td><td>Copies</td><td>Most Requested Books</td><td>Most Issued Books</td></tr>";
                    while($data=mysqli_fetch_row($qry))
                    {
                        echo "<tr><td>$data[0]</td><td>$data[1]</td><td>$data[2]</td><td>$data[3]</td><td>$data[4]</td><td>$data[5]</td><td>$data[6]</td><td>$data[7]</td></tr>";
                    }
                    echo "</table></form>";
                }
                else
                {
                    echo "<div style='width:100%;height:100px;background-color:#EEFFC1;padding:10px 30px;'><p>------ No Books In Library --------</p></div>";
                }
            }
            if($table_name=='book_request')
            {
                $qry=mysqli_query($cn,"select * from $table_name");
                $row_count=mysqli_num_rows($qry);
                if($row_count>0)
                {
                    echo "<form method='post' action='' class='req_table'>";
                    echo "<table border='1'>";
                    echo "<tr class='req_tr' align='center'> <td>Request ID</td><td>Enrollment No.</td><td>Username</td><td>Book ID</td><td>Book Name</td><td>Book Category</td><td>Book Author</td><td>Book Request Date</td></tr>";
                    while($data=mysqli_fetch_row($qry))
                    {
                        echo "<tr><td>$data[0]</td><td>$data[1]</td><td>$data[2]</td><td>$data[3]</td><td>$data[4]</td><td>$data[5]</td><td>$data[6]</td><td>$data[7]</td></tr>";
                    }
                    echo "</table></form>";
                }
                else
                {
                    echo "<div style='width:100%;height:100px;background-color:#EEFFC1;padding:10px 30px;'><p>------ No Requested Books In Library --------</p></div>";
                }              
            }
            if($table_name=='issue_book')
            {
                $qry=mysqli_query($cn,"select * from $table_name");
                $row_count=mysqli_num_rows($qry);
                if($row_count>0)
                {
                    echo "<form method='post' action='' class='req_table'>";
                    echo "<table border='1'>";
                    echo "<tr class='req_tr' align='center'> <td>Request ID</td><td>Enrollment No.</td><td>Username</td><td>Book ID</td><td>Book Name</td><td>Book Category</td><td>Book Author</td><td>Issued Date</td><td>Expected Return Date</td></tr>";
                    while($data=mysqli_fetch_row($qry))
                    {
                        echo "<tr><td>$data[0]</td><td>$data[1]</td><td>$data[2]</td><td>$data[3]</td><td>$data[4]</td><td>$data[5]</td><td>$data[6]</td><td>$data[7]</td><td>$data[8]</td></tr>";
                    }
                    echo "</table></form>";
                }
                else
                {
                    echo "<div style='width:100%;height:100px;background-color:#EEFFC1;padding:10px 30px;'><p>------ No Issued Books In Library --------</p></div>";
                }               
            }
            if($table_name=='return_book')
            {
                $qry=mysqli_query($cn,"select * from $table_name");
                $row_count=mysqli_num_rows($qry);
                if($row_count>0)
                {
                    echo "<form method='post' action='' class='req_table'>";
                    echo "<table border='1'>";
                    echo "<tr class='req_tr' align='center'> <td>Request ID</td><td>Enrollment No.</td><td>Username</td><td>Book ID</td><td>Book Name</td><td>Book Category</td><td>Book Author</td><td>Return Request Date</td><td>Book Return Date</td></tr>";
                    while($data=mysqli_fetch_row($qry))
                    {
                        echo "<tr><td>$data[0]</td><td>$data[1]</td><td>$data[2]</td><td>$data[3]</td><td>$data[4]</td><td>$data[5]</td><td>$data[6]</td><td>$data[7]</td><td>$data[8]</td></tr>";
                    }
                    echo "</table></form>";
                }
                else
                {
                    echo "<div style='width:100%;height:100px;background-color:#EEFFC1;padding:10px 30px;'><p>------ No Returned Books In Library --------</p></div>";
                }              
            }
        }















      else if(isset($_POST['table']) and isset($_POST['c_name']))
      {
            // TABLE NAME AND CATEGORY SELECTED
            
            $table_name=$_POST['table'];
            $c_name=$_POST['c_name'];

            if($table_name=='book_category')
            {
                $qry=mysqli_query($cn,"select c_name,most_req_book,most_issue_book from $table_name where c_name='$c_name'");
                $row_count=mysqli_num_rows($qry);
                if($row_count>0)
                {
                    echo "<form method='post' action='' class='req_table' style='margin-left:250px;'>";
                    echo "<table border='1'>";
                    echo "<tr class='req_tr' align='center'><td>Category Name</td><td>Most Requested Books</td><td>Most Issued Books</td></tr>";
                    while($data=mysqli_fetch_row($qry))
                    {
                        echo "<tr><td>$data[0]</td><td>$data[1]</td><td>$data[2]</td></tr>";
                    }
                    echo "</table></form>";
                }
                else
                {
                    echo "<div style='width:100%;height:100px;background-color:#EEFFC1;padding:10px 30px;'><p>------ No  $c_name data available  In Library --------</p></div>";
                }
            }
        
        if($table_name=='book_info')
        {
            $qry=mysqli_query($cn,"select book_id,book_name,book_author,c_name,pub_year,copies,most_req_book,most_issue_book from $table_name where c_name='$c_name'");
            $row_count=mysqli_num_rows($qry);
            if($row_count>0)
            {
                echo "<form method='post' action='' class='req_table'>";
                echo "<table border='1'>";
                echo "<tr class='req_tr' align='center'> <td>Book ID</td><td>Book Name</td><td>Book Author</td><td>Category Name</td><td>Publication Year</td><td>Copies</td><td>Most Requested Books</td><td>Most Issued Books</td></tr>";
                while($data=mysqli_fetch_row($qry))
                {
                    echo "<tr><td>$data[0]</td><td>$data[1]</td><td>$data[2]</td><td>$data[3]</td><td>$data[4]</td><td>$data[5]</td><td>$data[6]</td><td>$data[7]</td></tr>";
                }
                echo "</table></form>";
            }
            else
            {
                echo "<div style='width:100%;height:100px;background-color:#EEFFC1;padding:10px 30px;'><p>------ No Books Of $c_name category In Library --------</p></div>";
            }
        }
        if($table_name=='book_request')
        {
            $qry=mysqli_query($cn,"select * from $table_name where c_name='$c_name'");
            $row_count=mysqli_num_rows($qry);
            if($row_count>0)
            {
                echo "<form method='post' action='' class='req_table'>";
                echo "<table border='1'>";
                echo "<tr class='req_tr' align='center'> <td>Request ID</td><td>Enrollment No.</td><td>Username</td><td>Book ID</td><td>Book Name</td><td>Book Category</td><td>Book Author</td><td>Book Request Date</td></tr>";
                while($data=mysqli_fetch_row($qry))
                {
                    echo "<tr><td>$data[0]</td><td>$data[1]</td><td>$data[2]</td><td>$data[3]</td><td>$data[4]</td><td>$data[5]</td><td>$data[6]</td><td>$data[7]</td></tr>";
                }
                echo "</table></form>";
            }
            else
            {
                echo "<div style='width:100%;height:100px;background-color:#EEFFC1;padding:10px 30px;'><p>------ No Requested Books Of $c_name category In Library --------</p></div>";
            }          
        }
        if($table_name=='issue_book')
        {
            $qry=mysqli_query($cn,"select * from $table_name where c_name='$c_name'");
            $row_count=mysqli_num_rows($qry);
            if($row_count>0)
            {
                echo "<form method='post' action='' class='req_table'>";
                echo "<table border='1'>";
                echo "<tr class='req_tr' align='center'> <td>Request ID</td><td>Enrollment No.</td><td>Username</td><td>Book ID</td><td>Book Name</td><td>Book Category</td><td>Book Author</td><td>Issued Date</td><td>Expected Return Date</td></tr>";
                while($data=mysqli_fetch_row($qry))
                {
                    echo "<tr><td>$data[0]</td><td>$data[1]</td><td>$data[2]</td><td>$data[3]</td><td>$data[4]</td><td>$data[5]</td><td>$data[6]</td><td>$data[7]</td><td>$data[8]</td></tr>";
                }
                echo "</table></form>";
            }
            else
            {
                echo "<div style='width:100%;height:100px;background-color:#EEFFC1;padding:10px 30px;'><p>------ No Issued Books Of $c_name category In Library --------</p></div>";
            }          
        }
        if($table_name=='return_book')
        {
            $qry=mysqli_query($cn,"select * from $table_name where c_name='$c_name'");
            $row_count=mysqli_num_rows($qry);
            if($row_count>0)
            {
                echo "<form method='post' action='' class='req_table'>";
                echo "<table border='1'>";
                echo "<tr class='req_tr' align='center'> <td>Request ID</td><td>Enrollment No.</td><td>Username</td><td>Book ID</td><td>Book Name</td><td>Book Category</td><td>Book Author</td><td>Return Request Date</td><td>Book Return Date</td></tr>";
                while($data=mysqli_fetch_row($qry))
                {
                    echo "<tr><td>$data[0]</td><td>$data[1]</td><td>$data[2]</td><td>$data[3]</td><td>$data[4]</td><td>$data[5]</td><td>$data[6]</td><td>$data[7]</td><td>$data[8]</td></tr>";
                }
                echo "</table></form>";
            }
            else
            {
                echo "<div style='width:100%;height:100px;background-color:#EEFFC1;padding:10px 30px;'><p>------ No Returned Books Of $c_name category In Library --------</p></div>";
            }         
        }

     }        
     else
     {
            echo "<div class='alert'><a href='' style='text-decoration:none;color:white;'>";
            echo "<span class='closebtn' onclick='close();'>&times;</span>";  
            echo "<strong>Warning!</strong> Please Select Any Table..";
            echo "</a></div>";
     }

    }
}
else
{
    echo "<script>Window.alert('Server Not Responding.....');</script>";
}    
?>
















        <!-- //     if($table_name=='book_request')
        //     {
                            
        //     if($cn)
        //     {
        //         $qry=mysqli_query($cn,"select * from $table_name");
        //         $row_count=mysqli_num_rows($qry);
        //         if($row_count>0)
        //         {
        //             echo "<form method='post' action='' class='req_table'>";
        //             echo "<table border='1'>";
        //             echo "<tr class='req_tr' align='center'> <td>Request ID</td><td>Enrollment No.</td><td>Username</td><td>Book ID</td><td>Book Name</td><td>Book Category</td><td>Book Author</td></tr>";
        //             while($data=mysqli_fetch_row($qry))
        //             {
        //                 echo "<tr><td>$data[0]</td><td>$data[1]</td><td>$data[2]</td><td>$data[3]</td><td>$data[4]</td><td>$data[5]</td><td>$data[6]</td></tr>";
        //             }
        //             echo "</table></form>";
        //         }
        //         else
        //         {
        //             echo "<div style='width:100%;height:100px;background-color:#EEFFC1;position:fixed;'><p style='margin-left:80px;margin-top:30px;'>------ THERE IS NO REQUESTS --------</p></div>";
        //         }
    
    
        //     }
        //     else
        //     {
        //         echo "<script>Window.alert('Server Not Responding.....');</script>";
        //     }
        //     }
        //     if($table_name=='issue_book')
        //     {
                            
        //     if($cn)
        //     {
        //         $qry=mysqli_query($cn,"select * from $table_name");
        //         $row_count=mysqli_num_rows($qry);
        //         if($row_count>0)
        //         {
        //             echo "<form method='post' action='' class='req_table'>";
        //             echo "<table border='1'>";
        //             echo "<tr class='req_tr' align='center'> <td>Request ID</td><td>Enrollment No.</td><td>Username</td><td>Book ID</td><td>Book Name</td><td>Book Category</td><td>Book Author</td></tr>";
        //             while($data=mysqli_fetch_row($qry))
        //             {
        //                 echo "<tr><td>$data[0]</td><td>$data[1]</td><td>$data[2]</td><td>$data[3]</td><td>$data[4]</td><td>$data[5]</td><td>$data[6]</td></tr>";
        //             }
        //             echo "</table></form>";
        //         }
        //         else
        //         {
        //             echo "<div style='width:100%;height:100px;background-color:#EEFFC1;position:fixed;'><p style='margin-left:80px;margin-top:30px;'>------ THERE IS NO REQUESTS --------</p></div>";
        //         }
    
    
        //     }
        //     else
        //     {
        //         echo "<script>Window.alert('Server Not Responding.....');</script>";
        //     }
        //     }
        //     if($table_name=='return_book')
        //     {
                            
        //     if($cn)
        //     {
        //         $qry=mysqli_query($cn,"select * from $table_name");
        //         $row_count=mysqli_num_rows($qry);
        //         if($row_count>0)
        //         {
        //             echo "<form method='post' action='' class='req_table'>";
        //             echo "<table border='1'>";
        //             echo "<tr class='req_tr' align='center'> <td>Request ID</td><td>Enrollment No.</td><td>Username</td><td>Book ID</td><td>Book Name</td><td>Book Category</td><td>Book Author</td></tr>";
        //             while($data=mysqli_fetch_row($qry))
        //             {
        //                 echo "<tr><td>$data[0]</td><td>$data[1]</td><td>$data[2]</td><td>$data[3]</td><td>$data[4]</td><td>$data[5]</td><td>$data[6]</td></tr>";
        //             }
        //             echo "</table></form>";
        //         }
        //         else
        //         {
        //             echo "<div style='width:100%;height:100px;background-color:#EEFFC1;position:fixed;'><p style='margin-left:80px;margin-top:30px;'>------ THERE IS NO REQUESTS --------</p></div>";
        //         }
    
    
        //     }
        //     else
        //     {
        //         echo "<script>Window.alert('Server Not Responding.....');</script>";
        //     }
        //     }
        // }
    ?> -->
    </form>
</body>
</html>