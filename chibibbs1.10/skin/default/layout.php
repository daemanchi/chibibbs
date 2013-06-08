<script type="text/javascript">
jQuery(window).load(function(){
	var table_w = $("table").width();
	$("thead > tr > th").width(table_w);

	$('.cmt_more').click(function(){
		if($(this).attr('more')==0){
		$(this).attr('more','1');
		$(this).children('img').attr('src','skin/default/images/close.png');
		$(this).next('p').attr('style','display:block;');
		}else{
		$(this).attr('more','0');
		$(this).children('img').attr('src','skin/default/images/more.png');
		$(this).next().attr('style','display:none;');
		}
	});

	$('.pic_more').click(function(){
		if($(this).attr('more')==0){
		$(this).attr('more','1');
		$(this).children('img').attr('src','skin/default/images/close.png');
		$(this).next('a').attr('style','display:block;');
		}else{
		$(this).attr('more','0');
		$(this).children('img').attr('src','skin/default/images/more.png');
		$(this).next('a').attr('style','display:none;');
		}
	});
		
});
jQuery(window).resize(function(){
	var img_w = $("pic_log").width();
	if(<?=$skin->op->resize?>>img_w){
	$("pic_log > a > img").width(img_w);
	}
	var table_w = $("table").width();
	$("thead > tr > th").width(table_w);
});

</script>

<!--// 스킨 디자인 시작 //-->

<!--// 상단 공지사항 시작 //-->
<?php if($bbs->notice->head){?>
<div class="span8 offset2">
	<div class="user_notice_border_color user_notice_border_type user_notice_background_color">
		<?php echo nl2br($bbs->notice->head);?>
	</div>
</div>
<?}?>
<!--// 상단 공지사항 끝 //-->


<!-- // 페이지바 시작 //-->
<div class="span8 offset2 pagination text-center">
  <ul>
	<?php echo $paging;?>
  </ul>
</div>
<!-- // 페이지바 끝 //-->



<!--// 툴바 시작 //-->
<?php 
if($bbs->op->use_permission == "all" || ($bbs->op->use_permission=="admin" && $permission=="true")){
?>
<div class="span8 offset2 text-center">
	<p>
		<form id="drawForm" method="POST" class="form-inline" action="./index.php?cid=<?=$cid?>&cAct=picDraw">
			<input id="tool" type="hidden" name="tool" value="">
			<input id="chi_file" type="hidden" name="chi_file" value="">
			<span>너비</span> <input type="text" class="input-mini tool_width" id="width" name="width" placeholder="<?=$bbs->op->pic_min_width?>-<?=$bbs->op->pic_max_width?>">
			<span>높이</span> <input type="text" class="input-mini tool_height" id="height" name="height" placeholder="<?=$bbs->op->pic_min_width?>-<?=$bbs->op->pic_max_width?>">
			<?php if($device=="mobile") echo "<p class=\"marginTop5\">";?>
			<a href="javascript:;" onclick="selectTool('btool')" <?php if($bbs->op->btool=='off') echo "style=\"display:none;\"";?>><?=$skin->op->btool_icon?></a>
			<a href="javascript:;" onclick="selectTool('chibi')"><?=$skin->op->chibi_icon?></a>
			<a id="openLoad" href="javascript:;"><?=$skin->op->load_icon?></a>
			<?php if($device=="mobile") echo "</p>";?>
		</form>
	</p>
</div>
<?php 
}
?>
<!--// 툴바 종료 //-->

