<?php
header('P3P: CP="ALL CURa ADMa DEVa TAIa OUR BUS IND PHY ONL UNI PUR FIN COM NAV INT DEM CNT STA POL HEA PRE LOC OTC"');
header ('Cache-Control: no-cache, must-revalidate'); 
header ('Pragma: no-cache');
header ('Content-type: text/html; charset=UTF-8');
session_start();
define("__CHIBI__",time());
$cid = $_POST['cid'];
$idx = $_POST['idx'];
$passwd = $_POST['passwd'];

/* DB정보취득 */
include_once "../data/config/db.config.php";
include_once "./db.conn.php";
include_once "./bbs.fn.php";

if((empty($cid) && empty($idx))==false){

	$select = "SELECT * FROM `chibi_pic` WHERE `idx`='".mysql_real_escape_string($idx)."' AND `passwd`='".mysql_real_escape_string(md5($passwd))."'";
	$s_query = mysql_query($select,$chibi_conn);
	$picture = mysql_fetch_array($s_query);
	if(empty($picture['idx'])==true){
			$chk = false;
			echo $chk;
	}else{
	if($picture['type'] == "picture"){
		delfile("../".$picture['src']);
	}
	
	$bbs_query = select($cid,$chibi_conn);
		$bbs = (object) mysql_fetch_array($bbs_query);
		$bbs->op = (object) unserialize($bbs->op);
		if($bbs->op->secret=="all"){
		$point_sql = "UPDATE `xe_point` SET `point` = `point`-'10' WHERE `member_srl` ='".mysql_real_escape_string($bbs->member_srl)."'";
		mysql_query($point_sql);
		}

	$query = "DELETE FROM `chibi_pic` WHERE `idx`='".mysql_real_escape_string($idx)."' AND `cid` = '".mysql_real_escape_string($cid)."'";
	$cmt_query = "DELETE FROM `chibi_comment` WHERE `pic_no`='".mysql_real_escape_string($picture['no'])."' AND `cid` = '".mysql_real_escape_string($cid)."'";
	//echo $query;
	mysql_query($query,$chibi_conn);
	mysql_query($cmt_query,$chibi_conn);
		$chk = true;
		echo $chk;
		}
}else{
	$chk = false;
	echo $chk;
}
mysql_close($chibi_conn);
?>