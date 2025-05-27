<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\mproduct as product;
use App\Constants\Status as s_;

class CfprodCotntroller extends Controller
{
    public function datatable(Request $request)
    {

        $url_ = s_::URL_.'products/';
        $code  = array('33','34','35');
        $group = $request->post('group');
        // Check if group is null or empty
        $product = $group === null || $group === ''
                    ? product::whereIn('cgroup_code', $code)->get()
                    : product::where('cgroup_code', $group)->get();
        $data = $product->map(function ($item, $index) use ($url_) {
            if ($item->iPhoto){
                $src = $url_.$item->iPhoto;
            }else{
                $src = 'storage/NoImage.jpg';
            }
            $photo = '<img src="'.asset($src).'" alt="logo" class="rounded-circle img-fluid avatar-sm img-thumbnail" width="30%" id="file_image">';

            return [
                'no'       => $index + 1,
                'image'    => $photo,
                'item_code'=> $item->citem_code,
                'item_name'=> $item->citem_name,
                'barcode'  => $item->nbarcode,
                'uom_code' => $item->cuom_code,
                'price'    => '<div class="float-end">'.number_format($item->nretail_po_price).'</div>',
                'sell'     => '<div class="float-end">'.number_format($item->nretail_sell_price).'</div>',
                'action'   => '<div class="text-center">
                                <a href="/cafe/products/edit/'.$item->id.'" class="btn btn-sm btn-warning" title="Update"><i class="mdi mdi-square-edit-outline"></i></a>
                                <button wire:click="destroy('.$item->id.')" class="btn btn-sm btn-danger" title="Delete"><i class="mdi mdi-trash-can-outline"></i></button>
                            </div>'
            ];
        });
        return response()->json(['data' => $data]);
    }

}
