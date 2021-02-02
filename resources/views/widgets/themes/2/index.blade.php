@if(!empty($data))
	<div class="section page-logo">
		<div class="page-container" id="particles-js">
			<div class="container">
				<div class="section-header">
					<div class="row">
						<div class="col-md-6 col-sm-6 col-xs-6">
							<a href="{{ $data[2]['link'] }}" class="logo" title="{{ $data[2]['title'] }}">
								<img src="{{ $data[2]['img'] }}" alt="{{ $data[2]['title'] }}" title="{{ $data[2]['title'] }}" class="img-responsive">
							</a>
						</div>
						<div class="col-md-6 col-sm-6 col-xs-6 text-right">
							<a href="javascript:void(0)" onclick="menuShow()" class="section-menu" title="{{ $data[2]['title'] }}">
								<i class="fa fa-bars"></i>
							</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="section page-full-logo" style="background-image: url('{{ $data[1] }}');">
		<div class="page-full-container">
			<div class="container">
				<div class="section-body">
					<div class="section-services">
						<div class="row">
							<div class="col-md-4 col-sm-4 col-xs-12">
								<article class="item">
									<div class="item-content">
										<a href="{{ $data[3][0]['link'] }}" title="{{ $data[3][0]['title'] }}">
											<img src="{{ $data[3][0]['img'] }}" alt="{{ $data[3][0]['title'] }}" title="{{ $data[3][0]['title'] }}" class="img-responsive">
										</a>
									</div>
								</article>
								<article class="item">
									<div class="item-content">
										<a href="{{ $data[3][1]['link'] }}" title="{{ $data[3][1]['title'] }}">
											<img src="{{ $data[3][1]['img'] }}" alt="{{ $data[3][1]['title'] }}" title="{{ $data[3][1]['title'] }}" class="img-responsive">
										</a>
									</div>
								</article>
							</div>
							<div class="col-md-4 col-sm-4 col-xs-12">
								<article class="item item-center">
									<div class="item-content">
										<a href="{{ $data[3][2]['link'] }}" title="{{ $data[3][2]['title'] }}">
											<img src="{{ $data[3][2]['img'] }}" alt="{{ $data[3][2]['title'] }}" title="{{ $data[3][2]['title'] }}" class="img-responsive">
										</a>
									</div>
								</article>
							</div>
							<div class="col-md-4 col-sm-4 col-xs-12">
								<article class="item">
									<div class="item-content">
										<a href="{{ $data[3][3]['link'] }}" title="{{ $data[3][3]['title'] }}">
											<img src="{{ $data[3][3]['img'] }}" alt="{{ $data[3][3]['title'] }}" title="{{ $data[3][3]['title'] }}" class="img-responsive">
										</a>
									</div>
								</article>
								<article class="item">
									<div class="item-content">
										<a href="{{ $data[3][4]['link'] }}" title="{{ $data[3][4]['title'] }}">
											<img src="{{ $data[3][4]['img'] }}" alt="{{ $data[3][4]['title'] }}" title="{{ $data[3][4]['title'] }}" class="img-responsive">
										</a>
									</div>
								</article>
							</div>
						</div>
					</div>
					<div class="slogren">
						<h1>
							{{ $data[3][5] }}
						</h1>
						<h2>
							{{ $data[3][6] }}
						</h2>
					</div>
				</div>
			</div>
		</div>
	</div>
	@section('extend')
	<div class="main-menu mScrollbar">
		<a onclick="menuClose()" href="javascript:void(0)" class="btn-close-menu" title="close">X</a>
		<ul class="list-menu">
			@foreach($data[0] as $menu)
			@if(!count($menu['children_sub']))
				<li class="home-menu">
					<a class="no-line" href="{{ $menu['url'] }}" title="{{ $menu['title'] }}">{{ $menu['title'] }}</a>
				</li>
			@else
				<li>
					<a href="{{ $menu['url'] }}" title="{{ $menu['title'] }}">{{ $menu['title'] }}</a>
					<ul class="sub-menu">
						@foreach($menu['children_sub'] as $children)
							<li>
								<a href="{{ $children['url'] }}" title="{{ $children['title'] }}">{{ $children['title'] }}</a>
							</li>
						@endforeach
					</ul>
				</li>
			@endif
			
			@endforeach
		</ul>
		<div class="clearfix"></div>
	</div>
	@endsection
@endif