<!--// 로드 폼 시작 //-->
<div id="loadForm" class="text-center user_notice_border_color user_notice_border_type user_notice_background_color span4 offset4" style="padding:5px;">
<ul class="unstyled">
<li>
<select id="loadSelect">
<option selected="selected">로드 방식</option>
<option value="picture">그림</option>
<option value="youtube">유튜브</option>
<option value="naver">네이버동영상</option>
</select>
</li>
<li>
<div class=".div"></div>
<div class="loadpic">
<form class="form-horizontal" id="uploadForm" action="lib/load.submit.php" onsubmit="return upload()" method="post" enctype="multipart/form-data">
<input name="image" class="input-large" id="inputFile" type="file" required>
<input type="password" name="passwd" class="span5" placeholder="패스워드" required>
<input type="image" src="skin/default/images/load.png" id="uploadBtn" >
<input type="hidden" id="type" class="type" name="type">
<input type="hidden" id="cid" name="cid" value="<?=$cid?>">
<input type="hidden" id="user_id" name="user_id" value="<?=$member->user_id?>">
</form>
</div>
<div class="video">
<form class="form-horizontal" id="uploadVForm" action="lib/load.submit.php" onsubmit="return uploadV()" method="post" enctype="multipart/form-data">
<textarea rows="3" class="span12" id="video" name="image" style="resize:none;" required placeholder="동영상의 <iframe> 태그를 입력해주세요"></textarea>
<input type="password" name="passwd" class="span5" placeholder="패스워드" required>
<input type="image" src="skin/default/images/load.png" id="uploadVBtn" class="marginTop5">
<input type="hidden" id="type" class="type" name="type">
<input type="hidden" id="cid" name="cid" value="<?=$cid?>">
<input type="hidden" id="user_id" name="user_id" value="<?=$member->user_id?>">
</form>
</div>
<p class="text-right"><a id="closeLoad" href="javascript:;"><img src="skin/default/images/close.png"></a></p>
</li>
</ul>
<iframe id="uploadIFrame" name="uploadIFrame" src="" style="display:none;visibility:hidden"></iframe>
</div>
<!--// 로드 폼 종료 //-->



<!--// 상단 메뉴 시작 //-->
<div class="span8 offset2 text-center">
	<a href="./index.php?cid=<?=$cid?>&page=<?=$_GET['page']?>"><?=$skin->op->reflash_icon?></a>
	<?php if(empty($permission)==true){?><a href="./login.php?cid=<?=$cid?>"><?=$skin->op->login_icon?></a>
	<?php }else if($permission=="true"){ ?>
	<a href="./admin/admin.php?cid=<?=$cid?>" target="_blank"><?=$skin->op->admin_icon?></a>
	<a href="./logout.php?user_id=<?=$member->user_id?>"><?=$skin->op->logout_icon?></a>
	<?php }else{ ?>
	<a href="./logout.php?user_id=<?=$member->user_id?>"><?=$skin->op->logout_icon?></a>
	<?php } ?>
	<a href="javascript:;" onclick="javascript:window.open('./emoticon.php?cid=<?=$cid?>','이모티콘리스트','scrollbars=yes,toolbar=no,menubar=no,width=300,height=500')"><?=$skin->op->emoticon_icon?></a>
</div>
<!--// 상단 메뉴 종료 //-->

<!--// 관리자 패널 //-->
<?php if(empty($permission)==false && $permission=="true"){ ?>

<?php if($device!="mobile"){ ?>
<div class="text-center adminpanel" >
	<p>
		<form class="adminCmtDel margin0" action="#">
			<button type="submit" id="admindelbtn" class="btn btn-mini btn-danger" style="">리플<br/>삭제</button>
		</form>
	<p/>
	<p>
		<form class="adminPicDel margin0" action="#">
			<button type="submit" id="admindelbtn" class="btn btn-mini btn-danger" style="">그림<br/>삭제</button>
		</form>
	</p>
</div>
<?}else{?>
<div class="span6 offset3 text-center" >
	<form class="adminCmtDel margin0" action="#" style="display:inline;">
		<button type="submit" id="admindelbtn" class="btn btn-mini btn-danger" style="">리플 삭제</button>
	</form>
	<form class="adminPicDel margin0" action="#" style="display:inline;">
		<button type="submit" id="admindelbtn" class="btn btn-mini btn-danger" style="">그림 삭제</button>
	</form>
</div>
<?php } ?>

<?php } ?>
<!--// 관리자 패널 //-->

<!--// 그림을 불러오기 위한 반복문 시작 //-->
<@--START:PIC--@>

