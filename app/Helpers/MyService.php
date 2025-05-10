<?php
namespace App\Helpers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Auth;

use App\Models\Mcompanie;
use App\Models\Mdepart;
use App\Models\Mposition;
use App\Models\Mregion;

use App\Models\mbrand_group as prodgroup;
use App\Models\mbrand_prod as prodbrand;
use App\Models\indcities as cities;
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
            'id'   => Auth::user()->id,
            'name' => Auth::user()->name,
        );
        return $result;
    }
    public static function generateCode($table){
        $count = MyService::getCountTable($table);
        $numcode =$count+1;
        if (strlen($count) == 1) {
            $numcode = '0' .$numcode ;
        }
        if (strlen($count) == 2) {
            $numcode = '00' .$numcode ;
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
    /* Get Master */
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

    public static function getBranchId($where){
        $result = Mregion::where($where)->first();
        return $result;
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
    /* use function */
    public static function genRandomChr($num) {
        $randomStr = substr(str_shuffle(str_repeat($x='ABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($num/strlen($x)) )),1,$num);
        return $randomStr;
    }
    public static function genRandomNum($num) {
        $randomStr = substr(str_shuffle(str_repeat($x='01234567890987654321', ceil($num/strlen($x)) )),1,$num);
        return $randomStr;
    }

    public static function hari() {
        $hari2=date("w");
        Switch ($hari2){
            case 0 	: $hari="Minggu"; Break;
            case 1 	: $hari="Senin"; Break;
            case 2	: $hari="Selasa"; Break;
            case 3 	: $hari="Rabu"; Break;
            case 4 	: $hari="Kamis"; Break;
            case 5 	: $hari="Jumat"; Break;
            case 6 	: $hari="Sabtu"; Break;
        }
        return $hari;
    }
    public static function Server_thn($date){
        $exp = explode('-',$date);
        $tgl = $date;
        $date= substr($date, 0, 4);
        return $date;
    }
    public static function Server_date($date){
        $exp = explode('-',$date);
        $tgl = $date;
        $date= $exp[0].'-'.$exp[1].'-'.$exp[2];
        return $date;
    }
    public static function Server_date_str($date){
        $exp = explode('-',$date);
        $tgl = $date;
        $date= $exp[2].'-'.$exp[1].'-'.$exp[0];
        return $date;
    }
    public static function getAllData($table,$where,$order)
    {
        return DB::table($table)->where($where)->orderBy($order,'asc')->get();
    }
    public static function getAllDataLimited($table,$order,$limit)
    {
        return DB::table($table)->orderBy($order,'asc')->limit($limit)->get();
    }
    public static function getSelectedDataLimited($table,$where,$order,$limit)
    {
        return DB::table($table)->where($where)->orderBy($order,'asc')->limit($limit)->get();
    }
    public static function get_firsttable($table,$where,$key,$field) {
        $response = DB::table($table)->where($where, $key)->first();
        return (isset($response->$field) ? $response->$field : '');
    }
    //select table
    public static function getSelectedData($table,$where)
    {
        $response = DB::table($table)->select(\DB::raw('*'))->where($where)->get();
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
    //other function
    public static function tgl_sql($date){
        $exp = explode('-',$date);
        if(count($exp) == 3) {
            $date = $exp[2].'-'.$exp[1].'-'.$exp[0];
        }
        return $date;
    }
    public static function tgl_str($date){
        $exp = explode('-',$date);
        if(count($exp) == 3) {
            $date = $exp[2].'-'.$exp[1].'-'.$exp[0];
        }
        return $date;
    }
    public static function ambilTgl($tgl){
        $exp = explode('-',$tgl);
        $tgl = $exp[2];
        return $tgl;
    }
    public static function ambilBln($tgl){
        $exp = explode('-',$tgl);
        $tgl = $exp[1];
        $bln = MyService::getBulan($tgl);
        $hasil = substr($bln,0,3);
        return $hasil;
    }
    public static function tgl_indo($tgl){
        $jam = substr($tgl,11,10);
        $tgl = substr($tgl,0,10);
        $tanggal = substr($tgl,8,2);
        $bulan = MyService::getBulan(substr($tgl,5,2));
        $tahun = substr($tgl,0,4);
        return $tanggal.' '.$bulan.' '.$tahun.' '.$jam;
    }
    public static function combothn($awal, $akhir, $var, $select){
        echo "<select name=$var id=$var class='form-control' >
			  <option value=''>-Pilih-</option>";
        for ($t=$awal; $t<=$akhir; $t++){
            if ($t==$select)
                echo "<option value=$t selected>$t</option>";
            else
                echo "<option value=$t>$t</option>";
        }
        echo "</select> ";
    }
    public static function combobln($awal, $akhir, $var, $select){
        echo "<select name=$var id=$var class='form-control' >
			  <option value='All'>-Pilih-</option>";
        for ($bln=$awal; $bln<=$akhir; $bln++){
            $lebar=strlen($bln);
            $bulan = MyService::getBulan($bln);
            switch($lebar){
                case 1:
                {
                    $b="0".$bln;
                    break;
                }
                case 2:
                {
                    $b=$bln;
                    break;
                }
            }
            if ($bln==$select)
                echo "<option value=$b selected>$bulan</option>";
            else
                echo "<option value=$b>$bulan</option>";
        }
        echo "</select> ";
    }
    public static function getBulan($bln){
        switch ($bln){
            case 1:
                return "Januari";
                break;
            case 2:
                return "Februari";
                break;
            case 3:
                return "Maret";
                break;
            case 4:
                return "April";
                break;
            case 5:
                return "Mei";
                break;
            case 6:
                return "Juni";
                break;
            case 7:
                return "Juli";
                break;
            case 8:
                return "Agustus";
                break;
            case 9:
                return "September";
                break;
            case 10:
                return "Oktober";
                break;
            case 11:
                return "November";
                break;
            case 12:
                return "Desember";
                break;
        }
    }
    public static function hari_ini($hari){
        date_default_timezone_set('Asia/Jakarta'); // PHP 6 mengharuskan penyebutan timezone.
        $seminggu = array("Minggu","Senin","Selasa","Rabu","Kamis","Jumat","Sabtu");
        //$hari = date("w");
        $hari_ini = $seminggu[$hari];
        return $hari_ini;
    }
    public static function callSProcedure($name, $array) {
        $q = DB::statement(DB::raw('CALL '.$name.'(?, ?, ?, ?, ?)'), $array);
        return $q;
    }
    function hp($nohp) {
        // 0811 239 345
        $nohp = str_replace(" ","",$nohp);
        // (0274) 778787
        $nohp = str_replace("(","",$nohp);
        // (0274) 778787
        $nohp = str_replace(")","",$nohp);
        // 0811.239.345
        $nohp = str_replace(".","",$nohp);

        $nohp = str_replace("-","",$nohp);

        // cek apakah no hp mengandung karakter + dan 0-9
        if(!preg_match('/[^+0-9]/',trim($nohp))){
            // cek apakah no hp karakter 1-3 adalah +62
            if(substr(trim($nohp), 0, 2)=='62'){
                $hp = trim($nohp);
            }
            // cek apakah no hp karakter 1 adalah 0
            elseif(substr(trim($nohp), 0, 1)=='0'){
                $hp = '62'.substr(trim($nohp), 1);
            }
        }
        return $hp;
    }
    public static  function mapdbresult($arrobj, $key, $is_unique = true)
	{
		$returns = [];
		foreach ($arrobj as $row) {
			$row = (object) $row;
			if ($is_unique) {
				$returns[$row->$key] = $row;
			} else {
				if (!isset($return[$row->key]))
					$returns[$row->key] = [];
				$returns[$row->$key][] = $row;
			}
		}
		if (empty($returns[''])) {
			unset($returns['']);
		}
		return $returns;
	}

	public static  function makeArrayFormQueryIndex($arrays, $index, $noduplicate = false)
	{
		$result = array();
		foreach ($arrays as $key => $value) {
			$tempobject = (object) $value;
			if ($noduplicate) {
				if (!in_array($tempobject->$index, $result)) {
					array_push($result, $tempobject->$index);
				}
			} else {
				array_push($result, $tempobject->$index);
			}
		}
		return array_filter($result);
	}
}
