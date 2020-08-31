<div class="container">
    <?php
   //echo  $actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
    ?>
    <!-- Outer Row -->
    <div class="row justify-content-center">
      <div class="col-xl-6 col-lg-6 col-md-6">

        <div class="card o-hidden border-0 shadow-lg my-5">
          <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
              <div class="col-lg-12">
                <div class="p-5">
                  <div class="text-center">
                      
                      <h1 class="h4 text-gray-900 mb-4">Voucher Verification<br> 
                          <span style="color:white;background-color:green; padding:2px; border-radius:5px;"><b>Voucher ID: <?php echo $v_id;?></b></span>
                      </h1>
                      <p class="">Amount: <?php echo $v_detail['sub_total']." (".$view->app_config("APP_CURRENCY_SYMBOL"). ")"?></p>
                  </div>
                    <form class="user" method="POST" action="">
                    <div class="form-group">
                        <select class="form-control" name="status" required="">
                            <option value=""> Select Status </option>
                            <option value="Verified By Manager"> Verified</option>
                            <option value="Decline by Manager"> Decline</option>
                        </select>
                    </div>
                    <div class="form-group">
                      <input type="password" class="form-control" name="userPass" placeholder="Password">
                      <input type="hidden" class="form-control" name="uid" value="<?php echo $u_id;?>"  placeholder="">
                      <input type="hidden" class="form-control" name="vid" value="<?php echo $v_id;?>"  placeholder="">
                      <input type="hidden" class="form-control" name="url" value="<?php echo (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";?>"  placeholder="">
                    </div>
                   
                        <button type="submit" name="voucherapprovebylink" class="btn btn-primary btn-user btn-block"> Update</button>
                  </form>
               </div>
             
            </div>
          </div>
        </div>

      </div>

    </div>

  </div>
