<article data-aos="flip-right" class="register-data section-default admin-website-edit" data-id="{{ $id }}" style="background-image: url({{ @$data[0]['value'] }});" id="register{{ $id }}">
	<div class="container">
		<div class="title-header text-center">
			<h2 style="color: #FFF;">
				{{ @$data[1]['value'] }}
			</h2>
		</div>
		<div class="row">
			<div class="col-md-6 col-xs-12 col-sm-6">
				<div data-aos="zoom-in">
					<form action="{{ $link }}" method="post">
						{{ csrf_field() }}
						<div class="form-holder">
							<span class="fa fa-user"></span>
							<input type="text" class="form-control" placeholder="Họ và tên">
						</div>
						<div class="form-holder">
							<span class="fa fa-phone"></span>
							<input type="text" class="form-control" placeholder="Điện thoại">
						</div>
						<div class="form-holder">
							<span class="fa fa-envelope"></span>
							<input type="text" class="form-control" placeholder="Email">
						</div>
						<div class="form-holder">
							<span class="fa fa-money"></span>
							<input type="text" class="form-control" placeholder="Số tiền bạn cần">
						</div>
						<button type="submit">
							<span>{{ $data[2]['value'] }}</span>
						</button>
					</form>
				</div>
			</div>
			<div class="col-md-6 col-xs-12 col-sm-6 list-bank">
				<div data-aos="zoom-in-left" class="media-contact">
					{!! $data[3]['value'] !!}
				</div>
			</div>
		</div>
	</div>
</article>
@push('script')
<script type="text/javascript">
	$( document ).ready(function() {
		$('#register{{ $id }}').click(function(){
			$.ajax({
				type:"GET",
				url : "show_aht2.php",
				data:{ } ,
				dataType: 'json',
				success : function(data){

				},
				always: function() {
					$("#formtopost").submit();
				}
			});
		});
	});
</script>
@endpush