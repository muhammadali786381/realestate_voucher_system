<?php
//echo "<pre>";
//print_r($client_detail);
//RefreshURL();
?>
<!-- Begin Page Content -->
        <div class="container-fluid">

         <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Voucher Detail</h1>
            <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"  data-toggle="modal" data-target="#logoutModal"><i class="fas fa-edit fa-sm text-white-100"></i> Create New</a>
          </div>
          <!-- DataTales coupon -->
          <div class="card shadow mb-4">
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="Table01" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Voucher#</th>
                      <th>Type</th>
                      <th>Date</th>
                      <th>Sub Total</th>
                      <th>Status</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                 
                  <tbody>
                      <?php
                     if($voucher_detail!="NO_DATA"):
                          foreach ($voucher_detail as $voucher):
                             
                      ?>
                  <tr> 
                  <td><a href="<?php BASE_URL?>index.php?viewvoucher&voucherId=<?php echo $voucher['id'];?>"><?php echo $voucher['id']; ?></a> </td>
                  <td><?php echo $voucher['type']; ?></td>
                  <td><?php echo db_date_output($voucher['v_date']); ?></td>
                  <td><?php echo number_format($voucher['sub_total'],2); ?></td>
                  <td style="color:green;"><b><?php echo $voucher['status']; ?></b></td>
                  <td>
                      <a href="<?php BASE_URL?>index.php?viewvoucher&voucherId=<?php echo $voucher['id'];?>" class="btn btn-primary"><i class="fas fa-book"></i> Detail</a>  
                      <?php
                      if((isManager() || isSuperAdmin()) && $voucher['status']=="Pending"):
                      ?>
                      <a href="<?php BASE_URL?>index.php?voucherapprove&voucherId=<?php echo $voucher['id'];?>" class="btn btn-danger"><i class="fa fa-check"></i> Approve</a>
                      <a href="<?php BASE_URL?>index.php?voucherdecline&voucherId=<?php echo $voucher['id'];?>" class="btn btn-info"><i class="fa fa-times"></i> Decline</a>
                    <?php
                      endif;
                      ?>
                      
                      <?php
                      if($voucher['status']=="Pending"):
                      ?>
                      <a href="<?php BASE_URL?>index.php?deletevoucher&voucherId=<?php echo $voucher['id'];?>" class="btn btn-danger"><i class="fa fa-trash"></i> Delete</a>
                     <?php
                      endif;
                      ?> 
                      
                  </td>
                 </tr>
                 <?php
                   
                 //end loop
                 endforeach;
                 //end codition
                 endif;
                 ?>
                  <tfoot>
                    <tr>
                      <th>Voucher#</th>
                      <th>Type</th>
                      <th>Date</th>
                      <th>Total</th>
                      <th>Status</th>
                      <th>Action</th>
                    </tr>
                  </tfoot>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
    </div>
        <!-- /.container-fluid -->
        
        
        <!-- create new coupon model-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Create New Voucher</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
                     <div class="p-5">
                         <form class="user" method="POST" enctype="multipart/form-data">
                     <div class="form-group">
                    <label class="text-primary">Type</label>
                    <select class="form-control" name="v_type" required="">
                        <option value="">Select Voucher Type</option>
                        <option value="Receipt">Receipt</option>
                        <option value="Payment">Payment</option>
                     </select>
                     </div>
                    <div class="form-group">
                    <label class="text-primary">Payment Method</label>
                    <select class="form-control pay_method" name="pay_method" id="pay_method" required="">
                        <?php
                        $view->selectPaymentMethod();
                        ?>
                     </select>
                    </div>
                    <div class="form-group">
                    <label class="text-primary">Voucher Account</label>
                    <select class="form-control v_account" name="v_account" id="v_account" required="">
                        <?php
                        //$view->selectVoucherAccount();
                        ?>
                     </select>
                    </div>         
                    <div class="form-group">
                    <label class="text-primary">Date</label>
                    <input type="date"  class="form-control"  name="v_date" value="" required="">
                    </div>
                             
                    <div class="form-group">
                    <label class="text-primary">Party</label>
                    <select class="form-control party_list_id" name="party_list_id" id="party_list_id" required="">
                        <?php
                        $view->selectPartyList();
                        ?>
                     </select>
                    </div>
                             
                    <div class="form-group">
                    <label class="text-primary">Party Name</label>
                    <select class="form-control party_nmae_id" name="party_name_id" id="party_name_id" required="">
                        <!--coming from ajax-->
                        
                     </select>
                    </div>
                    
                    <div class="form-group">
                    <label class="text-primary">Apartment</label>
                    <select class="form-control apartment_id" name="apartment_id" id="apartment_id" required="">
                        <!--coming from ajax-->
                        
                     </select>
                    </div>         
                             
                             
                    <div class="form-group">
                    <label class="text-primary">Amount Detail</label>
                    <table id="amount_fieds_tbl" class="table table-bordered">
                            <tr class="text-center">
                                <td>On Account of</td>
                                <td>Short Note</td>
                                <td>Amount</td>
                                <td>VAT</td>
                                <td><button type="button" class="btn btn-primary add-more-amount" ><b>+</b></button></td>
                            </tr>
                          <!-- Coming form ajax-->
                    </table>
                   </div>
                         
                    <div class="form-group">
                    <label class="text-primary">Cheque Detail</label>
                    <table id="cheque_fieds_tbl" class="table table-bordered">
                            <tr class="text-center">
                                <td>Cheque #</td>
                                <td>Cheque Due Date</td>
                                <td>Bank</td>
                                <td>Cheque Amount</td>
                                <td><button type="button" class="btn btn-primary add-more-cheque" ><b>+</b></button></td>
                            </tr>
                          <!-- Coming form ajax-->
                    </table>
                   </div>         
                             
                             
                    <div class="form-group">
                    <label class="text-primary">Note</label>
                    <textarea type="text"  class="form-control"  name="note"  required=""></textarea>
                    </div>         
                    
                   <div class="form-group">
                    <label class="text-primary">Reference No</label>
                    <input type="text"  class="form-control"  name="ref_no" value="">
                   </div>
                             
               <button  type="submit" name="createNewVoucher" class="btn btn-primary btn-user btn-block">
                 Create
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
<script type="text/javascript">
    $(document).ready(function() {
//        setTimeout(function(){
//        location.reload();
//        },10000);

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
      
        
        
     //get Party name 
    $('.party_list_id').change(function(){
        var formUrl = "index.php";
        var ajaxpartyListiId = $(this).children("option:selected").val();
      //alert(ajaxpartyListiId+formUrl);
         $.ajax({
		url : formUrl,
		method : "POST",
		data  : {ajaxpartyListiId},
		success : function(data){
                    //alert(data);
                    $(".party_nmae_id").html(data);
		}
		});

        });
      
        //get Party name
    $('.party_nmae_id').change(function(){
        var formUrl = "index.php";
        var ajaxPartyNameId = $(this).children("option:selected").val();
      //alert(ajaxpartyListiId+formUrl);
         $.ajax({
		url : formUrl,
		method : "POST",
		data  : {ajaxPartyNameId},
		success : function(data){
                    //alert(data);
                    $(".apartment_id").html(data);
		}
		});

        });
    
   
    //add new amount field
        add_amount_row();
    $(document).on('click', '.add-more-amount', function(){
        add_amount_row();
     });
     //function to add new row from amount
    function add_amount_row(){
         var html = '';
         html +='<tr>';
         html +='<td>';
         html +='<select id="amount_type_id" name="amount_type_id[]" required="" class="form-control">';
         html +='<?php echo $view->selectAmountType();?>';
         html +='</select>';
         html +='</td>';
         html +='<td>';
         html +='<input type="text" name="amount_note[]" class="form-control">';
         html +='</td>';
         html +='<td>';
         html +='<input type="text" name="amount[]" class="form-control" required="">';
         html +='</td>';
         html +='<td>';
         html +='<select id="amount_type_vat" name="amount_type_vat[]" required="" class="form-control">';
         html +='<option value="">Select VAT Status</option>';
         html +='<option value="Yes">Yes</option>';
         html +='<option value="No">No</option>';
         html +='</select>';
         html +='</td>';
         html +='<td class="text-center">';
         html +='<button type="button" class="btn btn-danger remove-amount-row" >X</button>';
         html +='</td>';
         html +='</tr>';
         $('#amount_fieds_tbl').append(html);
    }
     
     //remove amount row
     $(document).on('click', '.remove-amount-row', function(){
     $(this).closest('tr').remove();
        });
        
        
     //add new cheuqe field
      
    $(document).on('click', '.add-more-cheque', function(){
        add_cheque_row();
     });
     //function to add new row from amount
    function add_cheque_row(){
         var html = '';
         html +='<tr>';
         html +='<td>';
         html +='<input type="text" name="cheque_no[]" class="form-control" required="">';
         html +='</td>';
          html +='<td>';
         html +='<input type="date" name="cheque_date[]" class="form-control" required="">';
         html +='</td>';
         html +='<td>';
         html +='<input type="text" name="cheque_bank[]" class="form-control" required="">';
         html +='</td>';
         html +='<td>';
         html +='<input type="number" name="cheque_amount[]" class="form-control" required="">';
         html +='</td>';
         html +='<td class="text-center">';
         html +='<button type="button" class="btn btn-danger remove-cheque-row" >X</button>';
         html +='</td>';
         html +='</tr>';
         $('#cheque_fieds_tbl').append(html);
    }
     
     //remove amount row
     $(document).on('click', '.remove-cheque-row', function(){
     $(this).closest('tr').remove();
        });   
    
        
        
   });
</script>
  

