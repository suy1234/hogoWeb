@extends('themes.layouts.master')
@section('content')
	@foreach($themes as $value)
		@widget($value['widget'], ['data' => $value, 'blade' => $value['widget_type']])
	@endforeach
@endsection