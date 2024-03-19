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
  src="https://code.jquery.com/jquery-3.7.1.min.js"
  integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo="
  crossorigin="anonymous"></script>
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
        <h5 class="card-title">
         Product List

        </h5>
        <button type="button" class="btn btn-primary" style="margin-top:-45px;float:right;" data-bs-toggle="modal" data-bs-target="#example-modal" id="create-btn">Add Product</button>


        <table id="product-table">
          <thead>
            <tr>
              <th>Id</th>
              <th>Product Name</th>
              <th>Selling price</th>
              <th>Margin</th>
              <th>Description</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody></tbody>
        </table>


        <div class="modal fade ajax-modal" tab-index="-1" id="example-modal">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="modal-title"> </h5>
                <button type="button" data-bs-dismiss="modal" class="btn-close"></button>
              </div>


              <form action="" id="ajax-form">
                <div class="row mx-2">
                  <div class="col-lg-6">
                  <input type="hidden" name="product_id" class="form-control" id="product_id">
                    <div class="form-group">
                    <label for="">Product Name</label>
                    <select name="purchase_id" id="pro_name" class="form-control" >
                      <option value="">Select Product</option>
                      @foreach($purchase as $purchase)

                      <option value="{{$purchase->id}}">{{$purchase->product}}(Rs:{{$purchase->cost_price}})</option>
                      @endforeach
                    </select>
                    </div>
                  </div>


                  <div class="col-lg-6">
                    <div class="form-group">
                    <label for="">Selling Price</label>
                    <input type="number" name="price" id='pro_selling_price' class="form-control">
                    </div>
                  </div>
                </div>


                <div class="row mt-4 mx-2">
                <div class="col-lg-6">
                    <div class="form-group">
                    <label for="">Margin</label>
                    <input type="number" name="discount" id='pro_margin'class="form-control">
                    </div>
                  </div>


                  <div class="col-lg-6">
                    <div class="form-group">
                    <label for="">Description</label>
                    <input type="text" name="description" id='pro_description' class="form-control">
                    </div>
                  </div>
                </div>


              </form>

              <div class="modal-footer">
                                
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                               <button type="button" class="btn btn-success" id="save-btn"></button>
                            </div>
            </div>

            
          </div>
        </div>
      </div>
    </div>
  </div>
</div>



  </main><!-- End #main -->
  <script type="text/javascript" charset="utf8" src="//cdn.datatables.net/1.10.15/js/jquery.dataTables.js"></script>

  <script>
    $(document).ready(function(){
      $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

$('#product-table').DataTable({
  ajax:"{{url('show_product_json')}}",
  method:"GET",
  processing:true,
  serverSide:true,
  columns:[
    {data:'id'},
    {data:'purchase_id'},
    {data:'price'},

    {data:'discount'},
    {data:'description'},
    {data:'action',name:'action',orderable:false,searchable:false},

  ]

  });


      $('#modal-title').html('Create Product');
      $('#save-btn').html('Save Product');
      var form=$('#ajax-form')[0];
      $('#save-btn').click(function(){


        var formD=new FormData(form);
        $.ajax({
          url:"{{url('add_product_json')}}",
          method:'POST',
          processData:false,
          contentType:false,
          data:formD,

          success:function(response){
            $('#product-table').DataTable().ajax.reload();
            $('#example-modal').modal('hide');


            $('#pro_name').val('');
        $('#pro_selling_price').val('');
        $('#pro_margin').val('');
        $('#pro_description').val('');
        $('#product_id').val('');
            if(response){

              swal("Good", response.success, "success");
            }
          },
          error:function(error){
            console.log(error)
          }
        })
      })


      $('body').on('click','.del-btn',function(){
        var id=$(this).data('id');
        $.ajax({
          url:"{{url('delete_product','')}}"+'/'+id,
          method:'DELETE',
          success:function(response){
            $('#product-table').DataTable().ajax.reload();
            if(response){
              swal("Good", response.success, "success");

            }
          },
          error:function(error){
            console.log(error);
          }
        })
      })

      $('body').on('click','.edit-btn',function(){
        var id=$(this).data('id');
        
        $.ajax({
          url:"{{url('edit_product','')}}"+'/'+id,
          method:'GET',
          success:function(response){
            $('.ajax-modal').modal('show');
        $('#modal-title').html('Update');
        $('#save-btn').html('Save change');
        $('#product_id').val(response.id);
        $('#pro_name').val(response.purchase_id);
        $('#pro_selling_price').val(response.price);
        $('#pro_margin').val(response.discount);
        $('#pro_description').val(response.description);
          },
          error:function(error){
            console.log(error);
          }

        })
      })

      $('#create-btn').click(function(){
        $('#modal-title').html('Add Product');
        $('#save-btn').html('Save Product');

      })


      
    })
  </script>

  

 


  

  <!-- Vendor JS Files -->
  @include('admin.js')

</body>

</html>