<?php
if($pic->type=="youtube"){// 유투브 동영상
	if(get_magic_quotes_gpc()) $pic->src = stripslashes($pic->src); /* magic_quotes_gpc가 off일경우 slashes설정 */
	preg_match('@src="([^"]+)"@',$pic->src,$src);
	$size[0] = preg_match('@width="([^"]+)"@',$pic->src,$src);
	$size[1] = preg_match('@height="([^"]+)"@',$pic->src,$src);
	$picture = "<p class=\"movie\"><iframe width=\"100%\" height=\"100%\" src=\"".$src[1]."\" frameborder=\"0\" allowfullscreen></iframe></p>";
}else if($pic->type=="naver"){// 네이버 동영상
	if(get_magic_quotes_gpc()) $pic->src = stripslashes($pic->src); /* magic_quotes_gpc가 off일경우 slashes설정 */
	preg_match( '@src="([^"]+)"@' , $pic->src , $src );
	$size[0] = preg_match('@width="([^"]+)"@',$pic->src,$src);
	$size[1] = preg_match('@height="([^"]+)"@',$pic->src,$src);
	$picture = "<p class=\"movie\"><iframe width=\"100%\" height=\"100%\" src=\"".$src[1]."\" frameborder=\"no\" scrolling=\"no\" ></iframe></p>";
}else if($pic->type=="picture"){//그림 일 경우
	$size = GetImageSize($pic->src); // 그림 크기 취득
	if((($pic->op->pic=="secret" || $pic->op->pic=="moresecret") && $pic->pic_ip != $_SERVER['REMOTE_ADDR'])&& empty($permission)==true) $picture = "<p class=\"text-center\">".$skin->op->secret_icon."</p>"; // 비밀 그림 일경우
	else{
		if($pic->op->pic=="more" || $pic->op->pic=="moresecret"){
			 $more = "style=\"display:none;\"";
			 $more_btn = "<a class=\"pic_more\" more=\"0\" href=\"javascript:;\">".$skin->op->more_icon."</a>";
		}
		$picture = $more_btn."<a class=\"lightbox_trigger\" href=\"".$pic->src."\" ".$more." ><img src=\"".$pic->src."\" id=\"".$pic->idx."\"style=\"width:100%;max-width:".$skin->op->resize."px;\"></a>"; //리사이즈
		if($pic->op->pic=="secret" || $pic->op->pic=="moresecret") $picture = "<p class=\"text-center\">".$skin->op->secret_icon."</p>".$picture;
	}
}else{// 텍스트 일 경우
	$picture = '';
}
?>

