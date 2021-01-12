
			<?php
			error_reporting(0);
			$link = mysqli_connect("127.0.0.1", "root", "asom12#$", "smartcity");
			$sql = "SELECT * FROM poplayer WHERE see='Y'";
			$result = mysqli_query($link, $sql);
			$i = 1;

			while($img = mysqli_fetch_array($result)){

				if($_COOKIE['ncookie'.$img['idx']] != 'done'){
					$img_length = 1;
					$imgsrc = '/files/'.$img['img'];
					if($img['pop_position'] == 'lefttop'){
						echo"<div class='poplayer poplayer".$img['idx']."' style='top:".$img['m_height']."px;left:".$img['m_width']."px'>";
						echo"<a target='_blank' href='".$img['link_value']."'><img src=".$imgsrc." style='width:".$img['i_width']."px; height:".$img['i_height']."px;' alt=''></a>";
						echo'<div class="close_box">';
						echo'<a class="close1'.$img['idx'].'" href="#">[닫기]</a>';
						echo'<a class="24h'.$img['idx'].'" href="#">하루동안 보지 않기</a>';
						echo'</div>';
						echo"</div>";
					}else if($img['pop_position'] == 'leftbot'){
						echo"<div class='poplayer poplayer".$img['idx']."' style='bottom:".$img['m_height']."px;left:".$img['m_width']."px'>";
						echo"<a target='_blank' href='".$img['link_value']."'><img src=".$imgsrc." style='width:".$img['i_width']."px; height:".$img['i_height']."px;' alt=''></a>";
						echo'<div class="close_box">';
						echo'<a class="close1'.$img['idx'].'" href="#">[닫기]</a>';
						echo'<a class="24h'.$img['idx'].'" href="#">하루동안 보지 않기</a>';
						echo'</div>';
						echo"</div>";
					}else if($img['pop_position'] == 'righttop'){
						echo"<div class='poplayer poplayer".$img['idx']."' style='top:".$img['m_height']."px;right:".$img['m_width']."px'>";
						echo"<a target='_blank' href='".$img['link_value']."'><img src=".$imgsrc." style='width:".$img['i_width']."px; height:".$img['i_height']."px;' alt=''></a>";
						echo'<div class="close_box">';
						echo'<a class="close1'.$img['idx'].'" href="#">[닫기]</a>';
						echo'<a class="24h'.$img['idx'].'" href="#">하루동안 보지 않기</a>';
						echo'</div>';
						echo"</div>";
					}else if($img['pop_position'] == 'rightbot'){
						echo"<div class='poplayer poplayer".$img['idx']."' style='bottom:".$img['m_height']."px;right:".$img['m_width']."px'>";
						echo"<a target='_blank' href='".$img['link_value']."'><img src=".$imgsrc." style='width:".$img['i_width']."px; height:".$img['i_height']."px;' alt=''></a>";
						echo'<div class="close_box">';
						echo'<a class="close1'.$img['idx'].'" href="#">[닫기]</a>';
						echo'<a class="24h'.$img['idx'].'" href="#">하루동안 보지 않기</a>';
						echo'</div>';
						echo"</div>";
					}
				}
		?>
				<script type="text/javascript">

					$(function(){
						var cookiedata = document.cookie;
						function setCookie(name, value, expirehours) {
							var todayDate = new Date();
							todayDate.setHours(todayDate.getHours() + expirehours);
							document.cookie = name + "=" + escape(value) + ";path=/;expires=" + todayDate.toGMTString() + ";"
						}
					
						function Pop_close() {
							var par = $(this).parents('div.poplayer<?=$img['idx']?>');
							$(par).hide();
						}
						$('.close1<?=$img["idx"]?>').click(function(){
							var par = $(this).parents('div.poplayer<?=$img['idx']?>');
							$(par).hide();
						});
						function todaycloseWin<?=$img['idx']?>() {
								setCookie("ncookie<?=$img['idx']?>", "done", 24);
								$('.poplayer<?=$img['idx']?>').hide();
							}
						$('.24h<?=$img['idx']?>').click(function(){
							todaycloseWin<?=$img['idx']?>();
						});
						//팝업모바일
						var popbox = $('.poplayer<?=$img["idx"]?>');
						var popimg = $('.poplayer<?=$img["idx"]?> img');
					
						if($(document).width()<769){
							$(popimg).css({width:'100%',height:'auto'});
							$(popbox).css({width:'calc(100% - 20px)',top:'60px',left:'10px'});
						}
					});

				</script>

		<?php
				$i++;
			}

			if($_COOKIE['ncookie'] != 'done'){
		?>
<!-- 		<div class="poplayer poplayer1" style="top:100px;left:1000px">
				<img src="/img/pop.png" style="width:400px; height:600px;" alt="" usemap="#pop_map01">
			<div class="close_box">
				<a class="close1" href="#">[닫기]</a>
				<a class="24h" href="#">하루동안 보지 않기</a>
			</div>
		</div> -->
		<?php
			}
		?>
		<script type="text/javascript">

			$(function(){
				var cookiedata = document.cookie;
				function setCookie(name, value, expirehours) {
					var todayDate = new Date();
					todayDate.setHours(todayDate.getHours() + expirehours);
					document.cookie = name + "=" + escape(value) + ";path=/;expires=" + todayDate.toGMTString() + ";"
				}
			
				function Pop_close() {
					var par = $(this).parents('div.poplayer1');
					$(par).hide();
				}
				$('.close1').click(function(){
					var par = $(this).parents('div.poplayer1');
					$(par).hide();
				});
				function todaycloseWin() {
						setCookie("ncookie", "done", 24);
						$('.poplayer1').hide();
					}
				$('.24h').click(function(){
					todaycloseWin();
				});
				//팝업모바일
				var popbox = $('div.poplayer1');
				var popimg = $('div.poplayer1 img');
			
				if($(document).width()<769){
					$(popimg).css({width:'100%',height:'auto'});
					$(popbox).css({width:'calc(100% - 20px)',top:'60px',left:'10px'});
				}
			});

        </script>
        <style>
		.poplayer{position:fixed;z-index:9999;}
		.poplayer img{display:block;}
		.poplayer .close_box a{float:right;text-align:right;padding:10px 5px;color:#000;}
		.poplayer .close_box{background-color:#dfdfdf;height:41px;}
		</style>