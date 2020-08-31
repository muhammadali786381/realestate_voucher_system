<?php

//-----------------------------below we can set all views---------------------------//
class View extends Main{
    /*
     * get all view that is used
     * 
     * 
     * 
     */
    
    //get APP_SETTING from DB Settig Table
    public function app_config($key_value){
        //user-> $obj->app_config("APP_NAME");
        $config= $this->getSingleRecord("setting", "key_value", $key_value);
        return $config['value'];
    }
    
    
    
    /*
     * DropDown Lists
     * 
     * 
     * 
     */
    
       
    //get Amount dropdown list
    public function selectAmountType(){
       $data= $this->getAllRecord("amount_type");
        if($data!="NO_DATA"){
            echo  "<option value="."".">Select Amount Type</option>"; 
         foreach ($data as $row){
            if($row['status']=="Active"){
              echo  "<option value=".$row['id'].">".$row['name']."</option>";  
            }
          }
       }
     }
     
    
     
      //get party list dropdown list
    public function selectPartyList(){
       $data= $this->getAllRecord("party_list");
        if($data!="NO_DATA"){
            echo  "<option value=''>Select Party</option>"; 
         foreach ($data as $row){
            if($row['status']=="Active"){
              echo  "<option value=".$row['id'].">".$row['name']."</option>";  
            }
          }
       }
     } 
     
       //get party list dropdown list
    public function selectPartyName($party_list_id){
       $data= $this->getAllRecord("party_name");
        if($data!="NO_DATA"){
            echo  "<option value=''>Select Party Name</option>"; 
         foreach ($data as $row){
            if($row['status']=="Active" && $row['party_list_id']==$party_list_id){
              echo  "<option value=".$row['id'].">".$row['unique_id']."-".$row['party_name']."</option>";  
            }
          }
       } else {
           echo  "<option value=''>No Data Found</option>"; 
       }
     }
     
    
     
     
       //get building list dropdown list
    public function selectBuildingList(){
       $data= $this->getAllRecord("building_list");
        if($data!="NO_DATA"){
            echo  "<option value=''>Select Building</option>"; 
         foreach ($data as $row){
            if($row['status']=="Active"){
              echo  "<option value=".$row['id'].">".$row['name']."</option>";  
            }
          }
       }
     }
     
        //get building list dropdown list
    public function selectApartmentList(){
       $data= $this->getAllRecord("appartment_list");
        if($data!="NO_DATA"){
            echo  "<option value=''>Select Apartment</option>"; 
         foreach ($data as $row){
            if($row['status']=="Active"){
                //get building name
                $build= $this->getSingleRecord("building_list", "id", $row['building_id']);
              echo  "<option value=".$row['id'].">".$build['name']. " - " .$row['name']."</option>";  
            }
          }
       }
     }
     
        //get party list dropdown list
    public function selectApartmentByBuilding($building_id){
       $data= $this->getAllRecord("appartment_list");
        if($data!="NO_DATA"){
            echo  "<option value=''>Select Appartment</option>"; 
         foreach ($data as $row){
            if($row['status']=="Active" && $row['building_id']==$building_id){
              echo  "<option value=".$row['id'].">".$row['name']."</option>";  
            }
          }
       } else {
           echo  "<option value=''>No Data Found</option>"; 
       }
     }
     
       //get party list dropdown list
    public function selectApartmentByParty($party_id){
       $data= $this->getAllRecord("party_appartment_list");
        if($data!="NO_DATA"){
            echo  "<option value=''>Select Apartment</option>"; 
         foreach ($data as $row){
            if($row['status']=="Active" && $row['party_name_id']==$party_id){
                //get apartment name
                $apartment= $this->getSingleRecord("appartment_list", "id", $row['appartment_id']);
              echo  "<option value=".$apartment['id'].">".$apartment['name']."</option>";  
            }
          }
       } else {
           echo  "<option value=''>No Data Found</option>"; 
       }
     } 
    
      //get oaymenth dropdown list
    public function selectPaymentMethod(){
       $data= $this->getAllRecord("payment_method");
        if($data!="NO_DATA"){
            echo  "<option value=''>Select Payment Method</option>"; 
         foreach ($data as $row){
            
              echo  "<option value=".$row['name'].">".$row['name']."</option>";  
           
          }
       }
     }
     
       //get oaymenth dropdown list
    public function selectVoucherAccount(){
       $data= $this->getAllRecord("voucher_account");
        if($data!="NO_DATA"){
            echo  "<option value=''>Select Voucher Account</option>"; 
         foreach ($data as $row){
            if($row['status']=="Active"){
              echo  "<option value=".$row['account'].">".$row['account_type']."-".$row['account']."</option>";   
            }
               
          }
       }
     }
     
        //get oaymenth dropdown list
    public function selectVoucherAccountByType($type){
       $data= $this->getAllRecord("voucher_account");
        if($data!="NO_DATA"){
            echo  "<option value=''>Select Voucher Account</option>"; 
         foreach ($data as $row){
            if($row['status']=="Active" && $row['account_type']==$type){
              echo  "<option value=".$row['account'].">".$row['account_type']."-".$row['account']."</option>";   
            }
               
          }
       }
     } 
     
     
     /*
      * End Dropdowns
      * 
      */
     
     
     
}
//$obj= new View();


//calling view class data
//echo $obj->app_config("APP_NAME");

//$obj->getAllTaskListByStatus("Assigned");