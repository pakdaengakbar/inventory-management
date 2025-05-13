<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
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
        $item = isset($code) ? product::where('nbarcode', $code)->orWhere('citem_code', $code)->first() : null;
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
}
