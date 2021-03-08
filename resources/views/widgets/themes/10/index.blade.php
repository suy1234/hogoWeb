<article class="article-content">
	<div class="container">
		<div class="row">
			<div class="col-md-8 col-sm-8 col-xs-12">
				<h1 class="title">{{ $data['entity']['title'] }}</h1>
				<p class="date_blog">
					<i class="fa fa-calendar"></i>
					<b class="color_main">{{ date('d-m-Y H:i', strtotime($data['entity']['created_at'])) }}</b>
					&nbsp; Đăng bởi: <b class="color_main">admin</b>
				</p>
				<h2 class="description">{{ $data['entity']['description'] }}</h2>
				<div class="content text-justify">
					{!! $data['entity']['content'] !!}
				</div>
			</div>
			@if(!empty($data[0]))
			<div class="col-md-4 col-sm-4 col-xs-12">
				<div class="navbar-inner-left">
					<div class="mega-left-title">
						<h3 class="sb-title">{{ $data[1][0] }}</h3>
					</div>
					<ul class="nav navs sidebar">
						@foreach($data[1][1] as $menu)
						<li>
							<ul class="nav children collapse in">
								<li>
									<a href="{{ $menu['url'] }}" title="{{ $menu['title'] }}">
										{!! $menu['title'] !!}
									</a>
								</li>
							</ul>
						</li>
						@endforeach
					</ul>
				</div>
				<div class="navbar-inner-left">
					<div class="mega-left-title">
						<h3 class="sb-title">{{ $data[2][0] }}</h3>
					</div>
					<ul class="nav navs sidebar">
						@foreach($data[2][1] as $menu)
						<li>
							<ul class="nav children collapse in">
								<li>
									<a href="{{ $menu['url'] }}" title="{{ $menu['title'] }}">
										{!! $menu['title'] !!}
									</a>
								</li>
							</ul>
						</li>
						@endforeach
					</ul>
				</div>
				<div class="navbar-inner-left">
					<ul class="nav navs sidebar">
						<li>
							<a href="{{ $data[3]['link'] }}" title="{{ $data[3]['title'] }}" style="padding-left: 0;padding-right: 0;">
								<img src="{{ $data[3]['img'] }}" title="{{ $data[3]['title'] }}" alt="{{ $data[3]['title'] }}" class="img-thumbnail img-responsive" style="max-width: 100%;">
							</a>
						</li>
					</ul>
				</div>
				<div class="navbar-inner-left">
					<div class="mega-left-title">
						<h3 class="sb-title">{{ $data[4][0] }}</h3>
					</div>
					<ul class="nav navs sidebar">
						<li>
							{!! $data[4][1] !!}
						</li>
					</ul>
				</div>
			</div>
			@endif
		</div>
	</div>
</article>