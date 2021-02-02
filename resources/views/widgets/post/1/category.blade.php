<section>
	<div class="row">
		@foreach($posts as $value)
		<div class="col-md-4 col-sm-4 col-xs-6 pb-3" style="margin-bottom: 30px;">
			<div class="blog_index">
				<div class="myblog" href="" title="{{ $value['title'] }}">
					<div class="image-blog-left text-center">
						<a href="{{ $value['seo']['alias'] }}" title="{{ $value['title'] }}">
							<img src="{{ $value['img'] }}" title="{{ $value['description'] }}" alt="{{ $value['description'] }}">
						</a>

						{{-- <div class="date_blog">
							<i class="fa fa-calendar"></i>
							<b class="color_main">{{ date('d-m-Y',  strtotime($value['published_at'])) }}</b>
						</div> --}}
					</div>
					<div class="content_blog">
						<div class="content_right">
							<h3>
								<a href="{{ $value['seo']['alias'] }}" title="{{ $value['title'] }}">{{ $value['title'] }}</a>
							</h3>
						</div>
						<div class="summary_item_blog">
							<p>{{ $value['description'] }}</p>
						</div>
					</div>	
				</div>
			</div>
		</div>
		@endforeach
	</div>
</section>