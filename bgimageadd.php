<?php 
	$key=isset($_POST['key'])?(int)$_POST['key']:'0';
	$now=time();
	$bnow=$now-43200;
	$anow=$now+43200;
	$pg='/domian\.org/';
	if(preg_match($pg,$_SERVER['HTTP_REFERER'])){
		if($bnow<$key&&$key<$anow){
			$imgurl=bgimageurl("./image/");//末尾必须加“/”,相对目录
			$dir64=base64($imgurl);
			$imga=getimagesize($imgurl);
			$mime=$imga['mime'];
			$info=file_get_contents($dir64);
			echo "data:".$mime.";base64,".$info;
		}else{
			return false;
		}
	}
	function bgimageurl($dir){
		$dirarray=scandir($dir);//末尾必须加“/”,相对目录
		$count=count($dirarray)-1;
		$mt=mt_rand(0,$count);
		$filedir=$dir.$dirarray[$mt];
		if(getimagesize($filedir)){
			return $filedir;
		}else{
			bgimageurl($dir)
		}
	}
	function base64($dir){
		if(!is_file($dir.".64")){
			$info=file_get_contents($dir);
			$bs=base64_encode($info);
			file_put_contents($dir.".64", $bs);
		}
		return $dir.".64";
	}
