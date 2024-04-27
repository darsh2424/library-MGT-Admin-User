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
</head>
<body>
    <?php
    $qry=mysqli_query($cn,"select distinct pod_category from podcast");
    // foreach($qry as $c_name)
    while($c_name=mysqli_fetch_assoc($qry))
    {
        $cat=$c_name['pod_category'];
        echo "<br><br><div class='title' style='padding:10px;margin-left:350px;'>$cat</div><hr>";
        $result=mysqli_query($cn,"select * from podcast where pod_category='$cat'");
        while($val=mysqli_fetch_assoc($result))
        {
            $title=$val['pod_title'];
            $link=$val['pod_link'];

            // echo $title.$link;
            // echo "<iframe width='560' height='315' src='$link'></iframe>";

            echo "<table  class='cat-table' style='float:left;'>";
            echo "<tr><td class='comic-image'><iframe width='560' height='315' src='$link' title='YouTube video player' frameborder='0' allow='accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share' allowfullscreen></iframe></td></tr>";
            echo "<tr><td style='text-align:center;padding:0px;font-size:1.2rem;font-family:ebrima;'>$title</tr>";
            // echo "<tr><td>$author</tr>";
            echo "</table>";


        }
        echo "<br clear='left'>";
    }
    
    ?>
</body>
</html>