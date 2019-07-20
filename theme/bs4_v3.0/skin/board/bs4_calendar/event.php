<?php
include_once('./_common.php');
include_once(G5_THEME_PATH.'/head.php');
?>

<style>
.content {
    padding: 30px 0;
    max-width: 900px;
}

/***
Pricing table
***/
.pricing {
  position: relative;
  margin-bottom: 15px;
  border: 3px solid #eee;
}

.pricing-active {
  border: 3px solid #36d7ac;
  margin-top: -10px;
  box-shadow: 7px 7px rgba(54, 215, 172, 0.2);
}

.pricing:hover {
  border: 3px solid #36d7ac;
}

.pricing:hover h4 {
  color: #36d7ac;
}

.pricing-head {
  text-align: center;
}

.pricing-head h3,
.pricing-head h4 {
  margin: 0;
  line-height: normal;
}

.pricing-head h3 span,
.pricing-head h4 span {
  display: block;
  margin-top: 5px;
  font-size: 14px;
  font-style: italic;
}

.pricing-head h3 {
  font-weight: 300;
  color: #fafafa;
  padding: 12px 0;
  font-size: 27px;
  background: #36d7ac;
  border-bottom: solid 1px #41b91c;
}

.pricing-head h4 {
  color: #bac39f;
  padding: 5px 0;
  font-size: 54px;
  font-weight: 300;
  background: #fbfef2;
  border-bottom: solid 1px #f5f9e7;
}

.pricing-head-active h4 {
  color: #36d7ac;
}

.pricing-head h4 i {
  top: -8px;
  font-size: 28px;
  font-style: normal;
  position: relative;
}

.pricing-head h4 span {
  top: -10px;
  font-size: 14px;
  font-style: normal;
  position: relative;
}

/*Pricing Content*/
.pricing-content li {
  color: #666;
  font-size: 14px;
  padding: 7px 15px;
  border-bottom: solid 1px #f5f9e7;
}

/*Pricing Footer*/
.pricing-footer {
  color: #777;
  font-size: 13px;
  line-height: 17px;
  text-align: center;
  padding: 0 20px 19px;
}

/*Priceing Active*/
.price-active,
.pricing:hover {
  z-index: 9;
}

.price-active h4 {
  color: #36d7ac;
}

.no-space-pricing .pricing:hover {
  transition: box-shadow 0.2s ease-in-out;
}

.no-space-pricing .price-active .pricing-head h4,
.no-space-pricing .pricing:hover .pricing-head h4 {
  color: #36d7ac;
  padding: 15px 0;
  font-size: 80px;
  transition: color 0.5s ease-in-out;
}

