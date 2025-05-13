<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Helpers\MyService as v_;

use App\Models\tr_inorderhdr as ioheader;
use App\Models\tr_inorderdtl as iodetail;

class RowInternalorder extends Controller
{
    public function datatable(Request $request)
    {
        $sdate = $request->ajax() ? $request->post('sdate') : date('Y-m-d');
        $edate = $request->ajax() ? $request->post('edate') : date('Y-m-d');
        $region = $request->ajax() ? $request->post('region') : null;
        $result = ioheader::where(DB::raw('dtrans_date'), '>=', $sdate)
						  ->where(DB::raw('dtrans_date'), '<=', $edate);

        if ($region != null) $result = $result->where('nregion_id', $region);
        $result = $result->orderBy('dtrans_date','desc')->limit(1000)->get();

        //DB::enableQueryLog();
        //$query = DB::getQueryLog();
        //dd($query);
        $data = $result->map(function ($row, $index) {
            return [
                'no' => $index + 1,
                'trnsdate'=> $row->dtrans_date,
                'nofaktur'=> $row->cno_inorder,
                'supplier'=> $row->csupplier_name,
                'notes'   => $row->cnotes,
                'status'  => '<div class="text-center">'.$row->cstatus.'</div>',
                'total'   => '<div class="float-end">'.number_format($row->ntotal).'</div>',
                'action'  => '<div class="text-center">
                                <a href="/product/products/edit/'.$row->id.'" class="btn btn-sm btn-warning" title="Update"><i class="mdi mdi-square-edit-outline"></i></a>
                                <button wire:click="destroy('.$row->id.')" class="btn btn-sm btn-danger" title="Delete"><i class="mdi mdi-trash-can-outline"></i></button>
                               </div>'
            ];
        });
        return response()->json(['data' => $data]);
    }

    public function simpan(Request $request)
    {
        $month = date('m').date('Y');
        $supplier = v_::getRowData('msuppliers', $request->post('csupplier_id'));
        //create post
        $uauth = v_::getUser_Auth();
        $code = v_::MaxNumber('tr_inorderhdr', 1, 1);
        $code = 'IO-'.date('ymd').'-'.$code;

        $datahdr = array(
            'cno_inorder' => $code,
            'dtrans_date' => $trans_date =  $request->post('dtrans_date'),
            'csupplier_id'=> $supplier_id = $request->post('csupplier_id'),
            'csupplier_name' => $supplier->cname,
            'cnotes'    => $request->post('cnotes'),
            'cstatus'   => 'O',
            'ccashier'  => $uauth['name'],
            'ccreate_by'=> $uauth['id'],
            'cmonth'    => $month,
            'ntotal'    => str_replace(",","",$request->post('ntotal')),
            'nregion_id'=> $region_id = $request->post('cregion_id'),
            'ncompanie_id' => $uauth['companie_id'],
        );
        ioheader::create($datahdr);
        $headerId = ioheader::latest()->first();
        // insert detail
        $datadtl = array();
        foreach ($request->post('icode') as $key => $row) {
            $datadtl[] = array(
                'nheader_id'  => $headerId->id,
                'dtrans_date' => $trans_date,
                'csupplier_id'=> $supplier_id,
                'cno_inorder' => $code,
                'nbarcode'    => $row['barcode'],
                'citem_code'  => $row['item_code'],
                'citem_name'  => $row['item_name'],
                'nqty'        => $row['qty'],
                'nqty1'       => $row['qty'],
                'ccreate_by'  => $uauth['id'],
                'nregion_id'=> $region_id,
                'ncompanie_id' => $uauth['companie_id'],
            );
        }
        iodetail::insert($datadtl);
        return response()->json(array('success' => true, 'last_insert_id' => $headerId), 200);
    }
}
