<?php

function isMobile() {
	global $_SERVER;
    return preg_match("/(android|avantgo|blackberry|bolt|boost|cricket|docomo|fone|hiptop|mini|mobi|palm|phone|pie|tablet|up\.browser|up\.link|webos|wos)/i", $_SERVER["HTTP_USER_AGENT"]);
}

function showContent($arr){
	global $langText;

	$lang_arr = $langText;
	if (isset($arr)){
		foreach ($arr as $item_name){
			if (array_key_exists($item_name,$lang_arr)){
				$lang_arr = $lang_arr[$item_name];
			}else{
				//item not found
				return "";
			}
		}
	}
	return (is_array($lang_arr)) ? "" : $lang_arr;
}

function gotoPage($filename){

	echo '
		<script type="text/javascript">
			location.href = "'.$filename.'";
		</script>
	';

}

function gotoTopPage($filename){

	echo '
		<script type="text/javascript">
			top.location.href = "'.$filename.'";
		</script>
	';

}

function getRandomString($length = 6) {
	$validCharacters = "abcdefghijklmnopqrstuxyvwzABCDEFGHIJKLMNOPQRSTUXYVWZ";
	$validCharNumber = strlen($validCharacters);

	$result = "";

	for ($i = 0; $i < $length; $i++) {
		$index = mt_rand(0, $validCharNumber - 1);
		$result .= $validCharacters[$index];
	}

	return $result;
}

function Text2Unicode( $str )
{

		$unicode = array();
		$values = array();
		$lookingFor = 1;

		for ($i = 0; $i < strlen( $str ); $i++ ) {
			$thisValue = ord( $str[ $i ] );
			if ( $thisValue < ord('A') )
			{
				 if ($thisValue >= ord('0') && $thisValue <= ord('9'))
				 {
					  $unicode[] = '00'.dechex($thisValue);
				 }
				 else
				 {
					$unicode[] = '00'.dechex($thisValue);
				 }
			}
			else {
			  if ( $thisValue < 128)
				   $unicode[] = '00'.dechex($thisValue);
			  else {
					if ( count( $values ) == 0 ) $lookingFor = ( $thisValue < 224 ) ? 2 : 3;
					$values[] = $thisValue;
					if ( count( $values ) == $lookingFor ) {
						$number = ( $lookingFor == 3 ) ?
							( ( $values[0] % 16 ) * 4096 ) + ( ( $values[1] % 64 ) * 64 ) + ( $values[2] % 64 ):
							( ( $values[0] % 32 ) * 64 ) + ( $values[1] % 64 );
				$number = dechex($number);
				$unicode[] = (strlen($number)==3)?"0".$number:"".$number;
						$values = array();
						$lookingFor = 1;
			  }
			}
		  }
		}
	for ($i = 0 ; $i < count($unicode) ; $i++) $unicode[$i] = str_pad($unicode[$i] , 4 , "0" , STR_PAD_LEFT);
		return implode("" , $unicode);

}


function sentSmsMessage($smsMessage){
	global $db;

	$p_username = $smsMessage['username'];
	$p_password = $smsMessage['password'];
	$p_number = $smsMessage['number'];
	$p_content = Text2Unicode($smsMessage['content']);
	$p_sender = $smsMessage['sender'];

	$form_id = $smsMessage['form_id'];


	$p_url = "http://www.meteorsis.com/misweb/f_sendsms.aspx?&langeng=0&dos=now&senderid=".$p_sender;
	$p_url .= "&content=" .$p_content;
	$p_url .= "&recipient=".$p_number;
	$p_url .= "&username=".$p_username;
	$p_url .= "&password=".$p_password;
	$p_url = preg_replace("/ /", "%20", $p_url);
	$webres = file($p_url);
	foreach($webres as $smsdid){
		$param = array();
		$param["form_id"] = "'".$db->escape_string($form_id) . "'";
		$param["sms_did"] = "'".$db->escape_string($smsdid) . "'";
		$param["phone"] = "'".$db->escape_string($p_number) . "'";
		$param["msg"] = "'".$db->escape_string($smsMessage['content']) . "'";
		$param["createdate"] = "now()";

		$sql = createInsertSQL("201609_nuxe_smslog", $param );
		$result = $db->query($sql) or die($db->error);

		if($result) {
			return array('status'=>'success');
		} else{
			return array('status'=>'failure');
		}
	}
}

