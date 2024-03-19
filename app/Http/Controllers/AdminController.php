<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\category;
use App\Models\purchase;
use DataTables;
use App\Models\product;
use App\Models\saleLaravel;
use App\Models\supplier;
Use \Carbon\Carbon;
use Illuminate\Support\Facades\DB;


class AdminController extends Controller
{
    public function show_category(){
        return view('admin.show_category');
    }

    public function add_category(Request $request){
        if($request->category_id){
            $category=category::find($request->category_id);
            if(!$category){
                abort(404);
            }

            $category->update([
                'category_name'=>$request->category_name
            ]);
            return response()->json([
                'success'=>'Category Updated Successfully'
    
            ],201);
        }

        

        else{
            $request->validate([
                'category_name'=>'required|min:2'
            ]);
            $category=category::create($request->all());
            return response()->json([
                'success'=>'Category Added Successfully'
            ],201
        
        );

        }
       

    }

    public function show_add_category(Request $request){
        $category=category::all();
        if($request->ajax()){
            return Datatables::of($category)
            ->addColumn('action',function($row){
                return '<a href="javascript:void[0]" class="btn-sm btn btn-info edit-button" data-id="'.$row->id.'">Edit</a>
                <a href="javascript:void[0]"  class="btn-sm btn btn-danger del-button" data-id="'.$row->id.'">Delete</a>';
            })
            ->rawColumns(['action'])
            ->make(true);

        }
        
    }

    public function edit_category($id){
        $category=category::find($id);
        if(!$category){
            abort(404);
        }
        return $category;
    }
    public function delete_category($id,Request $request){
        
            $category=category::find($id);
            if(!$category){
                abort();
            }
            $category->delete();
            return response()->json([
                'success'=>'Category deleted successfully'
            ],201);
    
        

    }

    public function add_purchase_page(){
        $supplier=supplier::all();

        $category=category::all();
        return view("admin.add_purchase_page",compact('category','supplier'));
    }

    public function add_purchase_data(Request $request){
        $purchase=new purchase;
        $purchase->product=$request->product;
        $purchase->supplier_id=$request->supplier_idy;
        $purchase->category_id=$request->category_id;
        $purchase->cost_price=$request->cost_price;
        $purchase->quantity=$request->quantity;
        $purchase->expiry_date=$request->expiry_date;
        $purchase->save();
        return redirect()->back();

    }

    public function show_purchase_page(){
        $supplier=supplier::all();
        $category=category::all();
        return view('admin.show_purchase_page',compact('category','supplier'));
    }

        public function add_purchase_data_jquery(Request $request){

            if($request->med_id){
                $purchase=purchase::find($request->med_id);
                if(!$purchase){
                    abort(404);
                }
                else{
                    $purchase->update([
                        'product'=>$request->product,
                        'category_id'=>$request->category_id,
                        'supplier_id'=>$request->supplier_id,
                        'quantity'=>$request->quantity,

                        'cost_price'=>$request->cost_price,
                        
                        'expiry_date'=>$request->expiry_date,
                        


                    ]);
                    return response()->json(['success'=>'Updated successfully'],201);
                }
            }
            else{
                $request->validate([
                    'product'=>'required',
                    'category_id'=>'required',
                    'supplier_id'=>'required',
                    'quantity'=>'required',
                    'cost_price'=>'required',
                    'expiry_date'=>'required',
                    
    
    
                ]);
    
                $purchase=purchase::create($request->all());
                return response()->json([
                    'success'=>'Purchase Added Successfully'
    
                ],201);

            }
            



        }


        public function show_purchase_jquery(Request $request){
            $purchase=purchase::all();
            if($request->ajax()){
            return Datatables::of($purchase)
            ->addColumn('action',function($row){
                return '<a href="javascript:void[0]" class="btn-sm btn btn-info edit-btn" data-id="'.$row->id.'">Edit</a>
                <a href="javascript:void[0]" class="btn-sm btn btn-danger del-btn" data-id="'.$row->id.'">Delete</a>';
            })
            ->rawColumns(['action'])
            
            
            ->make(true);
        }
        }