<!--// 본문 시작 //-->
	<div class="container">
		<table class="span12 table table-bordered user_table_border_color user_table_border_size user_table_border_type">
			<thead>
				<tr>
					<th class="font-size" colspan="2">
						<ul class="unstyled inline margin0">
							<li>
								<!--// 그림번호 //-->
								No.<?=$pic->no?>
								<!--// 그림번호 //-->
								<!--// 관리자용 체크박스 //-->
								<?php if(empty($permission)==false && $permission=="true"){?>
								<input style="line-height:20px;" type="checkbox" class="picidx" name="picidx" value="<?=$pic->idx?>" >
								<?php } ?>
								<!--// 관리자용 체크박스 //-->
							</li>
							<li>
								<!--// 그림옵션 아이콘 //-->
								<?php if($pic->pic_ip==$_SERVER['REMOTE_ADDR']||$permission=="true"){ ?>
								<a href="javascript:;" idx="<?=$pic->idx?>" class="opBtn"><?=$skin->op->op_icon?></a>
								<?php }?>
								<!--// 그림옵션 아이콘 //-->

								<!--// 이어그리기 아이콘 //-->
								<?php if($pic->type=="picture"){ ?>
								<a href="javascript:;" idx="<?=$pic->idx?>" class="continueBtn"><?=$skin->op->continue_icon?></a>
								<?php } ?>
								<!--// 이어그리기 아이콘 //-->

								<!--// 삭제 아이콘 //-->
								<a href="javascript:;" idx="<?=$pic->idx?>" class="picdelBtn"><?=$skin->op->del_icon?></a>
								<!--// 삭제 아이콘 //-->
							<!--// 로그정보 //-->
								<span class="log_info">
								작성시간: <?=date("Y년m월d일 H시i분s초",$pic->time)?>
								&nbsp;|&nbsp;
								원본크기: <?=$size[0]?>×<?=$size[1]?>
								<script type="text/javascript">
								function resize<?=$pic->idx?>(){
									var resize_w = $("#<?=$pic->idx?>").width();
									var resize_h = $("#<?=$pic->idx?>").height();
									if(<?=$skin->op->resize?> < resize_w || <?=$size[0]?> > resize_w){
									$('#resize<?=$pic->idx?>').html('(리사이즈:'+resize_w+'×'+resize_h+')');
									}else{
									$('#resize<?=$pic->idx?>').html('');
									}
								}
								$(window).load(function(){
									resize<?=$pic->idx?>();
								});	
								$(window).resize(function(){
									resize<?=$pic->idx?>();
								});
								</script>
								<span id="resize<?=$pic->idx?>" style="color: red;">
								</span>
								&nbsp;|&nbsp;
								작성툴: <?php if(strstr($pic->agent,"ChibiPaint")){ echo "치비 툴"; }else{ echo "로드 툴"; } ?>
								<?php if($bbs->op->showip=="on"){ echo "작성자IP: ".$pic->ip; }else if($bbs->op->showip=="admin" && $permission==ture){ echo "&nbsp;|&nbsp;작성자IP: ".$pic->ip; } else { } ?>
								</span>
							<!--// 로그정보 //-->
							</li>
						</ul>
					</th>
				</tr>
			</thead>
		<tbody>
			<tr>
				<!--//그림 출력//-->
				<td class="pic_log user_pic_background_color" <?php if($skin->op->table_down<$size[0] || $device=="mobile") echo "colspan=\"2\"";?> style="width:<?php if($size[0]<$skin->op->resize){ echo $size[0]; }else{ echo $skin->op->resize; }?>px;">
					<?=$picture?>
				</td>
				<!--//그림 출력//-->
				<?php if($skin->op->table_down<$size[0] || $device=="mobile") echo "</tr><tr>";?>
				<!--//코멘트 출력//-->
				<td class="user_reply_background_color">
					<ul class="unstyled">
					<!--// 코멘트를 불러오기 위한 반복문 시작 //-->
					<@--START:COMMENT--@>
					<?php
						if(($comment->op->secret=="secret" && $comment->ip != $_SERVER['REMOTE_ADDR']) && empty($permission)==true ){ 
						$comment->comment = ''; //비밀글 일때
						}else{
						$comment->comment = htmlFilter($comment->comment,1,$bbs->tag); //HTML 필터링(코멘트)
						$comment->name = htmlFilter($comment->name,1,$bbs->tag); //HTML 필터링(이름)
						$comment->memo = htmlFilter($comment->memo,1,$bbs->tag); //HTML 필터링(메모)
						$comment->comment = emoticon($comment->comment,$cid,$chibi_conn); //이모티콘
						$comment->comment = nl2br($comment->comment); //줄바꿈
						if($keyword && $search=="comment") $comment->comment = str_replace($keyword,"<span style='color:#FF001E;background-color:#FFF000;'>".$keyword."</span>",$comment->comment);
						if($keyword && $search=="name") $comment->name = str_replace($keyword,"<span style='color:#FF001E;background-color:#FFF000;'>".$keyword."</span>",$comment->name);
						}
						if($comment->op->dice) $dice = explode("+",$comment->op->dice); //주사위가 있을경우 주사위 배치
						else $dice = ''; //주사위가 없을 경우
					?>
						<li class="user_reply_text_color">
							<?php if($comment->depth > 1) for($i=1;$i<$comment->depth;$i++) echo "<blockquote class=\"user_rereply_bar_color user_rereply_text_color\">"; //리플 구분바?>
 
							<p class="name">
								<b><?=$comment->name?></b>
								<?php if($pic->pic_ip == $comment->ip) echo $skin->op->painter_icon; //작가글 아이콘 ?>
								<!--//홈페이지아이콘//-->
								<?php if($comment->hpurl) echo "<a href=\"".$comment->hpurl."\" target=\"_blank\">".$skin->op->hp_icon."</a>" ?>
								<!--//홈페이지아이콘//-->
								&nbsp;::&nbsp;
								<?php if(empty($dice)==false) echo "<img src=\"images/".$dice[0].".gif\"><img src=\"images/".$dice[1].".gif\">"; //주사위 출력?>
								<?=date("Y/m/d(D) H:i:s",$comment->rtime)//작성시간출력?> 
								&nbsp;
								<!--//리플아이콘//-->
								<a href="javascript:;" no="<?=$comment->no?>" pic_no="<?=$comment->pic_no?>" depth="<?=$comment->depth?>" class="reply"><?=$skin->op->reply_icon?></a>
								<!--//리플아이콘//-->

								<!--//수정아이콘//--> 
								<?php if($comment->op->secret!="secret" || ($_SERVER['REMOTE_ADDR'] == $comment->ip && $comment->op->secret=="secret")){?>
								<a href="javascript:;" no="<?=$comment->no?>" idx="<?=$comment->idx?>" pic_no="<?=$comment->pic_no?>" depth="<?=$comment->depth?>" class="modify"><?=$skin->op->modify_icon?></a>
								<?php } ?>
								<!--//수정아이콘//-->

								<!--//삭제아이콘//-->
								<a href="javascript:;" no="<?=$comment->no?>" idx="<?=$comment->idx?>" pic_no="<?=$comment->pic_no?>" depth="<?=$comment->depth?>" rtime="<?=$comment->rtime?>" class="delBtn"><?=$skin->op->del_icon?></a>
								<!--//삭제아이콘//-->

								<!--// 관리자용 체크박스 //-->
								<?php if(empty($permission)==false && $permission=="true"){?>
								<input style="line-height:20px;" type="checkbox" class="idx" name="idx" value="<?=$comment->idx?>" >
								<?php } ?>
								<!--// 관리자용 체크박스 //-->
							</p>
							<div>
							<!--//코멘트//-->
							<?php 
								if(empty($comment->op->more)==false){ echo"<a class=\"cmt_more\" more=\"0\" href=\"javascript:;\">".$skin->op->more_icon."</a><p class=\"comment\" style=\"display:none;\">";}
								else{ echo "<p class=\"comment\">";}
								if($comment->op->secret=="secret") echo $skin->op->secret_icon."</br>";
								if($comment->memo) echo "Memo :: ".$comment->memo."<br/>";
							?>
							<?=$comment->comment?>
							</p>
							<!--//코멘트//-->
							</div>
				
						<?php if($comment->depth > 1) for($i=0;$i<$comment->depth;$i++) echo "</blockquote>"; //리플 구분바?>
						</li>
					<@--END:COMMENT--@>
					<li class="user_reply_text_color">
						<!--// 코멘트 작성 폼 //-->
						<div class="text-right" style="margin-top:15px;">
							<form class="margin0 cmtForm" method="POST" action="./lib/comment.submit.php">
								<div class="controls">
									
										<input type="text" class="span6" name="memo" id="memo" placeholder="memo" >
										<input type="text" class="span6" name="hpurl" id="hpurl" placeholder="homepage" >
									
								</div>
								<div class="controls">
									<textarea rows="2" class="span12" id="comment" name="comment" style="resize:none;" ></textarea>
								</div>
								<div class="controls">
									<p>
										<label class="checkbox inline">
										<input type="checkbox" id="op['secret']" name="op[secret]" value="secret">secret
										</label>
										<label class="checkbox inline">
										<input type="checkbox" id="op['more']" name="op[more]" value="more">more
										</label>
										<label class="checkbox inline">
										<input type="checkbox" id="op['dice']" name="op[dice]" value="dice">dice
										</label>
										<label class="checkbox inline">
										<input type="checkbox" id="op['cookie']" name="op[cookie]" value="cookie">cookie
										</label>
									</p>
								</div>
								<div class="controls">
									<input type="hidden" name="cid" value="<?=$cid?>">
									<input type="hidden" name="page" value="<?=$page?>">
  									<input type="hidden" name="no" value="<?=$no?>">
  									<input type="hidden" name="pic_no" value="<?=$pic->no?>">
  									<input type="hidden" name="op[user_id]" value="<?=$member->user_id?>">
  									<input type="text" class="input-mini" name="name" id="name" placeholder="name" <?php if($_COOKIE['nickname']) echo 'value="'.$_COOKIE['nickname'].'"';?>>
  									<input type="password" class="input-mini" name="passwd" id="passwd" placeholder="password" <?php if($_COOKIE['passwd']) echo 'value="'.$_COOKIE['passwd'].'"';?>>
  									<?=$skin->op->write_icon?>
								</div>
							</form>
						</div>
						<!--// 코멘트 작성 종료 //-->
					</li>
					<!--// 코멘트를 불러오기 위한 반복문 종료 //-->
					</ul>
				</td>
				<!--//코멘트 출력//-->
			</tr>
		</tbody>
	</table>
