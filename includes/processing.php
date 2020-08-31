<?php
include_once __DIR__."/../config/config.php";
include_once __DIR__."/Main.php";
include_once __DIR__."/User.php";
include_once __DIR__."/View.php";
//object of Main class
$main= new Main();
//object of User Class
$user= new User();
//object of view Class
$view= new View();
//object init end

include_once __DIR__."/general_functions.php";

//---------------all user input processing-----//


//user login
if(isset($_POST["admin_login"])){
    $result=$user->AdminLogin($_POST["userMail"], $_POST["userPass"]);
    if($result=="error_login"){
     //header("location:".BASE_URL."index.php");
     AlertMsg("Email/Password worng OR Account Deactive", BASE_URL."login.php");
    }else{
        RedirectURL(BASE_URL."index.php?dashboard");
    }

exit();
}

//create new user
if(isset($_POST["createNewUser"])) {
  if($user->isMailExist($_POST["email"])){
     AlertMsg("Email Address all ready in use", BASE_URL."index.php?users");
     exit();
    }else{
        $res=$main->insert_record("admin", array(
            "full_name"=> remove_xss($_POST['name']),
            "email"=> remove_xss($_POST['email']),
            "password"=> remove_xss(md5($_POST['pass'])),
            "phone"=> remove_xss($_POST['phone']),
            "role"=> remove_xss($_POST['role'])
        ));
        if($res!=FALSE){
            AlertMsg("Added Successfuly", BASE_URL."index.php?users");
            
        } else {
            AlertMsg("Fail", BASE_URL."index.php?users");
        }
         
        }
  exit();
  
}

//get part name
if(isset($_POST["ajaxpartyListiId"])){
    $res=$view->selectPartyName($_POST["ajaxpartyListiId"]);
    echo $res;
    
   exit();
}

//get apartment by building name
if(isset($_POST["ajaxBuildingId"])){
    $res=$view->selectApartmentByBuilding($_POST["ajaxBuildingId"]);
    echo $res;
    
   exit();
}

//get voucher account by type
if(isset($_POST["ajaxVoucherTypeId"])){
    $res=$view->selectVoucherAccountByType($_POST["ajaxVoucherTypeId"]);
    echo $res;
    exit();
}


//get apartment by party name
if(isset($_POST["ajaxPartyNameId"])){
    $getPartListId=$main->getSingleRecord("party_name", "id", $_POST["ajaxPartyNameId"]);
    if($getPartListId['party_list_id']!=3){
     $res=$view->selectApartmentByParty($_POST["ajaxPartyNameId"]);   
    }else{
       $res=$view->selectApartmentList();
    }
    
    echo $res;
    
   exit();
}



