<?php 
	$key=isset($_POST['key'])?(int)$_POST['key']:'0';
	$now=time();
	$bnow=$now-1800;
	$anow=$now+1800;
	if($bnow<$key&&$key<$anow){
		$imgurl=bgimageurl("./image/");//末尾必须加“/”,相对目录
		$info=file_get_contents($imgurl);
		//header("Content-type: image/jpg");
		echo base64_encode($info);
	}else{
		return false;
	}
	

	function bgimageurl($dir){
		$dirarray=scandir($dir);//末尾必须加“/”,相对目录
		$imgarray=array();
		foreach ($dirarray as $key => $value) {
			$imgurl=$dir.$value;
			$jugg=getimagesize($imgurl);
			if($jugg){
				$imgarray[]=$imgurl;
			}
		}
		$count=count($imgarray)-1;
		$mt=mt_rand(0,$count);
		return $imgarray[$mt];
	}
