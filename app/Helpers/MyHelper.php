<?php
namespace App\Helpers;

use DateTime;
use App\Helpers\MyService;

class MyHelper {
    function key_google()
    {
        return "AIzaSyDxGJcoCywnUNJF-ldIz6dPka8NZ1tAKys";
    }
    function format_th($th){
        if($th=='id'){
            return 'ID';
        }
        else{
            return ucwords(str_replace("_", " ", $th));
        }
    }
    public static function setBreadcrumb($setli1, $setli2, $urlli = '/home'){
        return "<div class='py-3 d-flex align-items-sm-center flex-sm-row flex-column'>
                <div class='flex-grow-1'>
                    <h4 class='fs-18 fw-semibold m-0'>".$setli2."</h4>
                </div>
                <div class='text-end'>
                    <ol class='breadcrumb m-0 py-0'>
                        <li class='breadcrumb-item'><a href='/".$urlli."'>".$setli1."</a></li>
                        <li class='breadcrumb-item active'>".$setli2."</li>
                    </ol>
                </div>
                </div>";
    }

    public static function setStatusMaster(){
        return '<label class="form-label">Status</label>
                <select class="form-select" wire:model="cstatus" >
                    <option value="">Select Status</option>
                    <option value="1">Actived</option>
                    <option value="0">Not Active</option>
                </select>';
    }

    public static function setStatusTrans(){
        return '<label class="form-label">Status</label>
                <select class="form-select" wire:model="cstatus" >
                    <option value="">Select Status</option>
                    <option value="O">Open</option>
                    <option value="P">On Process</option>
                    <option value="C">Close</option>
                    <option value="R">Reject</option>
                </select>';
    }

    public static function getSearchByDate(){
        $first = MyHelper::thismonthfirstdate();
        $today = MyHelper::datenow();
        return '<div class="col-12">
                    <label for="sdate" class="form-label">Start Date</label>
                    <input type="date" id="sdate" class="form-control" value="'.$first.'">
                </div>
                <div class="col-12">
                    <label for="edate" class="form-label">End Date</label>
                    <input type="date" id="edate" class="form-control" value="'.$today.'">
                </div>';
    }

    public static function blur_text()
    {
        return "************";
    }

    function blur_data($data)
    {
        echo '<span class="blur_data" style="color:black" data-show="' . $data . '">';
        echo self::blur_text();
        echo '</span>';
    }

    function blur_data_script()
    {
        echo '<script>';
        echo '$(document).ready(function() {';
        echo '$(".blur_data").click(function() {';
        echo '$(".blur_data").each(function(){';
        echo '$(this).html("' . self::blur_text() . '")';
        echo '});';
        echo '$(this).html($(this).attr("data-show"))';
        echo '});';
        echo '});';
        echo '</script>';
    }

    function format_td($td,$col,$blur_phone=false){
        $excludecols=['outlet','from','to','srcoutlet','dstoutlet','phone','nowa','nowabutik','wa','id'];
        $phonecols=['phone','nowabutik'];
        if(in_array($col,$phonecols)){
            return "<a class='text-danger' target='_blank' href='https://wa.me/+62".$td."'>
                        <img class='image' width='20px' src='".url('assets/images/wa.ico')."'/>
                    </a>".($blur_phone?$this->blur_data($td):$td);
        }
        elseif(is_float($td) && !in_array($col,$excludecols)){
            return number_format($td,2);
        }
        elseif(is_numeric($td) && !in_array($col,$excludecols)){
            return number_format($td);
        }
        elseif (strtotime($td) !== false  && !in_array($col,$excludecols)) {
            if($td=='0000-00-00'){
                return '-';
            }
            else{
                $dt=new DateTime($td);
                return $dt->format("d M y");
            }
        }
        return $td;
    }

    function format_tdaction($action,$arr){
        $action=str_replace('$pk', $arr['pk'], $action);
        if(isset($arr['pk']))
            $action=str_replace('$pk', $arr['pk'], $action);
        if(isset($arr['id']))
            $action=str_replace('$id', $arr['id'], $action);
        if(isset($arr['code']))
            $action=str_replace('$code', $arr['code'], $action);
        if(isset($arr['purchaseid']))
            $action=str_replace('$purchaseid', $arr['purchaseid'], $action);
        return $action;
    }