function getExcelColumnName($columnNumber)
{
    $dividend = $columnNumber;
    $columnName = "";

    while ($dividend > 0)
    {
        $reminder = ($dividend - 1) % 26;
        $columnName = chr(65 + $reminder) . $columnName;
        $dividend = (int)(($dividend - $reminder) / 26);
    }

    return $columnName;
}

function removeEmoji($text) {

    $clean_text = "";

    // Match Emoticons
    $regexEmoticons = '/[\x{1F600}-\x{1F64F}]/u';
    $clean_text = preg_replace($regexEmoticons, '', $text);

    // Match Miscellaneous Symbols and Pictographs
    $regexSymbols = '/[\x{1F300}-\x{1F5FF}]/u';
    $clean_text = preg_replace($regexSymbols, '', $clean_text);

    // Match Transport And Map Symbols
    $regexTransport = '/[\x{1F680}-\x{1F6FF}]/u';
    $clean_text = preg_replace($regexTransport, '', $clean_text);

    // Match Miscellaneous Symbols
    $regexMisc = '/[\x{2600}-\x{26FF}]/u';
    $clean_text = preg_replace($regexMisc, '', $clean_text);

    // Match Dingbats
    $regexDingbats = '/[\x{2700}-\x{27BF}]/u';
    $clean_text = preg_replace($regexDingbats, '', $clean_text);

    return $clean_text;
}

function createInsertSQL($table, $param){
	$fields = array_keys($param);

	return sprintf("insert into %s (%s)values(%s)", $table, implode(",", $fields), implode(",", $param));
}

function createUpdateSQL($table, $param, $where){
	$condition_arr = array();
	foreach($param as $key => $val){
		$condition_arr[] = $key. " = " . $val;
	}
	$condition_str = implode(", ", $condition_arr);

	$where_arr = array();
	foreach($where as $key => $val){
		$where_arr[] = $key. " = " . $val;
	}
	$where_str = implode(", ", $where_arr);

	return "update ".$table." set ".$condition_str." where " . $where_str;
}

function generateXML($root_tag, $data){
	$xml_str = "";

	foreach($data as $key=>$value){
		$xml_str .= "<" . $key . "><![CDATA[".$value."]]></" . $key . ">" . "\n";
	}

	return "<" . $root_tag . ">" . "\n" . $xml_str . "\n" . "</" . $root_tag . ">";
}


function returnResult($type, $arr){
	if ($type == "1"){
		header('Content-type: text/json');
		echo json_encode($arr);
	}else{
		echo http_build_query($arr);
	}
	exit();
}

function NewGuid() {
	$s = strtoupper(md5(uniqid(rand(),true)));
	$guidText =
		substr($s,0,8) . '-' .
		substr($s,8,4) . '-' .
		substr($s,12,4). '-' .
		substr($s,16,4). '-' .
		substr($s,20);
	return $guidText;
}

function json_format($json)
{
    $tab = "  ";
    $new_json = "";
    $indent_level = 0;
    $in_string = false;

    $json_obj = json_decode($json);

    if($json_obj === false)
        return false;

    $json = json_encode($json_obj);
    $len = strlen($json);

    for($c = 0; $c < $len; $c++)
    {
        $char = $json[$c];
        switch($char)
        {
            case '{':
            case '[':
                if(!$in_string)
                {
                    $new_json .= $char . "\n" . str_repeat($tab, $indent_level+1);
                    $indent_level++;
                }
                else
                {
                    $new_json .= $char;
                }
                break;
            case '}':
            case ']':
                if(!$in_string)
                {
                    $indent_level--;
                    $new_json .= "\n" . str_repeat($tab, $indent_level) . $char;
                }
                else
                {
                    $new_json .= $char;
                }
                break;
            case ',':
                if(!$in_string)
                {
                    $new_json .= ",\n" . str_repeat($tab, $indent_level);
                }
                else
                {
                    $new_json .= $char;
                }
                break;
            case ':':
                if(!$in_string)
                {
                    $new_json .= ": ";
                }
                else
                {
                    $new_json .= $char;
                }
                break;
            case '"':
                if($c > 0 && $json[$c-1] != '\\')
                {
                    $in_string = !$in_string;
                }
            default:
                $new_json .= $char;
                break;
        }
    }

    return $new_json;
}
?>
