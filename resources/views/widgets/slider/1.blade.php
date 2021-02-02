@php
	$data = !empty($data[0]['data'][0]) ? $data[0]['data'][0] : [];
@endphp
<div id="slider" class = "page-section admin-website-edit" data-id="{{ $id }}" data-aos="zoom-in">
	<div class="slider-parallax-inner">
		<div class="full-screen force-full-screen dark section nopadding nomargin noborder ohidden" style="background-image: url({{ @$data[4]['value'] }}); background-size: cover; background-position: center center;">
			<div class="container center">
				<div class="vertical-middle">
					<div class= "emphasis-title">
						<h1 class = "egaLadi_slideshow_header_1 animate__animated animate__bounceInRight">
							{{ @$data[0]['value'] }}
						</h1>						
						<h3 class = "egaLadi_slideshow_header_2 animate__animated animate__bounceInLeft">
							{{ @$data[1]['value'] }}
						</h3>
					</div>
					
					<div style = "position: relative" class="animate__animated animate__bounceInUp">
						<a href="{{ @$data[2]['value'] }}" title="{{ @$data[3]['value'] }}" data-scrollto = "#egaladi_portfolio" class="egaLadi_slideshow_btn_nav btn btn-light btn-circle" data-easing="easeInOutExpo" data-speed="1250" data-offset="35">
							{{ @$data[3]['value'] }}
						</a>
					</div>
					
				</div>
			</div>
			<a href="{{ @$data[2]['value'] }}" title="{{ @$data[3]['value'] }}" id="egaladi-portfolio" class="one-page-arrow dark animate__animated animate__zoomIn">
				<i class="fa fa-angle-down infinite animated fadeInDown"></i>
			</a>
			<svg class="svg-image-bottom-large-triangle" xmlns="http://www.w3.org/2000/svg" version="1.1" fill="#ffffff" width="100%" height="140" viewBox="0 0 4.66666 0.333331" preserveAspectRatio="none"><path class="fil0" d="M-0 0.333331l4.66666 0 0 -3.93701e-006 -2.33333 0 -2.33333 0 0 3.93701e-006zm0 -0.333331l4.66666 0 0 0.166661 -4.66666 0 0 -0.166661zm4.66666 0.332618l0 -0.165953 -4.66666 0 0 0.165953 1.16162 -0.0826181 1.17171 -0.0833228 1.17171 0.0833228 1.16162 0.0826181z"></path></svg>	
		</div>
	</div>
</div>