        public function delete_purchase($id){
            $purchase=purchase::find($id);
            $purchase->delete();
            return response()->json([
                'success'=>'Delete Successfully'
            ],201);
        }

        public function edit_purchase($id){
            $purchase=purchase::find($id);
            if(!$purchase){
                abort(404);
            }
            return $purchase;

        }
    public function add_product_page(){
        $purchase=purchase::all();
        return view('admin.add_product_page',compact('purchase'));
    }

    public function show_product_page(){
        $purchase=purchase::all();
        return view('admin.show_product_page',compact('purchase'));
    }

    public function add_product_data(Request $request){
        $product=new product;
        $product->purchase_id=$request->pro_name;
        $product->price=$request->pro_selling_price;
        $product->discount=$request->pro_margin;
        $product->description=$request->pro_description;
        $product->save();
        return redirect()->back();
    }

    public function add_product_json(Request $request){


        if($request->product_id){
            $product=product::find($request->product_id);
            if(!$product){
                abort(404);
            }

           else{
            $product->update([
                'purchase_id'=>$request->purchase_id,
                'price'=>$request->price,
                'discount'=>$request->discount,
                'description'=>$request->description,

            ]);
            return response()->json([
                'success'=>'Product updated successfully'

            ],201);
           }
        }
        else{
            $request->validate([
                'purchase_id'=>'required',
                'price'=>'required',
    
                'discount'=>'required',
                'description'=>'required',
    
            ]);
    
            $product=product::create($request->all());
            return response()->json([
                'success'=>'Product Addedd successfully'
            ],201);
        }

    }

    public function show_product_json(){
        $product=product::all();
        return Datatables::of($product)
        ->addColumn('action',function($row){
            return '<a href="javascript:void[0]" class="btn-sm btn btn-info edit-btn" data-id="'.$row->id.'">Edit</a>
            <a href="javascript:void[0]" class="btn-sm btn btn-danger del-btn" data-id="'.$row->id.'">Delete</a>';
        })
        ->rawColumns(['action'])
        ->make(true);
    }

    public function delete_product($id){
        $product=product::find($id);
        if(!$product){
            abort(404);
        }

        $product->delete();
        return response()->json(['success'=>'Deleted successfully'],201);
    }

    public function edit_product($id){
        $product=product::find($id);
        if(!$product){
            abort(404);
        }
        return $product;
    }

    public function show_supplier_page(){
        return view('admin.show_supplier_page');
    }

    public function add_supplier_json(Request $request){


        if($request->supplier_id){
            $supplier=supplier::find($request->supplier_id);
            if(!$supplier){
                abort(404);
            }

           else{
            $supplier->update([
                'supplier_name'=>$request->supplier_name,
                'supplier_product_name'=>$request->supplier_product_name,
                'supplier_phone'=>$request->supplier_phone,
                'supplier_email'=>$request->supplier_email,
                'supplier_address'=>$request->supplier_address,
                'supplier_TRN'=>$request->supplier_TRN,

            ]);
            return response()->json([
                'success'=>'updated successfully'

            ],201);
           }
        }
        else{
            $request->validate([
                'supplier_name'=>'required',
                'supplier_product_name'=>'required',
    
                'supplier_phone'=>'required',
                'supplier_email'=>'required',
                'supplier_address'=>'required',
                'supplier_TRN'=>'required',
    
            ]);
    
            $supplier=supplier::create($request->all());
            return response()->json([
                'success'=>'Product Addedd successfully'
            ],201);
        }

    }

    public function show_supplier_data_json(){
        $supplier=supplier::all();
        return Datatables::of($supplier)
        ->addColumn('action',function($row){
            return '<a href="javascript:void[0]" class="btn-sm btn btn-info edit-btn" data-id="'.$row->id.'">Edit</a>
            <a href="javascript:void[0]" class="btn-sm btn btn-danger del-btn" data-id="'.$row->id.'">Delete</a>';
        })
        ->rawColumns(['action'])
        ->make(true);
    }

