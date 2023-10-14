<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\TemporaryProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use App\Models\User;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function product(Request $request )
    {
        $bioskopId = $request->input('vessel');
        $users = User::whereHas('roles', function($query) {
            $query->where('name', 'vessel');
        })->get();
        $data = Product::join('users', 'products.id_user', '=', 'users.id')
        ->select('products.*','users.name as user',
        )
        ->when($bioskopId, function ($query) use ($bioskopId) {
            return $query->where('products.id_user', $bioskopId);
        })
        ->latest('products.id')
        ->get();
        return view('product.product', compact('data','users'));
    }
    public function add()
    {
        $users = User::whereHas('roles', function($query) {
            $query->where('name', 'vessel');
        })->get();
        return view('product.add',compact('users'));
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
            'stock' => 'required',
            'vessel' => 'required',
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
            'stock' => $request->input('stock'),
            'id_user'=> $request->input('vessel'),
        ]);

        return redirect()->route('product')->with('success', 'Inventory created successfully.');
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
        $users = User::whereHas('roles', function($query) {
            $query->where('name', 'vessel');
        })->get();
        $product = Product::find(Crypt::decrypt($id));
        return view('product.add', ['product' => $product],compact('users'));
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
            'stock' => 'required',
            'vessel' => 'required',
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
            'stock' => $request->stock,
            'id_user' => $request->vessel,
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
    
        return redirect()->route('product')->with('success', 'Inventory Edit successfully.');
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
    
        return redirect()->route('product')->with('success', 'Delete successfully.');
}

}
