<!DOCTYPE html>

<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Serveur Web du Raspberry Pi Projet : La Sourcel</title>
    <link rel="stylesheet" href="style.css">
    <script src="script.js" async></script>
</head>
	
<body>
  <div class="wrapper">
    <div class="img-area">
      <div class="inner-area">
        <img src="https://toiledefond.net/wp-content/uploads/2013/12/xd3io-R-Pi_Logo.png" alt="">
      </div> 
    </div>
    <div class="icon arrow"><i class="fas fa-arrow-left"></i></div>
    <div class="icon dots"><i class="fas fa-ellipsis-v"></i></div>
    <div class="name">Serveur Web Raspberry</div>
    <div class="about">Projet : La Source</div>
    <div class="buttons" id="div_buttons">
      <input id="nop" type="button" value="Fermé"/>
      <input id="yup" type="button" value="Ouvert"/>
    </div>
    <div class="social-share">
      <div class="row">
        <span>Réception Base De Donnée : </span>
      </div>
      <div class="co BDD">
        <span>---</span>
      </div>
    </div>
			  <p id='p1'></p>
		<h1>- -  KIT M5 Afficheur  - -</h1>
		<h3>172.17.50.92 </h3>
		<form action="172.17.50.92" method="get">
			<div
      	<button id='b1'>Envoyer</button>
			</div>
		</form>
			  <button id='b2'>Annuler</button>
        <button id='b3'>Afficher l'heure</button>

			</body>
		<table>
		<tr>
			<th>Appareil</th>
			<th>Os</th>
			<th>Naviguateur</th>
		</tr>
		<tr>
			<td><?= UserInfo::get_device();?></td>
			<td><?= UserInfo::get_os();?></td>
			<td><?= UserInfo::get_browser();?></td>
		</tr>
	</table>
  	<?php
			if (!empty($_SERVER['HTTP_CLIENT_IP'])) 
			{
				echo "Votre ip : ";
    		echo $ip = $_SERVER['HTTP_CLIENT_IP'];
			} 
			else if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) 
			{
				echo "Votre ip : ";
    		echo $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
			} 
			else 
			{
				echo "Votre ip : ";
    		echo $ip = $_SERVER['REMOTE_ADDR'];
}

$rsltPing = exec("ping 172.17.50.92", $output);
while (list(,$val) = each($output)) :
   $val = str_replace('ÿ','',$val);
   $val = str_replace('ˆ','ê',$val);
   $val = str_replace('‡','ç',$val);
   $val = str_replace('“','ô',$val);
   $val = str_replace('R,p','Rép',$val);
    echo "<pre>$val</pre>";
endwhile ;


class UserInfo
	{
	private static function get_user_agent() 
		{
			return  $_SERVER['HTTP_USER_AGENT'];
		}

	public static function get_os() {

		$user_agent = self::get_user_agent();
		$os_platform    =   "Unknown OS Platform";
		$os_array       =   array(
			'/windows nt 11/i'			=>	'Windows 11',
			'/windows nt 10/i'     	=>  'Windows 10/11',
			'/windows nt 6.3/i'     =>  'Windows 8.1',
			'/windows nt 6.2/i'     =>  'Windows 8',
			'/windows nt 6.1/i'     =>  'Windows 7',
			'/windows nt 6.0/i'     =>  'Windows Vista',
			'/windows nt 5.2/i'     =>  'Windows Server 2003/XP x64',
			'/windows nt 5.1/i'     =>  'Windows XP',
			'/windows xp/i'         =>  'Windows XP',
			'/windows nt 5.0/i'     =>  'Windows 2000',
			'/windows me/i'         =>  'Windows ME',
			'/win98/i'              =>  'Windows 98',
			'/win95/i'              =>  'Windows 95',
			'/win16/i'              =>  'Windows 3.11',
			'/macintosh|mac os x/i' =>  'Mac OS X',
			'/mac_powerpc/i'        =>  'Mac OS 9',
			'/linux/i'              =>  'Linux',
			'/ubuntu/i'             =>  'Ubuntu',
			'/iphone/i'             =>  'iPhone',
			'/ipod/i'               =>  'iPod',
			'/ipad/i'               =>  'iPad',
			'/android/i'            =>  'Android',
			'/blackberry/i'         =>  'BlackBerry',
			'/webos/i'              =>  'Mobile'
		);

		foreach ($os_array as $regex => $value) {
			if (preg_match($regex, $user_agent)) {
				$os_platform    =   $value;
			}
		}   
		return $os_platform;
	}

	public static function  get_browser() {

		$user_agent= self::get_user_agent();

		$browser        =   "Unknown Browser";

		$browser_array  =   array(
			'/msie/i'       =>  'Internet Explorer',
			'/Trident/i'    =>  'Internet Explorer',
			'/firefox/i'    =>  'Firefox',
			'/safari/i'     =>  'Safari',
			'/chrome/i'     =>  'Chrome',
			'/edge/i'       =>  'Edge',
			'/opera/i'      =>  'Opera',
			'/netscape/i'   =>  'Netscape',
			'/maxthon/i'    =>  'Maxthon',
			'/konqueror/i'  =>  'Konqueror',
			'/ubrowser/i'   =>  'UC Browser',
			'/mobile/i'     =>  'Handheld Browser'
		);

		foreach ($browser_array as $regex => $value) {

			if (preg_match($regex, $user_agent)) {
				$browser    =   $value;
			}

		}
		return $browser;
	}

	public static function  get_device(){

		$tablet_browser = 0;
		$mobile_browser = 0;

		if (preg_match('/(tablet|ipad|playbook)|(android(?!.*(mobi|opera mini)))/i', strtolower($_SERVER['HTTP_USER_AGENT']))) {
			$tablet_browser++;
		}

		if (preg_match('/(up.browser|up.link|mmp|symbian|smartphone|midp|wap|phone|android|iemobile)/i', strtolower($_SERVER['HTTP_USER_AGENT']))) {
			$mobile_browser++;
		}
		$mobile_ua = strtolower(substr(self::get_user_agent(), 0, 4));
		$mobile_agents = array(
			'w3c ','acs-','alav','alca','amoi','audi','avan','benq','bird','blac',
			'blaz','brew','cell','cldc','cmd-','dang','doco','eric','hipt','inno',
			'ipaq','java','jigs','kddi','keji','leno','lg-c','lg-d','lg-g','lge-',
			'maui','maxo','midp','mits','mmef','mobi','mot-','moto','mwbp','nec-',
			'newt','noki','palm','pana','pant','phil','play','port','prox',
			'qwap','sage','sams','sany','sch-','sec-','send','seri','sgh-','shar',
			'sie-','siem','smal','smar','sony','sph-','symb','t-mo','teli','tim-',
			'tosh','tsm-','upg1','upsi','vk-v','voda','wap-','wapa','wapi','wapp',
			'wapr','webc','winw','winw','xda ','xda-');

		if (in_array($mobile_ua,$mobile_agents)) {
			$mobile_browser++;
		}

		if (strpos(strtolower(self::get_user_agent()),'opera mini') > 0) {
			$mobile_browser++;

			if (preg_match('/(tablet|ipad|playbook)|(android(?!.*mobile))/i', $stock_ua)) {
				$tablet_browser++;
			}
		}

		if ($tablet_browser > 0) {
	           // do something for tablet devices
			return 'Tablette';
		}
		else if ($mobile_browser > 0) {
	           // do something for mobile devices
			return 'Mobile';
		}
		else {
	           // do something for everything else
			return 'Ordinateur';
		}   
	}

}
?>