.yellow-crusta.btn {
  color: #FFFFFF;
  background-color: #f3c200;
}
.yellow-crusta.btn:hover,
.yellow-crusta.btn:focus,
.yellow-crusta.btn:active,
.yellow-crusta.btn.active {
    color: #FFFFFF;
    background-color: #cfa500;
}
/* count down */
#countdown{
	max-width: 465px;
	height: 160px;
	text-align: center;
	background: #222;
	background-image: -webkit-linear-gradient(top, #222, #333, #333, #222);
	background-image:    -moz-linear-gradient(top, #222, #333, #333, #222);
	background-image:     -ms-linear-gradient(top, #222, #333, #333, #222);
	background-image:      -o-linear-gradient(top, #222, #333, #333, #222);
	border: 1px solid #111;
	border-radius: 5px;
	box-shadow: 0px 0px 8px rgba(0, 0, 0, 0.6);
	margin: 20px auto;
	padding: 24px 0;
	position: relative;
  top: 0; bottom: 0; left: 0; right: 0;
}

#countdown:before{
	content:"";
	width: 8px;
	height: 65px;
	background: #444;
	background-image: -webkit-linear-gradient(top, #555, #444, #444, #555);
	background-image:    -moz-linear-gradient(top, #555, #444, #444, #555);
	background-image:     -ms-linear-gradient(top, #555, #444, #444, #555);
	background-image:      -o-linear-gradient(top, #555, #444, #444, #555);
	border: 1px solid #111;
	border-top-left-radius: 6px;
	border-bottom-left-radius: 6px;
	display: block;
	position: absolute;
	top: 48px; left: -10px;
}

#countdown:after{
	content:"";
	width: 8px;
	height: 65px;
	background: #444;
	background-image: -webkit-linear-gradient(top, #555, #444, #444, #555);
	background-image:    -moz-linear-gradient(top, #555, #444, #444, #555);
	background-image:     -ms-linear-gradient(top, #555, #444, #444, #555);
	background-image:      -o-linear-gradient(top, #555, #444, #444, #555);
	border: 1px solid #111;
	border-top-right-radius: 6px;
	border-bottom-right-radius: 6px;
	display: block;
	position: absolute;
	top: 48px; right: -10px;
}

#countdown #tiles{
	position: relative;
	z-index: 1;
}

#countdown #tiles > span{
	width: 23%;
	max-width: 92px;
	font: bold 48px 'Droid Sans', Arial, sans-serif;
	text-align: center;
	color: #111;
	background-color: #ddd;
	background-image: -webkit-linear-gradient(top, #bbb, #eee);
	background-image:    -moz-linear-gradient(top, #bbb, #eee);
	background-image:     -ms-linear-gradient(top, #bbb, #eee);
	background-image:      -o-linear-gradient(top, #bbb, #eee);
	border-top: 1px solid #fff;
	border-radius: 3px;
	box-shadow: 0px 0px 12px rgba(0, 0, 0, 0.7);
	margin: 0 7px;
	padding: 18px 0;
	display: inline-block;
	position: relative;
}

@media only screen and (max-width: 480px) {
  #countdown{
    max-width: 360px;
  }

  #countdown #tiles > span{
    max-width: 62px;
	  font: bold 26px 'Droid Sans', Arial, sans-serif;
  }
  #countdown .labels li{
	width: 25%;
  }
}

#countdown #tiles > span:before{
	content:"";
	width: 100%;
	height: 13px;
	background: #111;
	display: block;
	padding: 0 3px;
	position: absolute;
	top: 41%; left: -3px;
	z-index: -1;
}

#countdown #tiles > span:after{
	content:"";
	width: 100%;
	height: 1px;
	background: #eee;
	border-top: 1px solid #333;
	display: block;
	position: absolute;
	top: 48%; left: 0;
}

#countdown .labels{
	width: 100%;
	height: 25px;
	text-align: center;
	position: absolute;
	bottom: 8px;
}

#countdown .labels li{
	width: 23%;
	font: bold 15px 'Droid Sans', Arial, sans-serif;
	color: #f47321;
	text-shadow: 1px 1px 0px #000;
	text-align: center;
	text-transform: uppercase;
	display: inline-block;
}

</style>

<!-- 실전홈페이지 소개 -->
<div class="container content">
	<div class="row">
		<!-- Pricing -->
		<div class="col-md-12">
<?php
  $end_event = "2018-04-14"; //이벤트 마지막 날짜... 하단 js(현날짜+1)에도 반영해야...
  //날짜별 가격결정
  if(G5_TIME_YMD == "2018-04-14") {
      $event_price = "";
  } else if(G5_TIME_YMD == "2018-04-14"){
    $event_price = "0";
  } else if(G5_TIME_YMD == "2018-04-14"){
    $event_price = "0";
  } else if(G5_TIME_YMD == "2018-04-14"){
    $event_price = "0";
  }

  if(G5_TIME_YMD < $end_event){?>

			<div class="pricing pricing-active hover-effect">
				<div class="pricing-head pricing-head-active">
					<h3>태형이의 돌잔치에 초대 합니다.<span>
					</span>
					</h3>
					<h4><?php echo $event_price;?><i>2018. 4. 14</i></h4>
				</div>
        <div class="pricing-head pricing-head-active">
        <!-- countdown-->
          <div id="countdown">
            <div id='tiles'></div>
            <div class="labels">
              <li>일</li>
              <li>시</li>
              <li>분</li>
              <li>초</li>
            </div>
          </div>
          <!-- /countdown-->
				</div>
				<ul class="pricing-content list-unstyled">
					<li>
                    <i class="fa fa-gift"></i>&nbsp;2018. 4. 14 토요일 오후 6시 30분<br>
					거제 하나로컨벤션 들국화홀<!-- 내용 -->
					</li>
					<!--
					<li>
					<i class="fa fa-gift"></i>&nbsp; 테스트
					</li>
					-->
				</ul>
				<div class="pricing-footer">
					<p>
						&nbsp;<br>
					&nbsp;
					</p>
					<a href="/#" class="btn yellow-crusta">
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					</a>
				</div>
			</div>
  <?php
  } else {
    ?>
			<div class="pricing pricing-active hover-effect">
				<div class="pricing-head pricing-head-active">
					<h3>알림</h3>
				</div>
                <div class="pricing-head pricing-head-active" style="min-height:400px;padding:150px 50px;">
        현재는 알림이 없습니다.
				</div>
			</div>
   <?php
  }
?>
		</div>
		<!--//End Pricing -->
	</div>
</div>


<script>
var target_date = new Date("04/15/2018"); // 이벤트 마지막날 + 1 (월/일/년)
// var target_date = new Date().getTime() + (1000*3600*48); // set the countdown date

var days, hours, minutes, seconds; // variables for time units

var countdown = document.getElementById("tiles"); // get tag element

getCountdown();

setInterval(function () { getCountdown(); }, 1000);

function getCountdown(){

	// find the amount of "seconds" between now and target
	var current_date = new Date().getTime();
	var seconds_left = (target_date - current_date) / 1000;

	days = pad( parseInt(seconds_left / 86400) );
	seconds_left = seconds_left % 86400;

	hours = pad( parseInt(seconds_left / 3600) );
	seconds_left = seconds_left % 3600;

	minutes = pad( parseInt(seconds_left / 60) );
	seconds = pad( parseInt( seconds_left % 60 ) );

	// format countdown string + set tag value
	countdown.innerHTML = "<span>" + days + "</span><span>" + hours + "</span><span>" + minutes + "</span><span>" + seconds + "</span>";
}

function pad(n) {
	return (n < 10 ? '0' : '') + n;
}
</script>

<?php
include_once(G5_THEME_PATH.'/tail.php');
?>