</div>
<!--// 본문 종료 //-->
<@--END:PIC--@>
<!--// 그림 불러오기 위한 반복문 종료 //-->

<div class="span8 offset2 pagination text-center">
  <ul>
	<?php echo $paging;?>
  </ul>
</div>

<!--// 하단 공지사항 시작 //-->
<?php if($bbs->notice->foot){?>
<div class="span8 offset2">
	<div class="alert alert-info user_notice_border_color user_notice_border_type user_notice_background_color">
		<?php echo nl2br($bbs->notice->foot);?>
	</div>
</div>
<?}?>
<!--// 상단 공지사항 끝 //-->

<!--// 스킨 디자인 종료 //-->



<!--// 리플 폼 시작 //-->
<div id="replyForm" class="text-right">
	<p><a href="javascript:;" class="replyClose"><img alt="리플창 닫기" src="skin/default/images/close.png"></a></p>
	<form class="form-horizontal margin0 cmtForm" method="POST" action="./lib/comment.submit.php" >
		<div class="controls" style="margin-bottom: 3px">
			<input type="text" class="input-small" name="memo" id="memo" placeholder="memo" >
			<input type="text" class="input-small" name="hpurl" id="hpurl" placeholder="homepage" >
		</div>
		<div class="controls-group">
			<textarea rows="2" class="span7" id="comment" name="comment" style="resize:none;" ></textarea>
		</div>
		<div class="controls-group">
		<p>
			<label class="checkbox inline">
			<input type="checkbox" id="op['secret']" name="op[secret]" value="secret">secret
			</label>
			<label class="checkbox inline">
			<input type="checkbox" id="op['more']" name="op[more]" value="more">more
			</label>
			<label class="checkbox inline">
			<input type="checkbox" id="op['dice']" name="op[dice]" value="dice">dice
			</label>
			<label class="checkbox inline">
			<input type="checkbox" id="op['cookie']" name="op[cookie]" value="cookie">cookie
			</label>
		</p>
		</div>
		<div class="controls-group">
			<input type="hidden" name="idx" id="idx" value="">
			<input type="hidden" name="mode" id="mode" value="">
			<input type="hidden" name="cid" value="<?=$cid?>">
  			<input type="hidden" id="no" name="no" value="">
  			<input type="hidden" id="pic_no" name="pic_no" value="">
    		<input type="hidden" id="depth" name="depth" value="">
    		<input type="hidden" name="op[user_id]" value="<?=$member->user_id?>">
  			<input type="text" class="input-mini" name="name" id="name" placeholder="name" <?php if($_COOKIE['nickname']) echo 'value="'.$_COOKIE['nickname'].'"';?>>
  			<input type="password" class="input-mini" name="passwd" id="passwd" placeholder="password" <?php if($_COOKIE['passwd']) echo 'value="'.$_COOKIE['passwd'].'"';?>>
  			<?=$skin->op->write_icon?>
		</div>
	</form>
