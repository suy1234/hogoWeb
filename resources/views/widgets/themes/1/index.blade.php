@if(!empty($data))
	<div class="section page-map">
		<div class="page-map-container">
			<div class="container">
				<div class="row">
					<div class="col-md-8 col-sm-8 col-md-offset-2">
						<div class="row">
							<div class="col-md-8 col-sm-8 col-xs-12 page-map-address">
								{!! $data[0] !!}
							</div>
							<div class="col-md-4 col-sm-4 col-xs-12">
								<img src="{{ $data[1] }}" class="img-responsive img-map" alt="{{ @$data[2] }}">
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
@endif