<div id="header" style="background-color: {{ @$layout_default['header']['config']['background']['color'] }};background-image: url('{{ @$layout_default['header']['config']['background']['image'] }}');">
	@foreach($layout_default['header']['widgets'] as $key=>$widget)
		<article class="header-{{ $key }}">
			@widget($widget['widget'], ['data' => $widget, 'folder' => 'header'])
		</article>
	@endforeach
</div>