    function changespercent_colour($data){
        if($data>0)
            $colour="success";
        elseif($data==0)
            $colour="info";
        else
            $colour="danger";
        return $colour;
    }

    function badge_($data,$colour,$default=''){
        if($data=='' or $data==null or $data==false){
            $colour='danger';
            $data=$default;
        }
        return '<span class="badge badge-light-'.$colour.' fs-base">'.$data.'</span>';
    }

    function changesarrow($data){
        if($data>0){
            return '<i class="ki-outline ki-arrow-up text-success ms-n1"></i>';
        }
        elseif($data==0){
            return '=';
        }
        else{
            return '<i class="ki-outline ki-arrow-down text-danger ms-n1"></i>';
        }
    }

    function portionpercent_colour($data){
        if($data>=90)
            $colour="success";
        elseif($data>=80)
            $colour="primary";
        elseif($data>=70)
            $colour="info";
        elseif($data>=60)
            $colour="warning";
        elseif($data<60)
            $colour="danger";
        return $colour;
    }

    function amount_rupiah($data,$withPrepend=true){
        if($data>=0){
            if($data>=1000000000)
                $converted=round($data/1000000000,2).($withPrepend?" Miliar":"");
            elseif($data>=1000000)
                $converted=round($data/1000000,2).($withPrepend?" Juta":"");
            elseif($data>=1000)
                $converted=round($data/1000,2).($withPrepend?" Ribu":"");
            else
                return $data;
        }
        else{
            if($data<=-1000000000)
                $converted='('.round($data/1000000000,2).($withPrepend?") Miliar":")");
            elseif($data<=-1000000)
                $converted='('.round($data/1000000,2).($withPrepend?") Juta":")");
            elseif($data<=-1000)
                $converted='('.round($data/1000,2).($withPrepend?") Ribu":")");
            else
                return $data;
        }
        return $converted;
    }

    function pre($data, $next = 0)
    {
        echo '<pre>';
        print_r($data);
        echo '</pre>';
        if (!$next) {
            exit;
        }
    }

    function makeArrayFormQueryIndex($arrays, $index, $noduplicate = false)
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

    function setIndexArrayFormValue($arrays, $kvalue)
    {
        $result = array();
        foreach ($arrays as $key => $value) {
            $myvalue = (object)$value;
            $result[$myvalue->$kvalue] = $value;
        }
        return $result;
    }

    function encode12($plain, $usekey = true)
    {
        $key = floor($plain / 12);
        $plain = $plain % 12;
        if ($plain == 0) {
            $plain = 'C';
        } else if ($plain > 9) {
            if ($plain == 10) {
                $plain = 'A';
            } else if ($plain == 11) {
                $plain = 'B';
            } else if ($plain == 12) {
                $plain = 'C';
            }
        }
        return ($usekey ? $key : '') . $plain;
    }

    function decode12($code, $usekey = true)
    {
        $key = 0;
        $coded = '';
        $plain = '';
        if ($usekey) {
            $len = strlen($code);
            $key = substr($code, 0, $len - 1);
            $coded = substr($code, $len - 1, $len);
        } else {
            $coded = $code;
        }
        return (($key * 12) + $this->translateHex($coded));
    }

    function translateHex($text, $isHex = true)
    {
        if ($isHex) {
            if (strcmp($text, 'A') == 0) {
                return 10;
            } else if (strcmp($text, 'B') == 0) {
                return 11;
            }
            if (strcmp($text, 'C') == 0) {
                return 12;
            } else return (int)$text;
        } else {
            if ($text > 9) {
                if ($text == 10) {
                    return 'A';
                } else if ($text == 11) {
                    return 'B';
                } else if ($text == 12) {
                    return 'C';
                }
            } else return $text . '';
        }
    }

    function datediff($date1, $date2, $callback = 'd')
    {
        $interval = $date1->diff($date2);
        if ($callback == "y") return $interval->y;
        else if ($callback == "m") return ($interval->y > 0) ? ($interval->y * 12) + $interval->m : $interval->m;
        else if ($callback == "d") return $interval->days;
    }

