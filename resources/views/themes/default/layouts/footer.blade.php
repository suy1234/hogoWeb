<div id="footer" style="background-color: {{ $layout_default['footer']['config']['background']['color'] }};background-image: url('{{ $layout_default['footer']['config']['background']['image'] }}');">
	@foreach($layout_default['footer']['widgets'] as $key=>$widget)
		<article class="footer-{{ $key }}">
			@widget($widget['widget'], ['data' => $widget, 'folder' => 'footer'])
		</article>
	@endforeach
</div>