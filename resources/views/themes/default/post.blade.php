@extends('themes.default.layouts.master')
@section('content')
<div class="container">
	<div class="row">
		@if(!empty($layouts))
			@foreach($layouts as $layout)
				<article class="{{ $layout['class'] }}">
					@if(count($layout['widgets']))
						@foreach($layout['widgets'] as $widget)
							@widget($widget['widget'], ['data' => $widget, 'data_view' => $post, 'post' => 'post', 'folder' => 'post'])
						@endforeach
					@endif
				</article>
			@endforeach
		@endif
	</div>	
</div>
@endsection