    function like_match($pattern, $subject)
    {
        $pattern = str_replace('%', '.*', preg_quote($pattern, '/'));
        return (bool) preg_match("/^{$pattern}$/i", $subject);
    }

    function isset_set($cek, $default)
    {
        if (!isset($cek)) $cek = '';
        return (strcmp($cek, '') == 0 ? $default : $cek);
    }

    function durationdays($assigned_time = '', $completed_time = '')
    {
        $date1 = new DateTime($assigned_time);
        $date2 = new DateTime($completed_time);
        $diff = $date1->diff($date2);
        return $diff->days;
    }

    function validateDate($date, $format = 'Y-m-d H:i:s')
    {
        $d = DateTime::createFromFormat($format, $date);
        return $d && $d->format($format) == $date;
    }

    function get_day_name($date)
    {
        $no = date('N', strtotime($date));
        switch ($no) {
            case '1':
                return 'Senin';
                break;
            case '2':
                return 'Selasa';
                break;
            case '3':
                return 'Rabu';
                break;
            case '4':
                return 'Kamis';
                break;
            case '5':
                return "Jumat";
                break;
            case '6':
                return 'Sabtu';
                break;
            case '7':
                return 'Minggu';
                break;
        }
    }

    static function datenow()
    {
        return date('Y-m-d');
    }

    static function datetimenow()
    {
        return date('Y-m-d H:i:s');
    }

    static function thismonthfirstdate()
    {
        return date("Y-m-01");
    }

    function lastmonth()
    {
        return date("Y-m-d", strtotime(date("Y-m-d", strtotime(date("Y-m-d"))) . "-1 month"));
    }

    static function lastyear()
    {
        return date("Y-m-d", strtotime(date("Y-m-d", strtotime(date("Y-m-d"))) . "-1 year"));
    }

    static function divideint($amount, $num)
    {
        $res = intval($amount / $num);
        $result = array();
        $calc = 0;
        for ($i = 0; $i < $num - 1; $i++) {
            $calc += $res;
            $result[$i] = $res;
        }
        $result[$num - 1] = $amount - $calc;
        return $result;
    }

    function setminimum($val, $min = 0)
    {
        return $val < $min ? $min : $val;
    }

    function nformat($x, $dec = 0, $upper = false)
    {
        if ($x == 0) return '0';
        if ($upper) {
            $y = 1;
            for ($i = 0; $i < $dec; $i++) {
                $y *= 10;
            }
            $x = ceil($x * $y) / $y;
        }
        return number_format($x, $dec, ",", ".");
    }


    function is_hooutlet($outlet)
    {

        if (substr($outlet, 0, 1) == '9' || substr($outlet, 0, 1) == 'D' || in_array($outlet, ['AMD', 'OMD', 'AMP', 'NSO'])) {
            return true;
        } else
            return false;
    }
    function is_dncoutlet($outlet)
    {
        $outletarr = ['014', '888', 'D98', 'D99']; //online dnc,pameran dnc,marcom dnc
        if (in_array($outlet, $outletarr) || substr($outlet, 0, 1) == '6') {
            return true;
        } else
            return false;
    }
    function is_priveoutlet($outlet)
    {
        $outletarr = ['018', '022'];
        if (in_array($outlet, $outletarr)) {
            return true;
        } else
            return false;
    }
    function is_factoryoutlet($outlet)
    {
        $outletarr = ['005', '004'];
        if (in_array($outlet, $outletarr)) {
            return true;
        } else
            return false;
    }

    function is_passionoutlet($outlet)
    {
        $outletarr = ['800'];
        if (in_array($outlet, $outletarr) || (substr($outlet, 0, 1) == '0' && !in_array($outlet, ['005', '004']))) {
            // echo $outlet;
            return true;
        } else
            return false;
    }
    function is_wholesaleoutlet($outlet)
    {
        $outletarr = ['800', '801', '803', '807'];
        if (in_array($outlet, $outletarr)) {
            return true;
        } else
            return false;
    }
    function is_marcomoutlet($outlet)
    {
        if ($outlet == '999' || $outlet == '998' || $outlet == 'D98') {
            return true;
        } else return false;
    }

