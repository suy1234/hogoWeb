<article data-aos="flip-right" class="section-img admin-website-edit" data-id="{{ $id }}">
	<div class="widget-wrapper animated">
		<h3 class="title title_left">{{ $data[0]['value'] }}</h3>
		<div class="inner">
			<form accept-charset='UTF-8' class='form-data' data-id="1" method='post'>
				<div class="group-input">
					<input type="hidden" name="type" value="newsletter" />
					<input type="email" required="required" name="email" id="contact_email" placeholder="" />
					<span class="bar"></span>
					<label>{{ $data[1]['value'] }}</label>
					<button type="submit" name="submit">
						<i class="{{ !empty($data[2]['value']) ? $data[2]['value'] : 'fa fa-paper-plane-o' }}"></i>
					</button>
				</div>
			</form>
		</div>
		<div class="caption text-left">{{ $data[3]['value'] }}</div>
	</div>
</article>
