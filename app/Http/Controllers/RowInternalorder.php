<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\tr_inorderhdr as intorder;

class RowInternalorder extends Controller
{
    public function datatable(Request $request)
    {
        $sdate = $request->ajax() ? $request->post('sdate') : date('Y-m-d');
        $edate = $request->ajax() ? $request->post('edate') : date('Y-m-d');
        $result = intorder::where(DB::raw('dtrans_date'), '>=', $sdate)
						  ->where(DB::raw('dtrans_date'), '<=', $edate)
						  ->orderBy('dtrans_date','desc')->limit(1000)->get();
        $data = $result->map(function ($row, $index) {
            return [
                'no' => $index + 1,
                'trnsdate'=> $row->dtrans_date,
                'nofaktur'=> $row->cno_inorder,
                'supplier'=> $row->csupplier_name,
                'notes'   => $row->cnotes,
                'status'  => $row->cstatus,
                'total'   => '<div class="float-end">'.number_format($row->ntotal).'</div>',
                'action'  => '<div class="text-center">
                                <a href="/product/products/edit/'.$row->id.'" class="btn btn-sm btn-warning" title="Update"><i class="mdi mdi-square-edit-outline"></i></a>
                                <button wire:click="destroy('.$row->id.')" class="btn btn-sm btn-danger" title="Delete"><i class="mdi mdi-trash-can-outline"></i></button>
                               </div>'
            ];
        });
        return response()->json(['data' => $data]);
    }
}
