(function($) {
 "use strict"

// Back to top
 	jQuery(window).scroll(function(){
	if (jQuery(this).scrollTop() > 1) {
			jQuery('.dmtop').css({bottom:"25px"});
		} else {
			jQuery('.dmtop').css({bottom:"-100px"});
		}
	});
	jQuery('.dmtop').click(function(){
		jQuery('html, body').animate({scrollTop: '0px'}, 800);
		return false;
	});
	
 //Tooltips 
    $('.topbar, .social, .image-caption, .bs-example-tooltips').tooltip({
      selector: "[data-toggle=tooltip]",
      container: "body"
    })

	$('.selectpicker').selectpicker({
		style: 'btn-primary',
		size: 4
	});

	$('.popover-test').popover()
	
	// popover demo
    $("[data-toggle=popover]")
      .popover()

// DM Menu
	jQuery('#nav').affix({
		offset: { top: $('#nav').offset().top }
	});

// Menu
	$(".panel a").click(function(e){
		e.preventDefault();
			var style = $(this).attr("class");
			$(".jetmenu").removeAttr("class").addClass("jetmenu").addClass(style);
		});
	$().jetmenu();

// Search
	var $ctsearch = $( '#dmsearch' ),
		$ctsearchinput = $ctsearch.find('input.dmsearch-input'),
		$body = $('html,body'),
		openSearch = function() {
			$ctsearch.data('open',true).addClass('dmsearch-open');
			$ctsearchinput.focus();
			return false;
		},
		closeSearch = function() {
			$ctsearch.data('open',false).removeClass('dmsearch-open');
		};

	$ctsearchinput.on('click',function(e) { e.stopPropagation(); $ctsearch.data('open',true); });

	$ctsearch.on('click',function(e) {
		e.stopPropagation();
		if( !$ctsearch.data('open') ) {

			openSearch();

			$body.off( 'click' ).on( 'click', function(e) {
				closeSearch();
			} );

		}
		else {
			if( $ctsearchinput.val() === '' ) {
				closeSearch();
				return false;
			}
		}
	});

// Fun Facts
	function count($this){
		var current = parseInt($this.html(), 10);
		current = current + 1; /* Where 50 is increment */
		
		$this.html(++current);
			if(current > $this.data('count')){
				$this.html($this.data('count'));
			} else {    
				setTimeout(function(){count($this)}, 50);
			}
		}        
		
		$(".stat-count").each(function() {
		  $(this).data('count', parseInt($(this).html(), 10));
		  $(this).html('0');
		  count($(this));
	});

// Rotate Text
	$('.flickr-gallery').each(function(){
		$(this).jflickrfeed({
			limit: 8, // how many pictures to display
			qstrings: {
			id: $(this).data('flickr-id')
		},
		itemTemplate: '<li><a href="{{image_b}}"><img alt="{{title}}" src="{{image_s}}" /></a></li>'
		});
	})

// Rotate Text
	$(".rotate").textrotator({
		animation: "flipUp",
		speed: 2000
	});

// FitDiv
	$(document).ready(function(){
	// Target your .container, .wrapper, .post, etc.
		$(".general_wrapper").fitVids();
		$(".blog-wrapper").fitVids();
	});

 })(jQuery);