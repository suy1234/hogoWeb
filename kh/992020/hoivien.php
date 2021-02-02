<?php include 'config.php'; ?>

<?php include 'master/header.php'; ?>

<section>
	<div class="wrapper-banner wrapper-joomla wrapper-auto" style="background: url('images/banner-formula-reg.jpg');    background-size: cover;">
		<div id="particle-canvas"></div>
		<div class="row">
			<div class="title" style="    position: relative;z-index: 15;">
				<div class="container">
					<div class="row">
						<div class="col-xs-12">
							<h1 class="slogan">Đăng ký hội viên</h1>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<section data-aos="fade-up" class="section-contact">
	<div id="introduce" class="animate__animated animate__slideInUp" style="padding: 30px 0;">
		<div class="container">
			<div class="row">
				<div class="col-sm-6 a-center col-sm-push-6">
					<p>
						<a href="/gioi-thieu" style="display: block;" class="text-center">
							<img src="https://www.northshorebank.com/getdoc/86b745b4-2928-40c9-b683-2ab99cc78f5f/backgroundimage.aspx" class="img-responsive">
						</a>
					</p>
				</div>
				<div class="col-sm-6 col-sm-pull-6">
					<div class="title-header text-center">
						<h2>Điều khoản</h2>
					</div>
					<p>
						<strong>CÔNG TY TNHH TM DV TRÍ ĐĂNG</strong> được thành lập từ năm 2018. Công ty chúng tôi là công ty chuyên về mảng thiết kế, in ấn, quảng cáo, xây dựng và phát triển thương hiệu.
					</p>
					<p>
						Với nhiều năm kinh nghiệm thực tiển chúng tôi giúp khách hàng tạo ra sự khác biệt với các đối thủ cạnh tranh. Không chỉ thực hiện công việc đơn thuần như thiết kế, in ấn, quảng cáo, chúng tôi còn tư vấn cho khách hàng những yếu tố để tạo nên sự sáng tạo , khác biệt , giúp cho khách hàng của doanh nghiệp dễ dàng nhận ra bạn giữa muôn vàn đối thủ cạnh tranh.
					</p>
					<p>
						<strong>CÔNG TY TNHH TM DV TRÍ ĐĂNG</strong> chúng tôi luôn luôn phấn đấu trở thành một trong những công ty về thiết kế in ấn quảng cáo hàng đầu tại Việt Nam.

					</p>
					<p>
						Công ty chúng tôi đã, đang và sẽ thực hiện cho rất nhiều khách hàng nổi tiếng.
					</p>
				</div>
			</div>
		</div>
	</div>
</section>
<div class="service" data-aos="fade-up">
	<div class="row" style="margin:0;">
		<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 no-padding">
			<div class="service_video_main" style="background-image: url('<?php echo $config['service']['img'] ?>');">
				<div class="content_service_video">
					<div class="text_video_service">
						<h2 class="animate__animated animate__rotateInDownLeft">
							<a class="fancybox_video fancybox.iframe" href="/san-pham.html" title="Sản phẩm và dịch vụ của Stellar">Quy trình đăng ký</a>
						</h2>
						<p class="animate__animated animate__rotateInUpLeft"><?php echo $config['service']['description'] ?></p>
					</div>
				</div>
			</div>  
		</div>
		<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 no-padding right_service">
			<div class="row" style="margin:0;">
				<?php
				foreach($config['service']['data'] as $value){
					?>
					<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 item">
						<div class="col_service animate__animated animate__rotateInUpLeft">
							<?php if(!empty($value['img'])){ ?>
								<span class="icon_service">
									<img src="http://html.local/tridang/img/construction-design.svg" alt="Thiết kế trọng gói" height="65" />
								</span>
							<?php } ?>
							<div class="icon_text">
								<h3 class="title_category_sv">
									<a href="#" title="Thi công thiết kế"><?php echo $value['title'] ?></a>
								</h3>
								<p><?php echo $value['description'] ?></p>
							</div>
						</div>
					</div>
				<?php } ?>
			</div>
		</div>
	</div>
</div>

<section class="section-default register-data" style="background-image: url('images/money.jpg');">
	<div class="container">
		<div class="title-header text-center">
			<h2 style="color: #FFF;">
				Đăng ký vay
			</h2>
		</div>
		<div class="row">
			<div class="col-md-6 col-xs-12 col-sm-6">
				<div data-aos="zoom-in">
					<form action="">
						<div class="form-holder">
							<span class="fa fa-user"></span>
							<input type="text" class="form-control" placeholder="Họ và tên">
						</div>
						<div class="form-holder">
							<span class="fa fa-phone"></span>
							<input type="text" class="form-control" placeholder="Điện thoại">
						</div>
						<div class="form-holder">
							<span class="fa fa-envelope"></span>
							<input type="text" class="form-control" placeholder="Email">
						</div>
						<div class="form-holder">
							<span class="fa fa-money"></span>
							<input type="text" class="form-control" placeholder="Số tiền bạn cần">
						</div>
						<button>
							<span>Đăng ký</span>
						</button>
					</form>
				</div>
			</div>
			<div class="col-md-6 col-xs-12 col-sm-6 list-bank">
				<!-- <div data-aos="zoom-in-left" class="media-contact">
					<div class="media align-items-center icon-title-2">
						<div class="media-body">
							<h5 class="text-uppercase text-justify mb-0">
								Tư vấn viên: Huỳnh Ngọc Suy
							</h5>
							<p class="description text-justify m-0">
								<strong>
									Điện thoại: 
								</strong>
								0931 15 68 18
							</p>
							<p class="description text-justify m-0">
								<strong>
									Email: 
								</strong>
								huynhngocsuy@gmail.com
							</p>
						</div>
					</div>
					<div class="media align-items-center icon-title-2">
						<div class="media-body">
							<h5 class="text-uppercase text-justify mb-0">
								Tư vấn viên: Huỳnh Ngọc Suy
							</h5>
							<p class="description text-justify m-0">
								<strong>
									Điện thoại: 
								</strong>
								0931 15 68 18
							</p>
							<p class="description text-justify m-0">
								<strong>
									Email: 
								</strong>
								huynhngocsuy@gmail.com
							</p>
						</div>
					</div>
					<div class="media align-items-center icon-title-2">
						<div class="media-body">
							<h5 class="text-uppercase text-justify mb-0">
								Tư vấn viên: Huỳnh Ngọc Suy
							</h5>
							<p class="description text-justify m-0">
								<strong>
									Điện thoại: 
								</strong>
								0931 15 68 18
							</p>
							<p class="description text-justify m-0">
								<strong>
									Email: 
								</strong>
								huynhngocsuy@gmail.com
							</p>
						</div>
					</div>
				 --></div>
			</div>
		</div>
	</div>
</section>
<?php include 'master/footer.php'; ?>