
<div class="container container-fluid col-md-11" style="border-radius:10px; padding: 10px; box-shadow: 10px 10px 20px #888888;">
	<div class="row">
            <div class="row mx-auto">
            <button type="button" class="btn btn-info float-left" data-toggle="modal" data-target="#payInstallment"><strong >Pay Installment <span class="fa fa-money-check-alt"></span></strong></button>
            &nbsp;
            <button type="button" class="btn btn-info float-left" data-toggle="modal" data-target="#newSell"><strong >Sell New Product <span class="fa fa-edit"></span></strong></button>
            </div>
                <div class="col-md-12 col-sm-12 text-center">
                    <h1><b style="color:green;">Name:</b> <?php echo $client_detail['full_name'];  ?> | <b style="color:green;">Balance:</b> <?php echo $total_sell_amount-$total_pay_installments;  ?></h1>
                </div>
            <div class="col-lg-6">
                    <h5 class="font-weight-bold mb-4" style="color:green">Products Detail</h5>
                           <div class="table-responsive">
                            <table class="table table-bordered" id="couponTable" width="100%" cellspacing="0">
                              <thead>
                                <tr>
                                  <th>Name</th>
                                  <th width="70%">Detail</th>
                                </tr>
                              </thead>
                              <tfoot>
                                <tr>
                                  <th>Name</th>
                                  <th>Detail</th>
                                </tr>
                              </tfoot>
                              <tbody>
                                  <?php
                                  if($sell_products!="NO_DATA"):
                                      foreach ($sell_products as $row):
                                      //total amount
                                      $product_name=$main->getSingleRecord("products","id",$row['product_id']);
                                      $total_pay_for_sell=$main->sumValues("amount","installments","sell_id",$row['id']);
                                   ?>
                                <tr>
                                 <td><?php echo $product_name['name']; ?></td>
                                 <td><?php echo "<b>Price:</b> ". $row['price'] .
                                         "<br> <b>Fixed Installment:</b> ".$row['fix_installment']. 
                                         "<br> <b>Pay On:</b> ".$row['pay_on']. 
                                         "<br> <b>Description:</b> ".$row['description']. 
                                         "<br> <b>Create On:</b> ".$row['update_on'].
                                         "<br> <span style='color:green;'><b>Balance:</b> ".($row['price']-$total_pay_for_sell)."</span>"; 
                                 ?> 
                                 
                                 </td>
                                </tr>
                             <?php
                             //end loop
                             endforeach;
                             //end codition
                             endif;
                             ?>
                              </tbody>
                            </table>
                         </div>
                    </div>
            
            
            <div class="col-lg-6">
                    <h5 class="font-weight-bold mb-4" style="color:green">Installments Detail</h5>
                           <div class="table-responsive">
                            <table class="table table-bordered" id="userTable" width="100%" cellspacing="0">
                              <thead>
                                <tr>
                                  <th>Product</th>
                                  <th width="70%">Detail</th>
                                </tr>
                              </thead>
                              <tfoot>
                                <tr>
                                  <th>Product</th>
                                  <th>Detail</th>
                                </tr>
                              </tfoot>
                              <tbody>
                                  <?php
                                  if($all_installments!="NO_DATA"):
                                      foreach ($all_installments as $row):
                                      //total amount
                                      $product_ID=$main->getSingleRecord("sell_products","id",$row['sell_id']);
                                      $product_name=$main->getSingleRecord("products","id",$product_ID['product_id']);
                                   ?>
                                <tr>
                                 <td><?php echo "(".$row['id'].")".$product_name['name']; ?></td>
                                 <td><?php echo "<b>Received Amount</b> ". $row['amount'] ."<br><b>Note</b> ". $row['description']."<br><b>Pay On</b> ". $row['pay_on']."<br><b>Update On</b> ". $row['update_on']; ?></td>
                                </tr>
                             <?php
                             //end loop
                             endforeach;
                             //end codition
                             endif;
                             ?>
                              </tbody>
                            </table>
                         </div>
                    </div>
   
        </div>
</div>



 
 
 
  
  
  
  
    <!--Modal  change password-->
<div class="modal fade" id="payInstallment" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Pay Installment</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
        <form action="" method="POST">
      <div class="modal-body">
          <input type="hidden" name="clientId" value="<?php echo  $client_detail["id"] ; ?>">
          <label>Product</label>
          <select name="sell_id" class="form-control" required="">
              <option value="">Select Product</option>
                    <?php
                                  if($sell_products!="NO_DATA"):
                                      foreach ($sell_products as $row):
                                      $product_name=$main->getSingleRecord("products","id",$row['product_id']);
                                      
                                   ?>
              <option value="<?php echo $row['id'];?>"><?php echo $product_name['name']." | " .$row['description']." | ". $row['fix_installment'];?></option>
              
              <?php
                            //end loop
                             endforeach;
                             //end codition
                             endif;
              ?>
             </select>
          
          <label>Pay Amount</label>
          <input type="number" class="form-control" name="payAmount" value="" required="">
          <label>Date</label>
          <input type="text" class="form-control" id="cStartDate" name="payDate" value="" required="">
          <label>Note</label>
          <input type="text" class="form-control"  name="payNote" value="">
          <br>
        <button type="submit" name="payInstallment" class="btn btn-primary">Pay Now</button>  
      </div>
      </form>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
     </div>
    </div>
  </div>
</div>
    
    
    
 <!--Modal  change profile-->
<div class="modal fade" id="newSell" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Update Profile Images</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="" method="POST">
      <div class="modal-body">
          <input type="hidden" name="clientId" value="<?php echo  $client_detail["id"] ; ?>">
          <label>Product</label>
          <select name="product_id" class="form-control" required="">
              <option value="">Select Product</option>
                    <?php
                                  if($products_list!="NO_DATA"):
                                      foreach ($products_list as $row):
                                   ?>
              <option value="<?php echo $row['id'];?>"><?php echo $row['name']." | " .$row['description'];?></option>
              
              <?php
                            //end loop
                             endforeach;
                             //end codition
                             endif;
              ?>
             </select>
          
          <label>Price</label>
          <input type="number" class="form-control" name="TAmount" value="" required="">
          <label>Fixed Installment</label>
          <input type="text" class="form-control"  name="fix_installment" value="" required="">
          <label>Note</label>
          <input type="text" class="form-control"  name="Note" value="">
          <label>Pay On</label>
          <input type="text" class="form-control"  name="payOn" value="" placeholder="10th of Month">
          <br>
        <button type="submit" name="newSell" class="btn btn-primary">Sell Now</button>  
      </div>
      </form>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
     </div>
    </div>
  </div>
</div>
 
 
 
 
 



    
