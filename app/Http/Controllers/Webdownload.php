<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\web_download as download;

class Webdownload extends Controller
{
    public function datatable(Request $request)
    {
        $rows = download::all();
        $datas = $rows->map(function ($data, $index) {
            return [
                'no'   => $index + 1,
                'ctype'=> $data->ctype,
                'cname'=> $data->cname,
                'cleader' => $data->cleader,
                'caddress'=> $data->caddress,
                'cphone'  => $data->cphone,
                'cemail'  => $data->cemail,
                'ctestimonials' => $data->ctestimonials,
                'action'=> '<div class="text-center">
                                <button wire:click="editData('.$data->id.')" class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#dataModal" title="Update"><i class="mdi mdi-square-edit-outline"></i></button>
                                <button wire:click="delData('.$data->id.')" class="btn btn-sm btn-danger" title="Delete"><i class="mdi mdi-trash-can-outline"></i></button>
                            </div>'
            ];
        });
        return response()->json(['data' => $datas]);
    }
}
