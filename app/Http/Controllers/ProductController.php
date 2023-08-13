<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\TemporaryProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function product()
    {
        $data = Product::all();
        return view('product.product', compact('data'));
    }
    public function add()
    {
        $temporaryProducts = TemporaryProduct::all();
        return view('product.add',compact('temporaryProducts'));
    }
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeproduct(Request $request)
    {
        $request->validate([
            'ID_Product_Code' => 'required',
            'Product_Spec' => 'required',
            'Product_Name' => 'required',
            'ID_Product_Type' => 'required',
            'Product_Image' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Image validation rules
            'Product_Alias' => 'required',
            'Product_Unit' => 'required',
            'Min_Order' => 'required',
            'Lead_Time' => 'required',
            'Delivery_Time' => 'required',
            'Idle_Time' => 'required',
            'Volume' => 'required',
        ]);

        // untuk menaruh foto ke folder image
        $imagePath = null;
        if ($request->hasFile('Product_Image')) {
            $image = $request->file('Product_Image');
            $imagePath =date('YmdHis') . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('image'), $imagePath);
        }

        Product::create([
            'product_id' => $request->input('ID_Product_Code'),
            'spec' => $request->input('Product_Spec'),
            'name' => $request->input('Product_Name'),
            'type' => $request->input('ID_Product_Type'),
            'image' => $imagePath,
            'alias' => $request->input('Product_Alias'),
            'unit' => $request->input('Product_Unit'),
            'min' => $request->input('Min_Order'),
            'lead' => $request->input('Lead_Time'),
            'delivery' => $request->input('Delivery_Time'),
            'idle' => $request->input('Idle_Time'),
            'volume' => $request->input('Volume'),
        ]);

        return redirect()->route('product')->with('success', 'Product created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function editproduct($id)
    {
        $product = Product::find(Crypt::decrypt($id));
        return view('product.add', ['product' => $product]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function updateproduct(Request $request, Product $product,$encryptedId)
    {
        $id = Crypt::decrypt($encryptedId);
        $request->validate([
            'ID_Product_Code' => 'required',
            'Product_Spec' => 'required',
            'Product_Name' => 'required',
            'ID_Product_Type' => 'required',
            'Product_Alias' => 'required',
            'Product_Unit' => 'required',
            'Min_Order' => 'required',
            'Lead_Time' => 'required',
            'Delivery_Time' => 'required',
            'Idle_Time' => 'required',
            'Volume' => 'required',
            'Product_Image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        $product = Product::find($id);

        $data = [
            'product_id' => $request->ID_Product_Code,
            'spec' => $request->Product_Spec,
            'name' => $request->Product_Name,
            'type' => $request->ID_Product_Type,
            'alias' => $request->Product_Alias,
            'unit' => $request->Product_Unit,
            'min' => $request->Min_Order,
            'lead' => $request->Lead_Time,
            'delivery' => $request->Delivery_Time,
            'idle' => $request->Idle_Time,
            'volume' => $request->Volume,
        ];
    
        if ($request->hasFile('Product_Image')) {
            $file = $request->file('Product_Image');
            $destinationPath = public_path('image');
    
            // Hapus gambar lama jika ada
            if ($product->image) {
                $gambarPath = $destinationPath . '/' . $product->image;
                if (file_exists($gambarPath)) {
                    unlink($gambarPath);
                }
            }
    
            // Pindahkan gambar baru ke direktori penyimpanan
            $gambarNama = date('YmdHis') . "." . $file->getClientOriginalExtension();
            $file->move($destinationPath, $gambarNama);
    
            $data['image'] = $gambarNama;
        }
        
    
        $product->update($data);
    
        return redirect()->route('product')->with('success', 'Product updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function delete($encryptedId)
    {   $id = Crypt::decrypt($encryptedId);
        $product = Product::find($id);

        // Hapus gambar jika ada
        $gambarPath = public_path('image');
        $gambarFile = $gambarPath . '/' . $product->image;
    
        if (file_exists($gambarFile)) {
            // Hapus file gambar
            unlink($gambarFile);
        }
    
        // Hapus data film
        $product->delete();
    
        return redirect()->route('product');
}

    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required',
            'name' => 'required',
            'spec' => 'required',
            // Add validation rules for other fields if needed
        ]);

        TemporaryProduct::create($request->all());

        return redirect()->back()->with('success', 'Product added to temporary list.');
    }

    public function clearTemporaryProducts()
    {
        TemporaryProduct::truncate();
        return redirect()->back()->with('success', 'Temporary product list cleared.');
    }
}