// send voucher info db
if(isset($_POST["createNewVoucher"])){
  //get subtotal amount  
  $total_amount= array_sum($_POST['amount']);
  //patment account
  $payment_acc=null;
  
  $vat_amount_sum=0;
  if($_POST['pay_method']=="Cheque"){
      $payment_acc=$view->app_config("APP_CHEQUE_ACCOUNT");
  }else{
      $payment_acc=$view->app_config("APP_CASH_ACCOUNT");
  }
  //insert data
   $res=$main->insert_record("vouchers", array(
       "type"=> remove_xss($_POST['v_type']),
       "ref_num"=> remove_xss($_POST['ref_no']),
       "payment_method"=> remove_xss($_POST['pay_method']),
       "v_date"=> remove_xss($_POST['v_date']),
       "party_list_id"=> remove_xss($_POST['party_list_id']),
       "party_name_id"=> remove_xss($_POST['party_name_id']),
       "apartment_id"=> remove_xss($_POST['apartment_id']),
       "sub_total"=> remove_xss($total_amount),
       "note"=> remove_xss($_POST['note']),
       "payment_account"=>remove_xss($_POST['v_account']),
       "create_by"=> remove_xss($_SESSION['userId'])
    ));
   if($res!=FALSE){
       if(isset($_POST['amount_type_id'])){
           $i=0;
          $counter_amount= count($_POST['amount_type_id']);
          for($i;$i<$counter_amount;$i++){
              //chcek VAT
              $vat_amount=0;
             //echo  $_POST['amount_type_vat'][$i];
             //die;
              if($_POST['amount_type_vat'][$i]=="Yes"){
              $vat_amount=($view->app_config("APP_VAT_PERCENT")*$_POST['amount'][$i])/100;  
              $vat_amount_sum+=$vat_amount;
              }
             $insert_amount=$main->insert_record("voucher_amount_detail", array(
              "voucher_id"=> remove_xss($res),
              "amount_type_id"=>remove_xss($_POST['amount_type_id'][$i]),
              "amount"=>remove_xss($_POST['amount'][$i]),
              "note"=>remove_xss($_POST['amount_note'][$i]),
              "vat_amount"=> remove_xss($vat_amount)
            )); 
            }
       }
       
        if(isset($_POST['cheque_no'])){
        $i=0;
        $counter_cheque=count($_POST['cheque_no']);
        for($i;$i<$counter_cheque;$i++){
             $insert_amount=$main->insert_record("voucher_cheques", array(
              "voucher_id"=> remove_xss($res),
              "cheque_no"=> remove_xss($_POST['cheque_no'][$i]),
              "bank"=> remove_xss($_POST['cheque_bank'][$i]),
              "amount"=> remove_xss($_POST['cheque_amount'][$i]),
              "due_date"=> remove_xss($_POST['cheque_date'][$i])
               )); 
            }
           
       }
       
       //update vat amount
       $vat_update=$main->update_record("vouchers", ["id"=>$res], ["vat_amount"=>$vat_amount_sum]);
   }
   if($res!=FALSE){
       //get all managers
       
       $manager=$main->getAllConditionRecords("admin","role","Manager","admin_id");
       if($manager!="NO_DATA"){
         //http://localhost/voucher_system/v.php?voucherapprovebylink&voucherid=10021&uid=1
         foreach ($manager as $manager){
           $msg='<center>';
           $msg.="<a href='".BASE_URL."v.php?voucherapprovebylink&voucherid=".$res."&uid=".$manager['admin_id']."'>Verified Voucher</a>";
           $msg.='</center>';
           send_mail($manager['email'],"New voucher verification",$msg);
         }
       }
       
       AlertMsg("Voucher Created Successfuly.",BASE_URL."index.php?dashboard");
   }else{
       AlertMsg("Problem",BASE_URL."index.php?dashboard");
   }
   
   
   
    
   exit();
}

//update voucher status
if(isset($_GET['voucherapprove']) && (isManager() || isSuperAdmin())){
    $id=$_GET['voucherId'];
    $res=$main->update_record("vouchers", ["id"=>$id], ["status"=>"Verified By Manager","verified_by"=>$_SESSION['userId']]);
    if($res=="UPDATED"){
        AlertMsg("Update Successfuly.", BASE_URL."index.php?dashboard");
    }else{
        AlertMsg("Fail", BASE_URL."index.php?dashboard");
    }
     exit();
}

//update voucher status
if(isset($_GET['voucherdecline']) && (isManager() || isSuperAdmin())){
    $id=$_GET['voucherId'];
    $res=$main->update_record("vouchers", ["id"=>$id], ["status"=>"Decline by Manager","verified_by"=>$_SESSION['userId']]);
    if($res=="UPDATED"){
        AlertMsg("Update Successfuly.", BASE_URL."index.php?dashboard");
    }else{
        AlertMsg("Fail", BASE_URL."index.php?dashboard");
    }
     exit();
}

//create new party
if(isSuperAdmin() && isset($_POST['createNewParty'])){
    $res=$main->insert_record("party_list", array(
        "name"=> remove_xss($_POST['name']),
        "description"=> remove_xss($_POST['note'])
      ));
    if($res!=FALSE){
        AlertMsg("Added Successfuly",BASE_URL."index.php?partylist");
        
    } else {
        AlertMsg("Fail.",BASE_URL."index.php?partylist");
    }
    exit();
}

