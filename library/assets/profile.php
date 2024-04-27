<?php
require 'session.php';
if(!($_SESSION['login']==true))
{
	header("location:http://localhost/library/");
}
$username=$_SESSION['name'];
$enroll=$_SESSION['enroll'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        .main{
            margin-left:10px;
            margin-top:100px;
            height:500px;
            width:1300px;
            /* background:white; */
            color:white;
            border:none;
        }
        table{
            border-spacing:25px;
            /* border:none; */
        }
        table td{
            font-family:ebrima;
            font-size:1.2rem;
            border:none;
            font-weight:bolder;
        }
        .main .box{
            border:1px solid black;
            padding:30px;
            background:#003aba;
            color:white;
            transition: transform 0.1s;
            /* box-shadow: 10px 10px 20px wheat; */
	        margin: 0 30px;
            border-radius:5px;
	        border-bottom:11px solid #FBAF00;
        }
        .main .box:hover{
            transform: translateY(15px);
            box-shadow: 10px 10px 20px black;
        }
        .personal-child{
            background:#003aba;
            color:white;
            border-radius:10px;
            box-shadow: 10px 10px 20px black;
            /* background:#003aba;
            color:white; */
        }
        .personal-child .title_td{
            /* background:grey; */
            text-decoration:underline;
        }
        .personal-child h1{
            /* background:#FF5A5A; */
            width:400px;
            color:white;
            border-radius:50px;
        }
        .box a{
            text-decoration:none;
            color:white;
        }
    </style>
</head>
<body>
    <?php
     $cn=mysqli_connect('localhost','root','','library');
     $row=mysqli_fetch_row(mysqli_query($cn,"select * from profile where enroll=$enroll"));
        
    ?>
    <table border='2' class='main'>
            <tr>
                    <td rowspan='2'>
                        <table class="personal-parent">
                            <tr>
                                <td>
                                    <img src='img\profile-user.png' height='200' width='200' style='margin-left:33%;'>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <?php
                                        echo "<table class='personal-child'>";
                                        echo"<td class='tab-header' align='center' colspan='4'><h1>Personal Details</h1></td>";
                                        echo "<tr>";
                                               echo "<td class='title_td' colspan='1'>Name:</td>";
                                                                 echo "<td colspan='3'>$row[1]</td>";
                                         echo "</tr>";

                                         echo "<tr>";
                                                echo "<td class='title_td'>Enollment NO. :</td>";
                                                                 echo "<td>$row[2]</td>";

                                                echo "<td class='title_td'>Password:</td>";
                                                                  echo "<td>$row[3]</td>";
                                        echo "</tr>";
                                        echo "<tr>";
                                                   echo "<td class='title_td'>Class:</td>";
                                                                    echo "<td>$row[4]</td>";
                                                //  echo "<td class='title_td'>Course:</td>";
                                                //                    echo "<td>$row[5]</td>";

                                                echo "<td class='title_td'>College:</td>";
                                                                   echo "<td>$row[6]</td>";
                                         echo "</tr>";
                                         echo "</table>";
                                    ?>
                                </td>
                            </tr>
                        </table>
                    </td>
                    <td class='box'>
                        <a href='account.php'>
                        <img src='img\pending.png' height='150' width='150'><br>
                        <div class='book-dtl-title'>Requested Books:</div><br>
                        <div class='book-dtl-data'><?= $row[7]; ?></div>
                        </a>
                    </td>
                    <td class='box'>
                    <a href='account.php'>
                        <img src='img\issue.png' height='150' width='150'><br>
                        <div class='book-dtl-title'>Issued Books:</div><br>
                        <div class='book-dtl-data'><?= $row[8]; ?></div>
                        </a>
                    </td>
            </tr>

            <tr>
                    
                    <td class='box'>
                    <a href='account.php'>
                        <img src='img\request.png' height='150' width='150'><br>
                        <div class='book-dtl-title'>Return Request Books:</div><br>
                        <div class='book-dtl-data'><?= $row[9]; ?></div>
                        </a>
                    </td>
                    <td class='box'> 
                    <a href='account.php'>
                    <img src='img\return.png' height='150' width='150'><br>
                        <div class='book-dtl-title'>Returned Books:</div><br>
                        <div class='book-dtl-data'><?= $row[10]; ?></div>
                        </a>
                    </td>
            </tr>
    </table>

</body>
</html>