</div>
<!--// 리플 폼 종료 //-->

<!--// 리플 삭제 폼 //-->
<div id="delForm" class="text-right" style="display:none;">
<form class="cmtdelForm form-inline margin0" action="#">
<input type="hidden" name="cid" value="<?=$cid?>">
<input type="hidden" id="pic_no" name="pic_no" value="">
<input type="hidden" id="idx" name="idx" value="">
<input type="hidden" id="member" name="member" value="<?=session_id()?>">
<input type="password" class="input-mini" name="passwd" id="passwd" placeholder="passwd">
<input type="image" src="skin/default/images/del.png" />
<a href="javascript:;" class="delClose"><img src="skin/default/images/close.png"></a>
</form>
</div>
<!--// 리플 삭제 폼 //-->

<!--// 그림 삭제 폼 //-->
<div id="delpicForm" class="text-center marginTop5" style="width:250px;height:35px;line-height:34px;display:none;position:absolute;background-color:#ffffff;border:1px solid #999999;">
<form class="picdelForm form-inline margin0" action="#">
<input type="hidden" name="cid" value="<?=$cid?>">
<input type="hidden" id="idx" name="idx" value="">
<input type="password" class="input-mini" name="passwd" id="passwd" placeholder="passwd">
<input type="image" src="skin/default/images/del.png" /> 
<a href="javascript:;" class="picdelClose"><img src="skin/default/images/close.png"></a>
</form>
</div>
<!--// 그림 삭제 폼 //-->

