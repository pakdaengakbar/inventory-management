<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\web_category as category;

class WebCategory extends Controller
{
    public function datatable(Request $request)
    {
        $categorys = category::all();
        $data = $categorys->map(function ($item, $index) {
            return [
                'no'    => $index + 1,
                'name'  => $item->cname,
                'type'  => $item->ctype,
                'order' => $item->corder,
                'action'=> '<div class="text-center">
                                <button wire:click="editData('.$item->id.')" class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#dataModal" title="Update"><i class="mdi mdi-square-edit-outline"></i></button>
                                <button wire:click="delData('.$item->id.')" class="btn btn-sm btn-danger" title="Delete"><i class="mdi mdi-trash-can-outline"></i></button>
                            </div>'
            ];
        });
        return response()->json(['data' => $data]);
    }
}
