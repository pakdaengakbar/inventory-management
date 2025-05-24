<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\mcustomer as customer;

class Mstcustomer extends Controller
{
    public function getDatasearch(Request $request)
    {
        $name = $request->ajax() ? $request->post('search') : null;
        $customer = isset($name)  ? customer::where('cphone', 'like', '%'.$name.'%')
                                            ->orwhere('cmobile', 'like', '%'.$name.'%')
                                            ->orwhere('cname', 'like', '%'.$name.'%')
                                            ->get() : customer::all();
        $data = $customer->map(function ($data, $index) {
            return [
                'no' => $index + 1,
                'id'=> '<a href="javascript:void(0)" onclick="getCustomer(\''.$data->id.'\', \''.$data->cname.'\')" title="Get barcode">'.$data->ccode.'</a>',
                'cname'=> $data->cname,
            ];
        });
        if ($data->isNotEmpty()) {
            return response()->json(['data' => $data]);
        }
        return response()->json([]);
    }
}
