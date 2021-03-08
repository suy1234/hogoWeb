@extends('themes.default.layouts.master')
@section('content')
	@if(!empty($layout_default['post']))
		@foreach($layout_default['post']['widgets'] as $widget)
			@widget($widget['widget'], ['data' => $widget, 'entity' => $post])
		@endforeach
	@endif
@endsection