<?php
    $cn=mysqli_connect("localhost","root","","library");
?>
<!DOCTYPE html>
<html>
<head>

<title>Getting the file information</title>
    <style>
        .add_cat{
            margin-left:125px;
            margin-top:-28px;
            width: 430px;
            height: 320px;
            position: absolute;
            transform: translate(-50%,-50%);
             left: 15%;
            top: 22%;
            border-radius: 50%;
            /* border:5px; */
            height: 300px;
            width: 400px;
            background-color: rgba(255,255,255,0.13);
            position: absolute;
            transform: translate(-50%,-50%);
            /* top: 50%;
            left: 75%; */
            top:20%;
            border-radius: 20px;
            /* backdrop-filter: blur(5px); */
            border: 2px solid rgba(255,255,255,0.1);
            box-shadow: 0 0 40px rgba(8,7,16,0.6);
            padding: 50px 35px;
            font-family: Ebrima;
            font-size:1.2rem;
            font-weight:bold;
            color: black;
            letter-spacing: 0.5px;
            outline: none;
            border: none;
            
        }
        .heading{
            background-color:#004AAD;
            color:white;
        }
        .add_cat td{
            padding:5px;
        }
        .heading{
            border-top-left-radius:10px;
            border-top-right-radius:10px;
        }
        /* h1{
            font-size:30px;
            margin-top:-50px;
            background:#004AAD;
            height:45px;
            color:white;
        } */
        .name{
           margin-bottom:20px; 
        }
        .file{
           margin-bottom:40px; 
        }
        input[type=text],[type=number]{
            color:black;
            background-color:#cce6ff;
            width: 250px;
            height:25px;
            /* opacity: 0.3; */
            border-color:#7393B3;
            border:3px;
            font-size:1rem;
        }

        

        input[type="file"] {
            font-size:1.2rem;
        
        }

        input[type="submit"] {
            font-size:1.2rem;
            color:white;
            background:#004AAD;
            height:50px;
            width:100px;
            border-radius:5px;
            border:none;
            cursor:pointer;
        }
        


        .add_book{
            margin-left:125px;
            margin-top:-28px;
            position: absolute;
            transform: translate(-50%,-50%);
             left: 65%;
            top: 28%;
            border-radius: 50%;
            /* border:5px; */
            height: 580px;
            width: 400px;
            background-color: rgba(255,255,255,0.13);
            position: absolute;
            transform: translate(-50%,-50%);
            /* top: 50%;
            left: 75%; */
            /* top:50%; */
            border-radius: 20px;
            /* backdrop-filter: blur(5px); */
            border: 2px solid rgba(255,255,255,0.1);
            box-shadow: 0 0 40px rgba(8,7,16,0.6);
            padding: 50px 35px;
            font-family: 'Poppins',sans-serif;
            color: black;
            letter-spacing: 0.5px;
            outline: none;
            border: none;
            font-family: Ebrima;
            font-size:1.2rem;
            font-weight:bold;
            color: black;
        }

        .add_book select{
            width: 250px;
            height:35px;
            font-size:1rem;
            background-color:#cce6ff;
            color:black;
            border:none;
        }
        .add_book td{
            padding:5px;
        }

        .add_cat table td{
            margin-left:50%;
        }
    </style>
</head>
<body>
 
   <div class="cat">     
   <form action="" method="post" enctype="multipart/form-data" class="add_cat">
        
     <table width="475px" style="margin-left:-38px;margin-top:-52px;">
        <tr><td colspan="2" class="heading" align="center"><h1>Add Category</h1></td></tr>
        <tr><td style='padding-left: 18px;'>Category Name:</td>
        <tr><td align="center"><input type="text" name='c_name' size='30' required class="name"></td></tr>

        <tr><td style='padding-left: 18px;'>Add Cover-Photo:</td>
        <tr><td align="center">
        <input type="file" name="cover" class="file"></td></tr>


        <!-- <tr><td></td></tr>
        <tr><td></td></tr>
        <tr><td></td></tr>
        <tr><td></td></tr>
        <tr><td></td></tr> -->
        <tr><td colspan='2' align="center"><input type="submit" name="cat_submit" value="SUBMIT"></td></tr>
    </table>
  </form>
    </div>


 

    <div class="cat">     
   <form action="" method="post" enctype="multipart/form-data" class="add_book">
     <table width="483px" style="margin-left:-42px;margin-top:-57px;padding:5px;">
        <tr><td colspan="2" class="heading" align="center"><h1>Add Book
            
        </h1></td></tr>
        <tr>
            <td style='padding-left: 18px;'>Book Name:</td>
        </tr>
        <tr>
            <td align="center"> <input type='text' name='book_name' required class="name" ></td>
        </tr>
        
        <tr>
            <td style='padding-left: 18px;'>Book Author:</td>
        </tr>
        <tr>
            <td align="center"><input type='text' name='book_author' required class="name"></td>
        </tr>
        <tr>
            <td style='padding-left: 18px;'>Book Category:</td>
        </tr>
        <tr>
            <td align="center">
                <?php
                    $cn=mysqli_connect("localhost","root","","library");
                    $result=mysqli_query($cn,"select distinct(c_name) from book_category");
                    echo "<select name='c_name'>";
                    while($option=mysqli_fetch_row($result))
                    {
                        echo "<option>$option[0]</option>";
                    }
                    echo "</select>";
                ?>
            </td>
        </tr>

        <tr>
            <td style='padding-left: 18px;'>Book Publication Year:</td>
        </tr>
        <tr>
            <td align="center"><input type='number' name='book_pub_year' required class="name"></td>
        </tr>   
        <tr>
        <tr><td style='padding-left: 18px;'>Add Cover-Photo:</td></tr>
        <tr>
        <td align="center"><input type="file" name="book-cover" class="file"></td></tr>

        <tr><td colspan='2' align="center"><input type="submit" name="book_submit" value="SUBMIT" ></td></tr> 
    </table>
 </form>
