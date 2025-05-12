<?php
namespace App\Helpers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Auth;

use App\Models\Mcompanie;
use App\Models\Mregion;
use App\Models\Mdepart;
use App\Models\Mposition;
use App\Models\indcities as cities;
use App\Models\mbrand_group as prodgroup;
use App\Models\mbrand_prod as prodbrand;
use App\Models\mbrand_type as prodtype;
use App\Models\muom as uom;

use App\Models\msupplier as supplier;
use App\Models\mcustomer as customer;

use App\Models\Mlog_user as userLog;
use App\Models\Mlog_activity as activitylog;

class MyService {
    /* Log Query */
    public static function lastquery($script)
    {
        DB::enableQueryLog();
        $users = $script;
        $quries = DB::getQueryLog();
        dd($quries);
    }
    /* User Auth */
    public static function getUser_Auth(){
        $result = array(
            'id'        => Auth::user()->id,
            'name'      => Auth::user()->name,
            'region_id'  => Auth::user()->nregion_id,
            'companie_id'=> Auth::user()->ncompanie_id,
        );
        return $result;
    }
    public static function generateCode($table){
        $count = MyService::getCountTable($table);
        $numcode =$count+1;
        if (strlen($numcode) == 1) {
            $numcode = '00' . $numcode;
        }
        if (strlen($numcode) == 2) {
            $numcode = '0' . $numcode;
        }
        return $numcode;
    }
    public static function generateNum($table,$field,$id){
        $where = array($field => $id);
        $count = MyService::getCountWhere($table,$where);
        $numcode =$count+1;
        if (strlen($count) == 1) {
            $numcode = '0' .$numcode ;
        }
        return $id.$numcode;
    }
    public static function MaxNumber($table, $region, $companie){
		$month = date('m').date('Y');
        $data = DB::table($table)
                    ->select(DB::raw('MAX(nnum_log) as no'))
                    ->where('cmonth', $month)
                    ->where('nregion_id', $region)
                    ->where('ncompanie_id', $companie)
                    ->first();
		if($data){
			$no = $data->no;
			if ($no==''){$no=0;}
			$tmp = ((int) substr($no,0,5)+1);
			$hasil =sprintf("%05s", $tmp);
		}else{
			$hasil = $month.'00001';
		}
		return $hasil;
	}
    public static function getRowData($table,$id)
    {
        return DB::table($table)->where('id',$id)->first();
    }
    /* Tipe */
    public static function activityLog($uid,$type,$action){
        try {
            $action = json_encode($action);
            $data = array(
                'nuser_id' => $uid,
                'caction'  => $action,
                'ctype'    => $type,
                'curl'     => "$_SERVER[REQUEST_URI]",
                'cip_address' => "http://$_SERVER[HTTP_HOST]"
            );
            activitylog::create($data);
            return 'Success';
        } catch (\Exception $e) {
            return 'Error: ' . $e->getMessage();
        }

    }
    public static function userLog($id,$before,$after){
        try {
            $data = array(
                'nuser_id'=> $id,
                'cbefore' => json_encode($before),
                'cafter'  => json_encode($after),
                'curl'    => "$_SERVER[REQUEST_URI]",
                'cip_address'=> "http://$_SERVER[HTTP_HOST]",
            );
            userLog::create($data);
            return 'Success';
        } catch (\Exception $e) {
            return 'Error: ' . $e->getMessage();
        }
    }
    public static function getCountWhere($table,$where)
    {
        $count = DB::table($table)->where($where)->count();
        return $count;
    }
    public static function getCountTable($table)
    {
        $count = DB::table($table)->count();
        return $count;
    }
    //select all table
    public static function getAllData($table,$where,$order)
    {
        return DB::table($table)->where($where)->orderBy($order,'asc')->get();
    }
    //select all limited table
    public static function getAllDataLimited($table,$order,$limit)
    {
        return DB::table($table)->orderBy($order,'asc')->limit($limit)->get();
    }
    public static function getSelectedDataLimited($table,$where,$order,$limit)
    {
        return DB::table($table)->where($where)->orderBy($order,'asc')->limit($limit)->get();
    }
    //select field
    public static function get_firsttable($table,$where,$key,$field) {
        $response = DB::table($table)->where($where, $key)->first();
        return (isset($response->$field) ? $response->$field : '');
    }
    //select table
    public static function getSelectedData($table,$where)
    {
        $response = DB::table($table)->select(DB::raw('*'))->where($where)->get();
        return $response;
    }
    //update table
    public static function updateData($table,$data,$field_key)
    {
        return DB::table($table)->where($field_key)->update([$data]);
    }
    public static function insertData($table,$data)
    {
        return DB::table($table)->insert([$data]);
    }
    /* Get Data Master */
    public static function getCompany(){
        $result = Mcompanie::all();
        return $result;
    }
    public static function getRegion(){
        $result = Mregion::where('cstatus',1)->get();
        return $result;
    }
    public static function getDepart(){
        $result = Mdepart::all();
        return $result;
    }
    public static function getPosition(){
        $result = Mposition::all();
        return $result;
    }
    public static function getCities(){
        $result = cities::all();
        return $result;
    }
    public static function getProdgroup(){
        $result = prodgroup::all();
        return $result;
    }
    public static function getProdbrand(){
        $result = prodbrand::all();
        return $result;
    }
    public static function getProdtype(){
        $result = prodtype::all();
        return $result;
    }
    public static function getUom(){
        $result = uom::all();
        return $result;
    }
    public static function getSupplier(){
        $result = supplier::where('cstatus', 1)->get();
        return $result;
    }
    public static function getCustomer($status){
        $result = customer::where('cstatus', $status)->where('cflag', 1)->get();
        return $result;
    }
    public static function getBranchId($where){
        $result = Mregion::where($where)->first();
        return $result;
    }
}
