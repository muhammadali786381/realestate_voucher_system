<?php
//echo "<pre>";
//print_r($client_detail);
?>
<!-- Begin Page Content -->
        <div class="container-fluid">

         <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Setting</h1>
            <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"  data-toggle="modal" data-target="#logoutModal"><i class="fas fa-edit fa-sm text-white-100"></i> Update Voucher Banner</a>
         </div>
          <!-- DataTales coupon -->
          <div class="card shadow mb-4">
            <div class="card-body">
                <div class="p-5">
                    <form class="user" method="POST" enctype="multipart/form-data">
                   <div class="form-group">
                    <label class="text-primary">Application Name</label>
                    <input type="text"  class="form-control"  name="APP_NAME" value="<?php echo $view->app_config("APP_NAME");?>" required="">
                    </div>
                    <div class="form-group">
                    <label class="text-primary">Address</label>
                    <input type="text"  class="form-control"  name="APP_COMPANY_ADDRESS" value="<?php echo $view->app_config("APP_COMPANY_ADDRESS");?>" required="">
                    </div>
                    <div class="form-group">
                    <label class="text-primary">P.O Box</label>
                    <input type="text"  class="form-control"  name="APP_PO_BOX" value="<?php echo $view->app_config("APP_PO_BOX");?>" required="">
                    </div>
                     <div class="form-group">
                    <label class="text-primary">Currency Name</label>
                    <input type="text"  class="form-control"  name="APP_CURRENCY_NAME" value="<?php echo $view->app_config("APP_CURRENCY_NAME");?>" required="">
                    </div> 
                     <div class="form-group">
                    <label class="text-primary">Currency Symbol</label>
                    <input type="text"  class="form-control"  name="APP_CURRENCY_SYMBOL" value="<?php echo $view->app_config("APP_CURRENCY_SYMBOL");?>" required="">
                    </div>
                     <div class="form-group">
                    <label class="text-primary">VAT %Age (only numeric value e.g 5)</label>
                    <input type="number"  class="form-control"  name="APP_VAT_PERCENT" value="<?php echo $view->app_config("APP_VAT_PERCENT");?>" required="">
                    </div>  
                    <div class="form-group">
                    <label class="text-primary">TRN</label>
                    <input type="text"  class="form-control"  name="APP_TRN" value="<?php echo $view->app_config("APP_TRN");?>" required="">
                    </div> 
                     <div class="form-group">
                    <label class="text-primary">Application Cash Account</label>
                    <input type="text"  class="form-control"  name="APP_CASH_ACCOUNT" value="<?php echo $view->app_config("APP_CASH_ACCOUNT");?>" required="">
                    </div> 
                     <div class="form-group">
                    <label class="text-primary">Application Cheque Account</label>
                    <input type="text"  class="form-control"  name="APP_CHEQUE_ACCOUNT" value="<?php echo $view->app_config("APP_CHEQUE_ACCOUNT");?>" required="">
                    </div>  
                     <div class="form-group">
                    <label class="text-primary">Manager email for verification system</label>
                    <input type="text"  class="form-control"  name="APP_MANAGER_EMAIL" value="<?php echo $view->app_config("APP_MANAGER_EMAIL");?>" required="">
                    </div>
                    <div class="form-group">
                    <label class="text-primary">Email for sending verification link</label>
                    <input type="text"  class="form-control"  name="APP_EMAIL_SEND_ADRESS" value="<?php echo $view->app_config("APP_EMAIL_SEND_ADRESS");?>" required="">
                    </div>    
                  
                    
                <button  type="submit" name="updateAppSetting" class="btn btn-primary btn-user btn-block">
                 Update
               </button>
              </form>
           </div>
        </div>
          </div>

        </div>
        <!-- /.container-fluid -->
        
        
       <!-- create new coupon model-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Update Banner Image</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
                     <div class="p-5">
                    <form class="user" method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                    <label class="text-primary">Select File (PNG or JPG)</label>
                    <input type="file" name="banner" class="form-control" required="">
                    </div>    
                   
                <button  type="submit" name="updateVoucherBanner" class="btn btn-primary btn-user btn-block">
                 Update
               </button>
              </form>
           </div>
        
        </div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
        </div>
      </div>
    </div>
  </div>       
 

