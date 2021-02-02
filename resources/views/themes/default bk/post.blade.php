@extends('themes.layouts.master')
@section('content')
<div class="page-content">
	<div class="container">
		<div class="p-2">
			<div class="row">
				<div class="col-md-9 col-sm-7 col-xs-12">
					<div class="title">
						<h1>
							{{ $post->title }}
						</h1>
						<p class="date_blog">
							<i class="fa fa-calendar"></i>
							<b class="color_main">{{ date('d-m-Y H:i', strtotime($post->created_at)) }}</b>
							- Đăng bởi: <b class="color_main">{{ $post->owner->fullname }}</b>
							- Lược xem: <b class="color_main">{{ number_format($post->view_count) }}</b>
						</p>
						@widget('social', ['type' => 'onpage', 'data' => $post])
						<h2 class="description">Chanh và công dụng đáng thán phục,tăng sức đề kháng cho cơ thể tốt nhất</h2>
					</div>
					<div class="content">
						{!! $post->content !!}
						<div>
							@widget('social', ['type' => 'onpage', 'data' => $post])
						</div>
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