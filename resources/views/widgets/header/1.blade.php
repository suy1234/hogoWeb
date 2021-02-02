<article data-aos="flip-right" class="header header-active section-img admin-website-edit" data-id="{{ $id }}" style="position: relative;z-index: 9">
	<div class="mid-header wid_100">
		<div class="container">
			<div class="row">
				<div class="content_header">
					<div class="header-main">
						<div class="menu-bar-h nav-mobile-button hidden-lg hidden-md">
							<a href="#nav-mobile" title="{{ @$data[0]['value'] }}">
								<img src="{{ @$data[5]['value'] }}" title="{{ @$data[0]['value'] }}" alt="{{ @$data[2]['value'] }}">
							</a>
						</div>
						<div class="col-lg-2 col-md-2 logo-main">
							<div class="logo">
								<a href="http://hiephoitindung.vn" class="logo-wrapper" title="{{ @$data[0]['value'] }}">
									<img src="{{ @$data[3]['value'] }}" alt="{{ @$data[2]['value'] }}" title="{{ @$data[0]['value'] }}">
								</a>

							</div>
						</div>
						<div class="col-lg-9 col-md-9 hidden-xs hidden-sm padding-0">
							<div class="header-left">
								<div class="bg-header-nav hidden-xs hidden-sm">
									<div>
										<div class= "row row-noGutter-2">
											<nav class="header-nav">
												<ul class="item_big">
													@foreach($menu as $value)
													<li class="nav-item">
														
														@if(count($value['children_sub']))
														<a href="{{ $value['url'] }}" title="{{ $value['title'] }}">
															{{ $value['title'] }} <i class="fa fa-angle-right"></i>
														</a>
														<ul class="item_small hidden-sm hidden-xs">
															@foreach($value['children_sub'] as $item)
															<li>
																<a href="{{ $item['url'] }}" title="{{ $item['title'] }}">
																	{{ $item['title'] }}
																</a>
															</li>
															@endforeach
														</ul>
														@else
														<a href="{{ $value['url'] }}" title="{{ $value['title'] }}">
															{{ $value['title'] }}
														</a>
														@endif
													</li>
													@endforeach
												</ul>
											</nav>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-lg-1 col-md-1 col-xs-12 no-padding-left cartright">
							<div class="searchbox">
								<div class="search_inner">
									<i class="fa fa-search"></i>
									<div class="search-box">
										<div class="header-search search_form">
											<form action="/tim-kiem" method="get" class="input-group search-bar search_form" role="search">
												<input type="text" name="keyword" value="" autocomplete="off" placeholder="{{ @$data[7]['value'] }}" class="input-group-field auto-search">
												<span class="input-group-btn">
													<button type="submit" class="btn icon-fallback-text">
														<span class="fa fa-search" ></span>      
													</button>
												</span>
											</form>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</article>