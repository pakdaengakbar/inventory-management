<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Helpers\MyService as v_;
use App\Helpers\MyHelper as h_;

use App\Models\tr_saleshdr as srheader;
use App\Models\tr_salesdtl as srdetail;

class CfcashierController extends Controller
{
    public function datatable(Request $request)
    {

        $sdate  = $request->ajax() ? $request->post('sdate') : date('Y-m-d');
        $edate  = $request->ajax() ? $request->post('edate') : date('Y-m-d');
        $region = $request->ajax() ? $request->post('region') : null;
        $result = srheader::select('id','cno_faktur','corder_num','dtrans_date',
                                    'ccustomer_name','nsub_total','ntot_ppn','ntotal',
                                    'npayment','nremaining','cpay_type','cstatus','nregion_id')
                            ->where(DB::raw('dtrans_date'), '>=', $sdate)
						    ->where(DB::raw('dtrans_date'), '<=', $edate)
                            ->where('cflag', 'CF');
        if ($region != null) $result = $result->where('nregion_id', $region);
        $result = $result->orderBy('dtrans_date','desc')->limit(1000)->get();

        $data = $result->map(function ($row, $index) {
            return [
                'no' => $index + 1,
                'trnsdate' => $row->dtrans_date,
                'no_faktur'=> $row->cno_faktur,
                'cust_name'=> $row->ccustomer_name,
                'sub_total'=> '<div class="float-end">'.number_format($row->nsub_total).'</div>',
                'tot_ppn'  => '<div class="float-end">'.number_format($row->ntot_ppn).'</div>',
                'total'    => '<div class="float-end">'.number_format($row->ntotal).'</div>',
                'payment'  => '<div class="float-end">'.number_format($row->npayment).'</div>',
                'remaining'=> '<div class="float-end">'.number_format($row->nremaining).'</div>',
                'pay_type' => $row->cpay_type,
                'status'   => '<div class="text-center">'.h_::_getstatus($row->cstatus).'</div>',
                'region'   => $row->region ? $row->region->cname : '',
                'action'   => '<div class="text-center">
                                    <a href="/sales/cashier/edit/'.$row->id.'" class="btn btn-sm btn-warning" title="Update"><i class="mdi mdi-square-edit-outline"></i></a>
                                    <button wire:click="destroy('.$row->id.', \''.$row->cstatus.'\')" class="btn btn-sm btn-danger" title="Delete"><i class="mdi mdi-trash-can-outline"></i></button>
                                </div>'
            ];
        });
        return response()->json(['data' => $data]);
    }

    public function save(Request $request)
    {
        $month = date('m').date('Y');
        //create post
        $uauth = v_::getUser_Auth();
        $code  = v_::MaxNumber('tr_saleshdr', $uauth['region_id'], $uauth['companie_id']);
        $datahdr = array(
            'cstatus'     => 'C',
            'cflag'       => 'CF',
            'cmonth'      => $month,
            'cpay_type'   => $request->post('cpay_type'),
            'cno_faktur'  => $no_so = 'SV-'.date('ymd').'-'.$code['gennum'],
            'dtrans_date' => $trans_date = $request->post('dtrans_date'),
            'ncustomer_id'=> $request->post('ncustomer_id'),
            'ccustomer_name'=> $request->post('ccustomer_name'),
            'cnotes'      => 'Service Center',
            'nsub_total'  => $request->post('nsub_total') ? str_replace(",","",$request->post('nsub_total')) : 0,
            'nppn'        => $request->post('nppn') ? str_replace(",","",$request->post('nppn')) : 0,
            'ntot_ppn'    => $request->post('ntot_ppn') ? str_replace(",","",$request->post('ntot_ppn')) : 0,
            'ntotal'      => $request->post('ntotal') ? str_replace(",","",$request->post('ntotal')) : 0,
            'npayment'    => $request->post('npayment') ? str_replace(",","",$request->post('npayment')) : 0,
            'nremaining'   => abs($request->post('nremaining') ? str_replace(",","",$request->post('nremaining')) : 0),
            'ccashier'    => $uauth['name'],
            'ccreate_by'  => $uauth['id'],
            'nnum_log'    => $code['maxnum'],
            'nregion_id'  => $region_id = $uauth['region_id'],
            'ncompanie_id'=> $uauth['companie_id'],
        );
        srheader::create($datahdr);
        $headerId = srheader::latest()->first();
        // insert detail
        $datadtl = array();
        if ($request->post('icode')) {
            foreach ($request->post('icode') as $key => $row) {
                $datadtl[] = array(
                    'nheader_id'  => $headerId->id,
                    'dtrans_date' => $trans_date,
                    'cno_faktur'  => $no_so,
                    'nbarcode'    => $row['barcode'],
                    'citem_code'  => $row['item_code'],
                    'citem_name'  => $row['item_name'],
                    'cuom'        => $row['uom'],
                    'nqty'        => $row['qty'],
                    'nprice'      => str_replace(",","",$row['price']),
                    'ntotal'      => str_replace(",","",$row['itotal']),
                    'ccreate_by'  => $uauth['id'],
                    'cmonth'      => $month,
                    'ctime'       => date('His'),
                    'ccashier'    => $uauth['name'],
                    'cpay_type'   => 'Cash',
                    'nregion_id'  => $region_id,
                    'ncompanie_id'=> $uauth['companie_id'],
                );
            }
            srdetail::insert($datadtl);
        }
        return response()->json(array('success' => true, 'last_insert_id' => $headerId), 200);
    }

