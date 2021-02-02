@push('style')
<style type="text/css">
	.page-full-logo{
		background-size: cover;
		background-repeat: no-repeat;
		background-position: center;
		height: 100vh;
	}
	.page-full-container{
		overflow-x: hidden;
	}
	.page-full-logo .section-header{
		padding-top: 20px;
		border: none;
	}
	.page-full-logo .section-menu{
		color: #FFF;
		padding: 5px;
		display: inline-block;
	}
	.page-full-logo .section-menu i{
		font-size: 25px;
	}
	.page-full-logo .slogren{
		background: #0d090999;
		padding: 15px;
		text-align: center;
	}
	.page-full-logo .slogren a, .page-full-logo .slogren h1 {
		color: #FFF;
		font-size: 30px;
	}
	.page-full-logo .slogren h2{
		font-size: 20px;
	}
	.page-full-logo .section-body .section-services{
		margin-top: 2%;
	}
	.page-full-logo .section-body .section-services .item{
		width: 100%;
		height: 30vh;
		padding: 15px 0;
	}
	.page-full-logo .section-body .section-services .item.item-center{
		height: 60vh;
	}
	.page-full-logo .section-body .section-services .item .item-content{
		border: 1px solid #FFF;
		height: 100%;
	}
	.page-full-logo .section-body .section-services .item img{
		height: 100%;
		object-fit: contain;
	}


	.page-map{
		background-position: center;
		background-repeat: no-repeat;
		background-size: cover;
		background-color: #f0f0f0;
	}
	.page-map .page-map-container{
		padding: 30px 0;
	}
	.page-map .page-map-container .img-map{
		height: 70vh;
		margin: auto;
		text-align: center;
		display: block;
	}
	.page-map .page-map-container .page-map-address h2{
		padding: 10px 0;
		text-transform: uppercase;
		border-bottom: 1px solid #CCC;
		margin: 0;
		font-size: 20px;
	}
	@media only screen and (max-width: 768px) {
		.page-full-logo{
			height: auto;
		}
		.page-map .page-map-container .page-map-address{
			text-align: center;
		}
		.page-map .page-map-container .page-map-address ul{
			padding: 0;
		}
		.page-map .page-map-container .page-map-address ul li{
			list-style: none;
		}
	}
	/*Menu*/
	.page-logo{
		position: absolute;
		width: 100%;
	}
	.page-logo + div{
		padding-top: 40px;
	}
	.page-logo .section-header{
		padding: 20px 0;
		border: none;
	}
	.page-logo .section-menu{
		color: #FFF;
		padding: 5px;
		display: inline-block;
	}
	.page-logo .section-menu i{
		font-size: 25px;
	}

	.main-menu{
		top: 0;
		right: -333px;
		position: fixed;
		overflow-x: hidden;
		overflow-y: auto;
		width: 333px;
		height: 100%;
		z-index: 1000;
		background: #fff;
		-webkit-overflow-scrolling: touch;
		-webkit-transition: all 0.5s;
		-moz-transition: all 0.5s;
		transition: all 0.5s;
	}
	.main-menu .btn-close-menu{
		width: 30px;
		height: 30px;
		position: absolute;
		right: 10px;
		top: 10px;
		text-align: center;
		line-height: 30px;
		color: #004042;	
		cursor: pointer;
	}

	.main-menu .btn-close-menu:hover{
		background: #fff;
	}
	body.open-menu{
		overflow:hidden;
	}
	body.open-menu .main-menu{
		right: 0px;
	}
	.main-menu .list-menu{
		list-style: none;
		background: #fff;
		right: 0;
		font-size: 12px;
		padding: 15px 2px 15px 20px;
		margin-bottom: 0;
	}
	.main-menu .list-menu.active{
		display: block;
	}
	.main-menu .list-menu>li{
		white-space: nowrap;
		margin-bottom: 15px;
	}
	.main-menu .list-menu>li:first-child{
		margin-bottom: 20px;
	}
	.main-menu .list-menu>li>a{
		color: #fff;
		display: block;
		color: #77c147;
		text-transform: uppercase;
		border-bottom: 1px solid #77c147;
		margin-bottom: 15px;
	}
	.main-menu .list-menu>li>a.no-line{
		border-bottom: none;
	}
	.main-menu .list-menu>li> ul.sub-menu{
		list-style: none;
		margin-left: 12px;
		margin-right: 25px;
		margin-bottom: 10px;
	}
	.main-menu .list-menu>li> ul.sub-menu li{
		margin-bottom: 15px;
	}
	.main-menu .list-menu>li> ul.sub-menu a{
		color: #004042;	
		display: inline-block;
		text-transform: uppercase;
	}
	.main-menu .list-menu>li> ul.sub-menu a:hover{
		color: #77c147;
	}
	.main-menu .list-menu>li> ul.sub-social{
		list-style: none;	
		margin-bottom: 10px;	
	}
	.main-menu .list-menu>li> ul.sub-social li{
		display: inline-block;
		margin-right: 10px;
	}
	ul.sub-social img{
		width: 35px;
		-webkit-border-radius: 5px;
		-moz-border-radius: 5px;
		border-radius: 5px;
	}
