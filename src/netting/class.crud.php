<?php 
ob_start();
session_start();
require_once 'dbconfig.php'; 
class crud{
	public $db;
	private $dbhost=DBHOST;
	private $dbuser=DBUSER;
	private $dbpass=DBPWD;
	private $dbname=DBNAME;
	function __construct(){
		try {
			$this->db=new PDO('mysql:host='.$this->dbhost.';dbname='.$this->dbname.';charset=utf8',$this->dbuser,$this->dbpass);
		} catch (Exception $e) {
			die("Veritabanı Bağlantısı Başarısız: ".$e->getMessage());
		}
	}

	public function addValue($degerler){
		$values = implode(',',array_map(function ($item){

			return $item.'=?';

		},array_keys($degerler)));
		return $values;
	}

	public function imageUpload($name,$size,$tmp_name,$dir,$file_delete=null){
		try {
			$izinli_uzantilar=[
			'jpg',
			'jpge',
			'png',
			'ico'
			];
			$ext=mb_strtolower(substr($name, strpos($name,'.')+1));
			$urunad=mb_strtolower(strstr($name, ".",true));
			$urunad = $this->seo($urunad);
			if (in_array($ext, $izinli_uzantilar)===FALSE) {
				throw new Exception("BU DOSYA TÜRÜ KABUL EDİLMEMEKTEDİR.", 1);
			}
			if ($size>2097152) {
				throw new Exception("DOSYA BOYUTU 2 MB'DAN BÜYÜK OLAMAZ.", 1);
			}
			$name_y=$urunad."-".uniqid().".".$ext;
			if (!@move_uploaded_file($tmp_name , "../dimg/$dir/$name_y")) {
				throw new Exception("DOSYA YÜKLENİRKEN SORUN OLUŞTU.", 1);
			}
			if (!empty($file_delete)) {
				if ($dir=="admins") {
					unlink("../dimg/$dir/$file_delete");
				$_SESSION["admins"]['admins_file'] = $name_y; // HER TABLOYA UYUMLU OLMAYABİLİR ADMİNS VE ADMİNS FİLE YERİNE UYGUN OLACAK BİRŞEY YAZ.
			}else{
				unlink("../dimg/$dir/$file_delete");
			}

		}

		return $name_y;
	} catch (Exception $e) {
		return ['status' => FALSE,'error' => $e->getMessage()];
	}
}


public function insert($table,$values,$options=[]){

	try {

		function _clean(&$value) {
			$value = htmlspecialchars($value);
		}

		array_walk_recursive($values, '_clean');

		if (!empty($_FILES[$options['file_name']])) {
			$name_y=$this->imageUpload(
				$_FILES[$options['file_name']]['name'],
				$_FILES[$options['file_name']]['size'],
				$_FILES[$options['file_name']]['tmp_name'],
				$options['dir']
				);
			$values+=[$options['file_name'] => $name_y];
		}
		if (isset($options['pass'])) {
			$values[$options['pass']]=md5($values[$options['pass']]);
		} 


		unset($values[$options['form_name']]);


		$stmt=$this->db->prepare("INSERT INTO $table SET {$this->addValue($values)}");
		$stmt->execute(array_values($values)); 
		$sonuc = $stmt->errorInfo();
		return [
		'status' => TRUE,
		'error' => $sonuc 
		];

	} catch (Exception $e) {
		return ['status' => FALSE,'error' => $e->getMessage()];
	}

}

public function update($table,$values,$options=[]){

	try {

		// _clean fonksiyonu ve array_walk_recursive 22.02.2021 tarihinde sepet için eklendi ileride sıkıntı çıkarsa silebilirsin
		// veya sıkıntı çıkan yerlere veriyi çekerken htmlspecialcharset_decode kullanabilirsin.
		function _clean(&$value) {
			$value = htmlspecialchars($value);
		}

		array_walk_recursive($values, '_clean');

		if ($options['dir']=="settings"){
			$filename = $options['dir']."_value";
		}else{
			$filename = $options['dir']."_file";
		}

		if (!empty($_FILES[$filename]['name'])) {
			$name_y=$this->imageUpload(
				$_FILES[$options['file_name']]['name'],
				$_FILES[$options['file_name']]['size'],
				$_FILES[$options['file_name']]['tmp_name'],
				$options['dir'],
				$values[$options['file_delete']]
				);
			$values+=[$options['file_name'] => $name_y];
			unset($values[$options['file_delete']]);
		}else{
			unset($values[$options['file_name']]);
			unset($values[$options['file_delete']]);
		}
		if(!empty($values[$options['pass']])) {
			$values[$options['pass']]=md5($values[$options['pass']]);
		}elseif(empty($values[$options['pass']])) {
			unset($values[$options['pass']]);
		}


		$columns_id = $values[$options['columns']];
		unset($values[$options['form_name']]);
		unset($values[$options['columns']]);
		$valuesExecute=$values;
		$valuesExecute+=[$options['columns'] => $columns_id];

		$stmt=$this->db->prepare("UPDATE $table SET {$this->addValue($values)} WHERE {$options['columns']}=?");
		$stmt->execute(array_values($valuesExecute));
		return ['status' => TRUE];
	} catch (Exception $e) {
		return ['status' => FALSE,'error' => $e->getMessage()];
	}

}






public function delete($table,$columns,$values,$fileName=null){
	try {
		if (!empty($fileName)) {
			unlink("../dimg/$table/$fileName");
		}
		$stmt=$this->db->prepare("DELETE FROM $table WHERE $columns=?");
		$stmt->execute([htmlspecialchars($values)]);

		return ['status' => TRUE];

	} catch (Exception $e) {
		return ['status' => FALSE,'error' => $e->getMessage()];
	}
}





public function adminInsert($admins_namesurname,$admins_username,$admins_pass,$admins_status){
	try {
		$stmt=$this->db->prepare("INSERT INTO admins SET admins_namesurname=?,admins_username=?,admins_pass=?,admins_status=?");
		$stmt->execute([$admins_namesurname,$admins_username,md5($admins_pass),$admins_status]);
		return ['status' => TRUE];
	} catch (Exception $e) {
		return ['status' => FALSE,'error' => $e->getMessage()];
	}
}






public function adminsLogin($adminsusername,$adminspass){
	try {
		$stmt=$this->db->prepare("SELECT * FROM admins WHERE admins_username=? AND admins_pass=? AND admins_status=?");
		$stmt->execute([$adminsusername,
			md5($adminspass),1]);
		if ($stmt->rowCount()==1) {
			$row=$stmt->fetch(PDO::FETCH_ASSOC);
			$_SESSION["admins"] = [
			"admins_username" => $adminsusername,
			"admins_namesurname" => $row['admins_namesurname'],
			"admins_file" => $row['admins_file'],
			"admins_id" => $row['admins_id']
			];
			return ['status' => TRUE ];
		}else{
			return ['status' => FALSE ];
		}
	} catch (Exception $e) {
		return ['status' => FALSE,'error' => $e->getMessage()];
	}
}


public function usersLogin($usersmail,$userspass){
	try {
		$stmt=$this->db->prepare("SELECT * FROM users WHERE users_mail=? AND users_pass=? AND users_status=?");
		$stmt->execute([$usersmail,
			md5($userspass),1]);
		if ($stmt->rowCount()==1) {
			$row=$stmt->fetch(PDO::FETCH_ASSOC);
			$_SESSION["users"] = [ 
			"users_namesurname" => $row['users_namesurname'],
			"users_mail" => $usersmail,
			"users_file" => $row['users_file'],
			"users_id" => $row['users_id']
			];
			return ['status' => TRUE ];
		}else{
			return ['status' => FALSE ];
		}
	} catch (Exception $e) {
		return ['status' => FALSE,'error' => $e->getMessage()];
	}
}


function stok_sor($id,$adet,$urun_url){ 
	$stoksor = new crud();
	$urun_sor = $this->db->wread("urun","urun_id",$id);
	$toplam_stok = $urun_sor['urun_stok'];
	$istenen_stok = $adet + $_COOKIE['siteurlmiz'][$id];
	if ($toplam_stok<$istenen_stok) {
		header("location:$url?stok=yetersiz");
		exit;
	}
}



public function read($table,$options=[]){
	try {
		if (isset($options['columns_name']) && empty($options['limit'])) {
			$stmt=$this->db->prepare("SELECT * FROM $table ORDER BY {$options['columns_name']} {$options['columns_sort']}");
		}elseif(isset($options['columns_name']) && isset($options['limit'])){
			$stmt=$this->db->prepare("SELECT * FROM $table ORDER BY {$options['columns_name']} {$options['columns_sort']} LIMIT {$options['limit']}");
		}else{
			$stmt=$this->db->prepare("SELECT * FROM $table");
		}
		
		$stmt->execute();

		return $stmt;

	} catch (Exception $e) {

		return ['status' => FALSE,'error' => $e->getMessage()];
	}
}


public function wread($table,$columns,$values,$options=[]){
	try {
		if (isset($options['columns_name']) && empty($options['limit'])) {
			$stmt=$this->db->prepare("SELECT * FROM $table WHERE $columns=? ORDER BY {$options['columns_name']} {$options['columns_sort']}");
		}elseif(isset($options['columns_name']) && isset($options['limit'])){
			$stmt=$this->db->prepare("SELECT * FROM $table WHERE $columns=? ORDER BY {$options['columns_name']} {$options['columns_sort']} LIMIT {$options['limit']}");
		}else{
			$stmt=$this->db->prepare("SELECT * FROM $table WHERE $columns=?");
		}
		$stmt->execute([htmlspecialchars($values)]);
		$stmt=$stmt->fetch(PDO::FETCH_ASSOC);
		return $stmt;
	} catch (Exception $e) {
		return ['status' => FALSE,'error' => $e->getMessage()];
	}
}

public function wread2($table,$columns,$values,$options=[]){
	try {
		if (isset($options['columns_name']) && empty($options['limit'])) {
			$stmt=$this->db->prepare("SELECT * FROM $table WHERE $columns=? ORDER BY {$options['columns_name']} {$options['columns_sort']}");
		}elseif(isset($options['columns_name']) && isset($options['limit'])){
			$stmt=$this->db->prepare("SELECT * FROM $table WHERE $columns=? ORDER BY {$options['columns_name']} {$options['columns_sort']} LIMIT {$options['limit']}");
		}else{
			$stmt=$this->db->prepare("SELECT * FROM $table WHERE $columns=?");
		}
		$stmt->execute([htmlspecialchars($values)]);
		return $stmt;
	} catch (Exception $e) {
		return ['status' => FALSE,'error' => $e->getMessage()];
	}
}

public function qSql($sql,$options=[]){
	try {
		$stmt=$this->db->prepare($sql);
		$stmt->execute();
		$stmt=$stmt->fetch(PDO::FETCH_ASSOC);
		return $stmt;
	} catch (Exception $e) {
		return ['status' => FALSE,'error' => $e->getMessage()];
	}
}

public function qSql2($sql,$options=[]){
	try {
		$stmt=$this->db->prepare($sql);
		$stmt->execute();
		return $stmt;
	} catch (Exception $e) {
		return ['status' => FALSE,'error' => $e->getMessage()];
	}
}

public function ara($tablo,$sutun,$kelimeler,$options=[]){
	try {
		$kelimeler_arr = explode(" ", $kelimeler);
		$sqlsorgusu = "SELECT * FROM ".$tablo." WHERE ".$sutun." LIKE ";

		for ($i=0; $i < count($kelimeler_arr) ; $i++) { 
			$sqlsorgusu = $sqlsorgusu."'%".$kelimeler_arr[$i]."%' ";
			if ($i == count($kelimeler_arr)-1) {
				break;
			}else{
				$sqlsorgusu = $sqlsorgusu."OR ";
			}
		}



		$stmt=$this->db->prepare("{$sqlsorgusu}");
		$stmt->execute();
		return $stmt;
	} catch (Exception $e) {
		return ['status' => FALSE,'error' => $e->getMessage()];
	}
}



public function seo($str, $options = array())
{
	$str = mb_convert_encoding((string)$str, 'UTF-8', mb_list_encodings());
	$defaults = array(
		'delimiter' => '-',
		'limit' => null,
		'lowercase' => true,
		'replacements' => array(),
		'transliterate' => true
		);
	$options = array_merge($defaults, $options);
	$char_map = array(
  // Latin
		'À' => 'A', 'Á' => 'A', 'Â' => 'A', 'Ã' => 'A', 'Ä' => 'A', 'Å' => 'A', 'Æ' => 'AE', 'Ç' => 'C',
		'È' => 'E', 'É' => 'E', 'Ê' => 'E', 'Ë' => 'E', 'Ì' => 'I', 'Í' => 'I', 'Î' => 'I', 'Ï' => 'I',
		'Ð' => 'D', 'Ñ' => 'N', 'Ò' => 'O', 'Ó' => 'O', 'Ô' => 'O', 'Õ' => 'O', 'Ö' => 'O', 'Ő' => 'O',
		'Ø' => 'O', 'Ù' => 'U', 'Ú' => 'U', 'Û' => 'U', 'Ü' => 'U', 'Ű' => 'U', 'Ý' => 'Y', 'Þ' => 'TH',
		'ß' => 'ss',
		'à' => 'a', 'á' => 'a', 'â' => 'a', 'ã' => 'a', 'ä' => 'a', 'å' => 'a', 'æ' => 'ae', 'ç' => 'c',
		'è' => 'e', 'é' => 'e', 'ê' => 'e', 'ë' => 'e', 'ì' => 'i', 'í' => 'i', 'î' => 'i', 'ï' => 'i',
		'ð' => 'd', 'ñ' => 'n', 'ò' => 'o', 'ó' => 'o', 'ô' => 'o', 'õ' => 'o', 'ö' => 'o', 'ő' => 'o',
		'ø' => 'o', 'ù' => 'u', 'ú' => 'u', 'û' => 'u', 'ü' => 'u', 'ű' => 'u', 'ý' => 'y', 'þ' => 'th',
		'ÿ' => 'y',
  // Latin symbols
		'©' => '(c)',
  // Greek
		'Α' => 'A', 'Β' => 'B', 'Γ' => 'G', 'Δ' => 'D', 'Ε' => 'E', 'Ζ' => 'Z', 'Η' => 'H', 'Θ' => '8',
		'Ι' => 'I', 'Κ' => 'K', 'Λ' => 'L', 'Μ' => 'M', 'Ν' => 'N', 'Ξ' => '3', 'Ο' => 'O', 'Π' => 'P',
		'Ρ' => 'R', 'Σ' => 'S', 'Τ' => 'T', 'Υ' => 'Y', 'Φ' => 'F', 'Χ' => 'X', 'Ψ' => 'PS', 'Ω' => 'W',
		'Ά' => 'A', 'Έ' => 'E', 'Ί' => 'I', 'Ό' => 'O', 'Ύ' => 'Y', 'Ή' => 'H', 'Ώ' => 'W', 'Ϊ' => 'I',
		'Ϋ' => 'Y',
		'α' => 'a', 'β' => 'b', 'γ' => 'g', 'δ' => 'd', 'ε' => 'e', 'ζ' => 'z', 'η' => 'h', 'θ' => '8',
		'ι' => 'i', 'κ' => 'k', 'λ' => 'l', 'μ' => 'm', 'ν' => 'n', 'ξ' => '3', 'ο' => 'o', 'π' => 'p',
		'ρ' => 'r', 'σ' => 's', 'τ' => 't', 'υ' => 'y', 'φ' => 'f', 'χ' => 'x', 'ψ' => 'ps', 'ω' => 'w',
		'ά' => 'a', 'έ' => 'e', 'ί' => 'i', 'ό' => 'o', 'ύ' => 'y', 'ή' => 'h', 'ώ' => 'w', 'ς' => 's',
		'ϊ' => 'i', 'ΰ' => 'y', 'ϋ' => 'y', 'ΐ' => 'i',
  // Turkish
		'Ş' => 'S', 'İ' => 'I', 'Ç' => 'C', 'Ü' => 'U', 'Ö' => 'O', 'Ğ' => 'G',
		'ş' => 's', 'ı' => 'i', 'ç' => 'c', 'ü' => 'u', 'ö' => 'o', 'ğ' => 'g',
  // Russian
		'А' => 'A', 'Б' => 'B', 'В' => 'V', 'Г' => 'G', 'Д' => 'D', 'Е' => 'E', 'Ё' => 'Yo', 'Ж' => 'Zh',
		'З' => 'Z', 'И' => 'I', 'Й' => 'J', 'К' => 'K', 'Л' => 'L', 'М' => 'M', 'Н' => 'N', 'О' => 'O',
		'П' => 'P', 'Р' => 'R', 'С' => 'S', 'Т' => 'T', 'У' => 'U', 'Ф' => 'F', 'Х' => 'H', 'Ц' => 'C',
		'Ч' => 'Ch', 'Ш' => 'Sh', 'Щ' => 'Sh', 'Ъ' => '', 'Ы' => 'Y', 'Ь' => '', 'Э' => 'E', 'Ю' => 'Yu',
		'Я' => 'Ya',
		'а' => 'a', 'б' => 'b', 'в' => 'v', 'г' => 'g', 'д' => 'd', 'е' => 'e', 'ё' => 'yo', 'ж' => 'zh',
		'з' => 'z', 'и' => 'i', 'й' => 'j', 'к' => 'k', 'л' => 'l', 'м' => 'm', 'н' => 'n', 'о' => 'o',
		'п' => 'p', 'р' => 'r', 'с' => 's', 'т' => 't', 'у' => 'u', 'ф' => 'f', 'х' => 'h', 'ц' => 'c',
		'ч' => 'ch', 'ш' => 'sh', 'щ' => 'sh', 'ъ' => '', 'ы' => 'y', 'ь' => '', 'э' => 'e', 'ю' => 'yu',
		'я' => 'ya',
  // Ukrainian
		'Є' => 'Ye', 'І' => 'I', 'Ї' => 'Yi', 'Ґ' => 'G',
		'є' => 'ye', 'і' => 'i', 'ї' => 'yi', 'ґ' => 'g',
  // Czech
		'Č' => 'C', 'Ď' => 'D', 'Ě' => 'E', 'Ň' => 'N', 'Ř' => 'R', 'Š' => 'S', 'Ť' => 'T', 'Ů' => 'U',
		'Ž' => 'Z',
		'č' => 'c', 'ď' => 'd', 'ě' => 'e', 'ň' => 'n', 'ř' => 'r', 'š' => 's', 'ť' => 't', 'ů' => 'u',
		'ž' => 'z',
  // Polish
		'Ą' => 'A', 'Ć' => 'C', 'Ę' => 'e', 'Ł' => 'L', 'Ń' => 'N', 'Ó' => 'o', 'Ś' => 'S', 'Ź' => 'Z',
		'Ż' => 'Z',
		'ą' => 'a', 'ć' => 'c', 'ę' => 'e', 'ł' => 'l', 'ń' => 'n', 'ó' => 'o', 'ś' => 's', 'ź' => 'z',
		'ż' => 'z',
  // Latvian
		'Ā' => 'A', 'Č' => 'C', 'Ē' => 'E', 'Ģ' => 'G', 'Ī' => 'i', 'Ķ' => 'k', 'Ļ' => 'L', 'Ņ' => 'N',
		'Š' => 'S', 'Ū' => 'u', 'Ž' => 'Z',
		'ā' => 'a', 'č' => 'c', 'ē' => 'e', 'ģ' => 'g', 'ī' => 'i', 'ķ' => 'k', 'ļ' => 'l', 'ņ' => 'n',
		'š' => 's', 'ū' => 'u', 'ž' => 'z'
		);
	$str = preg_replace(array_keys($options['replacements']), $options['replacements'], $str);
	if ($options['transliterate']) {
		$str = str_replace(array_keys($char_map), $char_map, $str);
	}
	$str = preg_replace('/[^\p{L}\p{Nd}]+/u', $options['delimiter'], $str);
	$str = preg_replace('/(' . preg_quote($options['delimiter'], '/') . '){2,}/', '$1', $str);
	$str = mb_substr($str, 0, ($options['limit'] ? $options['limit'] : mb_strlen($str, 'UTF-8')), 'UTF-8');
	$str = trim($str, $options['delimiter']);
	return $options['lowercase'] ? mb_strtolower($str, 'UTF-8') : $str;
}



}
?>