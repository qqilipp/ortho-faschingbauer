// alert( "Es tut." );

//------------------
// Functions
//------------------

// Main Nav
function mainnav() {
	$('#nav ul.menu').superfish();	
}

// Mobnav, Mobnav Sub
function mobnav() {

	// Navicon
	$('.navtrigger').click(
		function (e) {
		e.preventDefault();
		$('#navicon').toggleClass('active');
	    $('#mobnav').toggleClass('active');	
	    $('#mobolay').toggleClass('active');
	    $('body').toggleClass('stopoverflow');		    
	});
	
	// Mobnav Sub
	$('#mobnav ul.menu li ul').addClass('sub-menu');
	$('#mobnav ul.menu li ul').before('<div class="subnavicon"><span></span></div>');	
	
	$('#mobnav ul.menu>li.current-menu-item>.subnavicon').addClass('sub-menu-active');
	$('#mobnav ul.menu>li.current-menu-item>ul').addClass('sub-menu-active');
	$('#mobnav ul.menu>li.current-menu-item>ul').show();
	
	$('#mobnav ul.menu>li li.current-menu-item>.subnavicon').addClass('sub-menu-active');
	$('#mobnav ul.menu>li li.current-menu-item>ul').addClass('sub-menu-active');
	$('#mobnav ul.menu>li li.current-menu-item>ul').show();
	
	$('#mobnav ul.menu li.current-menu-ancestor>.subnavicon').addClass('sub-menu-active');
	$('#mobnav ul.menu li.current-menu-ancestor>ul').addClass('sub-menu-active');
	$('#mobnav ul.menu li.current-menu-ancestor>ul').show();	
	
	$('.subnavicon').on('click', function() {
	
		$(this).parent().toggleClass('has-sub-menu-active');		
		$submenu = $( this ).parent().children('.sub-menu');
				
		$(this).add($submenu).parent().siblings().removeClass('has-sub-menu-active');
		$(this).add($submenu).parent().siblings().children('ul').removeClass('sub-menu-active');
		$(this).add($submenu).parent().siblings().children('ul').slideUp('200');
		$(this).add($submenu).parent().siblings().children('.subnavicon').removeClass('sub-menu-active');
		
		$(this).add($submenu).toggleClass('sub-menu-active');
		if ($submenu.hasClass('sub-menu-active')) {
		    $submenu.slideDown('slow');
		} else {
		    $submenu.slideUp('slow');
		}
				
    });
    
    
    $('.showform').click(
		function (e) {
		e.preventDefault();
		$('#formbox').toggleClass('active');
		$('body').toggleClass('stopoverflow');		    
	});
	
	$('.hideform').click(
		function (e) {
		e.preventDefault();
		$('#formbox').removeClass('active');
		$('body').removeClass('stopoverflow');		    
	});

}

// Soft Scroll
function scrolly() {
	// var scrollHeaderHeight = $('#header').innerHeight();
	$(".scrolly").click(function(event){
        event.preventDefault();
        var dest=0;
        if($(this.hash).offset().top > $(document).height()-$(window).height()){
            dest=$(document).height()-$(window).height();
        }else{
	    	if ($(window).width() < 1024) {
            	dest=$(this.hash).offset().top - 80;   // scrollHeaderHeight
            } else {
	            dest=$(this.hash).offset().top - 90;  // scrollHeaderHeight
            }
        }
        $('html,body').animate({scrollTop:dest}, 500,'linear');
    });
    
    $(".scrollto a").click(function(event){
        event.preventDefault();
        $('#navicon').removeClass('active');
	    $('#mobnav').removeClass('active');	
	    $('#mobolay').removeClass('active');
	    $('body').removeClass('stopoverflow');
        var dest=0;
        if($(this.hash).offset().top > $(document).height()-$(window).height()){
            dest=$(document).height()-$(window).height();
        }else{
	    	if ($(window).width() < 1024) {
            	dest=$(this.hash).offset().top - 66;   // scrollHeaderHeight
            } else {
	            dest=$(this.hash).offset().top - 90;  // scrollHeaderHeight
            }
        }
        $('html,body').animate({scrollTop:dest}, 500,'linear');
    });
}

function readmore() {
	$('.antwort').hide();
	
	$('.frage').click(
		function (e) {
		e.preventDefault();
		// if( $(this).hasClass('active') ){
		// 	$('html,body').animate({scrollTop: '+=0px'}, 500,'linear');
		// } else {
		// 	$('html,body').animate({scrollTop: '+=100px'}, 500,'linear');
		// }
		$(this).parent().toggleClass('faqactive');
		$(this).toggleClass('active');
	    $(this).next().toggleClass('active');
	    $(this).next().toggle(250);
	});	
}

// Equal Heights
equalheight = function(container){

var currentTallest = 0,
	currentRowStart = 0,
    rowDivs = new Array(),
    $el,
    topPosition = 0;

	$(container).each(function() {
		$el = $(this);
		$($el).height('auto')
		topPostion = $el.position().top;
	
		if (currentRowStart != topPostion) {
	    	for (currentDiv = 0 ; currentDiv < rowDivs.length ; currentDiv++) {
			rowDivs[currentDiv].height(currentTallest);
	    }
	    rowDivs.length = 0;
	    currentRowStart = topPostion;
	    currentTallest = $el.height();
	    rowDivs.push($el);
		} else {
	    	rowDivs.push($el);
			currentTallest = (currentTallest < $el.height()) ? ($el.height()) : (currentTallest);
		}
		for (currentDiv = 0 ; currentDiv < rowDivs.length ; currentDiv++) {
	    	rowDivs[currentDiv].height(currentTallest);
		}
	});
}


//------------------
// Calls
//------------------

$(document).ready(function () {
	mainnav();
	mobnav();
	scrolly();	
	readmore();
	
	$("#main iframe").wrap("<div class='video'/>");
	
	$('a').each(function() {
	   var a = new RegExp('/' + window.location.host + '/');
	   if (!a.test(this.href)) {
	      $(this).attr("target","_blank");
	   }
	});
	
	$('a[href$=".pdf"]').attr('target','_blank');
	
	$( ".js-acc_item" ).contentToggle( {
		independent: true,
		toggleOptions: {
			duration: 400
		}
	});
	
	// CAROUSEL, SLIDER 
	$('.owl-mainslider').owlCarousel({
		items:				1,
		margin:				0,
		autoplay: 			true,
		// autoplaySpeed: 	500,
		responsiveClass: 	true,
		nav:				false,
		dots: 				true,
		animateOut: 		'fadeOut',
		loop:				true,
		autoplayTimeout:	4000,
		autoplayHoverPause:	false		
	});
	
	
	// WAYPOINTS	
	// Basic Waypoint by ID
	
	var waypoint = new Waypoint({
		element: document.getElementById('scroll0'),
		handler: function(direction) {
			$('#totop').toggleClass('show');	
		}
	});
	
	var waypoint = new Waypoint({
		element: document.getElementById('scroll1'),
		handler: function(direction) {
			$('body').toggleClass('scroll1');	
		}
	});
	
	var waypoint = new Waypoint({
		element: document.getElementById('scroll2'),
		handler: function(direction) {
			$('body').toggleClass('scroll2');	
		}
	});
	
});

$(window).load(function() {
	equalheight('.heights .height');
	equalheight('.teasers .teaser');
});

$(window).resize(function() {
	$('#nav .sub-menu').hide();
	equalheight('.heights .height');
	equalheight('.teasers .teaser');
});

$(window).scroll(function() {  
    // totop();
    // bodyscroll();
});


