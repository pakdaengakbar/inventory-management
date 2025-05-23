<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\mbrand_group as group;

class DtgroupController extends Controller
{
    public function datatable(Request $request)
    {
        $groups = group::all();
        $data = $groups->map(function ($item, $index) {
            return [
                'no' => $index + 1,
                'code' => $item->ccode,
                'name' => $item->cname,
                'action' => '<div class="text-center">
                                <button wire:click="editGroup('.$item->id.')" class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#departModal" title="Update"><i class="mdi mdi-square-edit-outline"></i></button>
                                <button wire:click="delGroup('.$item->id.')" class="btn btn-sm btn-danger" title="Delete"><i class="mdi mdi-trash-can-outline"></i></button>
                            </div>'
            ];
        });
        return response()->json(['data' => $data]);
    }
}
