<section class="bread-crumb">
	<ul class="breadcrumb" itemscope itemtype="http://data-vocabulary.org/Breadcrumb">
		@foreach($links as $key => $link)
			<li {{ $key == 0 ? ' class="home" ' : '' }}>
				<a itemprop="url" href="{{ $link['link'] }}" title="{{ $link['title'] }}">
					<span itemprop="title">{{ $link['title'] }}</span>
				</a>                        
			</li>
		@endforeach
	</ul>
</section>