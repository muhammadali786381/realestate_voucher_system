<?php
//echo "<pre>";
//print_r($client_detail);
?>
<!-- Begin Page Content -->
        <div class="container-fluid">

         <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Amount Type List</h1>
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
                     <th>Name</th>
                     <th>Description</th>
                     <th>Status</th>
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                      <th>#</th>
                     <th>Name</th>
                     <th>Description</th>
                     <th>Status</th>
                    </tr>
                  </tfoot>
                  <tbody>
                      <?php
                      if($amount_type!="NO_DATA"):
                          foreach ($amount_type as $row):
                      ?>
                  <tr> 
                  <td><?php echo $row['id']; ?></td>
                  <td><?php echo $row['name']; ?></td>
                  <td><?php echo $row['description']; ?></td>
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
                    <label class="text-primary">Name</label>
                    <input type="text"  class="form-control"  name="name" value="" required="">
                    </div>
                   <div class="form-group">
                    <label class="text-primary">Description</label>
                    <input type="text" class="form-control"  name="note" required="">
                    </div>
                <button  type="submit" name="createNewAmountType" class="btn btn-primary btn-user btn-block">
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

