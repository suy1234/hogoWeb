function menuShow(){
	$("body").addClass("open-menu");}
	function menuClose()
	{$("body").removeClass("open-menu");
}
if($('.opacity_menu')){
	$('.menu-bar-h a').click(function(e){
		$('#nav-mobile').addClass('open_sidebar_menu');
		$('.opacity_menu').toggleClass('open_opacity');
	});
	$('.opacity_menu').click(function(e){
		$('.menu_mobile').removeClass('open_sidebar_menu'); 
		$('.opacity_menu').removeClass('open_opacity');
	});  
	$('.ul_collections li > .fa').click(function(){
		$(this).parent().toggleClass('current');
		$(this).toggleClass('fa-angle-down fa-angle-up');
		$(this).next('ul').slideToggle("fast");
		$(this).next('div').slideToggle("fast");
	});
}