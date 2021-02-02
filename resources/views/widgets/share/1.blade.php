<section id="widget-social" class="social-icons" style="margin: 0;padding: 0">
	<ul class="list-inline">
		@foreach($socials as $social)
		@php($link = str_replace(['[TITLE]', '[DESCRIPTION]', '[URL]', '[IMG]'], [$data->title, $data->description, $url, url('/').$data->img], $social['link']))
		<li>
			<a target="_blank" href="{{ $link }}" title="share {{ $data->title }} {{ $social['icon'] }}" rel="nofollow" class="social-wrapper">
				<span class="social-icon">
					<i class="{{ $social['icon'] }}"></i>
				</span>
			</a>
		</li>
		@endforeach
	</ul>
</section>