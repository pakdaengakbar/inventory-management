<?php
namespace App\Helpers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;
use App\Models\User;

class MyLibrary {
	/**
	* Returns an encrypted & utf8-encoded
	*/
	public function encrypt($char)
	{
		$result = Crypt::encryptString($char);
		return($result);
	}

	public function decrypt($char)
	{
		$result= Crypt::decryptString($char);
		return($result);
	}
	public static function pinencrypt($char)
	{
		$str = ['$','!','%','^','0','1','&','=','.','A','y','x','X','c','s',','];
		$n1 = $str[7].$str[3].$str[5].$str[14].$str[1].$str[0].$str[12].$str[13];
		$n2 = $str[4].$str[11].$str[10].$str[6].$str[2].$str[0].$str[1].$str[1].$str[8].$str[2].$str[9].$str[15].$str[11];
		$pinencrypt = $n1.md5(sha1($char)).$n2;
		return($pinencrypt);
	}

	public static function stringRandom($panjang_karakter){
		$karakter = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
		$string = '';
		for($i = 0; $i < $panjang_karakter; $i++) {
			$pos = rand(0, strlen($karakter)-1);
			$string .= $karakter[$pos];
		}
		return $string;
	}
	public static function numberRandom($panjang_karakter){
		$karakter = '1234567890987654321';
		$string = '';
		for($i = 0; $i < $panjang_karakter; $i++) {
			$pos = rand(0, strlen($karakter)-1);
			$string .= $karakter[$pos];
		}
		return $string;
	}
	public static function stringUsername($id){
		$user = User::find($id);
		if($user){$string = $user->name;}else{$string = '';}
		return $string;
	}
	/* ::load table condition:: */
	public static function get_firsttable($table,$where,$key,$field) {
        $response = DB::table($table)->where($where, $key)->first();
        return (isset($response->$field) ? $response->$field : '');
    }
	public static function get_datatable($table,$where,$key,$order) {
        $response = DB::table($table)->where($where, $key)->orderBy($order,'asc')->get();
        return $response;
    }
	/* ::load table:: */
	public static function data_table($table,$order) {
        $response = DB::table($table)->orderBy($order,'asc')->get();
        return $response;
    }
	/* ::count trans:: */
	public static function count_table($table) {
        $response = DB::table($table)->count();
        return $response;
    }
	public static function count_where($table,$field,$key) {
        $response = DB::table($table)->where($field, $key)->count();
        return $response;
    }
	public static function sendWA($phone,$message){

	    $token  = "VRFxyBzmAV2qwQQUDdQsS95o61ZndxJZVk2346Cb72ZbwDs7MQ";
        $curl   = curl_init();
	    curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://app.ruangwa.id/api/send_message',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING  => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT   => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION  => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS    => 'token='.$token.'&number='.$phone.'&message='.$message,
        ));
        $response = curl_exec($curl);
        curl_close($curl);
		return $response;
	}
}
