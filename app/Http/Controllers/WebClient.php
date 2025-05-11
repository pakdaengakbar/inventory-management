<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\web_client as client;

class WebClient extends Controller
{
    public function datatable(Request $request)
    {
        $clients = client::all();
        $data = $clients->map(function ($item, $index) {
            return [
                'no'   => $index + 1,
                'ctype'=> $item->ctype,
                'cname'=> $item->cname,
                'cleader' => $item->cleader,
                'caddress'=> $item->caddress,
                'cphone'  => $item->cphone,
                'cemail'  => $item->cemail,
                'ctestimonials' => $item->ctestimonials,
                'action'=> '<div class="text-center">
                                <button wire:click="editData('.$item->id.')" class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#dataModal" title="Update"><i class="mdi mdi-square-edit-outline"></i></button>
                                <button wire:click="delData('.$item->id.')" class="btn btn-sm btn-danger" title="Delete"><i class="mdi mdi-trash-can-outline"></i></button>
                            </div>'
            ];
        });
        return response()->json(['data' => $data]);
    }
}
