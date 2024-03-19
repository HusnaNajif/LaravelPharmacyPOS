<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>Dashboard - NiceAdmin Bootstrap Template</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="admin/assets/img/favicon.png" rel="icon">
  <link href="admin/assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="admin/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="admin/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="admin/assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="admin/assets/vendor/quill/quill.snow.css" rel="stylesheet">
  <link href="admin/assets/vendor/quill/quill.bubble.css" rel="stylesheet">
  <link href="admin/assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="admin/assets/vendor/simple-datatables/style.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="admin/assets/css/style.css" rel="stylesheet">

  <script
  src="https://code.jquery.com/jquery-3.7.1.min.js">
  </script>
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
  <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.15/css/jquery.dataTables.css">

  <!-- =======================================================
  * Template Name: NiceAdmin
  * Updated: Jan 29 2024 with Bootstrap v5.3.2
  * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>
@include('admin.header')
  <!-- ======= Header ======= -->
  <!-- End Header -->

  <!-- ======= Sidebar ======= -->
  @include('admin.sidebar')
  <main id="main" class="main">

  <div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                
               
                  <h5 class="card-title">Category</h5>
                
                <button class="btn btn-primary" style=" float:right;margin-top:-45px;" data-bs-toggle="modal" data-bs-target="#examplemodal" id="add-categorybtn" >Add Category</button>



                <table class="table" id="category-table">
                  <thead>
                    <tr>
                      <th scope="col">Id</th>
                      <th scope="col">Category Name</th>
                      <th scope="col">Created At</th>
                      <th scope="col">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    
                  </tbody>
                  </table>
                
                
                <div class="modal fade ajax-modal" tab-index="-1" id="examplemodal" style="display:none">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="modaltitle"></h5>
                        <button class="btn-close" data-bs-dismiss="modal"></button>
                      </div>
                      <div class="modal-body">
                        <form id="ajax-form">
                        
                              <input type="hidden" class="form-control"  name="category_id" id="category_id" >
                              
                            
                          <div class="row mb-2">
                            <label for="" class="col-sm-4 form-label">Category Name:
                            <span style="color:red;">*</span>
                            </label>
                            <div class="col-sm-8">
                              <input type="text" class="form-control" placeholder="Enter Category Name" name="category_name" id="category_name" >
                              
                            </div>
                          </div>
                        </form>
                      </div>
                      <div class="modal-footer">
                        <button type="button" data-bs-dismiss="modal" class="btn btn-secondary">Close</button>
                        <button type="button" class="btn btn-primary" id="save-btn"></button>
                      </div>
                    </div>
                  </div>
                </div>



                
            </div>


        </div>
    </div>
  </div>
  
  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  

  

  <!-- Vendor JS Files -->
  @include('admin.js')
  <script type="text/javascript" charset="utf8" src="//cdn.datatables.net/1.10.15/js/jquery.dataTables.js"></script>


  <script>
    $(document).ready(function(){

      $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
$('#category-table').DataTable({
  
  processing:true,
  serverSide:true,
  ajax:"{{url('show_add_category')}}",
  columns:[
    {data:'id'},
    {data:'category_name'},
    {data:'created_at'},
    {data:'action',name:"action",orderable:false,searchable:false},
  ]
});

      $('#modaltitle').html('Add Category');
      $("#save-btn").html('Save Category');
      var form=$('#ajax-form')[0];
    

    $('#save-btn').click(function(){
      var formd=new FormData(form);
      $.ajax({
        url:"{{url('add_category')}}",
        method:'POST',
        processData:false,
        contentType:false,
        data:formd,

        success:function(response){
          $('#category_name').val('');
          $('#category_id').val('');
          $('#category-table').DataTable().ajax.reload();
          
        
          $('.ajax-modal').modal('hide');

          if(response){
            swal("Good job!", response.success, "success");

          }
          
        },
        
          error:function(error){
            console.log(error);
          }
        

      })
    })




    $('body').on('click','.edit-button',function(){
      var id=$(this).data('id');
      $.ajax({
        url:"{{url('edit_category','')}}"+'/'+id,
        method:'GET',
        success:function(response){
          $('.ajax-modal').modal('show');
          $('#modaltitle').html('Update Category');
          $('#save-btn').html('Update Change');
          $('#category_id').val(response.id);
          $('#category_name').val(response.category_name);
        },
        error:function(error){
          console.log(error);
        }
      })
    })

    $('body').on('click','.del-button',function(){
      var id=$(this).data('id');
      $.ajax({
        url:"{{url('delete_category','')}}"+'/'+id,
        method:'DELETE',
        success:function(response){
          $('#category-table').DataTable().ajax.reload();

          if(response){
            swal("Done", response.success, "success");

          }
        },
        error:function(error){
          console.log(error);
        }
      })

    })

    $('#add-categorybtn').click(function(){
      $('#modaltitle').html('Create Category');
      $('#save-btn').html('Save category');
    })
  });
  </script>

</body>

</html>