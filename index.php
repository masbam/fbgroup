<?php

require "facebook/facebook.php";

// Facebook

	function link_it($text)  
	{  
	    $text= preg_replace("/(^|[\n ])([\w]*?)((ht|f)tp(s)?:\/\/[\w]+[^ \,\"\n\r\t<]*)/is", "$1$2<a href=\"$3\" >$3</a>", $text);  
	    $text= preg_replace("/(^|[\n ])([\w]*?)((www|ftp)\.[^ \,\"\t\n\r<]*)/is", "$1$2<a href=\"http://$3\" >$3</a>", $text);  
	    $text= preg_replace("/(^|[\n ])([a-z0-9&\-_\.]+?)@([\w\-]+\.([\w\-\.]+)+)/i", "$1<a href=\"mailto:$2@$3\">$2@$3</a>", $text);  
	    return($text);  
	}


	$appId = '547353862285214'; //appid from facebook
	$secret = 'bac13b33288dc0fc6f5665284029a478'; //secrete from facebook
	$app_id = $appId;
	$app_secret = $secret;
	$groupId = '1841081392797911'; //facebook groupid
	$my_url = 'http://www.ichahouse.com/';
	
	$facebook = new Facebook(array(
	'appId' => $appId,
	'secret' => $secret,
	'cookie' => true,
	));


// Meno text grazie - 

function troncatext($string, $limit, $break=".", $pad="...") {
if(strlen($string) <= $limit) return $string;
	if(false !== ($breakpoint = strpos($string, $break, $limit))) {
		if($breakpoint < strlen($string) - 1) {
			$string = substr($string, 0, $breakpoint) . $pad;
		}
	} return $string;
}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta charset="utf-8">
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<title>DevC Surabaya, Facebook Group</title>
	<meta name="description" content="">
	<meta name="author" content="">

  <meta property="og:url"           content="https://www.ichahouse.com/fbgroup/index.php" />
  <meta property="og:type"          content="website" />
  <meta property="og:title"         content="DevC Surabaya, Facebook Group" />
  <meta property="og:description"   content="Sample web API" />
  <meta property="og:image"         content="https://www.ichahouse.com/fbgroup/img/logo.png" />
	
	
	<link rel="stylesheet" href="style.css" type="text/css" media="screen, projection" />
	 

<script>
  window.fbAsyncInit = function() {
    FB.init({
      appId      : '547353862285214',
      cookie     : true,
      xfbml      : true,
      version    : 'v2.8'
    });
    FB.AppEvents.logPageView();   
  };

  (function(d, s, id){
     var js, fjs = d.getElementsByTagName(s)[0];
     if (d.getElementById(id)) {return;}
     js = d.createElement(s); js.id = id;
     js.src = "//connect.facebook.net/en_US/sdk.js";
     fjs.parentNode.insertBefore(js, fjs);
   }(document, 'script', 'facebook-jssdk'));
</script>

<div id="fb-root"></div>
      <script>
        window.fbAsyncInit = function() {
          FB.init({
            appId      : '<?php echo $facebook->getAppId(); ?>',
            status     : true, 
            cookie     : true,
            xfbml      : true
          });
		/*FB.login({
        scope: 'email,user_groups,user_likes,user_online_presence,user_website,user_about_me,offline_access,user_location,read_stream,publish_stream',
      });
        FB.Event.subscribe('auth.login', function() {
          window.location.reload();
        });*/
        (function(d){
           var js, id = 'facebook-jssdk'; if (d.getElementById(id)) {return;}
           js = d.createElement('script'); js.id = id; js.async = true;
           js.src = "//connect.facebook.net/en_US/all.js";
           d.getElementsByTagName('head')[0].appendChild(js);
         }(document));
};
      </script>

<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.10&appId=547353862285214";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>




</head>

<body>

<div id="wrapper">

<?php
// Get User ID / Session
$user = $facebook->getUser();
$loginUrl = $facebook->getLoginUrl();
$logoutUrl = $facebook->getLogoutUrl();