</div>

    
</body>
</html>
<?php

// Add book-------------
// if(isset($_POST['book_submit']))
// {
//     $book_name=$_POST['book_name'];
//     $book_author=$_POST['book_author'];
//     $book_category=$_POST['c_name'];
//     $book_pub_year=$_POST['book_pub_year'];

//     $cname=$_POST['c_name'];
//     if($cn)
//     {
//         $insert=mysqli_query($cn,"insert into book_info(book_name,book_author,c_name,pub_year) values('$book_name','$book_author','$book_category',$book_pub_year)");
//         if($insert)
//         {
//             echo "<script>window.alert('Book Successfully Inserted!!');</script>";
//         }
//         mysqli_close($cn);      
//     }
//     else
//     {
//         echo "<script>alert('Server Not Responding....Try Again Later..........');</script>";
//     }

// }

if(isset($_POST['book_submit']))
{
    $book_name=$_POST['book_name'];
    $book_author=$_POST['book_author'];
    $book_category=$_POST['c_name'];
    $book_pub_year=$_POST['book_pub_year'];

 if($cn)
 {            
    if(isset($_FILES['book-cover']))
    {
        $uploads_dir = 'book_img/';
        $tmp_name = $_FILES["book-cover"]["tmp_name"];
        $name = basename($_FILES["book-cover"]["name"]);
        $file=$uploads_dir.$name;
    
        if($file=='book_img/')
        {
            $insert=mysqli_query($cn,"insert into book_info(book_name,book_author,c_name,pub_year,copies) values('$book_name','$book_author','$book_category',$book_pub_year,5)");
        }
        else
        {

                $move=move_uploaded_file($tmp_name, "$uploads_dir/$name");
                
                if($move==true)
                {
                    $insert=mysqli_query($cn,"insert into book_info(book_name,book_author,c_name,pub_year,book_img,copies) value('$book_name','$book_author','$book_category',$book_pub_year,'$file',5)");
                    
                }
            
        }
    }
    else
    {
        $insert=mysqli_query($cn,"insert into book_info(book_name,book_author,c_name,pub_year,copies) values('$book_name','$book_author','$book_category',$book_pub_year,5)");   
    }
    if($insert)
    {
          echo "<script>window.alert('Book Successfully Inserted!!');</script>";
    }
    else
    {
        echo "<script>window.alert('There is an issue.. Please Try Again!!');</script>";        
    }
    mysqli_close($cn);

 } 
}



//Add category-----------
if((isset($_POST['c_name']))&&(isset($_POST['cat_submit'])))
{
    $cname=$_POST['c_name'];
    $row=mysqli_num_rows(mysqli_query($cn,"select * from book_category where c_name='$cname'"));
    if($row>0)
    {
        echo "<script>alert('Category Name Already Exist!!');</script>";
    }

 if($cn && $row==0)
 {            
    if(isset($_FILES['cover']))
    {
        $uploads_dir = 'category_img/';
        $tmp_name = $_FILES["cover"]["tmp_name"];
        $name = basename($_FILES["cover"]["name"]);
        $file=$uploads_dir.$name;
    
        if($file=='category_img/')
        {
            $insert_category=mysqli_query($cn,"insert into book_category(c_name) value('$cname')");
        }
        else
        {
            if(file_exists($file))
            {
                echo "<script>alert('File Name Already Exist!! Change File Name!!');</script>";
            }
            else
            {
                $move=move_uploaded_file($tmp_name, "$uploads_dir/$name");
                
                if($move==true)
                {
                    $insert_category=mysqli_query($cn,"insert into book_category(c_name,cover_img) value('$cname','$file')");
                    
                }
            }
        }
    }
    else
    {
        $insert_category=mysqli_query($cn,"insert into book_category(c_name) value('$cname')");        
    }
    if($insert_category)
    {
          echo "<script>window.alert('Category Successfully Inserted!!');</script>";
          header('Refresh: 0');
    }
    
 
    mysqli_close($cn);

 } 
 
}
?>