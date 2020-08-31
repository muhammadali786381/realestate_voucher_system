/*
 * all custom js code
 * that help to conneting
 * with different plugin
 * 
 * 
 * 
 */

$(document).ready(function() {
  //document ready    
    
    
    /*
     * All table plugin link
     * 
     */
    
    //coupon table
  $('#Table01').DataTable({
      "paging": true,
      "ordering": true,
      "order": [[ 0, "desc" ]]
      });
 
 
  

  
 
  
    //user table
  $('#userTable').DataTable();
  
  
  
  
    //   
   $('#cStartDate').datepicker({ });
   $('#cEndDate').datepicker({ });
  
  
   

  
  
  
  
  
  
  
  
//end document ready  
});
