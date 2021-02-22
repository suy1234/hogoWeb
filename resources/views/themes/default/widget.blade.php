@extends('themes.default.layouts.master')
@section('content')
<div id="home-page">
	<div class="row" style="margin: 0;">
		@foreach($layouts as $layout)
			<section class="{{ $layout['class'] }}" style="padding: 0">
				@if(count($layout['widgets']))
					@if( $layout['widget'] == 'selection')
						<section class="row">
							@foreach($layout['widgets'] as $widget)
								<div class="{{ $widget['class'] }}">
									@if(count($widget['widgets']))
										@foreach($widget['widgets'] as $item)
											@widget($item['widget'], ['data' => $item])
										@endforeach
									@endif
								</div>
							@endforeach
						</section>
					@else
						@foreach($layout['widgets'] as $widget)
							@widget($widget['widget'], ['data' => $widget])
						@endforeach
					@endif
				@endif
			</section>
		@endforeach
	</div>
</div>
@endsection
@push('script')

@endpush