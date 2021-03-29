@if(count($data))
<header class="header tophead">
	<div class="mid-header wid_100">
		<div class="container">
			<div class="row">
				<div class="content_header">
					<div class="header-main">
						<div class="menu-bar-h nav-mobile-button hidden-lg">
							<a href="#nav-mobile" title="icon menu">
								<img src="/public/web/img/i_menubar.png" alt="icon menu">
							</a>
						</div>
						<div class="col-lg-2 logo-main">
							<div class="logo">
								<a href="{{ @$data[1]['link'] }}" class="logo-wrapper " title="{{ @$data[1]['title'] }}">					
									<img src="{{ @$data[1]['img'] }}" alt="{{ @$data[1]['title'] }}">					
								</a>
							</div>
						</div>
						<div class="col-lg-9 col-md-9 hidden-xs hidden-sm hidden-md padding-0 col-lg-offset-1 col-md-offset-1">
							<div class="header-left">
								<div class="bg-header-nav hidden-xs hidden-sm">
									<div>
										<div class= "row row-noGutter-2">
											<nav class="header-nav">
												<ul class="item_big">
												@if(count($data[0]))
													@foreach($data[0] as $key => $menu)
														@if(!count($menu['children_sub']))
															<li class="nav-item {{ $key == 0 ? 'active' : ''}}">
																<a href="{{ $menu['url'] }}" class="a-img" title="{{ $menu['title'] }}">
																	<span>{{ $menu['title'] }}</span>
																</a>
															</li>
														@else
															<li class="nav-item">
																<a class="a-img" href="{{ $menu['url'] }}" title="{{ $menu['title'] }}">
																	<span>{{ $menu['title'] }}</span>
																	<i class="fa fa-angle-down" aria-hidden="true"></i>
																</a>
																<ul class="item_small hidden-sm hidden-xs">
																	@foreach($menu['children_sub'] as $children)
																		@if(!count($children['children_sub']))
																			<li> 
																				<a href="{{ $children['url'] }}" title="{{ $children['title'] }}">{{ $children['title'] }}</a>
																			</li>
																		@else
																			<li>
																				<a href="{{ $children['url'] }}" title="{{ $children['title'] }}">
																					<span>
																						{{ $children['title'] }}
																					</span>
																				</a>
																				<i class="fa fa-angle-down" aria-hidden="true"></i>
																				<ul class="item_small hidden-sm hidden-xs">
																				@foreach($children['children_sub'] as $child)
																					<li> 
																						<a href="{{ $child['url'] }}" title="{{ $child['title'] }}">{{ $child['title'] }}</a>
																					</li>
																				@endforeach
																				</ul>
																			</li>
																		@endif
																	@endforeach
																</ul>
															</li>
														@endif
													@endforeach
												@endif
												</ul>
											</nav>
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
</header>

<!-- Menu mobile -->
<div class="menu_mobile sidenav max_991 hidden-lg" id="nav-mobile">
	<ul class="ul_collections">
		<li class="special">
			<a href="/" title="menu">MENU</a>
		</li>
		@if(count($data[0]))
		@foreach($data[0] as $menu)
			@if(!count($menu['children_sub']))
				<li class="level0 level-top parent">
					<a href="{{ $menu['url'] }}" title="{{ $menu['title'] }}">{{ $menu['title'] }}</a>
				</li>
			@else
				<li class="level0 level-top parent">
					<a href="{{ $menu['url'] }}" title="{{ $menu['title'] }}">{{ $menu['title'] }}</a>
					<i class="fa fa-angle-down" aria-hidden="true"></i>
					<ul class="level0" style="display:none;">
						@foreach($menu['children_sub'] as $children)
							@if(!count($children['children_sub']))
								<li class="level1"> 
									<a href="{{ $children['url'] }}" title="{{ $children['title'] }}">{{ $children['title'] }}</a>
								</li>
							@else
								<li class="level1 level-top parent">
									<a href="{{ $children['url'] }}" title="{{ $children['title'] }}">{{ $children['title'] }}</a>
									<i class="fa fa-angle-down" aria-hidden="true"></i>
									<ul class="level1" style="display:none;">
									@foreach($children['children_sub'] as $child)
										<li class="level2"> 
											<a href="{{ $child['url'] }}" title="{{ $child['title'] }}">{{ $child['title'] }}</a>
										</li>
									@endforeach
									</ul>
								</li>
							@endif
						@endforeach
					</ul>
				</li>
			@endif
		@endforeach
		@endif
	</ul>
</div>
<div class="opacity_menu"></div>
@endif