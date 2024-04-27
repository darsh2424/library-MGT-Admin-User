<?php
    $cn=mysqli_connect("localhost","root","","library");
    if($cn)
    {
        $cnt=mysqli_num_rows(mysqli_query($cn,"select * from fine"));
        if($cnt>0)
        {
            $result=mysqli_query($cn,"select * from fine");
            foreach ($result as $row)
            {
                $day=date('d',strtotime($row['curr_date']))-date('d',strtotime($row['expected_return_date']));

                $email=$row['enroll'];
                $to_email=$email.".semcom@cvmu.edu.in";
                $subject="Return Book['Library']";
                // echo $row['expected_return_date'].$row['curr_date'].$day;
                // echo "<br>";

                // echo $to_email;
               if($day==-1)
               {
                    $req_id=$row['req_id'];
                    $qry=mysqli_fetch_assoc(mysqli_query($cn,"select * from issue_book where req_id=$req_id"));
                    $bookname=$qry['book_name'];
                    $issued_date=$qry['issued_date'];
                    $to      = $to_email;
                    $subject = $subject;
                    $message = 'Tomorrow is your last day to return your book-'.$bookname.' which you issued on '.$issued_date;
                    $headers = 'From:iamdarsh2424@gmail.com';
            
                    mail($to, $subject, $message, $headers);
                    //  if(mail($to, $subject, $message, $headers))
                    // {
                    //     echo "<h1>Successssssssss</h1>";
                    // }
               }

               else if($day==0)
               {
                $req_id=$row['req_id'];
                $qry=mysqli_fetch_assoc(mysqli_query($cn,"select * from issue_book where req_id=$req_id"));
                $bookname=$qry['book_name'];
                $issued_date=$qry['issued_date'];
                $to      = $to_email;
                $subject = $subject;
                $message = 'Today is your last day to return your book-'.$bookname.' which you issued on '.$issued_date;
                $headers = 'From:iamdarsh2424@gmail.com';
        
                mail($to, $subject, $message, $headers);
               }

                else if($day>0)
                {
                    $fine=$day*10;
                    $req_id=$row['req_id'];
                    $update=mysqli_query($cn,"update fine set total_fine=$fine where req_id=$req_id");

                    $qry=mysqli_fetch_assoc(mysqli_query($cn,"select * from issue_book where req_id=$req_id"));
                    $bookname=$qry['book_name'];
                    $issued_date=$qry['issued_date'];
                    $expected_date=$qry['expected_return_date'];
                    
                    $to      = $to_email;
                    $subject = $subject;
                    $message = 'Your Last Day To Return Book '.$bookname.' which was on '.$expected_date.' has already been passed so kindly pay fine of Rs. '.$fine;
                    $headers = 'From:iamdarsh2424@gmail.com';
            
                    mail($to, $subject, $message, $headers);
                }
            }

        }
        

    }


?>
<!-- date('d',strtotime($row['curr_date'])) -->