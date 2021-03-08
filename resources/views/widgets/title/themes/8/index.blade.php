@if(count($data))
<div class="breadcrumb_background" style="background-image:url({{ !empty($data[0]['gallerys']) ? $data[0]['gallerys'][0] : '' }})">
	<div class="title_full">
		<div class="container a-center">
			<h1 class="title_page">{{ @$data[0]['breadcrumb']['this_breadcrumb']['title'] }}</h1>
		</div>
	</div>
</div>
<section class="bread-crumb">
	<span class="crumb-border"></span>
	<div class="container">
		<div class="row">
			<div class="col-xs-12 a-left">
				<ul class="breadcrumb">	
					@foreach(@$data[0]['breadcrumb']['list'] as $link)				
					<li>
						<a href="{{ $link['link'] }}" title="{{ $link['title'] }}">{{ $link['title'] }}</a>
						<span class="mr_lr">&nbsp;/&nbsp;</span>
					</li>
					@endforeach
					<li><strong>{{ @$data[0]['breadcrumb']['this_breadcrumb']['title'] }}</strong></li>
				</ul>
			</div>
		</div>
	</div>
</section>
@endif