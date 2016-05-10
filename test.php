<?php 
/** 
 * @连接mysql数据库的类
 * @filename：Class_Con.inc.php
 *  
 * @example $this -> Link ();  
 */ 

//接口定义
interface Connected 
{ 
 
// Buat Bayangan Pertama 
public function __construct(); 
 
// Buat Bayangan Function Kedua  
public function connect (); 
 
// Buat Bayangan Function Ketiga 
public function error_mysql (); 
 
// Buat Bayangan Function Keempat 
public function db_selected (); 
 
// Buat Bayangan Function Kelima  
public function mysql_close (); 
} 

/** 
 *  
 * 使用接品类操作mysql 
 *  
 * @return Function Dari Interface 
 * @var String Variable  
 */ 

class ConfigureMysql implements Connected{ 
 
/** 
 * @var String 
 */ 
var $_link ; 
 
/** 
 * @var String  
 */ 
var $_Link_Cons ;  
 
/** 
 * @var String  
 */ 
var $_Error;  
 
/** 
 * @var String  
 */ 
var $_DB;  
 
 
// Setting Function Dari Interface 
public function __construct() { 
 
$this ->_Link_Cons = $this ->connect(); 
return $this ->_Link_Cons ; 
} 
 
// Setting Function Kedua Dari Interface  
public function connect () { 
 
$this ->_link = @mysql_connect('localhost' , 'root' , 'tonghangyun123', '3306') or die($this->error_mysql ()); 
} 
 
// Settiong Function Ketiga Dari Interface  
public function error_mysql () { 
 
$this ->_Error = "<h2> Masalah Pada Koneksi Ke Jalur Mysql </h2>"; 
 
} 
 
// Settiong Function Keempat Dari Interface  
public function db_selected () { 
 
$this ->_DB = mysql_select_db('tonghangyuntestdb'); 
if ($this ->_DB != TRUE) { 
return $this ->error_mysql(); 
}else { 
return false ; 
} 
} 
 
// Setting Function Kelima Dari Interface  
public function mysql_close () { 
 
return mysql_close($this ->connect()); 
} 
} 

/** 
 * Gunakan Script Classes Untuk Function Parent::  
 *  
 * @example parent::__Construct(); 
 */ 

class LinkCon extends ConfigureMysql  { 
 
/** 
 * @var String 
 */ 
var $_Con ;  
 
/** 
 * @var String 
 */ 
var $_Db ; 
 
/** 
 * @magic Self:: 
 */ 
var  $_Error_Show ; 

/** 
 * @return Mysql_Close  
 */ 
var $_Close ; 
 
 
// Setting Function Dari Class Yang Di Extends 
public function Conf_Show_Mysql () { 
 
$this ->_Con = parent::__construct(); 
} 
 
// Setting Function Dari Class Yang Di Extends  
public function DB_Selected () { 
 
$this ->_Db = $this ->DB_Selected(); 
return $this ->_Db ; 
} 
 
// Setting Function Dari Class Yang Di Extends  
public function _CloseMysql () { 
 
$this ->_Close = $this ->mysql_close(); 
return $this ->_Close ; 
} 
 
// Set Error  
public function Eroor_Show () { 
 
$this ->_Error_Show = $this ->error_mysql();; 
return true ; 
} 
 
// Akhir Classes  
} 
?>


