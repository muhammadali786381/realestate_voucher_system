<?php
//echo "<pre>";
//print_r($client_detail);
?>
<!-- Begin Page Content -->
        <div class="container-fluid">

         <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Party Apartment List</h1>
            <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"  data-toggle="modal" data-target="#logoutModal"><i class="fas fa-edit fa-sm text-white-100"></i> Create New</a>
          </div>
          <!-- DataTales coupon -->
          <div class="card shadow mb-4">
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="Table01" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                     <th>#</th>
                     <th>Party Name</th>
                     <th>Building</th>
                     <th>Apartment</th>
                     <th>Status</th>
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                     <th>#</th>
                     <th>Party Name</th>
                     <th>Building</th>
                     <th>Apartment</th>
                     <th>Status</th>
                    </tr>
                  </tfoot>
                  <tbody>
                      <?php
                      if($party_apartment_list!="NO_DATA"):
                          foreach ($party_apartment_list as $row):
                          //get part name
                          $party=$main->getSingleRecord("party_name","id",$row['party_name_id']);
                          //get apartment name
                          $apartment=$main->getSingleRecord("appartment_list","id",$row['appartment_id']);
                          //get building name
                          $buidling=$main->getSingleRecord("building_list","id",$apartment['building_id']);
                       ?>
                  <tr> 
                  <td><?php echo $row['id']; ?></td>
                  <td><?php echo $party['party_name']; ?></td>
                  <td><?php echo $buidling['name']; ?></td>
                  <td><?php echo $apartment['name']; ?></td>
                  <td><?php echo $row['status'];?></td>
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
        <!-- /.container-fluid -->
        
        
        <!-- create new coupon model-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Create New</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
                     <div class="p-5">
                    <form class="user" method="POST" enctype="multipart/form-data">
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
                    <label class="text-primary">Building</label>
                    <select class="form-control building_id" name="building_id" id="building_id" required="">
                        <?php
                        $view->selectBuildingList();
                        ?>
                     </select>
                    </div>
                    <div class="form-group">
                    <label class="text-primary">Apartment</label>
                    <select class="form-control apartment_id" name="apartment_id" id="apartment_id" required="">
                        <!--coming from ajax-->
                        
                     </select>
                    </div>    
                        
                        
                <button  type="submit" name="createPartyApartment" class="btn btn-primary btn-user btn-block">
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
        
        
     //get party name 
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
        
        //get apartment name 
    $('.building_id').change(function(){
        var formUrl = "index.php";
        var ajaxBuildingId = $(this).children("option:selected").val();
      //alert(ajaxpartyListiId+formUrl);
         $.ajax({
		url : formUrl,
		method : "POST",
		data  : {ajaxBuildingId},
		success : function(data){
                    //alert(data);
                    $(".apartment_id").html(data);
		}
		});
        }); 
    
   
      
   
      
    
        
        
   });
</script>        