if ($user) {
  try {
    $user_profile = $facebook->api('/me');
  } catch (FacebookApiException $e) {
    error_log($e);
    $user = null;
  }
}
?>


	<?php if ($cookie || $user) { ?>
	<a href="<?php echo $logoutUrl; ?>">Logout</a>
<?php  } else { ?>
      <div class="fb-login-button" data-show-faces="true" data-max-rows="1" perms="email,user_groups,user_likes,user_online_presence,user_website,user_about_me,offline_access,user_location,read_stream,publish_stream"></div>
    <?php } ?>

	<div id="container">
		<div id="main">

			<div class="social">   
			<a href="https://www.facebook.com/groups/DevCSurabaya/" target="_blank"><img src="img/facebook.png" alt="DevC Surabaya" /></a>
			</div>

	<?php



		function ShowDate($date) // $date -- time(); value
		{
		$stf = 0;
		$cur_time = time();
		$diff = $cur_time - $date;
		$phrase = array('second','minute','hour','day','week','month','year','decade');
		$length = array(1,60,3600,86400,604800,2630880,31570560,315705600);
		for($i = sizeof($length)-1; ($i >= 0)&&(($no = $diff/$length[$i])<= 1); $i--); if($i < 0) $i = 0; $_time = $cur_time -($diff%$length[$i]);
		$no = floor($no); if($no <> 1) $phrase[$i] .='s'; $value=sprintf("%d %s ",$no,$phrase[$i]);
		if(($stf == 1)&&($i >= 1)&&(($cur_tm-$_time) > 0)) $value .= time_ago($_time);
		return $value.' ago';
		} 

		function ShowReplyDate($reply_date) // $date -- time(); value
		{
		$stf = 0;
		$cur_time = time();
		$diff = $cur_time - $reply_date;
		$phrase = array('second','minute','hour','day','week','month','year','decade');
		$length = array(1,60,3600,86400,604800,2630880,31570560,315705600);
		for($i = sizeof($length)-1; ($i >= 0)&&(($no = $diff/$length[$i])<= 1); $i--); if($i < 0) $i = 0; $_time = $cur_time -($diff%$length[$i]);
		$no = floor($no); if($no <> 1) $phrase[$i] .='s'; $value=sprintf("%d %s ",$no,$phrase[$i]);
		if(($stf == 1)&&($i >= 1)&&(($cur_tm-$_time) > 0)) $reply_value .= time_ago($_time);
		return $reply_value.' ago';
		} 

	print "<div id=\"header\">";
	


	$group_stuff = $facebook->api('/'.$groupId.'/', array('fields'=>'icon,owner,name,description'));
	print "<img class=\"rounded logo\" src=\"img/logo.png\"/>";
	print "<h1><a href=\"/\">".$group_stuff['name']."</a></h1>";
	print "<h4>".$group_stuff['description']."</h4>";
	//print "<h2>Group DevC Surabaya. this is sample for capture Developer Circles from Facebook. </h2>";
    ?>
	<br>
	
    <iframe src="https://www.facebook.com/plugins/follow.php?href=https%3A%2F%2Fwww.facebook.com%2Fbamsbams&width=450&height=80&layout=standard&size=small&show_faces=true&appId=547353862285214" width="450" height="80" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowTransparency="true"></iframe>
