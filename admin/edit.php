<?php
include "header.php";

if(isset($_GET['place_id'])) {
  $place_id = htmlspecialchars($_GET['place_id']); 
} else if(isset($_POST['place_id'])) {
  $place_id = htmlspecialchars($_POST['place_id']);
} else {
  exit; 
}

// get place info
$place_query = mysql_query("SELECT * FROM places WHERE id='$place_id' LIMIT 1");
if(mysql_num_rows($place_query) != 1) { exit; }
$place = mysql_fetch_assoc($place_query);


// do place edit if requested
if($task == "doedit") {
  $name = str_replace( "'", "\\'", str_replace( "\\", "\\\\", $_POST['name'] ) );
  $type = $_POST['type'];
  $address = str_replace( "'", "\\'", str_replace( "\\", "\\\\", $_POST['address'] ) );
  $uri = $_POST['uri'];
  $description = str_replace( "'", "\\'", str_replace( "\\", "\\\\", $_POST['description'] ) );
  $employer_name = str_replace( "'", "\\'", str_replace( "\\", "\\\\", $_POST['employer_name'] ) );
  $position = str_replace( "'", "\\'", str_replace( "\\", "\\\\", $_POST['position'] ) );
  $student_work = str_replace( "'", "\\'", str_replace( "\\", "\\\\", $_POST['student_work'] ) );
  $phone_number = str_replace( "'", "\\'", str_replace( "\\", "\\\\", $_POST['phone_number'] ) );
  $qq_number = str_replace( "'", "\\'", str_replace( "\\", "\\\\", $_POST['qq_number'] ) );
  $wechat_number = str_replace( "'", "\\'", str_replace( "\\", "\\\\", $_POST['wechat_number'] ) );
  $email = $_POST['email'];
  $lat = (float) $_POST['lat'];
  $lng = (float) $_POST['lng'];
  
  mysql_query("UPDATE places SET name='$name', type='$type', address='$address', uri='$uri', lat='$lat', lng='$lng', description='$description', employer_name='$employer_name', student_work='$student_work', phone_number='$phone_number', qq_number='$qq_number', wechat_number='$wechat_number', position='$position', email='$email' WHERE id='$place_id' LIMIT 1") or die(mysql_error());
  
  // geocode
  //$hide_geocode_output = true;
  //include "../geocode.php";
  header("Location: index.php?view=$view&search=$search&p=$p");
  exit;
}

?>



<? echo $admin_head; ?>

