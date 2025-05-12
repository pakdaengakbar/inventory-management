<?php
namespace App\Helpers;

class MyFormat {

    const CURRENCY_SYMBOL = 'Rp ';

    public static function currency($amount)
    {
        return self::CURRENCY_SYMBOL . number_format($amount, 0, ',', '.');
    }

    public static function tanggal($date, $format = 'd M Y')
    {
        return \Carbon\Carbon::parse($date)->format($format);
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
}
