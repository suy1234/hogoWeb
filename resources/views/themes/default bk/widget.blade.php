@extends('themes.layouts.master')
@section('content')

<section style="padding-top: 77px;">
	<div class="wrapper-banner wrapper-joomla wrapper-auto" style="background: url('/kh/992020/images/banner-formula-reg.jpg');    background-size: cover;">
		<div id="particle-canvas"></div>
		<div class="row">
			<div class="title" style="    position: relative;z-index: 15;">
				<div class="container">
					<div class="row">
						<div class="col-xs-12">
							<h1 class="slogan">Đăng ký hội viên</h1>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

@endsection
@push('script')
<script type="text/javascript" src="/public/web/cavan/rAF.js"></script>
<script type="text/javascript" src="/public/web/cavan/particle.canvas.js"></script>
<script type="text/javascript">
	var canvasDiv = document.getElementById('particle-canvas');
	var options = {
		particleColor: '#FFF',
		background: '/kh/992020/images/banner-formula-reg.jpg',
		interactive: true,
		speed: 'fast',
		density: 'high'
	};
	var particleCanvas = new ParticleNetwork(canvasDiv, options);
</script>
@endpush