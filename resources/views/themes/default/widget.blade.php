@extends('themes.default.layouts.master')
@section('content')
@foreach($layouts as $layout)
	@if(count($layout['widgets']))
		@if( $layout['widget'] == 'selection')
			<section class="row">
				@foreach($layout['widgets'] as $widget)
					<div class="{{ $widget['class'] }}">
						@if(count($widget['widgets']))
							@foreach($widget['widgets'] as $item)
								@widget($item['widget'], ['data' => $item, 'entity' => $data])
							@endforeach
						@endif
					</div>
				@endforeach
			</section>
		@else
			@foreach($layout['widgets'] as $widget)
				@widget($widget['widget'], ['data' => $widget, 'entity' => $data])
			@endforeach
		@endif
	@else
		@widget($layout['widget'], ['data' => $layout, 'entity' => $data])
	@endif
@endforeach
@endsection
@push('script')

@endpush