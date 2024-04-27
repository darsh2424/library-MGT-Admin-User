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
    $qry=mysqli_query($cn,"select distinct ebook_cat from ebook_info");
    // foreach($qry as $c_name)
    while($c_name=mysqli_fetch_assoc($qry))
    {
        $cat=$c_name['ebook_cat'];
        echo "<br><br><div class='title' style='padding:10px;'>$cat</div><hr>";

        $result=mysqli_query($cn,"select * from ebook_info where ebook_cat='$cat'");
        while($val=mysqli_fetch_assoc($result))
        {
            $title=$val['ebook_title'];
            $author=$val['ebook_author'];
            $ebook_img=$val['ebook_img'];
            $link=$val['ebook_path'];

            echo "<table  class='cat-table' style='float:left;'>";
            echo "<tr><td class='comic-image'><a href='$link' target='_blank'><img src='$ebook_img' height='100' width='100'></a></td></tr>";
            echo "<tr><td style='text-align:center;padding:0px;font-size:1.2rem;font-family:ebrima;'>$title</tr>";
            // echo "<tr><td>$author</tr>";
            echo "</table>";


        }
        echo "<br clear='left'>";
    }

?>
<hr>
</body>
</html>