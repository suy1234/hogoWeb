<article data-aos="flip-right" class="section-img admin-website-edit" data-id="{{ $id }}">
	<div class="navbar-inner-left">
		<div class="mega-left-title">
			@if(!empty($title))
			<h3 class="sb-title">{{ $title }}</h3>
			@endif
		</div>
		@if(!empty($fanpage))
			<div class="fb-page" data-href="{{ $fanpage }}" data-tabs="timeline" data-width="" data-height="{{ $height }}" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true">
				<blockquote cite="{{ $fanpage }}" class="fb-xfbml-parse-ignore">
					<a href="{{ $fanpage }}" rel="nofollow" title="{{ $title_fanpage }}"></a>
				</blockquote>
			</div>
		@endif
	</div>
</article>