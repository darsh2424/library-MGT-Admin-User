<?php
require 'session.php';
if(!($_SESSION['login']==true))
{
	header("location:http://localhost/library/");
}

    $cn=mysqli_connect("localhost","root","","library");
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
    </script>
</head>

<body>
    <form>
        <input type="search">
    </form>
<br>

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
                $link="#".$data[1];
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
    <div id="arrow"><a href=''><img src="img/up-arrow.png" height="70px" width="70px" onclick='refresh();'></a></div>
    <?php
    if(isset($_POST['select']))
    {
        $form_data=$_POST['select'];
        $location='#'.$form_data;

        $book_form_data=mysqli_query($cn,"select * from book_info where book_name='$form_data'");
        $book_row=mysqli_fetch_assoc($book_form_data);
        
        echo "<form method='post'>";
        echo "<table>";
        echo "</table>";
        echo "</form>";

        echo $book_row['ref_no'].$book_row['book_name'].$book_row['book_author'].$book_row['pub_year'].$_SESSION['enroll'].$_SESSION['name'];
        

        echo "<a href='$location'><button>CLOSE</button></a>";
        // echo "<span>$form_data</span>";
    }

    ?>
<?php
        $i=$i+1;
        $result=mysqli_query($cn,"select * from book_category");
        echo "<form method='post' action=''>";
        while($data=mysqli_fetch_row($result))
        {
            echo "<br clear='left'>";
            echo "<div id='$data[1]'>";
            echo "<span class='title'>$data[1]</span><hr>";
            $book=mysqli_query($cn,"select * from book_info where c_name='$data[1]'");
                
                while($bookdata=mysqli_fetch_row($book))
                {
                    echo "<table id='$bookdata[1]' style='padding:10px;width:400px;height:400px;float:left;'>";
                    echo "<tr><td height='60%' colspan='2' align='center'><button name='select' value='$bookdata[1]'><img src='$bookdata[5]' height='300px' width='200px'></button></td></tr>";
                    echo "<tr><td valign='top' align='center'><span style='font-size: 20px;letter-spacing: 0.1em;'>$bookdata[1]</span></td></tr></table>";
                }
            echo "</div>";
        }  
        echo "</form>";
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
