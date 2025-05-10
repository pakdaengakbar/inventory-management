<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\mbrand_prod as brand;

class DtbrandController extends Controller
{
    public function datatable(Request $request)
    {
        $brands = brand::all();
        $data = $brands->map(function ($item, $index) {
            return [
                'no' => $index + 1,
                'code' => $item->ccode,
                'name' => $item->cname,
                'action' => '<div class="text-center">
                                <button wire:click="editBrand('.$item->id.')" class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#departModal" title="Update"><i class="mdi mdi-square-edit-outline"></i></button>
                                <button wire:click="delBrand('.$item->id.')" class="btn btn-sm btn-danger" title="Delete"><i class="mdi mdi-trash-can-outline"></i></button>
                            </div>'
            ];
        });
        return response()->json(['data' => $data]);
    }
}
