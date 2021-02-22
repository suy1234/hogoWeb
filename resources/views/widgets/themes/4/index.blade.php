<article id="footer" class="clearfix">
	<div class="footer-bottom">
		<div class="container">
			<div class="row">
				<div class="col-sm-6 col-md-4 col-xs-12 clear-sm">
					{!! @$data[0] !!}
				</div>
				<div class="col-sm-6 col-md-2 col-xs-12 clear-sm">
					<div class="widget-wrapper animated">
						<h3 class="title title_left">{{ @$data[1][0] }}</h3>
						<div class="inner">
							<ul class="list-unstyled list-styled">
								@if(count(@$data[1][1]))
									@foreach(@$data[1][1] as $menu)
										<li>
											<a href="{{ $menu['url'] }}" title="{{ $menu['title'] }}" target="_blank" name="{{ $menu['title'] }}">{{ $menu['title'] }}</a>
										</li>
									@endforeach
								@endif
							</ul>
						</div>
					</div>
				</div>
				<div class="col-sm-6 col-md-3 col-xs-12 clear-sm">
					<div class="widget-wrapper animated">
						<h3 class="title title_left">{{ @$data[2][0] }}</h3>
						<div class="inner">
							<form accept-charset='UTF-8' action='/account/contact' class='contact-form' method='post'>
								<input name='form_type' type='hidden' value='customer'>
								<input name='utf8' type='hidden' value='✓'>

								<div class="group-input">
									<input type="hidden" id="contact_tags" name="contact[tags]" value="new _alert" />
									<input type="hidden" id="contact_tags" name="contact[alert]" value="{{ @$data[2][3] }}" />
									<input type="email" required="required" name="contact[email]" id="contact_email" />
									<span class="bar"></span>
									<label>{{ @$data[2][1] }}</label>
									<button type="submit"><i class="fa fa-paper-plane-o"></i>
									</button>
								</div>
							</form>
							<div class="caption">{{ @$data[2][2] }}</div>
						</div>
						<div id="widget-social" class="social-icons">
							<ul class="list-inline">
								@if(!empty($data[2][4]))
								@foreach(@$data[2][4] as $social)
									@if(!empty($social['value']))
										<li>
											<a target="_blank" rel="nofollow" href="{{ $social['value'] }}" class="social-wrapper {{ $social['icon'] }}">
												<span class="social-icon">
													<i class="{{ $social['icon'] }}"></i>
												</span>
											</a>
										</li>
									@endif
								@endforeach
								@endif
							</ul>
						</div>
					</div>
				</div>

				<div class="col-sm-6 col-md-3 col-xs-12 clear-sm">
					<div class="widget-wrapper animated">
						<h3 class="title title_left">{{ @$data[3][0]['value'] }}</h3>
						<div class="inner">
							{!! @$data[3][1]['value'] !!}
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="footer-copyright">
		<div class="container copyright" style="background: inherit;">
			{!! @$data[4][0]['value'] !!}
		</div>
	</div>
</article>

<a id="back-top">
	<i class="{{ @$data[5][0] }}"></i>
</a>