<?php
header('P3P: CP="ALL CURa ADMa DEVa TAIa OUR BUS IND PHY ONL UNI PUR FIN COM NAV INT DEM CNT STA POL HEA PRE LOC OTC"');
header ('Cache-Control: no-cache, must-revalidate'); 
header ('Pragma: no-cache');
header ('Content-type: text/html; charset=UTF-8');
define("__CHIBI__",time());
$cid = $_POST['cid'];
$page = $_POST['page'];
$name = $_POST['name'];
$passwd = $_POST['passwd'];
$comment = $_POST['comment'];
$idx = $_POST['idx'];
$op = $_POST['op'];
$depth = $_POST['depth'];
if(empty($depth)==false){
	$depth++;
}
else{
	$depth = 1;
}
if(empty($no)==false){
if($depth==1)$no++;
}else{
$no = 1;
}

if(empty($op)==false){
	if($op['dice']) $op['dice'] = rand(1,6)."+".rand(1,6);
	if($op['cookie']=="cookie"){
	setcookie('nickname',$name,60*60*24*30+time(),"/");
	setcookie('passwd',$passwd,60*60*24*30+time(),"/");
	}
	$op = serialize($op);
}
else{
	$op = '';
}

$hpurl ='';


/* DB정보취득 */
include_once "../data/config/db.config.php";
include_once "./db.conn.php";
include_once "./bbs.fn.php";
$bbs_query = select($cid,$chibi_conn);
$bbs = mysql_fetch_array($bbs_query);
$spamword = unserialize($bbs['spam']);
//echo $spam['word'];
if($name && $passwd && $comment && $no && $pic_no){
$cf_filter = explode(",", $spamword['word']); 
foreach ($cf_filter as $filter) { 
    $filter = trim($filter); 
    if (strstr($comment, $filter)) 
        $spam = $filter;
}
if(empty($spam)==false){
	echo "<script>alert('".$spam." 은(는) 사용 금지된 단어입니다.');
	history.go(-1);
	</script>";
	exit;

}else{

	  $query = "INSERT INTO `chibi_comment` (`idx`,`cid`,`pic_no`,`no`, `depth`, `name`, `passwd`, `rtime`, `comment`, `memo`, `hpurl`, `ip`, `op`)VALUES('','".mysql_real_escape_string($cid)."','".mysql_real_escape_string($pic_no)."','".mysql_real_escape_string($no)."','".mysql_real_escape_string($depth)."','".mysql_real_escape_string($name)."','".mysql_real_escape_string(md5($passwd))."','".time()."','".mysql_real_escape_string($comment)."','','".mysql_real_escape_string($hpurl)."','".$_SERVER["REMOTE_ADDR"]."','".mysql_real_escape_string($op)."')";
	  mysql_query($query,$chibi_conn);	  
		echo "<script>alert('등록 완료!!');
	location.href = '../index.php?cid=".$cid."&page=".$page."';
	</script>";
}
}else{
	echo "<script>alert('등록 실패!!');
	history.go(-1);
	</script>";
}

mysql_close($chibi_conn);
?>