<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\mbank;

class DtbankController extends Controller
{
    public function datatable(Request $request)
    {
        $cafes = mbank::all();
        $data = $cafes->map(function ($data, $index) {
            return [
                'no'     => $index + 1,
                'code'   => $data->ccode,
                'name'   => $data->cname,
                'action' => '<div class="text-center">
                                <button wire:click="editData('.$data->id.')" class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#dataModal" title="Update"><i class="mdi mdi-square-edit-outline"></i></button>
                                <button wire:click="delData('.$data->id.')" class="btn btn-sm btn-danger" title="Delete"><i class="mdi mdi-trash-can-outline"></i></button>
                            </div>'
            ];
        });
        return response()->json(['data' => $data]);
    }
}
