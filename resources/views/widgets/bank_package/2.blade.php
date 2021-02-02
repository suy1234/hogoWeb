<section data-aos="fade-up" class="admin-website-edit bank_package" data-id="{{ $id }}">
	<div class="container">
		@if(!empty($data[0]['value']))
			<div class="title-header text-center">
				<h2>
					{{ $data[0]['value'] }}
				</h2>
			</div>
		@endif
		<div class=" list-bank">
			<div class="row">
				<div class="col-md-4 col-sm-4 col-xs-12">
					@if(!empty($data[1]['value']))
						<div class="media align-items-center icon-title-2">
							<div class="media-body">
								{!! $data[1]['value'] !!}
							</div>
						</div>
					@endif
					
				</div>
				<div class="col-md-8 col-sm-8 col-xs-12">
					@foreach($bank_interest_rates as $value)
					<div class="panel panel-default" data-aos="fade-down">
						<div class="panel-heading" style="background: #FFF;position: relative;">
							{{ $value['category']['title'] }} {{ strtolower($value['group']['title']) }} tại {{ strtolower($value['bank']['title']) }}
							
							<button type="button" class="btn btn-info btn-xs" style="position: absolute;right: 15px">
								Đăng ký ngay
							</button>
						</div>
						<div class="panel-body">
							<div class="row">
								<div class="col-md-3 col-sm-4 col-xs-12">
									<img src="{{ $value['bank']['img'] }}" title="{{ $value['bank']['title'] }}" width="90" class="img-responsive">
								</div>
								<div class="col-md-3 col-sm-4 col-xs-12 text-center">
									<div class="interest-info">
										<p class="title">{{ $value['bank_info']['interest_rate']['title'] }}</p>
										<p class="value text-one-row">
											{{ $value['bank_info']['interest_rate']['value'] }}
										</p>
										<p class="text">{{ $value['bank_info']['interest_rate']['unit'] }}</p>
									</div>
								</div>
								<div class="col-md-3 col-sm-4 col-xs-12 text-center">
									<div class="interest-info">
										<p class="title">{{ $value['bank_info']['endow']['title'] }}</p>
										<p class="value text-one-row">
											{{ $value['bank_info']['endow']['value'] }}
										</p>
										<p class="text">{{ $value['bank_info']['endow']['unit'] }}</p>
									</div>
								</div>
								<div class="col-md-3 col-sm-4 col-xs-12 text-center">
									<div class="interest-info">
										<p class="title">{{ $value['bank_info']['timeout']['title'] }}</p>
										<p class="value text-one-row">
											{{ $value['bank_info']['timeout']['value'] }}
										</p>
										<p class="text">{{ $value['bank_info']['timeout']['unit'] }}</p>
									</div>
								</div>
							</div>
							<div class="clearfix"></div>
						</div>
					</div>
					@endforeach
					
				</div>
			</div>
		</div>
	</div>
</section>