    function is_amom($outlet)
    {
        if ($outlet == '999' || $outlet == 'AMD' || $outlet == 'OMD' || $outlet == '994') {
            return true;
        } else return false;
    }

    function is_purchasingoutlet($outlet)
    {
        if ($outlet == '999' || $outlet == '992') {
            return true;
        } else return false;
    }

    function is_companycode($outlet)
    {
        if ($outlet == 'pak' || $outlet == 'bak')
            return true;
        else
            return false;
    }
    function isJson($str)
    {
        $json = json_decode($str);
        return (json_last_error() == JSON_ERROR_NONE) ? $json : false;
    }
    function uniqseq()
    {
        $datetime = date("ydimh");
        $tohex1 = dechex(substr($datetime, 0, 6)); //y d i s -> bisa diatas 26 (Z) digabung jadi satu int panjang -> hajar dectohex -> pasti unique
        $tohex2 = dechex(substr($datetime, 6, 2));
        $tohex3 = dechex(substr($datetime, 8, 2));
        // echo (substr($datetime,0,6))."<br>";
        // echo $tohex1." ".$tohex2." ".$tohex3."<br>";

        return $tohex1 . $tohex2 . $tohex3;
    }

    #filter forms
    function filterform($params, $allowedfields, $populate = false, $ignore_empty = false)
    {
        if (!$populate) {
            foreach ($params as $key => $value) {
                if (!in_array($key, $allowedfields)) {
                    unset($params[$key]);
                    continue;
                }
                if ($ignore_empty) {
                    if (empty($value)) {
                        unset($params[$key]);
                    }
                }
            }
        } else {
            foreach ($params as $key => $value) {
                if (!in_array($key, array_keys($allowedfields))) {
                    unset($params[$key]);
                }
            }
            foreach ($allowedfields as $key => $default) {
                if (!in_array($key, array_keys($params))) {
                    $params[$key] = $default;
                }
            }
        }
        return $params;
    }
    function randomString($n)
    {
        $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $randomString = '';

        for ($i = 0; $i < $n; $i++) {
            $index = rand(0, strlen($characters) - 1);
            $randomString .= $characters[$index];
        }

        return $randomString;
    }



    function mapdbresult($arrobj, $key, $is_unique = true)
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

    function maprdbresult($arrobj, $keyarr, $is_unique = true, $idx = 0)
    {
        $unique = false;
        if (count($keyarr) == $idx + 1) {
            $unique = $is_unique;
        }
        $res = $this->mapdbresult($arrobj, $keyarr[$idx], $unique);
        if (count($keyarr) > $idx + 1) {
            foreach ($res as $key => $val) {
                $res[$key] = $this->maprdbresult($val, $keyarr, $is_unique, $idx + 1);
            }
        }
        return $res;
    }
    function getUniqueColVal($arrobj,$keycol){
        $uniqvals=[];
        foreach($arrobj as $row){
            if(!in_array($row->$keycol,$uniqvals)){
                $uniqvals[]=$row->$keycol;
            }
        }
        return $uniqvals;
    }
    function mapdbresultkeyval($arrobj, $keycol, $valcol, $withempty = "", $is_unique = true)
    {
        $returns = [];
        // pre($withempty);
        // echo $withempty;
        if (!empty($withempty)) {
            $returns[''] = $withempty;
        }

        foreach ($arrobj as $row) {
            $row = (object) $row;
            if ($is_unique) {
                $returns[$row->$keycol] = $row->$valcol;
            } else {
                if (!isset($return[$row->$keycol]))
                    $returns[$row->$keycol] = [];
                $returns[$row->$keycol][] = $row->$valcol;
            }
        }
        // pre($returns);
        if (empty($returns[''])) {
            unset($returns['']);
        }
        return $returns;
    }

    function mapardbresult($arrobj, $key)
    {
        $returns = [];
        foreach ($arrobj as $row) {
            $row = (object) $row;
            if (!isset($returns[$row->$key])) {
                $returns[$row->$key] = array();
            }
            array_push($returns[$row->$key], $row);
        }
        return $returns;
    }

