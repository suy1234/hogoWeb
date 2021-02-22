<div id="footer" style="background-color: {{ $layout_default['footer']['config']['background']['color'] }};background-image: url('{{ $layout_default['footer']['config']['background']['image'] }}');">
	<div class="row" style="margin: 0">
		@foreach($layout_default['footer']['widgets'] as $layout)
			<article class="{{ $layout['class'] }}">
				@if(count($layout['widgets']))
					@foreach($layout['widgets'] as $widget)
						@widget($widget['widget'], ['data' => $widget, 'folder' => 'footer'])
					@endforeach
				@endif
			</article>
		@endforeach
	</div>
</div>