</style>
@endpush
@php
$page_map = [
	[
		'value' => '',
		'widget' => 'image',
		'label' => 'Ảnh',
	],[
		'value' => '',
		'widget' => 'image',
		'label' => 'Ảnh',
	],[
		'value' => '',
		'widget' => 'image',
		'label' => 'Ảnh',
	],[
		'value' => '',
		'widget' => 'image',
		'label' => 'Ảnh',
	],[
		'value' => '',
		'widget' => 'image',
		'label' => 'Ảnh',
	],[
		'value' => '',
		'widget' => 'title',
		'label' => 'Tiêu đề 1',
	],[
		'value' => '',
		'widget' => 'title',
		'label' => 'Tiêu đề 2',
	]
];
@endphp
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
<div class="section page-full-logo" style="background-image: url('/public/demo/each.png');">
	<div class="page-full-container">
		<div class="container">
			{{-- <div class="section-header">
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
			</div> --}}
			<div class="section-body">
				<div class="section-services">
					<div class="row">
						<div class="col-md-4 col-sm-4 col-xs-12">
							<article class="item">
								<div class="item-content"></div>
							</article>
							<article class="item">
								<div class="item-content"></div>
							</article>
						</div>
						<div class="col-md-4 col-sm-4 col-xs-12">
							<article class="item item-center">
								<div class="item-content">
									<a href="" title="logo">
										<img src="/public/admin/app/images/logo_light.png" class="img-responsive">
									</a>
								</div>
							</article>
						</div>
						<div class="col-md-4 col-sm-4 col-xs-12">
							<article class="item">
								<div class="item-content"></div>
							</article>
							<article class="item">
								<div class="item-content"></div>
							</article>
						</div>
					</div>
				</div>
				<div class="slogren">
					<a href="" title="">
						<h1>
							HOGO TRUNG TÂM ĐÀO TẠO LÁI XE HÀNG ĐẦU TẠI VIỆT NAM 
						</h1>
						<h2>
							LIÊN HỆ: 0931 15 68 18 - 0981 650 279
						</h2>
					</a>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="section page-map">
	<div class="page-map-container">
		<div class="container">
			<div class="row">
				<div class="col-md-8 col-sm-8 col-md-offset-2">
					<div class="row">
						<div class="col-md-8 col-sm-8 col-xs-12 page-map-address">
							{!! $page_map[0]['value'] !!}
						</div>
						<div class="col-md-4 col-sm-4 col-xs-12">
							<img src="{{ $page_map[1]['value'] }}" class="img-responsive img-map" alt="{{ $page_map[2]['value'] }}">
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
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
@push('script')
<script type="text/javascript">
	function menuShow()
	{
		$("body").addClass("open-menu");
	}
	function menuClose()
	{
		$("body").removeClass("open-menu");
	}
</script>
@endpush