    function map2ddbresult($arrobj, $key1, $key2, $is_unique = true)
    {
        $returns = [];
        foreach ($arrobj as $row) {
            if ($is_unique) {
                $returns[$row->$key1][$row->$key2] = $row;
            } else {
                if (!isset($return[$row->key]))
                    $returns[$row->key] = [];
                $returns[$row->$key1][$row->$key2][] = $row;
            }
        }
        return $returns;
    }

    function mapfileresult($object)
    {
        $newobject = array();
        foreach ($object['name'] as $key => $value) {
            $newval = array();
            foreach ($object as $k => $val) {
                $newval[$k] = $val[$key];
            }
            $newobject[$key] = $newval;
        }
        return $newobject;
    }

    function _monthname($monthno)
    {
        $montharr = [1 => 'Jan', 2 => 'Feb', 3 => 'Mar', 4 => 'Apr', 5 => 'Mei', 6 => 'Jun', 7 => 'Jul', 8 => 'Aug', 9 => 'Sep', 10 => 'Oct', 11 => 'Nov', 12 => 'Dec'];
        return $montharr[$monthno];
    }

    function stamptimemem($note, $time_start)
    {
        $time_stamp = microtime(true);
        $execution_time = round($time_stamp - $time_start, 2);
        $mem_usage = round(memory_get_usage() / 1048576, 2);
        echo "<b>" . $note . "</b>.<br> - Timestamp started: " . $execution_time . " Sec.<br> - Mem Usage: " . $mem_usage . " MB<br>";
    }

    function db_where_in(&$db, $array, $var, $chunk = 50, $or = false)
    {
        if ($or) {
            $db->or_group_start();
        } else {
            $db->group_start();
        }
        $chunk_ids = array_chunk($array, $chunk);
        foreach ($chunk_ids as $val) {
            $db->or_where_in($var, $val);
        }
        $db->group_end();
    }

    function _normalize_string($string)
    {
        $normalized = str_replace(`'`, '`', $string);
        $normalized = str_replace(`"`, '`', $string);
        $normalized = str_replace('\\', '`', $string);
        return $normalized;
    }
    function printtable($rows)
    {
        $headers = array_keys(get_object_vars($rows[0]));
        echo "<table id='table' border='1'><thead>";
        foreach ($headers as $key) {
            echo "<th>" . $key . "</th>";
        }
        echo "</thead><tbody>";
        foreach ($rows as $row) {
            echo "<tr>";
            foreach ($headers as $key) {
                echo "<td>" . $row->$key . "</td>";
            }
            echo "</tr>";
        }
        echo "</tbody></table>";
    }
    function writetocsv($rows, $filename)
    {
        $file = fopen("testingdatasource/report/$filename.csv", "w");
        $headers = array_keys(get_object_vars($rows[0]));
        fputcsv($file, $headers);
        foreach ($rows as $row) {
            fputcsv($file, array_values(get_object_vars($row)));
        }
        fclose($file);
    }

    /*
    * Convert multidimensional array into single array
    *
    */
    function array_flatten($array)
    {
        if (!is_array($array)) {
            return FALSE;
        }
        $result = array();
        foreach ($array as $key => $value) {
            if (is_array($value)) {
                $result = array_merge($result, $this->array_flatten($value));
            } else {
                $result[$key] = $value;
            }
        }
        return $result;
    }

    /**
     * getallheaders_lc()
     * helper function
     */

    function getallheaders_lc()
    {
        $headers = array();

        $copy_server = array(
            'CONTENT_TYPE'   => 'Content-Type',
            'CONTENT_LENGTH' => 'Content-Length',
            'CONTENT_MD5'    => 'Content-Md5',
        );

        foreach ($_SERVER as $key => $value) {
            if (substr($key, 0, 5) === 'HTTP_') {
                $key = substr($key, 5);
                if (!isset($copy_server[$key]) || !isset($_SERVER[$key])) {
                    $key = str_replace(' ', '-', ucwords(strtolower(str_replace('_', ' ', $key))));
                    $headers[$key] = $value;
                }
            } elseif (isset($copy_server[$key])) {
                $headers[$copy_server[$key]] = $value;
            }
        }

        if (!isset($headers['Authorization'])) {
            if (isset($_SERVER['REDIRECT_HTTP_AUTHORIZATION'])) {
                $headers['Authorization'] = $_SERVER['REDIRECT_HTTP_AUTHORIZATION'];
            } elseif (isset($_SERVER['PHP_AUTH_USER'])) {
                $basic_pass = isset($_SERVER['PHP_AUTH_PW']) ? $_SERVER['PHP_AUTH_PW'] : '';
                $headers['Authorization'] = 'Basic ' . base64_encode($_SERVER['PHP_AUTH_USER'] . ':' . $basic_pass);
            } elseif (isset($_SERVER['PHP_AUTH_DIGEST'])) {
                $headers['Authorization'] = $_SERVER['PHP_AUTH_DIGEST'];
            }
        }

        return array_change_key_case($headers);
    }