<form id="admin" class="form-horizontal" action="edit.php" method="post" role="form">
  <h1>
    编辑
  </h1>
  <fieldset>
    <div class="form-group">
      <label class="col-sm-2 control-label">姓名</label>
      <div class="col-sm-4">
        <input type="text" class="input form-control" name="name" value="<?=$place[name]?>">
      </div>
      <label class="col-sm-2 control-label">入学年份</label>
      <div class="col-sm-4">
      <select class="input form-control" name="type">
          <option<? if($place[type] == "2010") {?> selected="selected"<? } ?>>2010</option>
          <option<? if($place[type] == "2009") {?> selected="selected"<? } ?>>2009</option>
          <option<? if($place[type] == "2008") {?> selected="selected"<? } ?>>2008</option>
          <option<? if($place[type] == "2007") {?> selected="selected"<? } ?>>2007</option>
          <option<? if($place[type] == "2006") {?> selected="selected"<? } ?>>2006</option>
          <option<? if($place[type] == "2005") {?> selected="selected"<? } ?>>2005</option>
          <option<? if($place[type] == "2004") {?> selected="selected"<? } ?>>2004</option>
          <option<? if($place[type] == "2003") {?> selected="selected"<? } ?>>2003</option>
          <option<? if($place[type] == "2002") {?> selected="selected"<? } ?>>2002</option>
          <option<? if($place[type] == "2001") {?> selected="selected"<? } ?>>2001</option>
          <option<? if($place[type] == "2000") {?> selected="selected"<? } ?>>2000</option>
          <option<? if($place[type] == "other") {?> selected="selected"<? } ?>>other</option>
      </select>
      </div>
    </div>
    <div class="form-group">
      <label class="col-sm-2 control-label">工作单位</label>
      <div class="col-sm-4">
        <input type="text" class="input form-control" name="employer_name" value="<?=$place[employer_name]?>">
      </div>
      <label class="col-sm-2 control-label">职 务</label>
      <div class="col-sm-4">
        <input type="text" class="input form-control" name="position" value="<?=$place[position]?>">
      </div>
    </div>
    <div class="form-group">
      <label class="col-sm-2  control-label" for="add_student_work">曾参与社会工作</label>
      <div class="col-sm-10">
        <input type="text" class="input form-control" name="student_work" value="<?=$place[student_work]?>" id="student_work">
      </div>
    </div>
    <div class="form-group">
      <label class="col-sm-2 control-label">邮箱地址</label>
      <div class="col-sm-4">
        <input type="email" class="input form-control" name="email" value="<?=$place[email]?>">
      </div>
      <label class="col-sm-2 control-label">联系电话</label>
      <div class="col-sm-4">
        <input type="text" class="input form-control" name="phone_number" value="<?=$place[phone_number]?>">
      </div>
    </div>
    <div class="form-group">
      <label class="col-sm-2  control-label" for="add_address">地址</label>
      <div class="col-sm-10">
        <input type="text" class="input form-control" name="address" value="<?=$place[address]?>" id="add_address">
      </div>
    </div>
    <div class="form-group">
      <label class="col-sm-2 control-label">QQ号码</label>
      <div class="col-sm-4">
        <input type="text" class="input form-control" name="qq_number" value="<?=$place[qq_number]?>">
      </div>
      <label class="col-sm-2 control-label">微信号</label>
      <div class="col-sm-4">
        <input type="text" class="input form-control" name="wechat_number" value="<?=$place[wechat_number]?>">
      </div>
    </div>
    <div class="form-group">
      <label class="col-sm-2 control-label" for="add_uri">个人主页url</label>
      <div class="col-sm-10">
        <input type="url" class="input form-control" name="uri" value="<?=$place[uri]?>" id="add_uri">
      </div>
    </div>
    <div class="form-group">
      <label class="col-sm-2 control-label" for="add_description">个人描述</label>
      <div class="col-sm-10">
        <textarea class="input form-control" name="description" id="add_description"><?=$place[description]?></textarea>
      </div>
    </div>
    <div class="form-group">
      <label class="col-sm-2 control-label" for="add_address">标记位置</label>
      <div class="col-sm-10">
        <input type="hidden" name="lat" id="mylat" value="<?=$place[lat]?>"/>
        <input type="hidden" name="lng" id="mylng" value="<?=$place[lng]?>"/>
        <div id="map" style="width:80%;height:300px;"></div>
       	<script>
          var map = new google.maps.Map( document.getElementById('map'), {
            zoom: 17,
            center: new google.maps.LatLng( <?=$place[lat]?>, <?=$place[lng]?> ),
            mapTypeId: google.maps.MapTypeId.ROADMAP,
            streetViewControl: false,
            mapTypeControl: false
          });
          var marker = new google.maps.Marker({
            position: new google.maps.LatLng( <?=$place[lat]?>, <?=$place[lng]?> ),
            map: map,
            draggable: true
          });
          google.maps.event.addListener(marker, 'dragend', function(e){
            document.getElementById('mylat').value = e.latLng.lat().toFixed(6);
            document.getElementById('mylng').value = e.latLng.lng().toFixed(6);
          });
        </script>
      </div>
    </div>    
    <div class="form-actions">
      <button type="submit" class="btn btn-primary">保存修改</button>
      <input type="hidden" name="task" value="doedit" />
      <input type="hidden" name="place_id" value="<?=$place[id]?>" />
      <input type="hidden" name="view" value="<?=$view?>" />
      <input type="hidden" name="search" value="<?=$search?>" />
      <input type="hidden" name="p" value="<?=$p?>" />
      <a href="index.php" class="btn" style="float: right;">取消</a>
    </div>
  </fieldset>
</form>

<? echo $admin_foot; ?>
