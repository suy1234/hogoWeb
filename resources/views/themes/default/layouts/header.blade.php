<div id="header" style="background-color: {{ @$layout_default['header']['config']['background']['color'] }};background-image: url('{{ @$layout_default['header']['config']['background']['image'] }}');">
	<div class="row">
		@foreach($layout_default['header']['widgets'] as $layout)
			<article class="{{ $layout['class'] }}">
				@if(count($layout['widgets']))
					@foreach($layout['widgets'] as $widget)
						@widget($widget['widget'], ['data' => $widget, 'folder' => 'header'])
					@endforeach
				@endif
			</article>
		@endforeach
	</div>
</div>