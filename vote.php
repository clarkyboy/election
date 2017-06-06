<?php
	include_once('db.php');

       if(isset($_POST['vote']))
                {
                   
                    $hobb=  $_POST['candidates'];
                    if(empty($hobb)) 
                        {
                            echo '<script type="text/javascript">alert("You didn\'t select a lawfirm")</script>';
                        } 
                        else 
                        {
                            $N = count($hobb);
                            if($N == 13){

                                 for($i=0; $i < $N; $i++)
                                    {
                                        $var1=$hobb[$i];
                                        vote($var1);
                                        echo '<script type="text/javascript">alert("Successfully Added!")</script>';
                                    }
                            }
                            else{
                                echo '<script type="text/javascript">alert("Choose 13. No more, no less!")</script>';
                            }
                           
                        // mailer($email, $userid);
                        header("Location: index.php");
                        }
               }
?>

