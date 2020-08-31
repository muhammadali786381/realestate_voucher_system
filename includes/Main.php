<?php
class Main{
 private $con;
  //connect to database  
  function __construct() {
        include_once __DIR__.'/../config/database.php';
        $db= new Db();
        $this->con=$db->connect();
    }
    
    
    //run any query 
    public function query($query){
                $pre_stmt = $this->con->prepare($query);
		$pre_stmt->execute() or die($this->con->error);
                $result=$pre_stmt->get_result();
                //$row=$result->fetch_assoc();
                if($result){
                   //$result = $result;
                   return $result;
                }else{
                    return false;
                }
    }


    //insert data in any table
     public function insert_record($table,$fileds){
         //using-> $obj->insert_record("tbl_name",array("m_name" => $_POST["name"],"m_name" => $_POST["name"]))
        //"INSERT INTO table_name (, , ) VALUES ('m_name','qty')";
        $sql = "";
        $sql .= "INSERT INTO ".$table;
        $sql .= " (".implode(",", array_keys($fileds)).") VALUES ";
        $sql .= "('".implode("','", array_values($fileds))."')";
        $query = mysqli_query($this->con,$sql);
        //check query
                if($query){
                        return $this->con->insert_id;
                    }else{
                        return false;
                }

        }
        
        //select function
        public function select_records($table,$fileds,$logical_operator="AND"){
        //using-> $res=$test->select_record("users", array("status"=>"Active"));
       //SELECT * FROM users WHERE user_id='1' AND full_name='Muhammmad Ali' AND status='Active';
        $sql = "";
        $sql .= "SELECT * FROM ".$table." WHERE";
            if(is_array($fileds)){
                $end=count($fileds);
                $i=1;
                foreach($fileds as $key => $value){
                    $sql .= " ".$key."='".$value."' ";
                    if($i<$end){
                    $sql .= "".$logical_operator."";
                    }
                    $i++;
                }
              
            }else{
                return false;
            }
                $pre_stmt =$this->con->prepare($sql);
		$pre_stmt->execute() or die($this->con->error);
                $result=$pre_stmt->get_result();
               $rows = array();
		if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()){
				$rows[] = $row;
			}
                       
