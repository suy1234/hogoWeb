<section data-aos="fade-up" class="section-post01 margin-bottom-none admin-website-edit" data-id="{{ $id }}">
	@if(!empty($data[0]['value']))
		<div class="container">
			<div class="title-header text-center">
				<h2>
					{{ $data[0]['value'] }}
				</h2>
			</div>
		</div>
	@endif
	<div class="container post-slider">
		<div class="row">
			<div class="col-md-12">
				<div class="slick">
					@foreach($posts as $value)
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
					@endforeach
				</div>
				<div class="clearfix"></div>
			</div>
		</div>
	</div>
</section>
@push('script')
<script type="text/javascript">
	
</script>
@endpush