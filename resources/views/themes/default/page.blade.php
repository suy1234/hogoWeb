@extends('themes.default.layouts.master')
@section('content')
	@foreach($layout_default['page']['widgets'] as $widget)
		@widget($widget['widget'], ['data' => $widget, 'entity' => $data])
	@endforeach
@endsection