			return $rows;
                        
		}
		return "NO_DATA";
        }
    
   //get any table
   public function getAllRecord($table){
		$pre_stmt = $this->con->prepare("SELECT * FROM ".$table);
		$pre_stmt->execute() or die($this->con->error);
		$result = $pre_stmt->get_result();
		$rows = array();
		if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()){
				$rows[] = $row;
			}
                       
			return $rows;
                        
		}
		return "NO_DATA";
	}
        
        //get all records base on condition
	public function getAllConditionRecords($table,$pk,$id,$colOrder,$order="DESC"){
		$pre_stmt = $this->con->prepare("SELECT * FROM ".$table." WHERE ".$pk."= ? ORDER BY ".$table.".".$colOrder." ".$order."");
                $pre_stmt->bind_param("s",$id);
		$pre_stmt->execute() or die($this->con->error);
		$result = $pre_stmt->get_result();
		$rows = array();
		if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()){
				$rows[] = $row;
			}
                       
			return $rows;
                        
		}
		return "NO_DATA";
        }
        
        //geting sort records
        public function getSortRecord($table,$colOrder,$order="DESC"){
                $sql="SELECT * FROM ".$table." ORDER BY ".$table.".".$colOrder." ".$order."";
                $pre_stmt = $this->con->prepare($sql);
		$pre_stmt->execute() or die($this->con->error);
		$result = $pre_stmt->get_result();
		$rows = array();
		if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()){
				$rows[] = $row;
			}
                       //echo "<pre>";
			return $rows;
                        
		}
		return "NO_DATA";
                 
                
	}
        
        //delete Record
    public function deleteRecord($table,$pk,$id){
		
			$pre_stmt = $this->con->prepare("DELETE FROM ".$table." WHERE ".$pk." = ?");
			$pre_stmt->bind_param("i",$id);
			$result = $pre_stmt->execute() or die($this->con->error);
				if ($result) {
					return "DELETED";
                                }else{
                                    return "NOT_DELETED";
                                }
			
	}

        //get singlerecord
	public function getSingleRecord($table,$pk,$id){
		$pre_stmt = $this->con->prepare("SELECT * FROM ".$table." WHERE ".$pk."= ? ORDER BY ".$table.".".$pk." DESC LIMIT 1");
		$pre_stmt->bind_param("s",$id);
		$pre_stmt->execute() or die($this->con->error);
		$result = $pre_stmt->get_result();
                if ($result->num_rows == 1) {
			$row = $result->fetch_assoc();
                        return $row;
                }else{
                    return "NO_DATA";
                }
		
	}
        //update records
        public function update_record($table,$where,$fields){
                $sql = "";
		$condition = "";
		foreach ($where as $key => $value) {
			// id = '5' AND m_name = 'something'
			$condition .= $key . "='" . $value . "' AND ";
		}
		$condition = substr($condition, 0, -5);
		foreach ($fields as $key => $value) {
			//UPDATE table SET m_name = '' , qty = '' WHERE id = '';
			$sql .= $key . "='".$value."', ";
		}
		$sql = substr($sql, 0,-2);
		$sql = "UPDATE ".$table." SET ".$sql." WHERE ".$condition;
		if(mysqli_query($this->con,$sql)){
			return "UPDATED";
                }else{
                    return false;
                }
	}   
        
        //visitor msg add into database
        public function visitorMsgAdd($visitorName,$visitorCountry,$visitorMail,$userPhone,$visitorCompany,$msg){
        $pre_statm= $this->con->prepare("INSERT INTO `visitor_message`(`sender_name`,`sender_country`,`sender_mail`,`sender_phone`,`senderCompany`,`msg`)
               VALUES(?,?,?,?,?,?)");
        $pre_statm->bind_param("ssssss",$visitorName,$visitorCountry,$visitorMail,$userPhone,$visitorCompany,$msg);
        $result=$pre_statm->execute();
        if($result){
            //echo $this->con->insert_id;
            return "msg_submited";
        }else{
            //echo "user_cannot_created";
            return "error_in_msg";
        }
    }
    
    
        
    //add new country
       public function addCountry($country_name,$country_des)
        {   
        $pre_statm= $this->con->prepare("INSERT INTO `country`(`country_name`, `country_des`)
               VALUES(?,?)");
        $pre_statm->bind_param("ss",$country_name,$country_des);
        $result=$pre_statm->execute();
        if($result){
            //echo $this->con->insert_id;
            return "country_updated";
        }else{
            //echo "user_cannot_created";
            return "country_cannot_update";
        }
      }
      
      
      //add new city
       public function addCity($country_id,$city_name,$city_des)
        {   
        $pre_statm= $this->con->prepare("INSERT INTO `city`(`country_id`, `city_name`, `city_des`)
               VALUES(?,?,?)");
        $pre_statm->bind_param("iss",$country_id,$city_name,$city_des);
        $result=$pre_statm->execute();
        if($result){
            //echo $this->con->insert_id;
            return "city_updated";
        }else{
            //echo "user_cannot_created";
            return "city_cannot_update";
        }
      }
      
      
      //sum transction
       public function sumValues($table,$sumColumm,$pk,$id)
        {   
                //use-> $res=$test->sumValues("consultant_withdraw_request","amount","user_id","100003");                         
                $pre_stmt = $this->con->prepare("SELECT SUM(".$sumColumm.") FROM ".$table." WHERE ".$pk."=?");
		$pre_stmt->bind_param("s",$id);
		$pre_stmt->execute() or die($this->con->error);
		$result = $pre_stmt->get_result();
                $row = $result->fetch_assoc();
                $res=$row["SUM($sumColumm)"];
                return $res;
        }
        
        //sum transction base on two condtion
       public function sumValuesBaseTwoCondtion($table,$sumColumm,$pk_1,$id_1,$pk_2,$id_2)
        {   
                //use->  $res=$test->sumValuesBaseTwoCondtion("consultant_withdraw_request","amount","user_id","100003","status","Verified");                   
                $pre_stmt = $this->con->prepare("SELECT SUM(".$sumColumm.") FROM ".$table." WHERE ".$pk_1."=? AND ".$pk_2."=?");
		$pre_stmt->bind_param("ss",$id_1,$id_2);
		$pre_stmt->execute() or die($this->con->error);
		$result = $pre_stmt->get_result();
                $row = $result->fetch_assoc();
                $res=$row["SUM($sumColumm)"];
                return $res;
        }
        
        
        //count data
         public function CountData($count_col,$table){
            $pre_stmt= $this->con->prepare("SELECT COUNT(".$count_col.")FROM ".$table);
            $pre_stmt->execute() or die($this->con->error);
            $result = $pre_stmt->get_result();
            $row=$result->fetch_assoc();
            $res=$row["COUNT($count_col)"];
            return $res;
            
        }
        //get counted data with condtion
        public function CountDataCondition($count_col,$table,$id){
                //$query = $this->con->query("SELECT COUNT(*)AS rows FROM products WHERE status=0");
		//$row = mysqli_fetch_assoc($query);
           // $sql = "SELECT COUNT(*)FROM products WHERE status=1";
            
            $pre_stmt= $this->con->prepare("SELECT COUNT(*)FROM ".$table." WHERE ".$count_col."=? ");
            $pre_stmt->bind_param("s",$id);
            $pre_stmt->execute() or die($this->con->error);
            $result = $pre_stmt->get_result();
            $row=$result->fetch_assoc();
            $res=$row['COUNT(*)'];
            return $res;
            
        }
        
        
          //get completed counted Project by Client
        public function CountDatTwoCondition($table,$col_nam_1,$id_1,$col_nam_2,$id_2){
            //how to use->CountDatTwoCondition("post_service","client_id",2,"status","Completed");
                //$query = $this->con->query("SELECT COUNT(*)AS rows FROM products WHERE status=0");
		//$row = mysqli_fetch_assoc($query);
          // echo  $sql = "SELECT COUNT(*)FROM ".$table." WHERE ".$col_nam_1."='".$id_1."' AND ".$col_nam_2."='".$id_2."'";
            $pre_stmt= $this->con->prepare("SELECT COUNT(*)FROM ".$table." WHERE ".$col_nam_1."='".$id_1."' AND ".$col_nam_2."='".$id_2."'");
            $pre_stmt->execute() or die($this->con->error);
            $result = $pre_stmt->get_result();
            $row=$result->fetch_assoc();
            $res=$row['COUNT(*)'];
            return $res;
            
        }
        
        
        //get avg data with condtion
        public function AvgDataCondition($table,$condition_col_name,$user_id,$rate_col_name){
            /*how to use
             *  $rate=$test->AvgDataCondition("rating","professional_id",1,"rate");
             *  $rate=intval($rate);
             *   echo $rate; 
             *
             */
            $pre_stmt= $this->con->prepare("SELECT AVG(".$rate_col_name.") FROM ".$table." WHERE ".$condition_col_name."=".$user_id);
            $pre_stmt->execute() or die($this->con->error);
            $result = $pre_stmt->get_result();
            $row=$result->fetch_assoc();
            $res=$row["AVG($rate_col_name)"];
            return $res;
            //return $result;
            
        }
        
        //SELECT users.* FROM users WHERE DATE(create_on) BETWEEN '2020-07-08' AND '2020-07-26'
                
         public function getDateRangeRecord($table,$field,$date_from,$date_to){
             //how to user-> $res=$test->getDateRangeRecord("vouchers","v_date","2020-08-15","2020-08-15");
              $pre_stmt= $this->con->prepare("SELECT ".$table.".* FROM ".$table." WHERE DATE(".$field.") BETWEEN '".$date_from."' AND '".$date_to."'");
              $pre_stmt->execute() or die($this->con->error);
	      $result = $pre_stmt->get_result();
		$rows = array();
		if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()){
				$rows[] = $row;
			}
                       
			return $rows;
                        
		}
		return "NO_DATA";
             
         }
      
      
      
     	
           
           
        
}

//$test =new Main();
//$test->addClientOrder(1,2,"500 KG",1,"Muhammad Ali","92300000","ADada","Hassan","9220000","1","dadadad","700.2","2020-02-01","00:00","Cash on delivery");
//$res=$test->sumValues("amount","tbl_transactions","user_id","19");
//print_r($res); 
//echo $res['SUM(amount)'];
 //$test->visitorMsgAdd("visitorName","visitorCountry","visitorMail","userPhone","visitorCompany","msg");
// $rate=$test->AvgDataCondition("rating","professional_id",1,"rate");
// $rate=intval($rate);
// echo $rate; 
//user of query function for any query
////$res=$test->query("DELETE FROM users WHERE user_id='1'");
//$row=$res->fetch_assoc();
//$get_row=$test->get_result();
//echo "<pre>";
//print_r($row);
//$res=$test->sumValuesBaseTwoCondtion("consultant_withdraw_request","amount","user_id","100003","status","Verified");
//$res=$test->getDateRangeRecord("vouchers","v_date","2020-08-15","2020-08-15");
// "<pre>";
//print_r($res);
    
    