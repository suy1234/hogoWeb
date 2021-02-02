<article data-aos="flip-right" class="section-img admin-website-edit" data-id="{{ $id }}">
	<div id="widget-social" class="social-icons">
		<ul class="list-inline">
			@if(!empty($data))
				@foreach($data as $value)
					@if(!empty($value['value']) && $value['value'] !== 'null')
						<li>
							<a target="_blank" href="{{ $value['value'] }}" title="" rel="nofollow" class="social-wrapper">
								<span class="social-icon">
									<i class="{{ $value['label'] }}"></i>
								</span>
							</a>
						</li>
					@endif
				@endforeach
			@endif
		</ul>
	</div>
</article>