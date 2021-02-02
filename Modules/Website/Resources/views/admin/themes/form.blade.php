<div class="row">
	<div class="col-md-12 col-sm-12 col-xs-12">
		<form_title :label="'{{ trans('website::themes.form.title') }}'" v-model="form.title"></form_title>
	</div>
	<div class="col-md-6 col-sm-6 col-xs-12">
		<div class="form-group">
			<label>{{ trans('website::themes.form.font') }}:</label>
			<select name="fonts" class="form-control form-control-sm" v-model="form.config.font">
				<optgroup v-for="(fonts, key) in data_fonts" :label="key">
					<option v-for="(font, k) in fonts" :value="font">@{{ font }}</option>
				</optgroup>
			</select>
		</div>
	</div>
	<div class="col-md-6 col-sm-6 col-xs-12">
		<div class="form-group">
			<label>{{ trans('website::themes.form.size') }}:</label>
			<select name="fonts" class="form-control form-control-sm" v-model="form.config.size">
				<option value="8">8</option>
				<option value="9">9</option>
				<option value="10">10</option>
				<option value="11">11</option>
				<option value="12">12</option>
				<option value="13">13</option>
				<option value="14">14</option>
				<option value="15">15</option>
				<option value="16">16</option>
				<option value="17">17</option>
				<option value="18">18</option>
				<option value="19">19</option>
				<option value="20">20</option>
				<option value="21">21</option>
				<option value="22">22</option>
				<option value="23">23</option>
				<option value="24">24</option>
				<option value="25">25</option>
				<option value="26">26</option>
				<option value="27">27</option>
				<option value="28">28</option>
				<option value="29">29</option>
				<option value="30">30</option>
			</select>
		</div>
	</div>
	<div class="col-md-12 col-sm-12 col-xs-12">
		<fieldset class="content-group">
			<legend class="font-weight-bold text-uppercase">
				{{ trans('website::themes.form.color_website.title') }}
			</legend>
			<div class="row">
				<div class="col-md-12 col-sm-12 col-xs-12">
					<image_change v-model="form.config.color_website.background" :label="'{{ trans('website::themes.form.color_website.background') }}'"></image_change>
				</div>
				<div class="col-md-4 col-sm-4 col-xs-12">
					<form_color :color="form.config.color_website.color" v-model="form.config.color_website.color" :label="'{{ trans('website::themes.form.color_website.color') }}'" /> 
				</div>
			</div>
		</fieldset>

		<fieldset class="content-group">
			<legend class="font-weight-bold text-uppercase">
				{{ trans('website::themes.setting_color') }}
			</legend>
			<div class="row">
				<div class="col-md-4 col-sm-4 col-xs-12">
					<form_color :color="form.config.color_website.text_color" v-model="form.config.color_website.text_color" :label="'{{ trans('website::themes.form.color_website.text_color') }}'" /> 
				</div>
				<div class="col-md-4 col-sm-4 col-xs-12">
					<form_color :color="form.config.color_website.link_color" v-model="form.config.color_website.link_color" :label="'{{ trans('website::themes.form.color_website.link_color') }}'" />
				</div>
				<div class="col-md-4 col-sm-4 col-xs-12">
					<form_color :color="form.config.color_website.link_hover_color" v-model="form.config.color_website.link_hover_color" :label="'{{ trans('website::themes.form.color_website.link_hover_color') }}'" />
				</div>
			</div>
		</fieldset>
		
		<fieldset class="content-group">
			<legend class="font-weight-bold text-uppercase">
				{{ trans('website::themes.setting_price_color') }}
			</legend>
			<div class="row">
				<div class="col-md-4 col-sm-4 col-xs-12">
					<form_color :color="form.config.color_website.price_color" v-model="form.config.color_website.price_color" :label="'{{ trans('website::themes.form.color_website.price_color') }}'" />
				</div>
				<div class="col-md-4 col-sm-4 col-xs-12">
					<form_color :color="form.config.color_website.price_sale_color" v-model="form.config.color_website.price_sale_color" :label="'{{ trans('website::themes.form.color_website.price_sale_color') }}'" /> 
				</div>
			</div>
		</fieldset>

		<fieldset class="content-group">
			<legend class="font-weight-bold text-uppercase">
				{{ trans('website::themes.form.layout') }}
			</legend>
			<div class="row theme-check">
				<div class="col-md-3 col-sm-3 col-xs-12" v-for="item in layouts">
					<div class="item">
						<input type="radio" :id="item" v-model="form.config.layout" :value="item" />
						<label :for="item">
							<img :src="'/public/admin/assets/img/grid_'+item+'.png'" class="img-responsive" />
						</label>
					</div>
				</div>
			</div>
		</fieldset>
		<fieldset class="content-group mt-2">
			<legend class="font-weight-bold text-uppercase">
				{{ trans('website::themes.form.layout_box') }}
			</legend>
			<div class="row theme-check">
				<div class="col-md-4 col-sm-4 col-xs-12 mb-3" v-for="item in styles">
					<div class="item border border-dark">
						<input type="radio" :id="item" v-model="form.config.layout_box" :value="item" />
						<label :for="item" class="p-2 pl-0 pr-0">
							<img :src="'/public/admin/assets/img/'+item+'.png'" class="img-responsive" />
						</label>
					</div>
				</div>
			</div>
		</fieldset>
	</div>
</div>
@push('script')
<script type="text/javascript">
	var mix = {
		data: {
			layouts: ['w1000px', 'boxed', 'full', 'fullwidth'],
			styles: ['style1', 'style2', 'style3', 'style4', 'style5', 'style6', 'style7', 'style8', 'style9'],
			data_fonts: {!! json_encode(config('website.fonts')) !!},
			form: {
				title: '{{ @$theme->title }}',
				config: {!! !empty($theme->config) ? json_encode($theme->config) : json_encode(config('website.form_data')) !!}
			},
		},
		methods: {
			
		}
	}
</script>
@endpush