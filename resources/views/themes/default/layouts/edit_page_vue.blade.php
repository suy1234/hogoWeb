@if(!empty(auth()->user()->id) && auth()->user()->hasAccess('admin.layouts.design'))
<div class="admin-page-backgroup">
	<i class="fa fa-spinner fa-pulse"></i>
</div>
<div class="admin-edit-page">
	<a href="" class="close-admin">
		<i class="fa fa-times-circle"></i>
	</a>
	<div id="form-html" v-if="form.widget">
		<template v-if="form.config">
			<template  v-for="(item, key) in form.config">
				<template v-if='has_database'>
					<template v-if="!item.length">
						<component :is="'form_'+item.widget" :label="item.label" v-model="item.value"></component>
					</template>
					<template v-else>
						<div class="card">
							<div class="card-header">
								<h6 class="card-title">
									<a class="text-default collapsed" data-toggle="collapse" :href="'#accordion-group'+key" aria-expanded="false">Vị trí: @{{ key }}</a>
								</h6>
							</div>

							<div :id="'accordion-group'+key" class="collapse" style="">
								<div class="card-body">
									<template  v-for="value in item">
										<component :is="'form_'+value.widget" :label="value.label" v-model="value.value"></component>
									</template>
								</div>
							</div>
						</div>
					</template>
					
					<hr>
				</template>
				<template v-else>
					<template v-if="item.data">
						<template  v-for="value in item.data">
							<template  v-for="val in value">
								<component :is="'form_'+val.widget" :label="val.label" v-model="val.value"></component>
							</template>
						</template>
					</template>
					<template v-else>
						<component :is="'form_'+item.widget" :label="item.label" v-model="item.value"></component>
					</template>
				</template>
			</template>

		</template>
		<template v-else>
			<component :is="'form_'+form.widget" :label="form.config.label" v-model="form.config.value"></component>
		</template>

	</div>
	<div class="submit-btn">
		<button class="btn btn-primary btn-sm" v-on:click="save">
			Lưu
		</button>
	</div>
</div>
@endif