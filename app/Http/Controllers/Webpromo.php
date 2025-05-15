<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\web_promo as promo;

class Webpromo extends Controller
{
    public function datatable(Request $request)
    {
        $rows = promo::all();
        $datas = $rows->map(function ($data, $index) {
            return [
                'no'   => $index + 1,
                'ctitle'=> $data->ctitle,
                'csummary'=> $data->csummary,
                'ccontents' => $data->ccontents,
                'cstatus'=> $data->cstatus,
                'ctype'  => $data->ctype,
                'action'=> '<div class="text-center">
                                <button wire:click="editData('.$data->id.')" class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#dataModal" title="Update"><i class="mdi mdi-square-edit-outline"></i></button>
                                <button wire:click="delData('.$data->id.')" class="btn btn-sm btn-danger" title="Delete"><i class="mdi mdi-trash-can-outline"></i></button>
                            </div>'
            ];
        });
        return response()->json(['data' => $datas]);
    }
}
