<h1 class="title">{{ $data->title }}</h1>
<p class="date_blog">
	<i class="fa fa-calendar"></i>
	<strong class="color_main">{{ date('d-m-Y H:i', strtotime($data->created_at)) }}</strong>
	&nbsp;<i class="fa fa-eye"></i> Lược xem:<strong class="color_main">{{ $data->view_count }}</strong>
	&nbsp;<i class="fa fa-user-circle-o"></i> Đăng bởi: <strong class="color_main">admin</strong>
</p>
<h2 class="description">{{ $data->description }}</h2>
<div class="content">
	{!! $data->content !!}
</div>