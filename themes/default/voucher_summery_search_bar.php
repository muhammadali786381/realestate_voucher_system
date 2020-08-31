<!-- Begin Page Content -->
        <div class="container-fluid">
            
            
            <form action="" method="get">
            <div class="row">
                <div class="col-sm-2 mb-3 mb-sm-0">
                      <label>From</label>
                      <input type="date" name="from_date" class="form-control form-control-user" value="<?php echo (isset($_GET['from_date']))? $_GET['from_date']: "" ; ?>"  required="">
                  </div>
                   <div class="col-sm-2 mb-3 mb-sm-0">
                      <label>To</label>
                      <input type="date" name="to_date" class="form-control form-control-user" value="<?php echo (isset($_GET['to_date']))? $_GET['to_date']: "" ; ?>"  required="">
                  </div>
                 <div class="col-sm-2 mb-3 mb-sm-0">
                      <label>Funds Inflow & Outlflow</label>
                      <select class="form-control pay_method" name="method" id="pay_method" required="">
                          <?php
                          if(isset($_GET['method'])){
                              echo "<option value='".$_GET['method']."'>".$_GET['method']."</option>";
                          }
                          
                          echo $view-> selectPaymentMethod();
                          ?>
                      </select>
                  </div>
                
                 <div class="col-sm-2 mb-3 mb-sm-0">
                      <label>Voucher Account</label>
                      
                      <select class="form-control v_account" name="v_account" id="v_account" required="">
                        <?php
                          if(isset($_GET['method'])){
                              echo "<option value='".$_GET['v_account']."'>".$_GET['v_account']."</option>";
                          }
                         ?>
                     </select>
                      
                  </div>
                
                <div class="col-sm-2 mb-3 mb-sm-0">
                      <label>Summery Type</label>
                      <select class="form-control" name="summery_type" required="">
                           <?php
                          if(isset($_GET['summery_type'])){
                              echo "<option value='".$_GET['summery_type']."'>".$_GET['summery_type']."</option>";
                          }
                         ?>
                           <option value="">Select Type</option>
                          <option value="ShortSummery">Short Summery</option>
                          <option value="DetailSummery">Detail Summery</option>
                      </select>
                  </div> 
                  <div class="col-sm-2 mb-3 mb-sm-0">
                      <label></label>
                      <button type="submit" class="form-control btn btn-primary"  name="getSummery"><i class="fa fa-search"></i> Run Report</button>
                  </div>  
               </div>
        </form>
      </div>
        <!-- /.container-fluid -->
  <script type="text/javascript">
    $(document).ready(function() {
        //get vocher account by type
    $('.pay_method').change(function(){
        var formUrl = "index.php";
        var ajaxVoucherTypeId = $(this).children("option:selected").val();
      //alert(ajaxpartyListiId+formUrl);
         $.ajax({
		url : formUrl,
		method : "POST",
		data  : {ajaxVoucherTypeId},
		success : function(data){
                    //alert(data);
                    $(".v_account").html(data);
		}
		});

        });
      });
  </script>