    public function update(Request $request)
    {
        $month = date('m').date('Y');
        //create post
        $uauth = v_::getUser_Auth();
        $datahdr = srheader::find($request->post('id'));
        $rowhdr = array(
            'dtrans_date' => $request->post('dtrans_date'),
            'cexpedition' => $request->post('cexpedition'),
            'cshipment'   => $request->post('cshipment'),
            'nsrc_region' => $request->post('nsrc_region'),
            'ndst_region' => $request->post('ndst_region'),
            'cnotes'      => $request->post('cnotes'),
            'csender'     => $request->post('csender'),
            'crecipient'  => $request->post('crecipient'),
            'nsub_total'  => $request->post('nsub_total') ? str_replace(",","",$request->post('nsub_total')) : 0,
            'nshipp_cost' => $shipp_cost = $request->post('nshipp_cost') ? str_replace(",","",$request->post('nshipp_cost')) : 0,
            'ntotal'      => $request->post('ntotal') ? str_replace(",","",$request->post('ntotal')) : 0,
            'cupdate_by'=> $uauth['id'],
        );
        $datahdr->update($rowhdr);

        //update detail
        $datadtl = array();
        if ($request->post('icode')) {
            foreach ($request->post('icode') as $key => $row) {
                $checkdtl = srdetail::find($row['iid']);
                if($checkdtl) {
                    $row1dtl = array(
                        'nqty'        => $row['qty'],
                        'nprice'      => str_replace(",","",$row['price']),
                        'ntotal'      => str_replace(",","",$row['itotal']),
                        'cupdate_by'  => $uauth['id'],
                        'cmonth'      => $month,
                        'ctime'       => date('His'),
                    );
                    $checkdtl->update($row1dtl);
                } else {
                    $check2dtl = srdetail::where('nheader_id', $request->post('id'))
                                    ->where('citem_code', $row['item_code'])
                                    ->first();
                    if($check2dtl) {
                        $row2dtl = array(
                            'nqty'        => $check2dtl->nqty+$row['qty'],
                            'nprice'      => str_replace(",","",$row['price']),
                            'ntotal'      => str_replace(",","",$row['itotal']),
                            'cupdate_by'  => $uauth['id'],
                            'cmonth'      => $month,
                            'ctime'       => date('His'),
                        );
                        $check2dtl->update($row2dtl);
                    } else {
                        $datadtl[] = array(
                            'nheader_id'  => $request->post('id'),
                            'dtrans_date' => $request->post('dtrans_date'),
                            'cno_delivery'=> $request->post('cno_delivery'),
                            'nbarcode'    => $row['barcode'],
                            'citem_code'  => $row['item_code'],
                            'citem_name'  => $row['item_name'],
                            'cuom'        => $row['uom'],
                            'nqty'        => $row['qty'],
                            'nprice'      => str_replace(",","",$row['price']),
                            'ntotal'      => str_replace(",","",$row['itotal']),
                            'ccreate_by'  => $uauth['id'],
                            'ccashier'    => $uauth['name'],
                            'cpay_type'   => 'Cash',
                            'cmonth'      => $month,
                            'ctime'       => date('His'),
                            'nregion_id'  => $request->post('nregion_id'),
                            'ncompanie_id' => $uauth['companie_id'],
                        );
                        srdetail::insert($datadtl);
                    }
                }
            }
        }
        return response()->json(array('success' => true, 'last_insert_id' => $request->post('cno_inorder')), 200);
    }
}
