<?php 
include("includes/loginheader.php");
?>
      <!-- ============================================================== -->
      <!-- End Topbar header -->
      <!-- ============================================================== -->
 <?php 
include("includes/leftMenu.php");


?>    
      <!-- ============================================================== -->
      <!-- End Left Sidebar - style you can find in sidebar.scss  -->
      <!-- ============================================================== -->
      <!-- ============================================================== -->
      <!-- Page wrapper  -->
      <!-- ============================================================== -->
      <div class="page-wrapper">
        <!-- ============================================================== -->
        <!-- Bread crumb and right sidebar toggle -->
        <!-- ============================================================== -->
        <div class="page-breadcrumb">
          <div class="row">
            <div class="col-12 d-flex no-block align-items-center">
              
              <div class="ms-auto text-end">
                <nav aria-label="breadcrumb">
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="fn_uploads.php">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">
                     IDFC Finance KVB Data
                    </li>
                  </ol>
                </nav>
              </div>
            </div>
          </div>
        </div>
        <!-- ============================================================== -->
        <!-- End Bread crumb and right sidebar toggle -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Container fluid  -->
        <!-- ============================================================== -->
        <div class="container-fluid">
          <!-- ============================================================== -->
          <!-- Start Page Content -->
          <!-- ============================================================== -->
          <div class="row">
            <div class="col-12">
              <?php
			if($error != '')
				echo '<div class="has-error msg-login"><div class="input-group-addon">' . $error . '</div></div>';
			else if($success != '')
				echo '<div class="has-success msg-login"><div class="input-group-addon">' . $success . '</div></div>';
			else if($message != '')
				echo '<div class="has-success msg-login"><div class="input-group-addon">' . $message . '</div></div>';
			else
				echo '<div class="msg-login"></div>';
		?>		
             
			  
			  
			  <div class="card"><h4 class="page-title text-center">IDFC Finance KVB Data</h4>
			 
                <form class="form-horizontal2" name="frmadd2" id="frmadd2" method="post" action="idfc_kvb_upload_csv.php" enctype="multipart/form-data" >
				<input type="hidden" name="site_id" value="<?php echo $site_id;?>">
			 			 <input type="hidden" name="user_id" value="<?php echo $admin_id;?>">
                  <div class="card-body">
                   
					<div class="form-group row">
                    <label class="col-sm-6 text-end control-label col-form-label">Upload CSV file*</label>
                    <div class="col-sm-6">
                      <div class="custom-file">
                        <input type="file" class="custom-file-input" name="csvfile2"  id="validatedCustomFile2" accept=".csv" required />
                       
                      </div>
                    </div>
                  </div>
				  <div class="col-md-12">
				  
								 
							  </div>
                   
               <!-- <h5>Last Uploaded Date : <?php //echo $site_row2['created_on'];?></h5>-->
                  </div>
                  <div class="border-top text-center">
                    <div class="card-body">
                      <button type="submit" id="submit" class="btn btn-primary" name="sbmtbtn2">
                        Upload
                      </button>
					   <a type="button" class="btn btn-warning" href="fn_uploads.php"><i class="fa fa-repeat"></i>&nbsp;Back</a> <a type="button" class="btn btn-success" href="bajaj_fn.php"><i class="fa fa-repeat"></i>&nbsp;Home</a>
                    </div>
					<div id="message2" style="color:green"></div>
                  </div>
                </form>
					
				
              </div>
			  
			  
			  
			  
			  
			  
            </div>
          </div>
          <!-- ============================================================== -->
          <!-- End PAge Content -->
          <!-- ============================================================== -->
          <!-- ============================================================== -->
          <!-- Right sidebar -->
          <!-- ============================================================== -->
          <!-- .right-sidebar -->
          <!-- ============================================================== -->
          <!-- End Right sidebar -->
          <!-- ============================================================== -->
        </div>
        <!-- ============================================================== -->
        <!-- End Container fluid  -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- footer -->
        <!-- ============================================================== -->
        
        <!-- ============================================================== -->
        <!-- End footer -->
        <!-- ============================================================== -->
      </div>
      <!-- ============================================================== -->
      <!-- End Page wrapper  -->
      <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- All Jquery -->
    <!-- ============================================================== -->
   
     <script>
    jQuery(document).ready(function () {
	
		$('#frmadd2').submit(function() {  
			var formdata = new FormData(this);
			//var image = document.getElementById('image').files[0];
            var action = $(this).attr('action');
            //$("#messagetext").slideUp(750, function() {
                //$('#message').hide();
               // $('#submit').attr('disabled', 'disabled');
                   $('#message2').after('<br/><img src="images/ajax-loader.gif" class="loader" style="width:30px;"/>');
                 //$('#message').html('Please wait.. Uploading data...');
                $.ajax({
					type: "POST",
					url: action,
					data:  formdata,
					enctype: 'multipart/form-data',
					processData: false,  // tell jQuery not to process the data
					contentType: false,
					success: function(response)
					{ //alert(response);
						
						
						document.getElementById('message2').innerHTML = response;
						$('#message2').slideDown('slow');
                        $('#frmadd2 img.loader').fadeOut('slow', function () {
                            $(this).remove()
                        });
						
                       
					},
					beforeSend: function()
					{
						document.getElementById('message2').innerHTML = 'Please wait.. Uploading data...';
						// some code before request send if required like LOADING....
					}					
                       
               });
            //});
            return false;
        });
		
       
    });
</script>      
  </body>
</html>
