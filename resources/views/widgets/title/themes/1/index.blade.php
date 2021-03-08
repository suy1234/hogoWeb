<div class="section page-map">
	<div class="page-map-container">
	    @if(!empty($data))
		<div class="container">
			<div class="row">
				<div class="col-md-9 col-sm-9 col-md-offset-1">
					<div class="row">
						<div class="col-md-7 col-sm-7 col-xs-12 page-map-address">
							{!! $data[0] !!}
						</div>
						<div class="col-md-5 col-sm-5 col-xs-12">
							<img src="{{ $data[1] }}" class="img-responsive img-map" alt="{{ @$data[2] }}">
						</div>
					</div>
				</div>
			</div>
		</div>
		@endif
	</div>
</div>