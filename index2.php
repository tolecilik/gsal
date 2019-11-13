
    <!-- start: Meta -->
    <meta charset="utf-8" />
    <title>Amazon Email Valid Checker | Xombonkcrew</title>

    <!--header start-->
    <nav class="navbar navbar-default navbar-fixed-top">
    <div class="container-fluid container-fluid-spacious"> 
    <a class="navbar-brand navbar-brand-emphasized" href="http://bit.ly/2vgacd5">
    <i class="fa fa-code"></i> MahkotaDecode</a>
    </div>
      </nav>
    <!--header end-->

<br/>
    <!-- page content -->  
<div class="container-fluid container-fluid-spacious">
<div class="row">
<div class="col-lg-8" style="margin: 0px auto;float:none;">   
<div class="panel panel-primary">
<div class="panel-heading">  
<font color="white"><i class="fa fa-user"></i> Amazon Email Valid Checker</font> 		
</div>  
<div class="panel-body"> 
<div class="row" style="max-width: 100%;">
<div class="col-xs-8">
<div class="form-group">
<label for="mailpass" class="control-label">List E-mail|Password:</label>
<div>
<textarea name="mailpass" id="mailpass" class="form-control" rows="7" placeholder="admin@x0mbonkcrew.com|password"></textarea>
</div>
</div>
</div>
<div class="col-xs-4">
<div class="form-group">
<label for="socks" class="control-label">Socks 5 (<a href="http://vipsocks24.net/" target="_blank">Get Socks</a>):</label>
<div>
<textarea name="socks" id="socks" class="form-control" rows="7" placeholder="127.0.0.1:8080"><?php include"sok.php"; ?></textarea>
</div>
</div>
</div>
</div>

<button type="button" class="btn btn-primary" id="submit">Start</button> 
<button type="button" class="btn btn-danger" id="stop">Stop</button>&nbsp;
Delim: <input name="delim" id="delim" style="text-align: center;display:inline;width: 40px;margin-right: 8px;padding: 4px;" value="|" type="text" class="form-control">
Timeout: <input name="Timeout" id="Timeout" style="text-align: center;display:inline;width: 40px;margin-right: 8px;padding: 4px;" value="10" type="text" class="form-control">
<img id="loading">
<span id="checkStatus" style="color:limegreen"></span>
</form>
</div>
</div>
</div>
<div id="result" style="display: none;">
<div class="col-lg-8" style="margin: 0px auto;float:none;">
<br/>
<div class="" role="tabpanel" data-example-id="togglable-tabs">
<ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
<li role="presentation" class="active"><a href="#tab_content1" id="home-tab" role="tab" data-toggle="tab" aria-expanded="true">LIVE Result <span class="label label-info" id="acc_live_count" style="color:white">0</span></a>
</li>
<li role="presentation" class=""><a href="#tab_content2" role="tab" id="profile-tab" data-toggle="tab" aria-expanded="false">DIE Result <span class="label label-danger" id="acc_die_count" style="color:white">0</span></a>
</li>
<li role="presentation" class=""><a href="#tab_content3" role="tab" id="profile-tab2" data-toggle="tab" aria-expanded="false">WRONG Result <span class="label label-danger" id="wrong_count" style="color:white">0</span></a>
</li>
</ul>
<div id="myTabContent" class="tab-content">
<div role="tabpanel" class="tab-pane fade active in" id="tab_content1" aria-labelledby="home-tab">
 <p>
<span class="pull-right">
<button type="button" onclick="selectText('acc_live')" class="btn btn-xs btn-info">Select All</button>
<button type="button" id="live_kontol" class="btn btn-xs btn-danger">Hide/Unhide</button>
</span>
<div class="panel-body">
<hr/>
<div id="acc_live"></div>
</div>
</p>
</div>
<div role="tabpanel" class="tab-pane fade" id="tab_content2" aria-labelledby="profile-tab">
<p>
<span class="pull-right">
<button type="button" id="die_kontol" class="btn btn-xs btn-danger">Hide/Unhide</button>
</span>
 <div class="panel-body">
 <hr/>
<div id="acc_die"></div>
</div>
 </p>
</div>
<div role="tabpanel" class="tab-pane fade" id="tab_content3" aria-labelledby="profile-tab">
<p>
<span class="pull-right"><button type="button" id="wrong_kontol" class="btn btn-xs btn-danger">Hide/Unhide</button>
</span>
<div class="panel-body">
<hr/>
<div id="wrong"></div>
</div>
</p>
</div>
</div>
</div>
    <!-- /page content --> 
</div>
</div>  
    <script type="text/javascript" src="check.js></script> 
