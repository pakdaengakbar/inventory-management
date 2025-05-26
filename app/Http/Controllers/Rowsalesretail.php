<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Helpers\MyService as v_;
use App\Helpers\MyHelper as h_;

use App\Models\tr_saleshdr as srheader;
use App\Models\tr_salesdtl as srdetail;

class Rowsalesretail extends Controller
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
                            ->where('cflag', 'SO');
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
                                    <a href="/sales/retail/edit/'.$row->id.'" class="btn btn-sm btn-warning" title="Update"><i class="mdi mdi-square-edit-outline"></i></a>
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
            'cflag'       => 'SO',
            'cmonth'      => $month,
            'cpay_type'   => 2,
            'cno_faktur'  => $no_so = 'SO-'.date('ymd').'-'.$code['gennum'],
            'dtrans_date' => $trans_date =  date('Y-m-d'),
            'ncustomer_id'=> '999999999',
            'ccustomer_name'=> 'Customer',
            'cnotes'      => 'Sales Retail',
            'nprint'      => 1,
            'nsub_total'  => $request->post('nsub_total') ? str_replace(",","",$request->post('nsub_total')) : 0,
            'nppn'        => $request->post('nppn') ? str_replace(",","",$request->post('nppn')) : 0,
            'ntot_ppn'    => $request->post('ntot_ppn') ? str_replace(",","",$request->post('ntot_ppn')) : 0,
            'ntotal'      => $request->post('ntotal') ? str_replace(",","",$request->post('ntotal')) : 0,
            'npayment'    => $request->post('npayment') ? str_replace(",","",$request->post('npayment')) : 0,
            'nremaining'  => abs($request->post('nremaining') ? str_replace(",","",$request->post('nremaining')) : 0),
            'ccashier'    => $uauth['name'],
            'ccreate_by'  => $uauth['id'],
            'nnum_log'    => $code['maxnum'],
            'nregion_id'  => $region_id = $uauth['region_id'],
            'ncompanie_id'=> $uauth['companie_id'],
        );
        // check if status is pending or complete
        if ($request->post('status') == 'P') {
            $datahdr['cstatus'] = 'P';
        }else {
            $datahdr['cstatus'] = 'C';
        }
        // insert header
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
            'nsub_total' => $request->post('nsub_total') ? str_replace(",","",$request->post('nsub_total')) : 0,
            'nppn'       => $request->post('nppn') ? str_replace(",","",$request->post('nppn')) : 0,
            'ntot_ppn'   => $request->post('ntot_ppn') ? str_replace(",","",$request->post('ntot_ppn')) : 0,
            'ntotal'     => $request->post('ntotal') ? str_replace(",","",$request->post('ntotal')) : 0,
            'npayment'   => $request->post('npayment') ? str_replace(",","",$request->post('npayment')) : 0,
            'nremaining' => abs($request->post('nremaining') ? str_replace(",","",$request->post('nremaining')) : 0),
            'nprint'     => $datahdr->nprint + 1,
            'cupdate_by' => $uauth['id'],
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
                            'nheader_id'  => $datahdr->id,
                            'dtrans_date' => $datahdr->dtrans_date,
                            'cno_faktur'  => $datahdr->cno_faktur,
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

    public function getSearchsales(Request $request)
    {
        $search= $request->ajax() ? $request->post('search') : null;
        $sales = srheader::select('dtrans_date','cno_faktur','ntotal','ncustomer_id','ccustomer_name')->where('cflag', 'SV')->where('cstatus', 'C')->where('cno_faktur', 'like', '%'.$search.'%')->get();
        $data  = $sales->map(function ($data, $index) {
            return [
                'no' => $index + 1,
                'trans_date'=> $data->dtrans_date,
                'no_faktur'=> '<a href="javascript:void(0)" onclick="getSalesretail(\''.$data->cno_faktur.'\',\''.$data->ncustomer_id.'\',\''.$data->ccustomer_name.'\')"
                                title="Get No-sales">'.$data->cno_faktur.'</a>',
                'total'=> number_format($data->ntotal),
                'customer'=> '<a href="javascript:void(0)" class="text-danger" onclick="getSalesretail(\''.$data->cno_faktur.'\',\''.$data->ncustomer_id.'\',\''.$data->ccustomer_name.'\')"
                                title="Get No-sales">'.$data->ccustomer_name.'</a>',
            ];
        });

        if ($data->isNotEmpty()) {
            return response()->json(['data' => $data]);
        }
        return response()->json([]);
    }

    public function getItemsales(Request $request)
    {
        $nofaktur = $request->post('nofaktur');
        $sales = isset($nofaktur) ? srdetail::select('nbarcode','citem_code','citem_name','cuom','nqty','nprice')
                           ->where('cno_faktur', $nofaktur)->get() : null;
        if ($sales && $sales->isNotEmpty()) {
            $item = $sales->map(function ($data) {
                return [
                    'barcode' => $data->nbarcode,
                    'icode'   => $data->citem_code,
                    'iname'   => $data->citem_name,
                    'runit'   => $data->cuom,
                    'qty'     => $data->nqty,
                    'rprice'  => number_format($data->nprice),
                ];
            });
            return response()->json($item);
        }
        return response()->json([]);
    }
}
