<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Helpers\MyService as v_;
use App\Helpers\MyHelper as h_;

use App\Models\tr_orderhdr as poheader;
use App\Models\tr_orderdtl as podetail;

class Rowmutationout extends Controller
{
    public function datatable(Request $request)
    {
        $sdate  = $request->ajax() ? $request->post('sdate') : date('Y-m-d');
        $edate  = $request->ajax() ? $request->post('edate') : date('Y-m-d');
        $region = $request->ajax() ? $request->post('region') : null;
        $result = poheader::select('id','dtrans_date','cno_po','cno_order','csupplier_id','csupplier_name',
                                   'cstatus','cnotes','ntotal','csupplier_id','nregion_id')
                            ->where(DB::raw('dtrans_date'), '>=', $sdate)
						    ->where(DB::raw('dtrans_date'), '<=', $edate);
        if ($region != null) $result = $result->where('nregion_id', $region);
        $result = $result->orderBy('dtrans_date','desc')->limit(1000)->get();
        $data = $result->map(function ($row, $index) {
            return [
                'no' => $index + 1,
                'trnsdate'=> $row->dtrans_date,
                'no_po'=> $row->cno_po,
                'no_order'=> $row->cno_quorder,
                'supplier'=> $row->csupplier_name,
                'suppinv' => $row->csupplier_inv,
                'notes'   => $row->cnotes,
                'status'  => '<div class="text-center">'.h_::_getstatus($row->cstatus).'</div>',
                'region'  => $row->region->cname,
                'total'   => '<div class="float-end">'.number_format($row->ntotal).'</div>',
                'action'  => '<div class="text-center">
                                <a href="/inventory/quorder/edit/'.$row->id.'" class="btn btn-sm btn-warning" title="Update"><i class="mdi mdi-square-edit-outline"></i></a>
                                <button wire:click="destroy('.$row->id.')" class="btn btn-sm btn-danger" title="Delete"><i class="mdi mdi-trash-can-outline"></i></button>
                               </div>'
            ];
        });
        return response()->json(['data' => $data]);
    }

    public function save(Request $request)
    {
        $month = date('m').date('Y');
        $supplier = v_::getRowData('msuppliers', $request->post('csupplier_id'));
        //create post
        $uauth = v_::getUser_Auth();
        $code  = v_::MaxNumber('tr_qorderhdr', $uauth['region_id'], $uauth['companie_id']);
        $datahdr = array(
            'cstatus' => 'O',
            'cmonth'  => $month,
            'cno_quorder' => $no_inorder = 'QO-'.date('ymd').'-'.$code['gennum'],
            'dtrans_date' => $trans_date =  $request->post('dtrans_date'),
            'csupplier_id'=> $supplier_id = $request->post('csupplier_id'),
            'csupplier_name' => $supplier->cname,
            'cnotes'  => $request->post('cnotes'),
            'ntotal'  => $request->post('ntotal') ? str_replace(",","",$request->post('ntotal')) : 0,
            'nregion_id'=> $region_id = $request->post('nregion_id'),
            'ncompanie_id' => $uauth['companie_id'],
            'ccashier'  => $uauth['name'],
            'ccreate_by'=> $uauth['id'],
            'nnum_log'  => $code['maxnum']
        );
        poheader::create($datahdr);
        $headerId = poheader::latest()->first();

        // insert detail
        $totalprice = 0;
        $datadtl = array();
        if ($request->post('icode')) {
            foreach ($request->post('icode') as $key => $row) {
                $datadtl[] = array(
                    'nheader_id'  => $headerId->id,
                    'dtrans_date' => $trans_date,
                    'csupplier_id'=> $supplier_id,
                    'cno_quorder' => $no_inorder,
                    'nbarcode'    => $row['barcode'],
                    'citem_code'  => $row['item_code'],
                    'citem_name'  => $row['item_name'],
                    'cuom'        => $row['uom'],
                    'nqty'        => $uqty = $row['qty'],
                    'nqty1'       => $row['qty'],
                    'nprice'      => $uprice = str_replace(",","",$row['price']),
                    'ccreate_by'  => $uauth['id'],
                    'cmonth'      => $month,
                    'ctime'       => date('His'),
                    'nregion_id'  => $region_id,
                    'ncompanie_id' => $uauth['companie_id'],
                );
                $totalprice += ($uqty * $uprice);
            }
            podetail::insert($datadtl);
        }
        $update = array(
            'ntotal'    => $totalprice ? str_replace(",","",$totalprice) : 0,
            'cupdate_by'=> $uauth['id'],
        );
        poheader::where('id', $headerId->id)->update($update);

        return response()->json(array('success' => true, 'last_insert_id' => $headerId), 200);
    }

