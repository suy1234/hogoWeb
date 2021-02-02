<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="csrf-token" content="{{ csrf_token() }}" />
	<link rel="shortcut icon" href="{{ @$default['header']['config']['icon'] }}">
	@if(!empty($seo))<title>{{ $seo['title'] }}</title> 
	<meta name="description" content="{{ $seo['description'] }}" />
	<!-- Schema.org markup for Google+ --> 
	<meta itemprop="name" content="{{ $seo['title'] }}">
	<meta itemprop="description" content="{{ $seo['description'] }}">
	<meta itemprop="keyword" content="{{ $seo['title'] }}, {{ $seo['keyword'] }}">
	<meta itemprop="image" content="{{ url('/') }}{{ $seo['img'] }}"> 
	<!-- Twitter Card data --> 
	<meta name="twitter:card" content="summary_large_image"> 
	<meta name="twitter:title" content="{{ $seo['title'] }}"> 
	<meta name="twitter:description" content="{{ $seo['description'] }}">
	<meta name="twitter:image:src" content="{{ url('/') }}{{ $seo['img'] }}"> 
	<!-- Open Graph data -->
	<meta property="og:title" content="{{ $seo['title'] }}" /> 
	<meta property="og:type" content="article" />
	<link rel="canonical" href="{{  url()->full() }}" />
	<meta property="og:url" content="{{  url()->full() }}" /> 
	<meta property="og:image" content="{{ url('/') }}{{ $seo['img'] }}" />
	<meta property="og:description" content="{{ $seo['description'] }}" /> 
	<meta property="og:site_name" content="{{ url('/') }}" />
	<?php if(isset($seo['modified_time'])){ ?>
	<meta property="article:published_time" content="{{ $seo['published_at'] }}" />
	<meta property="article:modified_time" content="{{ $seo['updated_at'] }}" />
	<?php } ?>
	<meta property="article:section" content="{{ $seo['description'] }}" />
	<meta property="article:tag" content="{{ $seo['title'] }}, {{ $seo['keyword'] }}" />
	<meta property="fb:admins" content="{{ appID()['facebook'] }}" />
	@endif
	<link rel="stylesheet" type="text/css" href="/public/web/fontawesome/styles.min.css" media="all">
	<link rel="stylesheet" type="text/css" href="/public/web/animate.min.css" media="all">
	<link rel="stylesheet" type="text/css" href="/public/web/alocool/alocool.css" media="all">
	<link rel="stylesheet" type="text/css" href="/public/web/aos/aos.css" media="all">
	<link rel="stylesheet" type="text/css" href="/kh/992020/vendor/slick/slick.css" media="all">
	<link rel="stylesheet" type="text/css" href="/public/web/bootstrap/bootstrap.min.css" media="all">
	<link rel="stylesheet" type="text/css" href="/kh/992020/css/style.css" media="all">
	<link rel="stylesheet" type="text/css" href="/kh/992020/css/custom.css" media="all">
	<style type="text/css">
		body{
			font-family: 'Roboto' !important;
		}
		img{
			height: auto;
		}
		.mid-header .content_header .searchbox .search-box{
			width: auto;
		}
		.mid-header .content_header .searchbox .search-box .header-search{
			right: -40px;
		}
		.header.header-active{
			background: #2f3043;
		}
		.page-content{
			padding-top: 77px;
		}
		.page-content .p-2{
			padding: 15px 0;
		}
		.page-content .content{
			text-align: justify;
		}
		.page-content .content img{
			margin: auto;
			width: 100%;
			text-align: center;
		}
		@-webkit-keyframes xoayvong{
			from{
				-webkit-transform:rotate(0deg);
				-moz-transform:rotate(0deg);
				-o-transform:rotate(0deg);
			}
			to{
				-webkit-transform:rotate(360deg);
				-moz-transform:rotate(360deg);
				-o-transform:rotate(360deg);
			}
		}
		@keyframes xoayvong {
			from{
				-webkit-transform:rotate(0deg);
				-moz-transform:rotate(0deg);
				-o-transform:rotate(0deg);
			}
			to{
				-webkit-transform:rotate(360deg);
				-moz-transform:rotate(360deg);
				-o-transform:rotate(360deg);
			}
		}
		.page-loading{
			background: #cee7ef;
			position: fixed;
			height: 100vh;
			width: 100%;
			z-index: 99999999;
		}
		.page-loading .icon{
			position: absolute;
			width: 100%;
			text-align: center;
			top: 50%;
			left: 50%;
			-webkit-transform: translate(-50%, -100%);
			transform: translate(-50%, -100%);
		}
		.page-loading .icon img{
			animation: xoayvong 1s linear 0s infinite;
			-webkit-animation: xoayvong 1s linear 0s infinite;
			-moz-animation: xoayvong 1s linear 0s infinite;
			-o-animation: xoayvong 1s linear 0s infinite;
		}
		.page-content {}
		.slick-prev, .slick-next{
			z-index: 99 !important;
		}
		.slick-prev:before, .slick-next:before{
			font-size: 40px;
			opacity: 1;
			color: #2674be;
		}

		.navbar-inner-left .mega-left-title .sb-title {
			margin-bottom: 10px;
			font-size: 16px;
			line-height: 20px;
			font-weight: 500;
			text-transform: uppercase;
			text-align: left;
			position: relative;
			border-bottom: 1px solid #5ecfef;
			padding-bottom: 10px;
		}
		.navbar-inner-left .sidebar {
			width: 100%;
		}
		.navbar-inner-left .sidebar li ul li a {
			border-bottom: 1px dashed #5ecfef;
			color: #000;
		}
		.navbar-inner-left .sidebar li ul li a:hover {
			color: #5ecfef;
		}
	</style>
	<style>
		:root {
			--header-background-default: ;
			--header-border-extra: ;
			--header-background-default: ;
			--header-background-extra: ;
			--header-text-extra: ;
			--header-border: ;
			--header-text-default: #FFF;
			--header-text-hover: #5ecfef;
			--header-text-active: #FFF;

			--background:#fff;
			--font-family: 'Roboto' !important;
			--font-size: 14px;
			--btn-default: #5ecfef;
			--btn-color-default: #fff;
			--btn-hover: #2674be;
			--btn-color-hover: #fff;

			--border-default: #2674be;
			--border-hover: #68c9f6;

			--footer-background: #212121;
			--footer-text-default: #9e9e9e;
			--footer-text-hover: #fff;
			--footer-border: #2674be;
			--footer-border-hover: #2674be;

			--footer-background-extra: #111;
			--footer-text-extra: #9e9e9e;
			/*--foo*/
		</style>
		@stack('style')
	</head>
	<body>
		<div class="page-loading">
			<div class="icon">
				<img src="{{ @$default['header']['config']['icon'] }}" class="img-responsive">
			</div>
		</div>
		<div id="app-edit-web-admin">
			@widget('header', ['data' => $default['header']['config'], 'active' => @$header_active])
			<section>
				@yield('content')
			</section>
			@widget('footer', ['data' => $default['footer']['config']])

			@if(!empty(auth()->user()->id) && auth()->user()->hasAccess('admin.menus.index'))
			<div class="admin-page-backgroup">
				<i class="fa fa-spinner fa-pulse"></i>
			</div>
			<div class="admin-edit-page">
				<a href="" class="close-admin">
					<i class="fa fa-times-circle"></i>
				</a>
				<div id="form-html">
					<template v-for="(item, key) in data_forms">
						<images_tools v-model="item.img"  v-if="typeof(item['img']) != 'undefined'"></images_tools>
						<div class="form-group" v-if="typeof(item['title']) != 'undefined' && item['title'] !== null">
							<label for="code">{{ trans('main.form.title') }}<code>*</code></label> 
							<input type="text" class="form-control form-control-sm" v-model="item.title" placeholder="">
						</div>

						<div class="form-group" v-if="typeof(item['link']) != 'undefined' && item['link'] !== null">
							<label for="code">{{ trans('main.form.link') }}<code>*</code></label> 
							<input type="text" class="form-control form-control-sm" v-model="item.link" placeholder="">
						</div>

						<div class="form-group" v-if="typeof(item['btn']) != 'undefined' && item['btn'] !== null">
							<label for="code">{{ trans('main.form.btn') }}<code>*</code></label> 
							<input type="text" class="form-control form-control-sm" v-model="item.btn" placeholder="">
						</div>
						<div class="form-group" v-if="typeof(item['description']) != 'undefined' && item['description'] !== null">
							<label for="code">{{ trans('main.form.description') }}<code>*</code></label> 
							<textarea class="form-control form-control-sm" v-model="item.description"></textarea>
						</div>
						
						<div class="view" v-if="typeof(item['view']) != 'undefined' && item['view'] !== null">
							<p class="view-item">
								<strong>
									{{ trans('main.form.view') }}
								</strong>
							</p>
							<div class="form-group">
								<input type="text" class="form-control form-control-sm" v-model="item.view.title" placeholder="{{ trans('main.form.title') }}">
							</div>
							<div class="form-group">
								<input type="link" class="form-control form-control-sm" v-model="item.view.link" placeholder="{{ trans('main.form.link') }}">
							</div>
						</div>

						<div class="form-group" v-if="typeof(item['content']) != 'undefined' && item['content'] !== null">
							<label for="title">{{ trans('main.form.content') }}</label> 
							<tinymce v-model="item.content" class="tinymce"></tinymce>
						</div>
						
						<template v-if="typeof(item['table_data']) != 'undefined' && item['table_data'] !== null">
							<div class="form-group" v-if="typeof(item['table_data']['categorys']) != 'undefined' && item['table_data']['categorys'] !== null">
								<label class="control-label" for="category">
									{{ trans('main.form.category') }}
								</label>
								<select class="form-control form-control-sm" v-model="item.category_id">
									<option value="">{{ trans('validation.attributes.select') }}</option>
									<option v-for="(value, key_item) in item.table_data.categorys" :value="key_item">
										@{{ value }}
									</option>
								</select>
							</div>
							<div class="form-group" v-if="typeof(item['table_data']['groups']) != 'undefined' && item['table_data']['groups'] !== null">
								<label class="control-label" for="group">
									{{ trans('main.form.group') }}
								</label>
								<select class="form-control form-control-sm" v-model="item.group_id">
									<option value="">{{ trans('validation.attributes.select') }}</option>
									<option v-for="(value, key_item) in item.table_data.groups" :value="key_item">
										@{{ value }}
									</option>
								</select>
							</div>
						</template>

						<template v-if="typeof(item['items']) != 'undefined' && item['items'] !== null">
							<div class="view" v-for="(value, key_in) in item.items">
								<images_tools v-model="value.img"  v-if="typeof(value['img']) != 'undefined'"></images_tools>
								<div class="form-group">
									<input type="text" class="form-control form-control-sm" v-model="value.title" placeholder="{{ trans('main.form.title') }}">
								</div>
								<div class="form-group">
									<textarea class="form-control form-control-sm" v-model="value.description" placeholder="{{ trans('main.form.description') }}"></textarea>
								</div>
							</div>
							<div class="text-right">
								<button class="btn btn-primary btn-xs" v-on:click="addItems()"><i class="icon-plus3"></i> Thêm</button>
							</div>
						</template>

					</template>
				</div>
				<div class="submit-btn">
					<button class="btn btn-primary btn-sm" v-on:click="save">
						Lưu
					</button>
				</div>
			</div>
			@endif
			
		</div>

		<script type="text/javascript" src="/public/web/jquery/jquery.js"></script>
		<script type="text/javascript" src="/public/web/bootstrap/js/bootstrap.min.js"></script>
		<script type="text/javascript" src="/public/web/aos/aos.js"></script>
		<script type="text/javascript" src="/public/web/slick/slick.min.js"></script>
		@stack('script')
		<script type="text/javascript">
			$(document).ready(function() {
				$('.slick-slider').slick({
					dots: true,
				});
				$('.slick-banner').slick({
					dots: true,
					slidesToShow: 3,
					slidesToScroll: 3,
					responsive: [
					{
						breakpoint: 1024,
						settings: {
							slidesToShow: 3,
							slidesToScroll: 3
						}
					},
					{
						breakpoint: 600,
						settings: {
							slidesToShow: 2,
							slidesToScroll: 2
						}
					},
					{
						breakpoint: 480,
						settings: {
							slidesToShow: 1,
							slidesToScroll: 1
						}
					}
					]
				});
				$('.post-slider .slick').slick({
					dots: false,
					slidesToShow: 3,
					slidesToScroll: 3,
					responsive: [
					{
						breakpoint: 1024,
						settings: {
							slidesToShow: 3,
							slidesToScroll: 3
						}
					},
					{
						breakpoint: 600,
						settings: {
							slidesToShow: 2,
							slidesToScroll: 2
						}
					},
					{
						breakpoint: 480,
						settings: {
							slidesToShow: 1,
							slidesToScroll: 1
						}
					}
					]
				});
			});

			AOS.init();
			$("#back-top").click(function() {
				$("html, body").animate({ scrollTop: 0 }, "slow");
				return false;
			});
			$("#bacgrp-mobile").click(function(event) {
				$('.menu_mobile').removeClass('open_sidebar_menu');
				$("#bacgrp-mobile").css('display', 'none');
			});
			$(".menu-bar-h a").click(function(event) {
				event.preventDefault();
				$('.menu_mobile').addClass('open_sidebar_menu');
				$("#bacgrp-mobile").css('display', 'block');
			});
			$(window).scroll(function() {
				if($(this).scrollTop() > 100) {
					$("#back-top").fadeIn();
					$(".header").addClass('active');
				}else{
					$("#back-top").fadeOut();
					$(".header").removeClass('active');
				}
			});
			function showAloCall() {
				if ( $('.cool-alo-ph-img-circle36').hasClass("cool-down-img") ) {
					$('.cool-alo-ph-img-circle36').removeClass('cool-down-img');
					$('#alocool-actions').css({
						overflow: 'hidden',
						opacity: 0,
					});
				}else{
					$('.cool-alo-ph-img-circle36').addClass('cool-down-img');
					$('#alocool-actions').css({
						overflow: 'visible',
						opacity: 1,
					});
				}
			}
			$('.page-loading').css('display', 'none');
		</script>
		<div id="fb-root"></div>
		<script>(function(d, s, id) {
			var js, fjs = d.getElementsByTagName(s)[0];
			if (d.getElementById(id)) return;
			js = d.createElement(s); js.id = id;
			js.src = 'https://connect.facebook.net/vi_VN/sdk/xfbml.customerchat.js#xfbml=1&version=v2.12&autoLogAppEvents=1';
			fjs.parentNode.insertBefore(js, fjs);
		}(document, 'script', 'facebook-jssdk'));</script>
		@include('themes.layouts.edit_page')
	</body>
</html>