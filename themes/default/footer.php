    </div>
<!-- End of Content Wrapper -->
</div>
<!-- End of Page Wrapper --> 

 
  
    <!-- custom JS-->
    <script src="<?php echo BASE_URL ?>vendor/custom/custom.js"></script>
    <script type="text/javascript">
    //print div
     function PrintElem(elem)
    {
        Popup($(elem).html());
    }
    
    function Popup(data)
    {
        var mywindow = window.open('', 'new div', 'height=28512,width=20160');
        mywindow.document.write('<html><head><title><?php echo 'Installment System'; ?></title>');
        /*optional stylesheet*/ 
	mywindow.document.write('<link rel="stylesheet" href="<?php echo BASE_URL ?>vendor/vendor/fontawesome-free/css/all.min.css" type="text/css" />');
        mywindow.document.write('<link rel="stylesheet" href="<?php echo BASE_URL ?>vendor/css/sb-admin-2.min.css" type="text/css"  />');
        mywindow.document.write('<link rel="stylesheet" href="<?php echo BASE_URL ?>vendor/vendor/datatables/dataTables.bootstrap4.min.css" type="text/css" />');
        
    mywindow.document.write('</head><body>');
        mywindow.document.write(data);
        mywindow.document.write('</body></html>');
        mywindow.print();
        mywindow.close();
        return true;
    }
 </script>
    <?php
    RefreshURL("300000");
    ?>
</body>

</html>