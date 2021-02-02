@extends('themes.layouts.master')
@section('content')
<div class="page-content">
	<div class="container">
		<div class="p-2">
			<div class="row">
				<div class="col-md-9 col-sm-7 col-xs-12">
					<div class="content">
						{!! $page->content !!}
					</div>
				</div>
				<div class="col-md-3 col-sm-5 col-xs-12">
					@widget('sidebar_post')
				</div>
			</div>
		</div>
	</div>
</div>
@endsection