<?php
	print "<hr class=\"clearfix\" />";
	print "</div><!-- End #header-->"; 



	if($_POST['text'])
	{

	$facebook->api('/'.$groupId.'/feed', 'post', array('message'=>''.$_POST['text'].''));
	echo 'Posting!';

	}
	else
	{
	?>

	<div class="post posting_post" style="display:none;">
		<?php if ($user): ?><img class="rounded avatar avatar-main" src="https://graph.facebook.com/<?php echo $user; ?>/picture"><?php endif; ?>
		<div class="message">
		<form action="<?php echo basename($_SERVER['PHP_SELF']) ?>" method="post" enctype="multipart/form-data">
		<textarea name="text"></textarea>
		<input name="posting" value="posting" type="submit" class="button" />
		</form>
		</div> <!-- end .message -->
	</div>

	<?php
	}


	$response = $facebook->api('/'.$groupId.'/feed', array('limit' => 10, 'fields'=>'id,from,message,created_time,likes,comments,picture,link,description,updated_time')); 

	
	foreach ($response['data'] as $value) {
	$id = explode('_',$value['id']);
	print "
	<div class=\"post\"><a name='".$id[1]."'></a><img class=\"rounded avatar avatar-main\" src=\"http://graph.facebook.com/".$value['from']['id']."/picture\" /><div class=\"message\"><h4><a href=\"http://www.facebook.com/profile.php?id=".$value['from']['id']."\">".$value['from']['name']."</a> Wrote:</h4>";

	print "<p>".link_it($value['message'])."</p>";
	
	
	$date = strtotime($value['created_time']);

	print "<small>Updated ".ShowDate($date)."</small>"; //

	print "</div> <!-- end .message -->";
	
	print "<div class=\"message-box like-box\"><img src=\"img/like.png\" />";

	if ($value['like']) {
		print "<span>".$value['like']['counts']."</span>\nlikes"; 
		}
	else {
		print "<span>0</span>\nlikes";

	}
	print "</div> <!-- end .message-box -->";

	print "<div class=\"message-box comment-box\"><img src=\"img/comments.png\" />";
	if ($value['comments']['count']) {
		print "<span>".$value['comments']['count']."</span>\ncomment";
		}
	else {
		print "<span>0</span>\ncomment";

	}
	print "</div> <!-- end .message-box -->";

	$id = explode('_',$value['id']);
	print "<div class=\"message-box view-box\"><img src=\"img/fbicon.png\" /><a href=\"https://www.facebook.com/groups/DevCSurabaya/permalink/".$id[1]."/\" target=\"_blank\">To Facebook Group</a></div><!-- end .message-box -->";
	
	print "<hr class=\"clearfix\" />";
	
	// attacheds
	if ($value['link']) {
		print "<div class='attached'><a href='".$value['link']."'>";
		if ($value['picture']){
			print "<img class=\"rounded\" src='".$value['picture']."' />";
			}
			if ($value['description']) {
		print $value['description']."<br />";
			}
		print "<small>".$value['link']."</small></a><hr class=\"clearfix\" /></div>";


		$rssfeed = '<?xml version="1.0" encoding="UTF-8"?>';
		$rssfeed .= '<rss version="2.0">';
		$rssfeed .= '<channel>';
		$rssfeed .= '<title>Title of Feed</title>';
		$rssfeed .= '<link>Source Website</link>';
		$rssfeed .= '<description>Feed Description</description>';
		$rssfeed .= '<language>lang code (eg.it-it)</language>';
		$rssfeed .= '<copyright>Copyright (C) 2017</copyright>';

		foreach ($response['data'] as $value) {
		
		$textlungo = $value['message'];
		$texttroncato = troncatext($textlungo, 300);
		$datapub = strtotime($value['created_time']);
		$datagg = strtotime($value['updated_time']);
		$id = explode('_',$value['id']);

		$rssfeed .= '<item>';
        $rssfeed .= '<title>'.$value['from']['name'].' - until '.date('d M Y H:i',$datagg) .'</title>';
        $rssfeed .= '<description>'.$texttroncato.'</description>';
        //$rssfeed .= '<link>' . $value['link'] . '</link>';
		$rssfeed .= '<link>http://www.ichahouse.com/#'.$id[1].'</link>';
        $rssfeed .= '<pubDate>' . date('D, m F Y H:i:s T',$datapub) . '</pubDate>';
        $rssfeed .= '</item>';
    }
 
    $rssfeed .= '</channel>';
    $rssfeed .= '</rss>';
 
    //echo $rssfeed;

	$handle = fopen("rss.xml", "c");
	fwrite($handle, $rssfeed);
	fclose($handle);

}
	
		// List likes n comment
	?>
	
		<div class="indent">
	
	<?php		//Likes
		if ($value['likes']) {
		print "<div class=\"inner-block\"><h4 class=\"inner-left\">".$value['likes']['count']." likes</h4>";
		print "<ul class=\"blocco_likes\">";


		$id = explode('_',$value['id']);
		$likes = $facebook->api('/'.$groupId.'_'.$id[1].'/likes', array('fields'=>'id,name'));
		foreach ($likes['data'] as $like) {
		print "<li><a href='http://www.facebook.com/profile.php?id=".$like['id']."'><img class=\"rounded\" src='http://graph.facebook.com/".$like['id']."/picture' title='".$like['name']."' /></a></li>";
		} 
		print "</ul>";

		?>
		</div>
		<hr />
	<?php }	

		//Comment

		if ($value['comments']['count']) {
		print "<div class=\"inner-block\">";
			print "<h4 class=\"inner-left\">".$value['comments']['count']." comment</h4>";

		print "<button class=\"btn-slide button\">View Comment</button>";
		print "<ul class=\"Comment\">";
	


		//$comments = $facebook->api('/'.$value['id'].'/comments');// array('limit' => 10));
		$comments = $facebook->api('/'.$groupId.'_'.$id[1].'/comments', array('limit' => 10, 'fields'=>'id,from,message,created_time'));
		
		foreach ($comments['data'] as $comment) {
		print "<li><img class=\"avatar rounded\" src='http://graph.facebook.com/".$comment['from']['id']."/picture'>";
		print "<div><h4><a href='http://www.facebook.com/profile.php?id".$comment['from']['id']."'>".$comment['from']['name']."</a> answered:</h4>";
		print "<p>".$comment['message']."</p>";

		// format the dates of the or X with time ago 
		$date = strtotime($comment['created_time']);
		print "<small>".ShowDate($date)."</small></div></li>";

		} ?>
		
		<?php
			print "<li><img class=\"avatar\" src=\"img/fbicon.png\" /><div><h4><a href='https://www.facebook.com/groups/DevCSurabaya".$id[1]."/' target='_blank'>to Facebook</a></h4></div></li>";
		?>
		</ul>
		
		</div>
<?php } // fine IF comments > 0
	$id = explode('_',$value['id']);
	 ?>
	
				<?php 
				// Try to answer directly from the post - 

				if($_POST['text_comment'])
				{

				$facebook->api('/'.$groupId.'/feed/'.$id[1].'', 'post', array('message'=>''.$_POST['text_comment'].''));
				echo 'Comment Publish!';

				}
				else
				{
				?>

				<div class="posting_comment" style="display:none;">
					<?php if ($user): ?><img class="rounded avatar avatar-main" src="https://graph.facebook.com/<?php echo $user; ?>/picture"><?php endif; ?>
					<div class="message">
					<form action="<?php echo basename($_SERVER['PHP_SELF']) ?>" method="post" enctype="multipart/form-data">
					<textarea name="text_comment"></textarea>
					<input name="posting" value="posting" type="submit" class="button" />
					</form>
					</div> <!-- end .message -->
				</div>

				<?php } ?>
				
				</div> <!-- end of .indent -->

				<hr class="clearfix" />
			</div> <!-- end of .post -->
			<?php }	?>


		</div> <!-- end of main -->
   
		<div class="footer">
			<p>Facebook DevC Surabaya <a href="https://www.facebook.com/groups/DevCSurabaya" target="_blank">  GROUP</p>
		</div>

	</div> <!-- end of container-->

	<!-- Side bar -->
	<div class="sidebar_dx">
		

	<!-- Feedback -  -->
		<div id="feedback">
			<div class="section">
			   <h6><span class="arrow up"></span>Feedback!</h6>
				<p class="message"></p>
				<textarea></textarea>
				<a class="submit" href="">Post</a>
			</div>
		</div> 

	</div> <!-- end of sidebar_dx -->

</div> <!-- end of wrapper-->

<!-- Tutti i JS in fondo grazie! -  -->
<script type="text/javascript" src="http://code.jquery.com/jquery-1.4.4.js"></script>
<script type="text/javascript" src="script/feedback.js"></script>

<!-- jquery Comment -->
<script>
$(document).ready(function(){

	$(".btn-slide").click(function(){
		if (!($(this).next().is(':visible'))){
			$(this).next().slideDown();
			$(this).text('Comment');
		} else {
			$(this).next().slideUp();
			$(this).text('Comment');
		}
	});

});
</script>

</body>
</html>
