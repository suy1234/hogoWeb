<article data-aos="flip-right" class="section-img admin-website-edit" data-id="{{ $id }}">
	<div class="widget-wrapper animated">
		@if(!empty($title))
			<h3 class="title title_left">{{ $title }}</h3>
		@endif
		@if(count($menus))
		<div class="inner">
			<ul class="list-unstyled list-styled text-left">
				@foreach($menus as $menu)
				<li>
					<a href="{{ $menu['url'] }}" title="{{ $menu['title'] }}">
						{{ $menu['title'] }}
					</a>
				</li>
				@endforeach
			</ul>
		</div>
		@endif
	</div>
</article>