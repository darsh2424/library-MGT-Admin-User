<?php
require 'session.php';
if(!($_SESSION['login']==true))
{
	header("location:http://localhost/library/");
}   
require_once 'fine.php';
    $cn=mysqli_connect("localhost","root","","library");
    $enroll=$_SESSION['enroll'];
    $curr_date=date("Y-m-d");
    $qry=mysqli_query($cn,"select * from issue_book where enroll='$enroll'");
    $count=mysqli_num_rows($qry);
    if($count>0)
    {
        while($row1=mysqli_fetch_row($qry))
        {
            $req_id=$row1[0];
 
            $qry1=mysqli_query($cn,"select * from fine where req_id=$req_id");
            $count1=mysqli_num_rows($qry1);
            if($count1>0)
            {

                foreach ($qry1 as $date)
                {
                    $update=mysqli_query($cn,"update fine set curr_date='$curr_date' where req_id=$req_id");
                }

            } 

        }
    }
    // $update=mysqli_query($cn,"update fine set current_date='' where ");

    $result=mysqli_query($cn,"select * from book_category");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="books.css">
    <script src="https://kit.fontawesome.com/b99e675b6e.js"></script>
    <title>Dashboard</title>
    <script>
            function refresh()
            {
                window.location.href('http://localhost/library/dashboard.php');
            }
            function fun()
            {
                window.alert("hello");
                // window.document.getElementByID('serach').submit();
            }
    </script>
    <style>
        ::-webkit-scrollbar {
            display: none;
        }


.div-s{
    margin-left:300px;
}

.input {
  width: 400px;
  height: 20px;
  padding: 10px;
  transition: .2s linear;
  border: 2.5px solid #003aba;
  font-size: 14px;
  letter-spacing: 1px;
  margin-left:30px;
  border-radius:5px;
}

.input:focus {
  outline: none;
  border: 0.5px solid black;
  box-shadow: -5px -5px 0px #003aba;
}
button{
    padding:10px;
    height:40px;
}
button{
            border:none;
            height:45px;
            width:100px;
            background: #003aba;
            color:white;
            font-weight:600;
            border-radius:5px;
            box-shadow: rgb(38, 57, 77) 0px 20px 40px -10px;
            /* transition: transform 0.5s; */
        }
        button:hover{
            background: #90EE90;
            color:black;
            transition: all 0.5s ease-out;
            
        }





    </style>
</head>

<body>
    <div class="div-s">
<form method="post" action="searchbook.php" id="search">
    
    <input type="text" name="search" class="input"  placeholder="Search book...">
    <button name="searchbtn" type="submit">SEARCH</button>

</form><br><br><br>
    </div>





<span class="title">Categories</span>
<hr>
<div id="front-com" class="front-comic">

<?php
            $i=0;
            echo "<table class='cat-table'><tr>";
            while($data=mysqli_fetch_row($result))
            {   
                $i=$i+1;
                $class="comic".$i."-title";
                $link='book_list.php?cat_name='.$data[1];
                echo "<td class='comic-image' style='padding:20px 30px;'><a href='$link'><img src='$data[2]'></a>";
                echo "<br><br><div class='$class'><span style='margin-left:50px;font-size: 20px;letter-spacing: 0.1em;'>$data[1]</span></div></td>";
                if($i==4)
                {
                    echo "</tr>";
                    $i=0;
                }

            }     
            echo "</tr></table>";   
        ?>
   </div>
<hr>

<?php
        $row=mysqli_num_rows(mysqli_query($cn,"select * from book_info where most_req_book>0"));
        if($row>=4)
        {
            echo "<div class='title' style='padding:25px;margin-left:400px;'> Most Requested Books </div>";
        
            echo "<div id='front-com' class='front-comic'>";

            $var=mysqli_query($cn,"select * from book_info order by most_req_book desc limit 4");
            foreach ($var as $bookdata)
            {
                $book_id=$bookdata['book_id'];
                $book_name=$bookdata['book_name'];
                $c_name=$bookdata['c_name'];
                $img=$bookdata['book_img'];

                $link='user_book_request.php?book_id='.$book_id.'&cat_name='.$c_name;
        
                echo "<table id='$book_name' style='padding:10px;width:300px;height:400px;float:left;'>";
                echo "<tr><td height='60%' colspan='2' align='center'><a href='$link'><img src='$img' height='300px' width='200px'></a></td></tr>";
                echo "<tr><td valign='top' align='center'><span style='font-size: 20px;letter-spacing: 0.1em;'>".$bookdata['book_name']."</span></td></tr></table>";
            }
  
  
            echo "</div><hr>";
        }
    ?>


























     <!-- <a href=""><img src="bookimg/sci.jpg"></a>
     <a href=""><img src="bookimg/b1.jpg"></a>
     <a href=""><img src="bookimg/b1.jpg"></a>
     <a href=""><img src="bookimg/b1.jpg"></a>
     <a href=""><img src="bookimg/b1.jpg"></a><br>
     <a href=""><img src=""></a> -->

  <!-- <div class="comic-title">
  <?php
    // $i=0;
    // while($data=mysqli_fetch_row($result))
    // {   
    //     $i=$i+1;
    //     $class="comic".$i."-title";
    //     echo "<div class='$class'>
    //         <h4>$data[1]<br><span>2022</span></h4>
    //     </div>";
        
    // }
  ?>
  </div> -->
  <!-- 
     <div class="comic1-title">
         <h4>SCIENCE<br><span>2022</span></h4>
     </div>
     <div class="comic2-title">
        <h4>ARTS<br><span>2022</span></h4>
     </div>
     <div class="comic3-title">
        <h4>PHARMACEUTICAL <br>SCIENCE<br><span>2022</span></h4>
     </div>
     <div class="comic4-title">
        <h4>ENGINEERING & <br>TECHNOLOGY<br><span>2022</span></h4>
     </div>
     <div class="comic5-title">
        <h4>EDUCATION<br>#12<br><span>2022</span></h4>
     -->
</body>
</html>