    public function update(Request $request)
    {
        $month = date('m').date('Y');
        $supplier = v_::getRowData('msuppliers', $request->post('csupplier_id'));
        //create post
        $uauth = v_::getUser_Auth();
        $datahdr = poheader::find($request->post('id'));
        $rowhdr = array(
            'dtrans_date' => $request->post('dtrans_date'),
            'csupplier_id'=> $request->post('csupplier_id'),
            'csupplier_name' => $supplier->cname,
            'cnotes' => $request->post('cnotes'),
            'ntotal' => $request->post('ntotal') ? str_replace(",","",$request->post('ntotal')) : 0,
            'cupdate_by'=> $uauth['id'],
        );
        $datahdr->update($rowhdr);

        //update detail
        $datadtl = array();
        $totalprice = 0;
        if ($request->post('icode')) {
            foreach ($request->post('icode') as $key => $row) {
                $checkdtl = podetail::find($row['iid']);
                if($checkdtl) {
                    $row1dtl = array(
                        'nqty'        => $hqty = $row['qty'],
                        'nqty1'       => $hqty,
                        'nprice'      => $hprice = str_replace(",","",$row['price']),
                        'cupdate_by'  => $uauth['id'],
                        'cmonth'      => $month,
                        'ctime'       => date('His'),
                    );
                    $totalprice +=  $hqty * $hprice;
                    $checkdtl->update($row1dtl);
                } else {
                    $check2dtl = podetail::where('nheader_id', $request->post('id'))
                                    ->where('citem_code', $row['item_code'])
                                    ->first();
                    if($check2dtl) {
                        $row2dtl = array(
                            'nqty'        => $uqty = $check2dtl->nqty+$row['qty'],
                            'nqty1'       => $check2dtl->nqty1+$row['qty'],
                            'nprice'      => $uprice = str_replace(",","",$row['price']),
                            'cupdate_by'  => $uauth['id'],
                            'cmonth'      => $month,
                            'ctime'       => date('His'),
                        );
                        $totalprice += ($uqty * $uprice);
                        $check2dtl->update($row2dtl);
                    } else {
                        $datadtl[] = array(
                            'nheader_id'  => $request->post('id'),
                            'dtrans_date' => $request->post('dtrans_date'),
                            'csupplier_id'=> $request->post('csupplier_id'),
                            'cno_inorder' => $request->post('cno_inorder'),
                            'nbarcode'    => $row['barcode'],
                            'citem_code'  => $row['item_code'],
                            'citem_name'  => $row['item_name'],
                            'cuom'        => $row['uom'],
                            'nqty'        => $iqty = $row['qty'],
                            'nqty1'       => $iqty,
                            'nprice'      => $iprice = str_replace(",","",$row['price']),
                            'ccreate_by'  => $uauth['id'],
                            'cmonth'      => $month,
                            'ctime'       => date('His'),
                            'nregion_id'  => $request->post('nregion_id'),
                            'ncompanie_id' => $uauth['companie_id'],
                        );
                        $totalprice += ($iqty * $iprice);
                        podetail::insert($datadtl);
                    }
                }
            }
        }

        $update = array(
            'ntotal'    => $totalprice ? str_replace(",","",$totalprice) : 0,
            'cupdate_by'=> $uauth['id'],
        );
        poheader::where('id', $request->post('id'))->update($update);

        return response()->json(array('success' => true, 'last_insert_id' => $request->post('cno_inorder')), 200);
    }
}