<!--// 이어 그리기 폼 //-->
<div id="continuepicForm" class="text-center marginTop5" style="width:250px;height:35px;line-height:34px;display:none;position:absolute;background-color:#ffffff;border:1px solid #999999;">
<form class="piccontinueForm form-inline margin0" method="POST" action="./index.php?cAct=picContinue&cid=<?=$cid?>">
<input type="hidden" name="cid" value="<?=$cid?>">
<input type="hidden" id="chi_idx" name="chi_idx" value="">
<input type="password" class="input-mini" name="continue_passwd" id="continue_passwd" placeholder="passwd">
<input type="image" src="skin/default/images/continue.png" /> 
<a href="javascript:;" class="continueClose"><img src="skin/default/images/close.png"></a>
</form>
</div>
<!--// 이어 그리기 폼 //-->

<!--// 옵션 폼 //-->
<div id="opFormDiv" class="text-center marginTop5" style="width:250px;height:35px;line-height:34px;display:none;position:absolute;background-color:#ffffff;border:1px solid #999999;">
<form class="opForm form-inline margin0" method="POST" action="#">
<input type="hidden" name="cid" value="<?=$cid?>">
<input type="hidden" id="idx" name="idx" value="">
<select id="op" name="op[pic]" class="input-small">
<option selected="selected" >옵션</option>
<option value="more">접기</option>
<option value="secret">비밀</option>
<option value="moresecret">접기+비밀</option>
</select>
<input type="hidden" name="op[user_id]" value="<?=$member->user_id?>">
<input type="image" src="skin/default/images/ok.png" /> 
<a href="javascript:;" class="opClose"><img src="skin/default/images/close.png"></a>
</form>
</div>
<!--// 옵션 폼 //-->

<!--// 수정 폼 //-->
<div id="modifyForm" class="text-right" style="display:none;">
<p><a href="javascript:;" class="modifyClose"><img alt="수정 창 닫기" src="skin/default/images/close.png" style="margin-bottom:2px;"></a></p>
<div>
<form method="POST" class="margin0 cmtmodifyForm" action="./lib/comment.modify.ok.php">
<div class="controls">
<input type="text" class="input-small" name="memo" id="memo" placeholder="memo" >
<input type="text" class="input-small" name="hpurl" id="hpurl" placeholder="homepage" >
</div>
<div class="controls-group">
<textarea rows="2" class="span7" id="comment" name="comment" style="resize:none;margin-bottom:3px;" ></textarea>
</div>
<div class="controls-group">
<p>
<label class="checkbox inline">
<input type="checkbox" id="op[secret]" name="op[secret]" value="secret" >secret
</label>
<label class="checkbox inline">
<input type="checkbox" id="op[more]" name="op[more]" value="more" >more
</label>
</p>
</div>
<div class="controls-group">
<input type="hidden" name="mode" id="mode" value="modify">
<input type="hidden" name="cid" value="<?=$cid?>">
<input type="hidden" name="op[dice]" value="">
<input type="hidden" id="idx" name="idx" value="">
<input type="hidden" id="page" name="page" value="<?=$page?>">
<input type="hidden" name="op[user_id]" value="<?=$member->user_id?>">
<input type="text" class="input-mini" name="name" id="name" placeholder="name" value="">
<input type="password" class="input-mini" name="passwd" id="passwd" placeholder="password" required>
<?=$skin->op->write_icon?>
</div>
</form>
</div>
</div>
<!--// 수정 폼 //-->





<!--// 그림 원본 박스용 스크립트 //-->
<script>
jQuery(document).ready(function($) {
	$('.lightbox_trigger').click(function(e) {
		e.preventDefault();
		var image_href = $(this).attr("href");
		var scrolltop = $(window).scrollTop();
		if ($('#lightbox').length > 0) { 
			$('#lightbox').css('top',scrolltop);	
			$('#content').html('<a href="javascript:close();"><img src="' + image_href +'" /></a>');
			$('#lightbox').show();
		}
		else { 
			var lightbox = 
			'<div id="lightbox">' +
				'<div id="content">' + 
					'<a href="javascript:close();"><img src="' + image_href +'" /></a>' +
				'</div>' +	
			'</div>';
			$('body').append(lightbox);
			$('#lightbox').css('top',scrolltop);
			var win_h = $(document).height();
			$('#lightbox').height(win_h);
		}
	});
});
jQuery(window).resize(function(){
	var win_h = $(document).height();
	$('#lightbox').height(win_h);
});
function close() { 
		$('#lightbox').hide();
	}
</script>
<!--// 그림 원본 박스용 스크립트 //-->