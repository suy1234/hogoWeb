<section data-aos="fade-up" class="admin-website-edit" data-id="{{ $id }}">
	@if(!empty($data[0]['value']))
		<div class="title-header text-center">
			<h2>
				{{ $data[0]['value'] }}
			</h2>
		</div>
	@endif
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
</section>