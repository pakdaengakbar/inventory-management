<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Helpers\MyService as v_;
use App\Helpers\MyHelper as h_;

use App\Models\tr_mutationhdr as moheader;
use App\Models\tr_mutationdtl as modetail;

class Rowmutationout extends Controller
{
    public function datatable(Request $request)
    {
        $sdate  = $request->ajax() ? $request->post('sdate') : date('Y-m-d');
        $edate  = $request->ajax() ? $request->post('edate') : date('Y-m-d');
        $region = $request->ajax() ? $request->post('region') : null;
        $result = moheader::select('id','dtrans_date','cno_mutation','cno_order',
                                    'cexpedition','cshipment','cnotes','cstatus',
                                    'nsrc_region','ndst_region','ntotal','nregion_id')
                            ->where(DB::raw('dtrans_date'), '>=', $sdate)
						    ->where(DB::raw('dtrans_date'), '<=', $edate)
                            ->where('cflag','MOT');
        if ($region != null) $result = $result->where('nregion_id', $region);
        $result = $result->orderBy('dtrans_date','desc')->limit(1000)->get();
        $data = $result->map(function ($row, $index) {
            return [
                'no' => $index + 1,
                'trnsdate'   => $row->dtrans_date,
                'no_mutation'=> $row->cno_mutation,
                'no_order'   => $row->cno_order,
                'expedition' => $row->expedition->cname,
                'shipment'   => $row->cshipment,
                'sender'     => $row->src_region->cname,
                'recipient'  => $row->dst_region->cname,
                'notes'      => $row->cnotes,
                'status'     => '<div class="text-center">'.h_::_getstatus($row->cstatus).'</div>',
                'total'      => '<div class="float-end">'.number_format($row->ntotal).'</div>',
                'action'     => '<div class="text-center">
                                    <a href="/inventory/mutout/edit/'.$row->id.'" class="btn btn-sm btn-warning" title="Update"><i class="mdi mdi-square-edit-outline"></i></a>
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
        $code  = v_::MaxNumber('tr_mutationhdr', $uauth['region_id'], $uauth['companie_id']);
        $datahdr = array(
            'cstatus'     => 'O',
            'cflag'       => 'MOT',
            'cmonth'      => $month,
            'cno_mutation'=> $no_mot = 'MOT-'.date('ymd').'-'.$code['gennum'],
            'dtrans_date' => $trans_date =  $request->post('dtrans_date'),
            'cexpedition' => $request->post('cexpedition'),
            'cshipment'   => $request->post('cshipment'),
            'nsrc_region' => $request->post('nsrc_region'),
            'ndst_region' => $request->post('ndst_region'),
            'cnotes'      => $request->post('cnotes'),
            'nsub_total'  => $request->post('nsub_total') ? str_replace(",","",$request->post('nsub_total')) : 0,
            'nshipp_cost' => $shipp_cost =  $request->post('nshipp_cost') ? str_replace(",","",$request->post('nshipp_cost')) : 0,
            'ntotal'      => $request->post('ntotal') ? str_replace(",","",$request->post('ntotal')) : 0,
            'csender'     => $request->post('csender'),
            'crecipient'  => $request->post('crecipient'),
            'ccashier'    => $uauth['name'],
            'ccreate_by'  => $uauth['id'],
            'nnum_log'    => $code['maxnum'],
            'nregion_id'  => $region_id =  $uauth['region_id'],
            'ncompanie_id'=> $uauth['companie_id'],
        );
        moheader::create($datahdr);
        $headerId = moheader::latest()->first();

        // insert detail
        $totalprice = 0;
        $datadtl = array();
        if ($request->post('icode')) {
            foreach ($request->post('icode') as $key => $row) {
                $datadtl[] = array(
                    'nheader_id'  => $headerId->id,
                    'dtrans_date' => $trans_date,
                    'cno_mutation'=> $no_mot,
                    'nbarcode'    => $row['barcode'],
                    'citem_code'  => $row['item_code'],
                    'citem_name'  => $row['item_name'],
                    'cuom'        => $row['uom'],
                    'nqty'        => $uqty = $row['qty'],
                    'nprice'      => $uprice = str_replace(",","",$row['price']),
                    'ccreate_by'  => $uauth['id'],
                    'cmonth'      => $month,
                    'ctime'       => date('His'),
                    'nregion_id'  => $region_id,
                    'ncompanie_id' => $uauth['companie_id'],
                );
                $totalprice += ($uqty * $uprice);
            }
            modetail::insert($datadtl);
        }
        $update = array(
            'nsub_total' => $totalprice ? str_replace(",","",$totalprice) : 0,
            'ntotal'     => $totalprice + $shipp_cost,
            'cupdate_by' => $uauth['id'],
        );
        moheader::where('id', $headerId->id)->update($update);

        return response()->json(array('success' => true, 'last_insert_id' => $headerId), 200);
    }

    public function update(Request $request)
    {
        $month = date('m').date('Y');
        //create post
        $uauth = v_::getUser_Auth();
        $datahdr = moheader::find($request->post('id'));
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
        $totalprice = 0;
        if ($request->post('icode')) {
            foreach ($request->post('icode') as $key => $row) {
                $checkdtl = modetail::find($row['iid']);
                if($checkdtl) {
                    $row1dtl = array(
                        'nqty'        => $hqty = $row['qty'],
                        'nprice'      => $hprice = str_replace(",","",$row['price']),
                        'cupdate_by'  => $uauth['id'],
                        'cmonth'      => $month,
                        'ctime'       => date('His'),
                    );
                    $totalprice +=  $hqty * $hprice;
                    $checkdtl->update($row1dtl);
                } else {
                    $check2dtl = modetail::where('nheader_id', $request->post('id'))
                                    ->where('citem_code', $row['item_code'])
                                    ->first();
                    if($check2dtl) {
                        $row2dtl = array(
                            'nqty'        => $uqty = $check2dtl->nqty+$row['qty'],
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
                            'cno_mutation'=> $request->post('cno_mutation'),
                            'nbarcode'    => $row['barcode'],
                            'citem_code'  => $row['item_code'],
                            'citem_name'  => $row['item_name'],
                            'cuom'        => $row['uom'],
                            'nqty'        => $iqty = $row['qty'],
                            'nprice'      => $iprice = str_replace(",","",$row['price']),
                            'ccreate_by'  => $uauth['id'],
                            'cmonth'      => $month,
                            'ctime'       => date('His'),
                            'nregion_id'  => $request->post('nregion_id'),
                            'ncompanie_id' => $uauth['companie_id'],
                        );
                        $totalprice += ($iqty * $iprice);
                        modetail::insert($datadtl);
                    }
                }
            }
        }
        $update = array(
            'nsub_total' => $totalprice ? str_replace(",","",$totalprice) : 0,
            'ntotal'     => $totalprice + $shipp_cost,
            'cupdate_by' => $uauth['id'],
        );
        moheader::where('id', $request->post('id'))->update($update);

        return response()->json(array('success' => true, 'last_insert_id' => $request->post('cno_inorder')), 200);
    }
}