    public function delete_supplier($id){
        $supplier=supplier::find($id);
        if(!$supplier){
            abort(404);
        }

        $supplier->delete();
        return response()->json(['success'=>'Supplier Deleted successfully'],201);
    }

    public function edit_supplier($id){
        $supplier=supplier::find($id);
        if(!$supplier){
            abort(404);
        }
        return $supplier;
    }

    public function show_sale_page(){
        $products=product::all();
        return view('admin.show_sale_page',compact('products'));
    }

    public function add_sale_json(Request $request){

        $this->validate($request,[
            'product'=>'required',
            'quantity'=>'required|integer|min:1'
        ]);
        $sold_product = Product::find($request->product);
        
        /**update quantity of
            sold item from
         purchases
        **/
        $purchased_item = purchase::find($sold_product->purchase->id);
        $new_quantity = ($purchased_item->quantity) - ($request->quantity);
        $notification = '';
        if (!($new_quantity < 0)){

            $purchased_item->update([
                'quantity'=>$new_quantity,
            ]);

            /**
             * calcualting item's total price
            **/
            $total_price = ($request->quantity) * ($sold_product->price);
            saleLaravel::create([
                'product_id'=>$request->product,
                'quantity'=>$request->quantity,
                'total_price'=>$total_price,
            ]);

            
        } 
        if($new_quantity <=1 && $new_quantity !=0){
            // send notification 
            $product = Purchase::where('quantity', '<=', 1)->first();
           
            // end of notification 
            // return response()->json(['error'=>'Product out of stock'],201);
            
        }


        return response()->json(['success'=>'Product has been sold'],201);
    }

    public function delete_sale($id)
    {
        $sale=saleLaravel::find($id);
        if(!$sale){
            abort(404);
        }

        $sale->delete();
        return response()->json(['success'=>'Sale Deleted successfully'],201);
    }
        

    

    public function show_sale_data_json(){
        $sale=saleLaravel::all();
        return Datatables::of($sale)
        ->addColumn('action',function($row){
            return '<a href="javascript:void[0]" class="btn-sm btn btn-info edit-btn" data-id="'.$row->id.'">Edit</a>
            <a href="javascript:void[0]" class="btn-sm btn btn-danger del-btn" data-id="'.$row->id.'">Delete</a>';
        })

        ->addColumn('product',function($sale){
            
            if(!empty($sale->product)){
                return $sale->product->purchase->product;
            }                 
        })
        ->addColumn('date',function($row){
            return date_format(date_create($row->created_at),'d M, Y');
        })
        ->rawColumns(['action'])
        ->make(true);
    }

 

   


    public function report(Request $request){
        $title = 'sales reports';
        return view('admin.sale_report',compact(
            'title'
        ));
    }

   
    public function generateReport(Request $request){
        $this->validate($request,[
            'from_date' => 'required',
            'to_date' => 'required',
        ]);
        $title = 'sales reports';
        $sales = SaleLaravel::whereBetween(DB::raw('DATE(created_at)'), array($request->from_date, $request->to_date))->get();
        $pdf = Pdf::loadView('admin.pdf',compact('sales'));
 
        return $pdf->download('salesReport.pdf');

        
    }

    public function purchase_report(Request $request){
        $title = 'Purchase reports';
        return view('admin.purchase_report',compact(
            'title'
        ));
    }

   
    public function generate_purchase_Report(Request $request){
        $this->validate($request,[
            'from_date' => 'required',
            'to_date' => 'required',
        ]);
        $title = 'Purchase reports';
        $purchases = purchase::whereBetween(DB::raw('DATE(created_at)'), array($request->from_date, $request->to_date))->get();
        $pdf = Pdf::loadView('admin.purchase_pdf',compact('purchases'));
 
        return $pdf->download('PurchaseReport.pdf');

        
    }




}
