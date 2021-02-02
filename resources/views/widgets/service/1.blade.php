<section class="service admin-website-edit" data-id="{{ $id }}" data-aos="fade-up">
	<div class="row" style="margin:0;">
		<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 no-padding">
			<div class="service_video_main" style="background-image: url({{ $data['img'] }});">
				<div class="content_service_video">
					<div class="text_video_service">
						<h2 class="animate__animated animate__rotateInDownLeft">
							<a class="fancybox_video fancybox.iframe" href="{{ $data['link'] }}" title="{{ $data['title'] }}">
								{{ $data['title'] }}
							</a>
						</h2>
						<p class="animate__animated animate__rotateInUpLeft">{{ $data['description'] }}</p>
					</div>
				</div>
			</div>  
		</div>
		<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 no-padding right_service">
			<div class="row" style="margin:0;">
				@if(!empty($data['items']))
				@foreach($data['items'] as $value)
				<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 item">
					<div class="col_service animate__animated animate__rotateInUpLeft">
						@if(!empty($value['img']))
						<span class="icon_service">
							<img src="{{ $value['link'] }}" alt="{{ $value['title'] }}" height="65" />
						</span>
						@endif
						<div class="icon_text">
							<h3 class="title_category_sv">
								<a href="{{ $value['link'] }}" title="{{ $value['title'] }}">
									{{ $value['title'] }}
								</a>
							</h3>
							<p>{{ $value['description'] }}</p>
						</div>
					</div>
				</div>
				@endforeach
				@endif
			</div>
		</div>
	</div>
</section>