//create new Voucher Account
if(isSuperAdmin() && isset($_POST['createVoucherAccount'])){
    $res=$main->insert_record("voucher_account", array(
        "account_type"=> remove_xss($_POST['pay_method']),
        "account"=> remove_xss(str_replace(' ', '-', $_POST['account'])),
        "open_balance"=> remove_xss($_POST['o_balance'])
      ));
    if($res!=FALSE){
        AlertMsg("Added Successfuly",BASE_URL."index.php?voucheraccount");
        
    } else {
        AlertMsg("Fail.",BASE_URL."index.php?voucheraccount");
    }
    exit();
}

//create new building
if((isSuperAdmin() || isManager() || isAccountant()) && isset($_POST['createNewBuilding'])){
    $res=$main->insert_record("building_list", array(
        "name"=> remove_xss($_POST['name'])
      ));
    if($res!=FALSE){
        AlertMsg("Added Successfuly",BASE_URL."index.php?buildinglist");
        
    } else {
        AlertMsg("Fail.",BASE_URL."index.php?buildinglist");
    }
    exit();
}

//create new party Apartment
if((isSuperAdmin() || isManager() || isAccountant()) && isset($_POST['createPartyApartment'])){
    $res=$main->insert_record("party_appartment_list", array(
        "party_list_id"=> remove_xss($_POST['party_list_id']),
        "party_name_id"=> remove_xss($_POST['party_name_id']),
        "building_id"=> remove_xss($_POST['building_id']),
        "appartment_id"=> remove_xss($_POST['apartment_id'])
      ));
    if($res!=FALSE){
        AlertMsg("Added Successfuly",BASE_URL."index.php?partyapartmentlist");
        
    } else {
        AlertMsg("Fail.",BASE_URL."index.php?partyapartmentlist");
    }
    exit();
}

//create new party name
if((isSuperAdmin() || isManager() || isAccountant()) && isset($_POST['createNewPartyName'])){
    $res=$main->insert_record("party_name", array(
        "party_list_id"=> remove_xss($_POST['party_list_id']),
        "party_name"=> remove_xss($_POST['name']),
        "unique_id"=>remove_xss($_POST['u_id'])
      ));
    if($res!=FALSE){
        AlertMsg("Added Successfuly",BASE_URL."index.php?partyname");
        
    } else {
        AlertMsg("Fail.",BASE_URL."index.php?partyname");
    }
    exit();
}

//create new apartment
if((isSuperAdmin() || isManager() || isAccountant()) && isset($_POST['createNewApartment'])){
    $res=$main->insert_record("appartment_list", array(
        "building_id"=> remove_xss($_POST['building_id']),
        "name"=> remove_xss($_POST['name'])
      ));
    if($res!=FALSE){
        AlertMsg("Added Successfuly",BASE_URL."index.php?apartmentlist");
        
    } else {
        AlertMsg("Fail.",BASE_URL."index.php?apartmentlist");
    }
    exit();
}

//create new amount type
if((isSuperAdmin() || isManager() || isAccountant()) && isset($_POST['createNewAmountType'])){
    $res=$main->insert_record("amount_type", array(
        "name"=> remove_xss($_POST['name']),
        "description"=> remove_xss($_POST['note'])
      ));
    if($res!=FALSE){
        AlertMsg("Added Successfuly",BASE_URL."index.php?amounttype");
        
    } else {
        AlertMsg("Fail.",BASE_URL."index.php?amounttype");
    }
    exit();
}

