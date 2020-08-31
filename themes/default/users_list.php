<?php
//echo "<pre>";
//print_r($client_detail);
?>
<!-- Begin Page Content -->
        <div class="container-fluid">

         <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Users List</h1>
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
                     <th>Phone</th>
                     <th>Email</th>
                     <th>Role</th>
                     <th>Status</th>
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                     <th>#</th>
                     <th>Name</th>
                     <th>Phone</th>
                     <th>Email</th>
                     <th>Role</th>
                     <th>Status</th>
                    </tr>
                  </tfoot>
                  <tbody>
                      <?php
                      if($user_list!="NO_DATA"):
                          foreach ($user_list as $row):
                       ?>
                  <tr> 
                  <td><?php echo $row['admin_id']; ?></td>
                  <td><?php echo $row['full_name']; ?></td>
                  <td><?php echo $row['phone']; ?></td>
                  <td><?php echo $row['email']; ?></td>
                  <td><?php echo $row['role']; ?></td>
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
                    <label class="text-primary">Role</label>
                    <select class="form-control" required="" name="role">
                        <option value="">Select Role</option>
                        <option value="Super Admin">Super Admin</option>
                        <option value="Manager">Manager</option>
                        <option value="Accountant">Accountant</option>
                        <option value="Data Export">Data Export</option>
                    </select>
                    </div>    
                   <div class="form-group">
                    <label class="text-primary">Name</label>
                    <input type="text"  class="form-control"  name="name" value="" required="">
                    </div>
                   <div class="form-group">
                    <label class="text-primary">Phone</label>
                    <input type="text" class="form-control"  name="phone" required="">
                    </div>
                    <div class="form-group">
                    <label class="text-primary">Email</label>
                    <input type="email" class="form-control"  name="email" required="">
                    </div>
                     <div class="form-group">
                    <label class="text-primary">Password</label>
                    <input type="password" minlength="8" class="form-control"  name="pass" required="">
                    </div>
                <button  type="submit" name="createNewUser" class="btn btn-primary btn-user btn-block">
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

