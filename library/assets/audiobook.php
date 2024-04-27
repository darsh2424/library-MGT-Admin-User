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
    <link rel="stylesheet" href="books.css" type="text/css">
    <title>Document</title>
</head>
<body>
    <?php
        // echo "<div id='front-com' class='front-comic'>";
            $result=mysqli_query($cn,"select * from audio_book");
                    echo "<div class='title'>Audiobooks</div><br>";
                    $i=0;
                    while($data=mysqli_fetch_row($result))
                    {   
                        $i=$i+1;
                        $link=$data[3];
                        echo "<table class='cat-table' style='float:left;width:700;padding:50px;'>";
                        echo "<tr><td class='comic-image' style='padding:20px 30px;'><img src='$data[2]'></a></td></tr>";
                        echo "<tr><td style='padding:5px;'><span style='margin-left:50px;font-size:15px;letter-spacing: 0.1em;'>$data[1]</span></td></tr>";
                        echo "<tr><td style='padding:5px;'><audio controls>
                        <source src='$link' type='audio/mpeg'>
                      Your browser does not support the audio element.
                      </audio></td></tr>";
                        echo "</table>";  
        
                        if($i==3)
                        {
                            echo "<br clear='left'>";
                            $i=0;
                        }
                    }     
                     
                ?>


</body>
</html>