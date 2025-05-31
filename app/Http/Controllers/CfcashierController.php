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
        $status = $request->ajax() ? $request->post('status') : null;

        $result = srheader::select('id','cno_faktur','corder_num','dtrans_date',
                                    'ccustomer_name','nsub_total','ntot_ppn','ntotal','ntot_disc',
                                    'npayment','nremaining','cpay_type','cstatus','nregion_id')
                            ->where(DB::raw('dtrans_date'), '>=', $sdate)
						    ->where(DB::raw('dtrans_date'), '<=', $edate)
                            ->where('cflag', 'CF');
        if ($region != null) $result = $result->where('nregion_id', $region);
        if ($status != null) $result = $result->where('cstatus', $status);
        $result = $result->orderBy('dtrans_date','desc')->limit(1000)->get();

        $data = $result->map(function ($row, $index) {
            return [
                'no' => $index + 1,
                'trnsdate' => $row->dtrans_date,
                'no_faktur'=> $row->cno_faktur,
                'cust_name'=> $row->ccustomer_name,
                'sub_total'=> '<b class="float-end text-primary">'.number_format($row->nsub_total).'</b>',
                'tot_ppn'  => '<div class="float-end">'.number_format($row->ntot_ppn).'</div>',
                'tot_disc' => '<div class="float-end">'.number_format($row->ntot_disc).'</div>',
                'total'    => '<b class="float-end text-primary">'.number_format($row->ntotal).'</b>',
                'payment'  => '<b class="float-end text-warning">'.number_format($row->npayment).'</b>',
                'remaining'=> '<div class="float-end text-danger">'.number_format($row->nremaining).'</div>',
                'pay_type' => $row->cpay_type,
                'status'   => '<div class="text-center">'.h_::_getstatus($row->cstatus).'</div>',
                'region'   => $row->region ? $row->region->cname : '',
                'action'   => '<div class="text-center">
                                    <a href="/cafe/cashiers/edit/'.$row->id.'" class="btn btn-sm btn-warning" title="Update"><i class="mdi mdi-square-edit-outline"></i></a>
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
        $payment = $request->post('npayment') ? str_replace(",","",$request->post('npayment')) : 0;
        $datahdr = array(
            'cflag'       => 'CF',
            'cmonth'      => $month,
            'corder_num'  => $order_num = $request->post('corder_num'),
            'cpay_type'   => $pay_type  = $request->post('cpay_type'),
            'cno_faktur'  => $no_so = 'CF-'.date('ymd').'-'.$code['gennum'],
            'dtrans_date' => $trans_date = date('Y-m-d'),
            'ncustomer_id'=> '999999999',
            'ccustomer_name'=> $request->post('ccustomer_name'),
            'cnotes'      => 'Cafe & Resto',
            'nfee'        => $request->post('nfee') ? str_replace(",","",$request->post('nfee')) : 0,
            'ntot_fee'    => $request->post('ntot_fee') ? str_replace(",","",$request->post('ntot_fee')) : 0,
            'ndisc'       => $request->post('ndisc') ? str_replace(",","",$request->post('ndisc')) : 0,
            'ntot_disc'   => $request->post('ntot_disc') ? str_replace(",","",$request->post('ntot_disc')) : 0,
            'nsub_total'  => $request->post('nsub_total') ? str_replace(",","",$request->post('nsub_total')) : 0,
            'nppn'        => $request->post('nppn') ? str_replace(",","",$request->post('nppn')) : 0,
            'ntot_ppn'    => $request->post('ntot_ppn') ? str_replace(",","",$request->post('ntot_ppn')) : 0,
            'ntotal'      => $request->post('ntotal') ? str_replace(",","",$request->post('ntotal')) : 0,
            'npayment'    => $payment,
            'nremaining'  => abs($request->post('nremaining') ? str_replace(",","",$request->post('nremaining')) : 0),
            'ccashier'    => $uauth['name'],
            'ccreate_by'  => $uauth['id'],
            'nnum_log'    => $code['maxnum'],
            'nregion_id'  => $region_id = $uauth['region_id'],
            'ncompanie_id'=> $uauth['companie_id'],
            'cterminal'   => "http://$_SERVER[HTTP_HOST]"."$_SERVER[REQUEST_URI]",
        );
        if ($payment==0){
            $datahdr['cstatus']='O';
        }else{
            $datahdr['cstatus']='C';
        }

        srheader::create($datahdr);
        $headerId = srheader::latest()->first();
        // insert detail
        $items = $request->input('icode');
        $datadtl = array();
        if ($items) {
            foreach ($items as $key => $row) {
                $idetil = h_::getItemcode($row['iID']);
                $datadtl[] = array(
                    'nheader_id'  => $headerId->id,
                    'corder_num'  => $order_num,
                    'dtrans_date' => $trans_date,
                    'cno_faktur'  => $no_so,
                    'nbarcode'    => $idetil->nbarcode,
                    'citem_code'  => $idetil->citem_code,
                    'citem_name'  => $row['item_name'],
                    'cuom'        => $idetil->cuom_code,
                    'nqty'        => $row['iqty'],
                    'nhpp'        => $idetil->nretail_po_price,
                    'nprice'      => str_replace(",","",$row['iprice']),
                    'ntotal'      => str_replace(",","",$row['itotal']),
                    'ccreate_by'  => $uauth['id'],
                    'cmonth'      => $month,
                    'ctime'       => date('His'),
                    'ccashier'    => $uauth['name'],
                    'cpay_type'   => $pay_type,
                    'nregion_id'  => $region_id,
                    'csource'     => "http://$_SERVER[HTTP_HOST]"."$_SERVER[REQUEST_URI]",
                    'ncompanie_id'=> $uauth['companie_id'],
                    'cproduk_code'=> $idetil->cgroup_code,
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
        $payment = $request->post('npayment') ? str_replace(",","",$request->post('npayment')) : 0;
        $rowhdr = array(
            'nfee'        => $request->post('nfee') ? str_replace(",","",$request->post('nfee')) : 0,
            'ntot_fee'    => $request->post('ntot_fee') ? str_replace(",","",$request->post('ntot_fee')) : 0,
            'ndisc'       => $request->post('ndisc') ? str_replace(",","",$request->post('ndisc')) : 0,
            'ntot_disc'   => $request->post('ntot_disc') ? str_replace(",","",$request->post('ntot_disc')) : 0,
            'nsub_total'  => $request->post('nsub_total') ? str_replace(",","",$request->post('nsub_total')) : 0,
            'nppn'        => $request->post('nppn') ? str_replace(",","",$request->post('nppn')) : 0,
            'ntot_ppn'    => $request->post('ntot_ppn') ? str_replace(",","",$request->post('ntot_ppn')) : 0,
            'ntotal'      => $request->post('ntotal') ? str_replace(",","",$request->post('ntotal')) : 0,
            'npayment'    => $payment,
            'nremaining'  => abs($request->post('nremaining') ? str_replace(",","",$request->post('nremaining')) : 0),
            'cupdate_by'  => $uauth['id'],
        );
        if ($payment==0){
            $datahdr['cstatus']='O';
        }else{
            $datahdr['cstatus']='C';
        }
        $datahdr->update($rowhdr);

        //update detail
        $items = $request->input('icode');
        $datadtl = array();
        if ($items) {
            foreach ($items as $key => $row) {
                $checkdtl = srdetail::find($row['iID']);
                if($checkdtl) {
                    $row1dtl = array(
                        'nqty'        => $row['iqty'],
                        'nprice'      => str_replace(",","",$row['iprice']),
                        'ntotal'      => str_replace(",","",$row['itotal']),
                        'cupdate_by'  => $uauth['id'],
                        'cmonth'      => $month,
                        'ctime'       => date('His'),
                    );
                    $checkdtl->update($row1dtl);
                } else {
                    $check2dtl = srdetail::where('nheader_id', $request->post('id'))
                                    ->where('citem_code', $row['citem_code'])
                                    ->first();
                    if($check2dtl) {
                        $row2dtl = array(
                            'nqty'        => $check2dtl->nqty+$row['iqty'],
                            'nprice'      => str_replace(",","",$row['iprice']),
                            'ntotal'      => str_replace(",","",$row['itotal']),
                            'cupdate_by'  => $uauth['id'],
                            'cmonth'      => $month,
                            'ctime'       => date('His'),
                        );
                        $check2dtl->update($row2dtl);
                    } else {
                        $idetil = h_::getItemcode($row['citem_code']);
                        $datadtl[] = array(
                            'nheader_id'  => $datahdr->id,
                            'corder_num'  => $datahdr->corder_num,
                            'dtrans_date' => $datahdr->dtrans_date,
                            'cno_faktur'  => $datahdr->cno_faktur,
                            'nbarcode'    => $idetil->nbarcode,
                            'citem_code'  => $idetil->citem_code,
                            'citem_name'  => $row['item_name'],
                            'cuom'        => $idetil->cuom_code,
                            'nqty'        => $row['iqty'],
                            'nhpp'        => $idetil->nretail_po_price,
                            'nprice'      => str_replace(",","",$row['iprice']),
                            'ntotal'      => str_replace(",","",$row['itotal']),
                            'ccreate_by'  => $uauth['id'],
                            'cmonth'      => $month,
                            'ctime'       => date('His'),
                            'ccashier'    => $uauth['name'],
                            'cpay_type'   => $datahdr->cpay_type,
                            'nregion_id'  => $datahdr->nregion_id,
                            'csource'     => "http://$_SERVER[HTTP_HOST]"."$_SERVER[REQUEST_URI]",
                            'ncompanie_id'=> $uauth['companie_id'],
                            'cproduk_code'=> $idetil->cgroup_code,
                        );
                        srdetail::insert($datadtl);
                    }
                }
            }
        }
        return response()->json(array('success' => true, 'last_insert_id' => $request->post('cno_inorder')), 200);
    }
}
