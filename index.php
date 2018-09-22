<?php
/*
    方倍工作室 http://www.cnblogs.com/txw1958/
    CopyRight 2013 www.doucube.com  All Rights Reserved
*/

define("TOKEN", "31901130a"); //定义常量
$wechatObj = new wechatCallbackapiTest();//实例化类
if (isset($_GET['echostr'])) { //如果随机字符串存在
    $wechatObj->valid(); //执行wechatObj类下的valid函数
}else{
    $wechatObj->responseMsg(); //如果未得到随机字符串，执行wechatObj类下的responseMsg函数
}

class wechatCallbackapiTest  //定义类
{
    public function valid()  //定义valid函数
    {
        $echoStr = $_GET["echostr"];  //定义变量$echoStr 为获得的字符串
        if($this->checkSignature()){  //调用当前类里的chekSignature函数
            echo $echoStr;  //输出echoStr的值
            exit;
        }
    }

    private function checkSignature()  //定义checkSignature函数
    {
        $signature = $_GET["signature"];  //定义变量signature为获得的signature
        $timestamp = $_GET["timestamp"];  //获取时间戳
        $nonce = $_GET["nonce"];          //获取随机数

        $token = TOKEN; //获得token
        $tmpArr = array($token, $timestamp, $nonce);//定义数组tmpArr包含token值、时间戳、随机数
        sort($tmpArr, SORT_STRING);  //对数组进行升序排列
        $tmpStr = implode( $tmpArr );  //将数组组合为字符串
        $tmpStr = sha1( $tmpStr );  //计算字符串的sha1散列

        if( $tmpStr == $signature ){ //如果计算的散列与获取的加密签名一致
            return true;  //返回真
        }else{
            return false;  //不一致，返回假
        }
    }


public function responseMsg()
 {
 //get post data, May be due to the different environments
 $postStr = $GLOBALS["HTTP_RAW_POST_DATA"];

 //extract post data
 if (!empty($postStr)){
 /* libxml_disable_entity_loader is to prevent XML eXternal Entity Injection,
  the best way is to check the validity of xml by yourself */
 libxml_disable_entity_loader(true);
  $postObj = simplexml_load_string($postStr, 'SimpleXMLElement', LIBXML_NOCDATA);
 $fromUsername = $postObj->FromUserName;
 $toUsername = $postObj->ToUserName;
 $keyword = trim($postObj->Content);
 $time = time();
 $msgType = $postObj->MsgType;//消息类型
 $event = $postObj->Event;//时间类型，subscribe（订阅）、unsubscribe（取消订阅）
 $textTpl = "<xml>
  <ToUserName><![CDATA[%s]]></ToUserName>
  <FromUserName><![CDATA[%s]]></FromUserName>
  <CreateTime>%s</CreateTime>
  <MsgType><![CDATA[%s]]></MsgType>
  <Content><![CDATA[%s]]></Content>
  <FuncFlag>0</FuncFlag>
  </xml>";

 switch($msgType){
  case "event":
  if($event=="subscribe"){
  $contentStr = "欢迎来到Eink,这是一个免费下载图书的平台。在公众号中回复书名、作者或关键词，系统会自动推送下载资源。<a href='http://mp.weixin.qq.com/s/z451KXi0AprskMppk48Ihg'>Eink使用指南戳这里</a>，尚未收录的资源我们会及时补充，可在一周之内再次搜索.\n没有阅读器的朋友<a href='http://120.79.67.250/booklink/lalala.php'>点击下载掌阅</a>\n\nEink每周会推送一次图书，你一定会邂逅最爱。\n\n读书让我们自由!";
  }
  break;
  case "text":
  if($keyword=="看书")
{
$contentStr = "书名:追风筝的人.epub<a href= 'http://120.79.67.250/booklink/yiIbyq.php'>点击下载</a>\n
红楼梦<a href='http://120.79.67.250/booklink/iqUnmm.php'>点击下载</a>\n
请以你的名字呼唤我中文<a href='http://120.79.67.250/booklink/rMfaui.php'>点击下载</a>\n
书名:三体Ⅰ-Ⅲ.epub<a href= 'http://120.79.67.250/booklink/NzAjmu.php'>点击下载</a>\n
书名:理想国-(古希腊)柏拉图.epub<a href= 'http://120.79.67.250/booklink/E3mAJr.php' >点击下载</a>\n
书名:傲慢与偏见-（英）奥斯丁.epub<a href= 'http://120.79.67.250/booklink/zuu67b.php' >点击下载</a>\n
书名:《人间失格[精品]》.epub<a href= 'http://120.79.67.250/booklink/Yf6Fve.php' >点击下载</a>\n";
}
else if($keyword=="精选东野圭吾")
{
$contentStr = "书名:嫌疑犯X的献身.epub<a  href= 'http://120.79.67.250/booklink/3QFvuy.php' >点击下载</a>\n
书名:[日]东野圭吾《白夜行》.epub<a  href= 'http://120.79.67.250/booklink/YbUVne.php' >点击下载</a>\n
书名:[日]东野圭吾《恶意》.epub<a  href= 'http://120.79.67.250/booklink/RrMN7b.php' >点击下载</a>\n
书名:《秘密》东野圭吾.epub<a  href= 'http://120.79.67.250/booklink/3QjUfq.php' >点击下载</a>\n
书名:[日]东野圭吾《圣女的救济》.epub<a  href= 'http://120.79.67.250/booklink/jMFJV3.php' >点击下载</a>\n
书名:[日]东野圭吾《放学后》.epub<a  href= 'http://120.79.67.250/booklink/z2eimy.php' >点击下载</a>\n
书名:解忧杂货铺东野圭吾.epub<a  href= 'http://120.79.67.250/booklink/buY3Mv.php' >点击下载</a>\n";
}
else if($keyword=="推理小说")
{
$contentStr="书名:名家名译：福尔摩斯探案集（上中下）-柯南·道尔.epub<a  href= 'http://120.79.67.250/booklink/aIfYFv.php' >点击下载</a>\n
书名:东方快车谋杀案.epub<a  href= 'http://120.79.67.250/booklink/meiE7j.php' >点击下载</a>\n
书名:无人生还.epub<a  href= 'http://120.79.67.250/booklink/yIrya2.php' >点击下载</a>\n
书名:《时间的习俗》作者 (日)松本清张，曹逸冰 译, 丛书 松本清张作品·读客版.epub<a  href= 'http://120.79.67.250/booklink/aQJBJz.php' >点击下载</a>\n
书名:罗马帽子之谜.埃勒里·奎因.6寸版.pdf<a  href= 'http://120.79.67.250/booklink/Un2Ub2.php' >点击下载</a>\n
书名:三口棺材.epub<a  href= 'http://120.79.67.250/booklink/mAJVz2.php' >点击下载</a>\n
书名:杰佛瑞迪弗--人骨拼图.epub<a  href= 'http://120.79.67.250/booklink/aqyi6b.php' >点击下载</a>\n";
}
else if($keyword=="童话镇")
{
$contentStr="书名:安徒生童话.epub<a  href= 'http://120.79.67.250/booklink/rueqE3.php' >点击下载</a>\n
书名:小王子 (插图版).epub<a  href= 'http://120.79.67.250/booklink/AzuMNn.php' >点击下载</a>\n
书名:王尔德童话.epub<a  href= 'http://120.79.67.250/booklink/a22AVz.php' >点击下载</a>\n
书名:草房子.epub<a  href= 'http://120.79.67.250/booklink/NJZFZb.php' >点击下载</a>\n
书名:遥远的野玫瑰村.epub<a  href= 'http://120.79.67.250/booklink/7bYvMr.php' >点击下载</a>\n
书名:窗边的小豆豆.epub<a  href= 'http://120.79.67.250/booklink/InmEbu.php' >点击下载</a>\n
书名:《动物农场 (译文经典)》作者 乔治·奥威尔(George Orwell) (作者), 荣如德 (译者).epub<a  href= 'http://120.79.67.250/booklink/Fjiyey.php' >点击下载</a>\n";
}
else if($keyword=="传说")
{
$contentStr="书名:《山海经》山海经彩图版 冯国超译注.epub<a  href='http://120.79.67.250/booklink/NbA7ja.php'>点击下载</a>\n
书名:绣像版古典名著丛书：西游记-(明)吴承恩.epub<a  href='http://120.79.67.250/booklink/je2Any.php'>点击下载</a>\n
书名:《三国演义(上下) 》作者 罗贯中 中亚,带插图.epub<a  href='http://120.79.67.250/booklink/N7r6Fz.php'>点击下载</a>\n
书名:绣像版古典名著丛书：水浒传-(明)施耐庵.epub<a  href='http://120.79.67.250/booklink/VRvqai.php'>点击下载</a>\n
书名:易经.epub<a  href='http://120.79.67.250/booklink/fqAbUb.php'>点击下载</a>\n
书名:绣像版古典名著丛书：红楼梦-(清)曹雪芹,(清)高鄂.epub<a  href='http://120.79.67.250/booklink/iqUnmm.php'>点击下载</a>";

}
else if($keyword=="哈8")
{
$contentStr="书名:哈利波特8:哈利波特与被诅咒的孩子(英文原版)<a  href= 'http://120.79.67.250/booklink/3imQRn.php' >点击下载</a>
书名:哈利·波特与被诅咒的孩子.mobi<a  href= 'http://120.79.67.250/booklink/ai2MNz.php'>点击下载</a> ";
}
else
{
  $mysqli = new MySQLi("localhost","root","FA199831b606");
            $mysqli->select_db("book");
            $mysqli->query("set names utf8");
            $sql = "SELECT * FROM `bookdatas` WHERE `bookname` LIKE '%$keyword%'";
            $res = $mysqli->query($sql) or die($mysqli->error);
            if($res)
            {
                   $number=0;
                   $row1=$res->fetch_row();
                   $number = 0;
                   if(!$row1)
                   {
                         $contentStr="抱歉,我们暂时没有收录这本图书!";
                         $insert="INSERT INTO `newbookname`( `bookname`) VALUES ('".$keyword."')";
                         $result=$mysqli->query($insert) or die ($mysqli->erorr);
                   }
                   else
                   {
                         $contentStr=$contentStr.="书名:";
                         $contentStr=$contentStr.=$row1[0];
                         $contentStr=$contentStr.="<a href= 'http://120.79.67.250/booklink/";

                         $long_url=$row1[1];

                         $key = 'flyer0126';
                         $base32 = "abcdefghijklmnopqrstuvwxyz0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ";

                         $hex = hash('md5', $long_url.$key);
                         $hexLen = strlen($hex);
                         $subHexLen = $hexLen / 8;


                         $subHex = substr($hex, $i*8, 8);
                         $idx = 0x3FFFFFFF & (1 * ('0x' . $subHex));
                         $out = '';
                         for( $j = 0; $j < 6; $j++ )
                         {
                              $val = 0x0000003D & $idx;
                              $out .= $base32[$val];
                              $idx = $idx >> 5;
                         }


                         $filename="booklink/";
                         $filename.=$out.".php";
                         $myfile = fopen($filename, "w") or die("Unable to open file!");
                         $txt="<?php \n header('Location: http://p4uy0yhy4.bkt.clouddn.com/";
                         $txt.=$row1[1];
                         $txt.="'); \n ?>";
                         $txt1="\xEF\xBB\xBF".$txt;
                         fwrite($myfile, $txt1);
                         fclose($myfile);
                         $out.=".php";




                         $contentStr=$contentStr.=$out;
                         $contentStr=$contentStr.="'";
                         $contentStr=$contentStr.=" >点击下载</a>";
                         $contentStr=$contentStr.="\n";
                         $number++;
                   }
                   while($row = $res->fetch_row())
                   {
                         if($number>9)
                         {
                             break;
                         }
                         $number++;
                         $contentStr=$contentStr.="书名:";
                         $contentStr=$contentStr.=$row[0];

                         $contentStr=$contentStr.="<a href= 'http://120.79.67.250/booklink/";

                         $long_url=$row[1];

                         $key = 'flyer0126';
                         $base32 = "abcdefghijklmnopqrstuvwxyz0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ";

                         // 利用md5算法方式生成hash值
                         $hex = hash('md5', $long_url.$key);
                         $hexLen = strlen($hex);
                         $subHexLen = $hexLen / 8;


                         // 将这32位分成四份，每一份8个字符，将其视作16进制串与0x3fffffff(30位1)与操作
                         $subHex = substr($hex, $i*8, 8);
                         $idx = 0x3FFFFFFF & (1 * ('0x' . $subHex));

                         // 这30位分成6段, 每5个一组，算出其整数值，然后映射到我们准备的62个字符
                         $out = '';
                         for( $j = 0; $j < 6; $j++ )
                         {
                              $val = 0x0000003D & $idx;
                              $out .= $base32[$val];
                              $idx = $idx >> 5;
                         }


                         $filename="booklink/";
                         $filename.=$out.".php";
                         $myfile = fopen($filename, "w") or die("Unable to open file!");
                         $txt="<?php \n header('Location: http://p4uy0yhy4.bkt.clouddn.com/";
                         $txt.=$row[1];
                         $txt.="'); \n ?>";
                         $txt1="\xEF\xBB\xBF".$txt;
                         fwrite($myfile, $txt1);
                         fclose($myfile);
                         $out.=".php";
                         $contentStr=$contentStr.=$out;
                         $contentStr=$contentStr.="'";
                         $contentStr=$contentStr.=" >点击下载</a>";
                         $contentStr=$contentStr.="\n";
                   }
             }
             $res->free();
             $mysqli->close();
 }
}
 $msgType = "text";
 $resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
 echo $resultStr;
 }else {
 echo "";
 exit;
 }
 }










}
?>