//update application setting
  if(isset($_POST['updateAppSetting']) && isSuperAdmin()){
      //echo "<pre>";
      //print_r($_POST);
      $result=array();
      $result['1']=$main->update_record("setting", ["key_value"=>"APP_VAT_PERCENT"], ["value"=>$_POST['APP_VAT_PERCENT']]);
      $result['2']=$main->update_record("setting", ["key_value"=>"APP_NAME"], ["value"=>$_POST['APP_NAME']]);
      $result['3']=$main->update_record("setting", ["key_value"=>"APP_COMPANY_ADDRESS"], ["value"=>$_POST['APP_COMPANY_ADDRESS']]);
      $result['4']=$main->update_record("setting", ["key_value"=>"APP_PO_BOX"], ["value"=>$_POST['APP_PO_BOX']]);
      $result['5']=$main->update_record("setting", ["key_value"=>"APP_CURRENCY_NAME"], ["value"=>$_POST['APP_CURRENCY_NAME']]);
      $result['6']=$main->update_record("setting", ["key_value"=>"APP_CURRENCY_SYMBOL"], ["value"=>$_POST['APP_CURRENCY_SYMBOL']]);
      $result['7']=$main->update_record("setting", ["key_value"=>"APP_TRN"], ["value"=>$_POST['APP_TRN']]);
      $result['8']=$main->update_record("setting", ["key_value"=>"APP_CASH_ACCOUNT"], ["value"=>$_POST['APP_CASH_ACCOUNT']]);
      $result['9']=$main->update_record("setting", ["key_value"=>"APP_CHEQUE_ACCOUNT"], ["value"=>$_POST['APP_CHEQUE_ACCOUNT']]);
      $result['10']=$main->update_record("setting", ["key_value"=>"APP_EMAIL_SEND_ADRESS"], ["value"=>$_POST['APP_EMAIL_SEND_ADRESS']]);
      $result['11']=$main->update_record("setting", ["key_value"=>"APP_MANAGER_EMAIL"], ["value"=>$_POST['APP_MANAGER_EMAIL']]);
     //print_r($result);
      if(!in_array("false",$result)){
          AlertMsg("Update Successfully", BASE_URL."index.php?setting");
      }else{
          AlertMsg("Problem.", BASE_URL."index.php?setting");
      }
      
      exit();
  }
  
//update voucher banner
  if(isset($_POST['updateVoucherBanner']) && isSuperAdmin()){
      $file= file_upload($_FILES['banner'], "uploads/",array('.png','.jpg'));
     if($file!=FALSE){
         $result=$main->update_record("setting", ["key_value"=>"APP_VOUCHER_HEADER_BANNER"], ["value"=>$file]);
         if($result=="UPDATED"){
              AlertMsg("Update Successfully", BASE_URL."index.php?setting");
         }else{
             AlertMsg("Problem.", BASE_URL."index.php?setting");
         }
     } else {
         AlertMsg("File Cannot upload. Try again", BASE_URL."index.php?setting");   
     }
     
      
      exit();
  } 
  
  //delete voucher
  if(isset($_GET['deletevoucher']) && isset($_GET['voucherId'])){
      $id=$_GET['voucherId'];
      if(empty($id)){
          AlertMsg("Voucher ID Required", BASE_URL."index.php?dashboard");
          exit();
      }
      //get voucher detail
      $v_detail=$main->getSingleRecord("vouchers", "id", $id);
      if($v_detail['status']!="Pending"){
          AlertMsg("Cannot Deleted.", BASE_URL."index.php?dashboard");
          exit();
      }
      if($v_detail['status']=="Pending"){
          //delete cheuqe detail
          $cheque=$main->deleteRecord("voucher_cheques","voucher_id",$id);
          //delete amount detail detail
          $amount=$main->deleteRecord("voucher_amount_detail","voucher_id",$id);
           //delete voucher detail detail
          $vouceher=$main->deleteRecord("vouchers","id",$id);
          AlertMsg("Deleted Successfuly", BASE_URL."index.php?dashboard");
          exit();
      }
      
 exit();     
  }
//update voucher using link
if(isset($_POST['voucherapprovebylink'])){
    //check account password
    if(isset($_POST['uid']) && !empty($_POST['uid'])){
        $u=$main->getSingleRecord("admin", "admin_id", $_POST['uid']);
        if($u['password']!= md5(remove_xss($_POST['userPass']))){
            AlertMsg("Account Password Wrong.",$_POST['url']);
            exit();
        }
       
    }
    
    $id=$_POST['vid'];
    $res=$main->update_record("vouchers", ["id"=>$id], ["status"=>$_POST['status'],"verified_by"=>$_POST['uid']]);
    if($res=="UPDATED"){
        AlertMsg("Update Successfuly.", BASE_URL."login.php");
    }else{
        AlertMsg("Fail", BASE_URL."login.php");
    }
    
exit();
}