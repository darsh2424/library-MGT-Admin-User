<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" type="text/css" href="books.css">
    <style>
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

        /* Table Styling */
        .addstud{
            padding:0px 100px;
            
        }
        .addstud table{
            /* box-shadow: rgba(0, 0, 0, 0.15) 0px 15px 25px, rgba(0, 0, 0, 0.05) 0px 5px 10px; */
            /* box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px; */
            /* box-shadow: rgba(0, 0, 0, 0.16) 0px 1px 4px, rgb(51, 51, 51) 0px 0px 0px 3px; */
            box-shadow: rgba(0, 0, 0, 0.56) 0px 22px 70px 4px;
            border:none;
            backdrop-filter: blur(5px);
            background: #739cf5;
            color:white;
            font-weight:900;
            border-radius:10px;
        }
        .addstud table td{
            color:black;
            padding:20px 100px;
            border:none;
            font-size:1.3rem;
            font-weight:bold;
            font-family:ebrima;
            text-align:center;
            border-right:2px solid black;
            border-bottom:2px solid black;
        }
        input[type="text"],[type="password"]{
            font-size:1.2rem;
            font-weight:500;
            font-family:ebrima;
            text-align:left;
            color:white;
            border: 2px solid #e8e8e8;
            /* padding: 15px; */
            border-radius: 5px;
            background-color: #003aba;
            
            
            text-align: center;
        }
        input[type="text"]:focus,[type="password"]:focus{
            outline-color: white;
            background-color: #003aba;
            color: white;
            box-shadow: 5px 5px #888888;
        }
        select{
            width:150px;
            font-size:1.2rem;
            font-weight:500;
            font-family:ebrima;
            text-align:center;
            border: 2px solid #e8e8e8;
            /* padding: 15px; */
            border-radius: 5px;
            background-color: #003aba;
            color:white;
        }
        select:focus{
            outline-color: white;
            background-color: #003aba;
            color: #e8e8e8;
            box-shadow: 5px 5px #888888;
        }
        button{
            border:none;
            height:45px;
            width:160px;
            background: #003aba;
            color:white;
            font-weight:600;
            border-radius:5px;
            box-shadow: rgb(38, 57, 77) 0px 20px 40px -10px;
            transition: transform 0.5s;
        }
        button:hover{
            background: #90EE90;
            color:black;
            /* transition: all 0.5s ease-out; */
            transform: translateY(5px);
        }
    </style>
</head>
<body>
    <?php
        if(isset($_POST['submit']))
        {
            $enroll=$_POST['enroll'];
            $username=$_POST['username'];
            $pass=$_POST['pass'];
            $class=$_POST['year'].$_POST['course'];
            $course=$_POST['course'];
            $college=$_POST['college'];

            $cn=mysqli_connect("localhost","root","","library");
            if($cn)
            {
                $row=mysqli_num_rows(mysqli_query($cn,"select * from login where enroll='$enroll'"));
                if($row>0)
                {
                    echo "<div class='alert'><a href='' style='text-decoration:none;color:white;'>";
                    echo "<span class='closebtn' onclick='close();'>&times;</span>";  
                    echo "<strong>Warning!</strong> Enrollment No Already Exist.......";
                    echo "</a></div>";
                }
                else
                {
                    $insert=mysqli_query($cn,"insert into login values('$enroll','$username','$pass')");
                    if($insert)
                    {
                        $update=mysqli_query($cn,"insert into profile(enroll,name,password,class,course,college) values('$enroll','$username','$pass','$class','$course','$college')");
                        if($update)
                        {
                            echo "<div class='alert success'><a href='' style='text-decoration:none;color:white;'>";
                            echo "<span class='closebtn' onclick='close();'>&times;</span>";  
                            echo "<strong>Success!</strong> Student Succesfully Added....";
                            echo "</a></div>";
                        }
                    }
                }
            }
            else
            {
                echo "<script>alert('Server Not Responding......');</script>";
            }


        }
    ?>
        <br><div class='title'>Add Student</div><br>
    <form method='post' action='' class='addstud'>
    <table border='1' align='center'>
        
        <tr>
            <td>Enrollment No. :</td>
            <td style="border-right:none;"><input type='text' name='enroll' maxlength='10' autocomplete="off" pattern="[0-9]{10}" oninvalid="alert('Enrollment no Must Be 10 Digits Only');" required></td>
        </tr>
        <tr>
            <td>Username :</td>
            <td style="border-right:none;"><input type='text' name='username' autocomplete="off" required></td>
        </tr>
        <tr>
            <td>Password :</td>
            <td style="border-right:none;"><input type="password" name="pass" maxlength="8" pattern="[0-9]{8}" oninvalid="alert('Password should be 8 digits Only');" autocomplete="off" required></td>
        </tr>
        <tr>
            <td>Class:</td>
            <td style="border-right:none;">
                <select name='year'>
                    <option value='FY'>First Year</option>
                    <option value='SY'>Second Year</option>
                    <option value='TY'>Third Year</option>

                </select>
                <select name='course'>
                    <option>BCA</option>
                    <option>BBA</option>
                    <option>BBA-ITM</option>
                    <option>BCOM</option>
                    <option>B.Tech</option>
                    <option>M.Tech</option>
                    <option>B.Sc</option>
                    <option>M.Sc</option>
                </select>
            </td>
        </tr>
        <tr>
            <td>College:</td>
            <td style="border-right:none;">
                <select name='college'>
                    <option>SEMCOM</option>
                    <option>NVPAS</option>
                    <option>ADIT</option>
                    <option>GCET</option>
                    <option>MBIT</option>
                    <option>ISTAR</option>
                </select>
            </td>
        </tr>
        <tr>
            <td colspan='2' align='right' style="border-right:none;border-bottom:none;">
                <button type='submit' name='submit'>ADD STUDENT</button>
            </td>
        </tr>
    </table>
    </form>
</body>
</html>