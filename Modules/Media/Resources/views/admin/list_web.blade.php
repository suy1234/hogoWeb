<div class="card gallery gallery-web" id="media-data">
	<div class="card-body media-tabs">
		<div>
			<ul class="nav nav-tabs nav-tabs-bottom">
				<li class="nav-item active">
					<a id="showCrop" class="nav-link active" href="#gallery" data-toggle="tab" aria-expanded="false">
						<span class="icon-images3 mg-right-10"></span>
						<span>Thư viện ảnh</span>
					</a>
				</li>
				<li class="nav-item">
					<a href="#upload" class="nav-link" data-toggle="tab" aria-expanded="false">
						<span class="icon-upload mg-right-10"></span>
						<span>Tải ảnh lên</span>
					</a>
				</li>
			</ul>
			<div class="tab-content gallery-body" style="margin: 5px;">
				<div class="tab-pane fade in active" id="gallery">
					<div class="row">
						<div class="col-xs-12 col-sm-6 col-md-6">
							<form v-on:submit.prevent="filterData">
								<div class="form-group form-group-feedback form-group-feedback-right">
									<input type="text" class="form-control form-control-sm" placeholder="{{ trans('validation.attributes.find') }}" v-model="pagination.keyword">
									<div class="form-control-feedback form-control-feedback-sm"  v-on:click="filterData">
										<i class="icon-search4" style="font-size: 12px;"></i>
									</div>
								</div>
							</form>
						</div>
					</div>
					<div class="list-body">
						<div class="list-body-scroll">
							<div v-for="(item, index) in pagination.data" v-tooltip :title="item.name" placement="left" class="item"  @click.stop.prevent="_select(item)" :class="{'active' : _isSelected(item.id)}">
								<div class="item-inner">
									<img :src="item.path" alt="">
								</div>
								<a class="btn btn-check" >
									<i  class="fa fa-check-circle" ></i>
								</a>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-xs-12 col-sm-12 col-md-6 text-right">
							<template v-if="pagination.limit > 1">
								<p class="pageView">
									Tổng số dòng: 
									<strong class="text-danger">@{{ pagination.limit | money }}</strong>. 
									Số dòng đang xem:
									<strong class="text-danger">@{{ data.length | money }}</strong>
								</p>
							</template>
						</div>
						<div class="col-xs-12 col-sm-12 col-md-6 text-right sm-text-center">
							<pagination :current="pagination.current" v-model="pagination.page" :total="pagination.total"></pagination>
						</div>
					</div>
					<div class="list-footer text-right">
						<button class="btn btn-success pull-right" :disabled="!selected.length" @click.stop.prevent="_useSelect()">
							<i class="icon-check2"></i> Sử dụng những ảnh đã chọn
						</button>
					</div>
				</div>
				<div class="tab-pane" id="upload">
					<div class="list-body">
						<div class="row">
							<input id="componentUpdateFile" class="d-none hidden" type="file"  @change="_change($event)" accept="image/*" multiple="multiple">
							<div  class="col-xs-12 col-md-12"  @dragover.prevent @drop="_onDrop($event)">
								<div class="form-group input-group-sm">
									<input type="text" class="form-control text-center" v-model="upload.title" placeholder="{{ trans('media::medias.upload.title') }}">
								</div>
								<div class="drop-container">
									<div class="drop-container-content">
										<i class="icon-upload"></i>
										<h4>{{ trans('media::medias.upload.note_upload') }}</h4>
										<p>{{ trans('media::medias.upload.note_move_upload') }}</p>
										<p>
											<label for="componentUpdateFile" class="btn btn-custom">
												{{ trans('media::medias.upload.btn_update') }}
											</label>
										</p>
									</div>
								</div>
							</div>
							<div class="col-xs-12 col-md-12" >
								<div class="list-upload-file">
									<template v-if="upload.data.length">
										<template v-for="(item, index) in upload.data">
											<div class="item-upload">
												<div class="item-upload-container">
													<a href="#" class="btn-remove" v-if="!upload.isLoading" @click.stop.prevent="upload.data.splice(index , 1)">
														<i class="icon-cancel-circle2 text-danger"></i>
													</a>
													<div class="item-upload-inner">
														<div class="item-upload-thumb">
															<div class="item-upload-info">
																<span class="item-upload-info-title">
																	<b>@{{ (item.title) ? item.title : item.name }}</b>
																</span>
																<span class="item-upload-info-size">
																	@{{item.size | money}} Bytes
																</span>
															</div>
															<div class="item-upload-thumb-image">
																<img :src="item.url" alt="">
															</div>
														</div>
														<div class="item-upload-progress" v-if="upload.isLoading">
															<div class="progress" style="height: 0.375rem;">
																<div class="progress-bar progress-bar-striped progress-bar-animated bg-success"  :style="{ width : item.complete + '%' }"></div>
															</div>
														</div>
													</div>
												</div>
											</div>
										</template>
									</template>
								</div>
							</div>
						</div>
					</div>
					<div class="list-footer">
						<div class="text-right">
							<button class="btn btn-warning" :disabled="!upload.data.length" @click="_upload()">
								<i class="icon-upload"></i>
								&nbsp; Tải lên
							</button>
						</div>
					</div>
				</div>
				<div class="tab-pane" id="crop">
					<vue-croppie   ref="VueCroppie" :config="cropperConfig" ></vue-croppie>
				</div>
			</div>
		</div>
	</div>
</div>
@if(empty($modal))
@push('script')
@include('media::admin.script')
@endpush
@else
@include('media::admin.script', ['modal' => true])
<script type="text/javascript">
	function GalleryApp(element){
		var timeout = null;
		return new Vue(mix);
	}
	var VueGallery = GalleryApp('#media-data');
</script>
@endif
