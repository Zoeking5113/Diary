<?php
namespace Home\Controller;
use Think\Controller;
//get请求
	function metget($url, $param=array()){
		if(!is_array($param)){
			return false;
		}
		$p='';
		foreach($param as $key => $value){
			$p=$p.$key.'='.$value.'&';
		}
		if(preg_match('/\?[\d\D]+/',$url)){//matched ?c
			$p='&'.$p;
		}else if(preg_match('/\?$/',$url)){//matched ?$
			$p=$p;
		}else{
			$p='?'.$p;
		}
		$p=preg_replace('/&$/','',$p);
		$url=$url.$p;
		//echo $url;
		$httph =curl_init($url);
		curl_setopt($httph, CURLOPT_SSL_VERIFYPEER, 0);
		curl_setopt($httph, CURLOPT_SSL_VERIFYHOST, 1);
		curl_setopt($httph,CURLOPT_RETURNTRANSFER,1);
		curl_setopt($httph, CURLOPT_USERAGENT, "Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.0)");
		
		curl_setopt($httph, CURLOPT_RETURNTRANSFER,1);
		//curl_setopt($httph, CURLOPT_HEADER,1);
		$rst=curl_exec($httph);
		curl_close($httph);
		return $rst;
	}
	//post请求
	function metpost($url, $param=array()){
		if(!is_array($param)){
			return false;
		}
		$httph =curl_init($url);
		curl_setopt($httph, CURLOPT_SSL_VERIFYPEER, 0);
		curl_setopt($httph, CURLOPT_SSL_VERIFYHOST, 1);
		curl_setopt($httph,CURLOPT_RETURNTRANSFER,1);
		curl_setopt($httph, CURLOPT_USERAGENT, "Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.0)");
		curl_setopt($httph, CURLOPT_POST, 1);//设置为POST方式 
		curl_setopt($httph, CURLOPT_POSTFIELDS, $param);
		curl_setopt($httph, CURLOPT_RETURNTRANSFER,1);
		//curl_setopt($httph, CURLOPT_HEADER,1);
		$rst=curl_exec($httph);
		curl_close($httph);
		return $rst;
	}
class IndexController extends Controller {
    public function index(){
        $this->display('/index');
    }
    public function insert(){
        if(IS_POST){
            $uid=$_POST["uid"];
			$content=$_POST["content"];
			$name=$_POST["name"];
			$avatarUrl=$_POST["avatar"];
            if($uid&&$content){
                $Diary=M("Diary");
                $data["uid"]=$uid;
                $data["content"]= $content;
				$data["addtime"]=time();
				$data["name"]=$name;
				$data["avatar"]=$avatarUrl;
                $result=$Diary->add($data);
                if($result){
                    echo "add success";
                }
            }else{
                echo "empty";
            }
        }else{
            echo "illegal request";
        }
      
    }
   public function onLogin(){
         if(IS_POST){
             $code=$_POST["code"];
             $url='https://api.weixin.qq.com/sns/jscode2session';
             $array=array('appid'=>'wxc307dc7512bd2c08',
                'secret'=>'3041d325a285c4ae30f2a57dcbc1b338',
                'js_code'=>$code,
                'grant_type'=>'authorization_code'
             );
             $res=metget($url,$array);
			 echo $res;
         }else{
            echo "illegal request";
        }

   }
   public function read(){
	   if(IS_GET){
			$Diary=M("Diary");
			$res=$Diary->select();
			for($i=0;$i<count($res);$i++){
				$res[$i]["addtime"]=date("Y-m-d H:i:s",$res[$i]["addtime"]);
			}
			//$res["addtime"]=date("Y-m-d H:i:s",$res["addtime"]);
			$result=$this->ajaxReturn($res);
	   }else{
			echo "illegal request";
	   }
   }
}