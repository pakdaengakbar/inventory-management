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
                                <a href="/master/employees/edit/'.$item->id.'" class="btn btn-sm btn-warning" title="Update"><i class="mdi mdi-square-edit-outline"></i></a>
                                <button wire:click="destroy('.$item->id.')" class="btn btn-sm btn-danger" title="Delete"><i class="mdi mdi-trash-can-outline"></i></button>
                               </div>'
            ];
        });
        return response()->json(['data' => $data]);
    }
}
