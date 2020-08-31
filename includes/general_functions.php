<?php
//msg function
function AlertMsg($msg,$header){
echo '<script>';
echo "alert('$msg');";
echo "window.location.assign('$header');";
echo '</script>';
}

function Alert($msg){
echo '<script>';
echo "alert('$msg');";
echo '</script>';
}

//Redirect URL
function RedirectURL($header){
echo '<script>';
echo "window.location.assign('$header');";
echo '</script>';
}

//Redirect URL in after time
function RefreshURL($time="10000"){
echo '<script>';
echo 'setTimeout(function(){';
echo ' location.reload();';
echo "},$time);";
echo '</script>';
}



//code here
//
//
//check user is super admin
function isSuperAdmin (){
    if(isset($_SESSION['userRole'])){
        if($_SESSION['userRole']=="Super Admin"){
            return true;
        }else{
            return false;
        }
    }
}

//check user is Manager
function isManager (){
    if(isset($_SESSION['userRole'])){
        if($_SESSION['userRole']=="Manager"){
            return true;
        }else{
            return false;
        }
    }
}

//check user is Data Export
function isDataExport (){
    if(isset($_SESSION['userRole'])){
        if($_SESSION['userRole']=="Data Export"){
            return true;
        }else{
            return false;
        }
    }
}

//check user is Accountant
function isAccountant (){
    if(isset($_SESSION['userRole'])){
        if($_SESSION['userRole']=="Accountant"){
            return true;
        }else{
            return false;
        }
    }
}

 //check login status of user
   function isLogin(){
    if(isset($_SESSION["userId"])){
        return true;
    }else{
        return false;
        }
    }
    
    
    
    
   
// file upload function
    function file_upload($file,$upload_path,$allowed_file_types=array('.doc','.docx','.rtf','.pdf','.png','.jpg','.jpeg','.gif','.zip','.rar'),$max_size=104857600){
	//function is created by Muhammad Ali | veerali95@gmail.com
	//by default size is allowed is 100MB
	//how use-> file_upload($_FILES['upload'],"upload/",[,size in bytes],[,array for extensions eg. array('.doc','.docx','.rtf','.pdf','.png','.jpg','.jpge','.gif','.zip','.rar')]);
	
	$filename = $file['name'];
	
	$file_basename = substr($filename, 0, strripos($filename, '.')); // get file name
	
	$file_ext = substr($filename, strripos($filename, '.')); // get file extension 
	
	$filesize = $file['size'];
	
	$allowed_file_types = $allowed_file_types;	

	if (in_array($file_ext,$allowed_file_types) && ($filesize < $max_size))
	{	
		// Rename file
		$newfilename = $file_basename."_".date('Ymdhis').$file_ext;
		
                $upload_path= $_SERVER['DOCUMENT_ROOT']."/".BASE_PATH.$upload_path; 
		
		if (file_exists($upload_path . $newfilename))
		{
			// file already exists error
			echo "You have already uploaded this file.";
			return false;
		}
		else
		{		
			move_uploaded_file($file['tmp_name'], $upload_path . $newfilename);
			//echo "File uploaded successfully.";	
			
			return $newfilename;
				
		}
	}
	elseif (empty($file_basename))
	{	
		// file selection error
		echo "Please select a file to upload.";
		return false;
	} 
	elseif ($filesize > $max_size)
	{	
		// file size error
		echo "The file you are trying to upload is too large.";
		return false;
	}
	else
	{
		// file type error
		echo "Only these file typs are allowed for upload: " . implode(', ',$allowed_file_types);
		unlink($file['tmp_name']);
		return false;
	}
	
	
    }
    
    
 //remove hacking tag form input   
 function remove_xss($data) {
  $data = trim($data);
  $data = stripslashes($data);
  
//$data = htmlspecialchars($data, ENT_QUOTES, 'UTF-8');

return $data;
}


