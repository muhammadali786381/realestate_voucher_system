<?php
include_once __DIR__.'/processing.php';

if(isLogin()){
    
    //dashboard
    if(isset($_GET["dashboard"])){
        //get all records data
        $voucher_detail=$main->getAllRecord("vouchers");
        //set view
        include_once __DIR__.'/../themes/default/dashboard.php';
        
        
    }
    
    
    //print voucher
    if(isset($_GET["viewvoucher"]) && isset($_GET["voucherId"])){
        $id=$_GET["voucherId"];
        //get all records data
        $voucher_detail=$main->getSingleRecord("vouchers","id",$id);
        
        if($voucher_detail!="NO_DATA"){
           $get_voucher_party=$main->getSingleRecord("party_list","id",$voucher_detail['party_list_id']);
           $get_voucher_party_name=$main->getSingleRecord("party_name","id",$voucher_detail['party_name_id']);
           $voucher_cheque_detail=$main->getAllConditionRecords("voucher_cheques","voucher_id",$voucher_detail['id'],"id","ASC");
           $voucher_amount_detail=$main->getAllConditionRecords("voucher_amount_detail","voucher_id",$voucher_detail['id'],"id","ASC");
                //get apartment name
                 $apartment=$main->getSingleRecord("appartment_list","id",$voucher_detail['apartment_id']);
                //get building name
                 $building=$main->getSingleRecord("building_list","id",$apartment['building_id']);
           
           $get_voucher_create_by=$main->getSingleRecord("admin","admin_id",$voucher_detail['create_by']);
           if($voucher_detail['verified_by']!=null){
               $get_voucher_verified_by=$main->getSingleRecord("admin","admin_id",$voucher_detail['verified_by']);
           }
           
           
           
         //set view
        include_once __DIR__.'/../themes/default/voucher_detail.php';
        }else{
            AlertMsg("ID cannot exsit.",BASE_URL."index.php?dashboard");
        }
        
        
        
    }
    //load party list
    if(isset($_GET["partylist"]) && ( isSuperAdmin() || isManager() || isAccountant())){
        $party_list=$main->getAllRecord("party_list");
        include_once __DIR__.'/../themes/default/party_list.php';
        
    }
    
    //load party names list
    if(isset($_GET["partyname"]) && ( isSuperAdmin() || isManager() || isAccountant())){
        $party_names=$main->getAllRecord("party_name");
        include_once __DIR__.'/../themes/default/party_names.php';
        
    }
    
    //load building list
    if(isset($_GET["buildinglist"]) && ( isSuperAdmin() || isManager() || isAccountant())){
        $building_list=$main->getAllRecord("building_list");
        include_once __DIR__.'/../themes/default/building_list.php';
        
    }
    
    //load apartment list
    if(isset($_GET["apartmentlist"]) && ( isSuperAdmin() || isManager() || isAccountant())){
        $apartment_list=$main->getAllRecord("appartment_list");
        include_once __DIR__.'/../themes/default/apartment_list.php';
     }
     
    
    //load aparty apartment list 
    if(isset($_GET["partyapartmentlist"]) && ( isSuperAdmin() || isManager() || isAccountant())){
        $party_apartment_list=$main->getAllRecord("party_appartment_list");
        include_once __DIR__.'/../themes/default/party_apartment_list.php';
     }
    
        //load amounttype
    if(isset($_GET["amounttype"]) && isSuperAdmin()){
        $amount_type=$main->getAllRecord("amount_type");
        include_once __DIR__.'/../themes/default/amount_type.php';
        
    }
    
    //load amounttype
    if(isset($_GET["voucheraccount"]) && isSuperAdmin()){
        $voucher_account=$main->getAllRecord("voucher_account");
        include_once __DIR__.'/../themes/default/voucher_account_list.php';
        
    }
    
    //load admins list
    if(isset($_GET["users"]) && isSuperAdmin()){
        $user_list=$main->getAllRecord("admin");
        include_once __DIR__.'/../themes/default/users_list.php';
        
    }
    
    //load setting list
    if(isset($_GET["setting"]) && isSuperAdmin()){
        include_once __DIR__.'/../themes/default/setting.php';
    }
    
   //load detail summery report
   if((isset($_GET["VoucherSummery"]) || isset($_GET["getSummery"])) && ( isSuperAdmin() || isManager() || isAccountant())){
       include_once __DIR__.'/../themes/default/voucher_summery_search_bar.php';
      
       //get search result
       if(isset($_GET["getSummery"]) && isset($_GET["summery_type"]) && isset($_GET["method"])){
           $all_voucher_balanace=$main->getAllRecord("vouchers");
           //get voucher account
           $v_account=$main->getSingleRecord("voucher_account","account",$_GET['v_account']);
           $balance=intval($v_account['open_balance']);
           if($all_voucher_balanace!="NO_DATA"){
              foreach ($all_voucher_balanace as $b){
               if(($b['v_date']<$_GET['from_date']) && ($b['status']=="Pending" || $b['status']=="Verified By Manager") && ($b['payment_account']==$_GET['v_account'])){
                   if($b['type']=="Receipt"){
                       $balance+=$b['sub_total']+$b['vat_amount'];
                   }else{
                   $balance-=$b['sub_total']+$b['vat_amount'];
                   }
               }
            } 
           }
            
           
           $voucher_summery=$main->getDateRangeRecord("vouchers","v_date",$_GET["from_date"],$_GET["to_date"]);
          
           //print_r($voucher_summery);
           include_once __DIR__.'/../themes/default/voucher_summery.php';
           
       }
    }
    
    
    
    
    
    
}
else{
    RedirectURL(BASE_URL."logout.php");
}




?>