    function removeForbidenCharacter($string)
    {
        $forbiden_character = array('.', '/', ' ', '(', ')', '[', ']', '{', '}', '#', '!', '@', '$', '%', '&', ' ');
        return str_replace($forbiden_character, '', $string);
    }

    function find_in_array($array, $find, $objectkey = false, $bigger = false)
    {
        $key = "";
        foreach ($array as $i => $value) {
            if ($objectkey) {
                if ($bigger) {
                    if ($value->$objectkey >= $find) {
                        $key = $i;
                        break;
                    }
                } else {
                    if ($value->$objectkey <= $find) {
                        $key = $i;
                        break;
                    }
                }
            } else {
                if ($bigger) {
                    if ($value >= $find) {
                        $key = $i;
                        break;
                    }
                } else {
                    if ($value <= $find) {
                        $key = $i;
                        break;
                    }
                }
            }
        }
        if (strcmp($key, '') == 0) {
            return false;
        }
        return $array[$key];
    }

    function spk_customer_status($spk){
        if($spk->categoryid=='CREP'){
            if($spk->spk_statusid==7 && $spk->dj_status!=3){
                $status= 'Belum Handover';
            }
            elseif($spk->spk_statusid==7 && $spk->dj_status==3){
                $status= 'Selesai, Sudah Handover';
            }
            elseif($spk->spk_statusid<4 || $spk->spk_statusid==11){
                $status= 'Pengerjaan Pabrik';
            }
            elseif($spk->spk_statusid==5){
                $status= 'Selesai, masih di Pabrik';
            }
            elseif($spk->spk_statusid==6){
                $status= 'Selesai, dalam perjalanan ke Butik';
            }
            else{
                $status= '-';
            }
        }else{
            if($spk->spk_statusid==7 && $spk->dj_status!=3){
                $status= 'Selesai, Belum Terjual';
            }
            elseif($spk->spk_statusid==7 && $spk->salescode!=null){
                $status= 'Selesai, Terjual';
            }
            elseif($spk->spk_statusid<4 || $spk->spk_statusid==11){
                $status= 'Pengerjaan Pabrik';
            }
            elseif($spk->spk_statusid==5){
                $status= 'Selesai, masih di Pabrik';
            }
            elseif($spk->spk_statusid==6){
                $status= 'Selesai, dalam perjalanan ke Butik';
            }
            else{
                $status= '-';
            }

        }
        return $status;
    }

    function day_of_week_convertion()
    {
        return [
            'Monday' => 'Senin',
            'Tuesday' => 'Selasa',
            'Wednesday' => 'Rabu',
            'Thursday' => 'Kamis',
            'Friday' => 'Jumat',
            'Saturday' => 'Sabtu',
            'Sunday' => 'Minggu'
        ];
    }



    function calcchanges($a,$b){
        if(is_object($a)){
            $a=get_object_vars($a);
        }
        if(is_object($b)){
            $b=get_object_vars($b);
        }
        $changes=[];
        if(array_keys($a)!=array_keys($b)){
            foreach($a as $key=>$val){
                $changes[$key]=0;
            }
        }
        else{
            foreach($a as $key=>$val){
                if(is_numeric($val))
                    $changes[$key]=$val-$b[$key];
                else
                    $changes[$key]=0;
            }
        }
        return $changes;
    }


    function validateImageLink($url) {
        $headers = get_headers($url);
        return stripos($headers[0],"200 OK") ? true : false;
    }
}