//rate view
function rating_start_view($rate){
    if($rate>4){
                        echo "<a href='#'><span class='fa fa-star'></span></a>";
                        echo "<a href='#'><span class='fa fa-star'></span></a>";
                        echo "<a href='#'><span class='fa fa-star'></span></a>";
                        echo "<a href='#'><span class='fa fa-star'></span></a>";
                        echo "<a href='#'><span class='fa fa-star'></span></a>";
                          
    }elseif ($rate>3) {
                        echo "<a href='#'><span class='fa fa-star'></span></a>";
                        echo "<a href='#'><span class='fa fa-star'></span></a>";
                        echo "<a href='#'><span class='fa fa-star'></span></a>";
                        echo "<a href='#'><span class='fa fa-star'></span></a>";
                        echo "<a href='#'><span class='far fa-star'></span></a>";
    }
    elseif ($rate>2) {
                        echo "<a href='#'><span class='fa fa-star'></span></a>";
                        echo "<a href='#'><span class='fa fa-star'></span></a>";
                        echo "<a href='#'><span class='fa fa-star'></span></a>";
                        echo "<a href='#'><span class='far fa-star'></span></a>";
                        echo "<a href='#'><span class='far fa-star'></span></a>";
    }
    elseif ($rate>1) {
                        echo "<a href='#'><span class='fa fa-star'></span></a>";
                        echo "<a href='#'><span class='fa fa-star'></span></a>";
                        echo "<a href='#'><span class='far fa-star'></span></a>";
                        echo "<a href='#'><span class='far fa-star'></span></a>";
                        echo "<a href='#'><span class='far fa-star'></span></a>";
    }
    elseif ($rate>0) {
                        echo "<a href='#'><span class='fa fa-star'></span></a>";
                        echo "<a href='#'><span class='far fa-star'></span></a>";
                        echo "<a href='#'><span class='far fa-star'></span></a>";
                        echo "<a href='#'><span class='far fa-star'></span></a>";
                        echo "<a href='#'><span class='far fa-star'></span></a>";
    }
    elseif ($rate<=0) {
                        echo "<a href='#'><span class='far fa-star'></span></a>";
                        echo "<a href='#'><span class='far fa-star'></span></a>";
                        echo "<a href='#'><span class='far fa-star'></span></a>";
                        echo "<a href='#'><span class='far fa-star'></span></a>";
                        echo "<a href='#'><span class='far fa-star'></span></a>";
    }
}
    
	
	
	
//get your ip address
	function get_real_user_ip(){
  	/// This is to check ip from shared internet network
  	if(!empty($_SERVER['HTTP_CLIENT_IP'])){
  	$ip = $_SERVER['HTTP_CLIENT_IP'];
  	}
  	/// This is to check ip if it is passing from proxy network
  	elseif(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
  	$ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
  	}
  	else{
  	$ip = $_SERVER['REMOTE_ADDR'];
  	}
  	return $ip;
	}
	
        
              //input date into database 
function db_date_input($date){
            //use-> echo db_date_input("04/30/2020");
            return date('Y-m-d',strtotime($date));
        }
        
         //out data into database 
function db_date_output($date){
            //use-> echo db_date_output("2020-04-25");
            return date('d-m-Y',strtotime($date));
        }
		
		
function db_date_time_output($date){
            //use-> echo db_date_output("2020-04-25");
            return date('h:i:s a d-m-Y',strtotime($date));
        }

function db_time_output($time){
            //use-> echo db_date_output("2020-04-25");
            return date('h:i:s a',strtotime($time));
        }
        	
function send_mail($email_to,$subject,$body){
            global $view;
           $sender_mail=$view->app_config('APP_EMAIL_SEND_ADRESS');
           
           //test mail
           //$sender_mail="hassan@ccm-research.com";
           //test mail end
           
           $header= 'From:'.$sender_mail.''."\r\n";
           $header.='Content-type:text/html;charset=UTF-8'."\r\n";
            
            $res_mail= mail($email_to, $subject, $body,$header);
                if($res_mail){
                    return true;
                }else{
                    return false;
                }
            
        }
        
// send_mail("veerali95@gmail.com","Test Message","<h1>Hello World</h1>");
?>