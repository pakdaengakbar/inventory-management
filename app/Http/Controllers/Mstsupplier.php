<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\msupplier as supplier;

class Mstsupplier extends Controller
{
    public function getDatasearch(Request $request)
    {
        $name = $request->ajax() ? $request->post('search') : null;
        $supplier = isset($name)  ? supplier::where('ccode', 'like', '%'.$name.'%')
                                            ->orwhere('cname', 'like', '%'.$name.'%')
                                            ->get() : supplier::all();
        $data = $supplier->map(function ($data, $index) {
            return [
                'no' => $index + 1,
                'id'=> '<a href="javascript:void(0)" onclick="getCustomer(\''.$data->id.'\''.$data->cname.'\')"
                                title="Get barcode">'.$data->ccode.'</a>',
                'cname'=> $data->cname,
            ];
        });

        if ($data->isNotEmpty()) {
            return response()->json(['data' => $data]);
        }
        return response()->json([]);
    }
}
