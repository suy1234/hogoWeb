<div class="section page-logo">
	<div class="page-container">
		<div class="container">
			<div class="section-header">
				<div class="row">
					<div class="col-md-6 col-sm-6 col-xs-6">
						<a href="" title="logo">
							<img src="/public/admin/app/images/logo_light.png" class="img-responsive">
						</a>
					</div>
					<div class="col-md-6 col-sm-6 col-xs-6 text-right">
						<a href="javascript:void(0)" onclick="menuShow()" class="section-menu" title="">
							<i class="fa fa-bars"></i>
						</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@section('extend')
<div class="main-menu mScrollbar">
	<a onclick="menuClose()" href="javascript:void(0)" class="btn-close-menu" title="close">X</a>
	<ul class="list-menu">
		<li class="home-menu"><a class="no-line" href="http://greenmode.vn">Trang chủ</a></li>
		<li>
			<a href="">Giới thiệu</a>
			<ul class="sub-menu">
				<li><a href="http://greenmode.vn/vi/gioi-thieu-pa1.html">Giới thiệu chung</a></li>
				<li><a href="http://greenmode.vn/vi/tuyen-dung-pa2.html">Tuyền dụng</a></li>
				<li><a href="http://greenmode.vn/vi/tin-tuc-n1.html">Tin tức</a></li>                       
				<li><a href="http://greenmode.vn/vi/lien-he-pa3.html">Liên hệ</a></li>
			</ul>
		</li>            
		<li>
			<a href="">Thương hiệu</a>
			<ul class="sub-menu">
				<li><a href="http://vacosi.com" target="_blank">VACOSI</a></li>
				<li><a href="http://omivietnam.vn/" target="_blank">OMI</a></li>
				<li><a href="http://hasi.vn" target="_blank">HASI</a></li>
				<li><a href="http://www.newface.vn/b5-sokiss.html" target="_blank">SOKISS</a></li>
				<li><a href="http://newface.vn" target="_blank">New Face</a></li>                 
			</ul>
		</li>
		<li>
			<a href="#">Kết nối</a>
			<ul class="sub-social">
				<li><a target="_blank" href="https://www.facebook.com/vacosimakeup"><img src="http://greenmode.vn/img/icons/icon-fb.png" title="" alt=""></a></li>                 
				<li><a target="_blank" href="https://www.instagram.com/vacosi.makeup.house/"><img src="http://greenmode.vn/img/icons/logo-instagram.png" title="" alt=""></a></li>
				<li><a target="_blank" href="https://www.youtube.com/channel/UCd15G5mj6zgWmASgVAxTtxg"><img src="http://greenmode.vn/img/icons/icon-youtube.png" title="" alt=""></a></li>
				<li><a target="_blank" href="https://www.pinterest.com/vacosi/"><img src="http://greenmode.vn/img/icons/icon-pin.png" title="" alt=""></a></li>
			</ul>
		</li>            
	</ul>
	<div class="clearfix"></div>
</div>
@endsection