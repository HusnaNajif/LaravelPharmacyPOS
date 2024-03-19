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

  <!-- =======================================================
  * Template Name: NiceAdmin
  * Updated: Jan 29 2024 with Bootstrap v5.3.2
  * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->

  <script
  src="https://code.jquery.com/jquery-3.7.1.min.js"
  integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo="
  crossorigin="anonymous"></script>

  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
  <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.15/css/jquery.dataTables.css">
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
                
                    
                   
                    <h5 class="card-title">Purchase List</h5>
                    
                    
                    <button type="button" class="btn btn-success" style="float:right;margin-top:-45px;" data-bs-toggle="modal" data-bs-target="#example-modal" id="add-purchase">Add Purchase</button>
                    
                    
                <table id="purchase-table">
                    <thead>
                        <tr>
                        <th>ID</th>
                            <th>Product</th>
                            <th>Supplier Name</th>
                            
                            <th>Category</th>
                            <th>Qty</th>
                            <th>Cost Price</th>
                           
                            <th>Expiry date</th>
                            
                            <th>Action</th>

                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>

                <div class="modal fade ajax-modal" tab-index="-1" id="example-modal" style="display:none;">
                    <div class="modal-dialog">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modal-title"></h5>
                            <button class="btn-close" data-bs-dismiss="modal" type="button"></button>
                        </div>

                        <div class="modal-body">
                            <form action="" id="ajax-form">
                            <div class="row">
                            <input type="hidden" name="med_id" class="form-control" id="med_id">
                                <div class="col-sm-4">
                                    <div class="form-group">
                                    <label for=""> Medicine Name</label>
                                    <input type="text" name="product" class="form-control" id="med_name">
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                    <label for="">Category</label>
                                    <select name="category_id" id="med_category"class="form-control">
                                        <option value=""  >Select Category</option>
                                        @foreach($category as $category)
                                        <option value="{{$category->id}}">{{$category->category_name}}

                                        </option>
                                        @endforeach
                                        
                                    </select>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                    <label for="">Supplier Name</label>
                                    <select name="supplier_id" class="form-control" id="med_supplier">
                                        <option value=""  >Select Supplier</option>
                                        @foreach($supplier as $supplier)
                                        <option value="{{$supplier->id}}">{{$supplier->supplier_name}}

                                        </option>
                                        @endforeach
                                        
                                    </select>
                                    </div>
                                </div>
                                
                            </div>

                            <div class="row  mt-3">

                            <div class="col-sm-4">
                                    <div class="form-group">
                                    <label for="">Qty</label>
                                    <input type="number" name="quantity" class="form-control" id="med_qty">
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                    <label for="">Cost Price</label>
                                    <input type="number" name="cost_price" class="form-control" id="med_cost_price">
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                    <label for="">Expiry</label>
                                    <input type="date" name="expiry_date" class="form-control" id="med_expiry">
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
  </div>




   
  </main><!-- End #main -->

  

 

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

$('#purchase-table').DataTable({
    processing:true,
    serverSide:true,
    ajax:"{{url('show_purchase_jquery')}}",
    columns:[
        {data:'id'},
        {data:'product'},
       
        {data:'supplier_id'},
        {data:'category_id'},
        {data:'quantity'},
        {data:'cost_price'},
        {data:'expiry_date'},
        
        
        
        
        

       
        
        {data:'action',name:"action",orderable:false,searchable:false},

    ],

})

        
            $('#modal-title').html('Add Purchase');
            $('#save-btn').html('Save Purchase');
            var form=$('#ajax-form')[0];
    

        $('#save-btn').click(function(){
           

            var formD=new FormData(form);
            $.ajax({
                url:"{{url('add_purchase_data_jquery')}}",
                method:"post",
                processData:false,
                contentType:false,
                data:formD,
                success:function(response){
                    $('#purchase-table').DataTable().ajax.reload();
                    $('#med_name').val('');
        $('#med_supplier').val('');
        $('#med_category').val('');
        $('#med_qty').val('');
        $('#med_cost_price').val('');
        $('#med_expiry').val('');
        $('#med_id').val('');

                    
                    if(response){

                        swal("Good", response.success, "success");


                    }

                    $('#example-modal').modal('hide');
                },
                error:function(error){
                    console.log(error)
                }
            })

        })



        $('body').on('click','.del-btn',function(){
            var id=$(this).data('id');

            $.ajax({
                url:"{{url('delete_purchase','')}}"+'/'+id,
                method:'DELETE',
                success:function(response){
                    $('#purchase-table').DataTable().ajax.reload();
                    
                    if(response){

                        swal("Good", response.success, "success");


                    }
                    

                  
                },
                error:function(error){
                    console.log(error)
                }
            })
            
        })


        $('body').on('click','.edit-btn',function(){
            
            var id=$(this).data('id');

            $.ajax({
                url:"{{url('edit_purchase','')}}"+'/'+id,
                method:'GET',
                success:function(response){
                    $('#example-modal').modal('show');
                    $('#med_id').val(response.id);
            $('#modal-title').html('Edit Purchase');
            $('#save-btn').html('Update Change');
            $('#med_name').val(response.product);
            $('#med_supplier').val(response.supplier_id);
            $('#med_qty').val(response.quantity);
            $('#med_cost_price').val(response.cost_price);
            $('#med_category').val(response.category_id);
            $('#med_expiry').val(response.expiry_date);
           

            



                    
                    
                },
                error:function(error){
                    console.log(error)
                }
                
            })

           
        })

        $('#add-purchase').click(function(){
            $('#modal-title').html('Create Purchase');
            $('#save-btn').html('Save Purchase');
            $('#med_name').val('');
        $('#med_supplier').val('');
        $('#med_category').val('');
        $('#med_qty').val('');
        $('#med_cost_price').val('');
        $('#med_expiry').val('');
        $('#med_id').val('');
        })
            
    })
  </script>

</body>

</html>