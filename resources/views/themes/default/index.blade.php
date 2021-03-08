@extends('themes.default.layouts.master')
@section('content')
<div id="home-page">
	@foreach($layouts as $key => $layout)
		<section class="home-page-{{ $key }}">
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
			@else
				@widget($layout['widget'], ['data' => $layout])
			@endif
		</section>
	@endforeach
</div>
@endsection
@push('script')

@endpush