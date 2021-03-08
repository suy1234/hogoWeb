@extends('themes.default.layouts.master')
@section('content')
	<article>
		<div class="container">
			{!! $page['content'] !!}
		</div>
	</article>
@endsection