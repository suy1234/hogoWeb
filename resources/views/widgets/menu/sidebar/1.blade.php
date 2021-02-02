<article data-aos="flip-right" class="section-img admin-website-edit" data-id="{{ $id }}">
	<div class="navbar-inner-left">
		<div class="mega-left-title">
			@if(!empty($title))
				<h3 class="sb-title">{{ $title }}</h3>
			@endif
		</div>
		@if(count($menus))
			<ul class="nav navs sidebar">
				<li>
					<ul class="nav navs sidebar text-left">
						@foreach($menus as $menu)
							<li>
								<a href="{{ $menu['url'] }}" title="{{ $menu['title'] }}">
									{{ $menu['title'] }}
								</a>
							</li>
						@endforeach
					</ul>
				</li>
			</ul>
		@endif
	</div>
</article>