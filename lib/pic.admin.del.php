<?php
header('P3P: CP="ALL CURa ADMa DEVa TAIa OUR BUS IND PHY ONL UNI PUR FIN COM NAV INT DEM CNT STA POL HEA PRE LOC OTC"');
header ('Cache-Control: no-cache, must-revalidate'); 
header ('Pragma: no-cache');
header ('Content-type: text/html; charset=UTF-8');
session_start();
define("__CHIBI__",time());
$cid = $_POST['cid'];
//$src = $_POST['src'];
//$type = $_POST['type'];
$idx = explode("&",$_POST['idx']);
$idx_cmt = '';



/* DB정보취득 */
include_once "../data/config/db.config.php";
include_once "./db.conn.php";
include_once "./bbs.fn.php";

$sql2 = "SELECT * FROM `chibi_member` WHERE session='".mysqli_real_escape_string($chibi_conn, session_id())."'";
$query2 = mysqli_query($chibi_conn, $sql2);
$member2 = (object) mysqli_fetch_array($query2);
$bbs = mysqli_fetch_array(select($cid,$chibi_conn));
$bbs_op = unserialize($bbs['op']);
$point = $bbs_op['pic_point'];



if(bbs_permission($member2->permission,$cid)=="true"){
	$cmt ='';	
	$mi ='';
	for($i=0;$i<count($idx);$i++){
	$tmp = '';
	$tmp = explode("=",$idx[$i]);
	if($i !="0")$idx_cmt = $idx_cmt.",".$tmp[1];
	else $idx_cmt = $tmp[1];


	$select = "SELECT * FROM `chibi_pic` WHERE `idx`='".mysqli_real_escape_string($chibi_conn, $tmp[1])."'";
	$s_query = mysqli_query($chibi_conn, $select);
	$picture = mysqli_fetch_array($s_query);
	$picop = unserialize($picture["op"]);
	$user_id = $picop['user_id'];
	if(empty($user_id)==false){
		$p_sql = "UPDATE `chibi_member` SET `point` = point-'".mysqli_real_escape_string($chibi_conn, $point)."' , `pic`=pic-'1' WHERE `user_id` = '".mysqli_real_escape_string($chibi_conn, $user_id)."'";
	}
	mysqli_query($chibi_conn, $p_sql);
	
	if($i !="0")$cmt = $cmt.",".$picture['no'];
	else $cmt = $picture['no'];
	if($picture['type'] == "picture"){
		delfile("../".$picture['src']);
	}
	$mi = $i;
	}


	

	$query = "DELETE FROM `chibi_pic` WHERE `idx` IN (".mysqli_real_escape_string($chibi_conn, $idx_cmt).")";
	$query2 = "DELETE FROM `chibi_comment` WHERE `pic_no` IN (".mysqli_real_escape_string($chibi_conn, $cmt).") AND `cid` = '".mysqli_real_escape_string($chibi_conn, $cid)."'";
	//echo $query;
	mysqli_query($chibi_conn, $query);
	mysqli_query($chibi_conn, $query2);

		$chk = true;
		echo $chk;
	
}else{

	$chk = false;
	echo $chk;
}
mysqli_close($chibi_conn);
?>