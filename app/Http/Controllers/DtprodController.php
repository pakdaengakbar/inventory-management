<?php

namespace App\Http\Controllers;

use App\Helpers\MyService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\mproduct as product;

class DtprodController extends Controller
{
    public function datatable(Request $request)
    {
        $group = $request->ajax() ? $request->post('group') : null;
        $product = isset($group) ? product::where('cgroup_code', $group)->get() : product::all();
        $data = $product->map(function ($item, $index) {
            return [
                'no' => $index + 1,
                'item_code'=> $item->citem_code,
                'item_name'=> $item->citem_name,
                'barcode'  => $item->nbarcode,
                'uom_code' => $item->cuom_code,
                'price'    => '<div class="float-end">'.number_format($item->nretail_po_price).'</div>',
                'sell'     => '<div class="float-end">'.number_format($item->nretail_sell_price).'</div>',
                'action'   => '<div class="text-center">
                                <a href="/product/products/edit/'.$item->id.'" class="btn btn-sm btn-warning" title="Update"><i class="mdi mdi-square-edit-outline"></i></a>
                                <button wire:click="destroy('.$item->id.')" class="btn btn-sm btn-danger" title="Delete"><i class="mdi mdi-trash-can-outline"></i></button>
                            </div>'
            ];
        });
        return response()->json(['data' => $data]);
    }

    public function getDetailProduct(Request $request)
	{

        $code = $request->post('barcode');
        $data = DB::table('mproducts')->select('nbarcode', 'citem_code', 'citem_name', 'cwsale_unit',
                          'cretail_unit','nwsale_value', 'nwsale_po_price', 'nretail_po_price');
        $item = isset($code) ? $data->where('nbarcode', $code)->orWhere('citem_code', $code)->first() : null;
        if ($item) {
            return response()->json([
                'barcode'=> $item->nbarcode,
                'icode'  => $item->citem_code,
                'iname'  => $item->citem_name,
                'wunit'  => $item->cwsale_unit,
                'runit'  => $item->cretail_unit,
                'wvalue' => $item->nwsale_value,
                'wprice' => number_format($item->nwsale_po_price),
                'rprice' => number_format($item->nretail_po_price),
            ]);
        }
        return response()->json(['error' => 'Product not found'], 404);
	}

    public function getSearchProduct(Request $request)
    {
        $name = $request->ajax() ? $request->post('itemname') : null;
        $product = isset($name) ? product::where('citem_name', 'like', '%'.$name.'%')->get() : product::all();
        $data = $product->map(function ($item, $index) {
            return [
                'no' => $index + 1,
                'barcode'=> '<a href="javascript:void(0)" onclick="getItemBarcode(\''.$item->nbarcode.'\')"
                                title="Get barcode">'.$item->citem_code.'</a>',
                'item_name'=> $item->citem_name,
            ];
        });
        return response()->json(['data' => $data]);
    }
}
