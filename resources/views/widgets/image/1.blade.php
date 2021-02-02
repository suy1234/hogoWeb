<article data-aos="flip-right" class="section-img admin-website-edit" data-id="{{ $id }}">
	<div class="navbar-inner-left">
		<div class="mega-left-title">
			@if(!empty($title))
				<h3 class="sb-title">{{ $title }}</h3>
			@endif
		</div>
		<a href="{{ $link }}" title="{{ $title }}">
			<img src="{{ $img }}" title="{{ $title }}" rel="{{ $title }}" />
		</a>
	</div>
</article>