const SUBSCRIPTION_CONST = {
	'name'       : 'Name',
	'email'      : 'Email',
	'start_date' : 'Start Date',
	'end_date'   : 'End Date',
	'oss'        : 'OSS'
};
/**
 * Global Variables
 */
// bug patch, unsubscribe function
var selectedUser = '';

/**
 * Loader spinner
 *
 */
$(window).bind("load", function() {

	"use strict";

		if ( $(".spn_hol").length ) {
			$(".spn_hol").fadeOut(1000);
		}
});

/**
 * Email validator
 *
 */
function validateEmail(email) {
	var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
	return re.test(email);
}

/**
 * Zoom in about NEC presentation
 *
 */
function viewImage ( src ) {
	$('#img-src').attr('src', src);
	$('#mission-vision-image-viewer').modal('show');
}

/**
 * Show or hide error/success message in subscription
 *
 */

// by default, this function expects isError === true
function toggleMessages ( isError, message, class1, class2 ) {
		var className1 = class1;
		var className2 = class2;

		if ( !isError ) {
			className1 = class2;
			className2 = class1;
		}

		$( className1 ).removeClass( 'hide' );
		$( className1 ).text( message );
		if ( !$( className2 ).hasClass( 'hide' ) ) {
			$( className2 ).addClass( 'hide' );
		}
}

function applyDatatables ( className ) {
	if ( $( className ).length ) {
		$( className ).addClass( 'fontAwesomeSorting' );

		var t = $( className ).DataTable( {
				"columnDefs": [ {
						"searchable": false,
						"orderable": false,
						"targets": 0
				} ],
				"order": [[ 1, 'asc' ]]
		} );

		t.on( 'order.dt search.dt', function () {
				t.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
						cell.innerHTML = i+1;
				} );
		} ).draw();
	}
}

function confirmUnsubscribe ( ossid, userid ) {
	$( '#confirmUS-modal' ).modal( 'show' );

	$( '.confirm-unsubscribe-btn' ).click( function () {
		return $.ajax( {
			// url     : '../api/bug-patches/unsubscribe.php?user_id=' + userid + '&oss_id=' + ossid,
			url     : ajaxUrl + '?user_id=' + userid + '&oss_id=' + ossid + '&action=unsubscribe',
			type    : 'GET',
			success : function( data ) {
				var result = JSON.parse( data );

				toggleMessages( false, 'Successfully removed.', '.unsubscribe-error', '.unsubscribe-success' );
				$('#confirmUS-modal').modal('hide');
				getAllOss( userid );
			}
		} );
	} );
}

/**
 * Get all Oss that are subscribed from that specific user
 *
 */
function getAllOss ( id ) {
	return $.ajax( {
		url     : ajaxUrl + '?user_id=' + id + '&action=get_all_oss',
		type    : 'GET',
		success : function( data ) {
			var result = JSON.parse( data );

			if ( $( '.unsubscribe_dataTables tbody' ).children().length ) {
				$('.unsubscribe_dataTables').empty();
				$('.unsubscribe_dataTables').dataTable().fnDestroy();
			}

			result.map( function ( value ) {
				$( '.unsubscribe_dataTables' ).append( '<tr>'
						+ '<td style="width: 28px!important;" class="va-middle"></td>'
						+ '<td style="width: 696px!important;" class="va-middle">' + value.oss_name + '</td>'
						+ '<td style="width: 79px!important;" class="va-middle ta-center"><button type="button" class="btn btn-danger remove" onclick="confirmUnsubscribe( ' + value.oss_id + ', ' + id + ' )">Remove</button></td>' +
					'</tr>' );
			} );
			applyDatatables( '.unsubscribe_dataTables' );
			$( '#oss-table' ).removeClass( 'hidden' );
		}
	} );
}

function clearSubscriptionFields () {
	$( '#oss-table' ).addClass( 'hidden' );
	$( '#unsubscribe_email' ).prop( 'readonly', false );
	$( '#checkUsernameEmail' ).prop( 'disabled', false );
	$( '#users' ).prop( 'readonly', false );
	$( '#unsubscribe_email' ).val( '' );
	$( '#users' ).val( '' );
	selectedUser = '';
	toggleMessages( false, '', '.unsubscribe-error', '.unsubscribe-success' );
}

function handleSelect ( selected ) {
	selectedUser = selected.value;
}

/**
 * Datatables
 *
 */
$(document).ready(function() {
	"use strict";

	if ( $('.dataTables').length ) {
			var t = $('.dataTables').DataTable( {
					"columnDefs": [ {
							"searchable": false,
							"orderable": false,
							"targets": 0
					} ],
					"order": [[ 1, 'asc' ]]
			} );

			t.on( 'order.dt search.dt', function () {
					t.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
							cell.innerHTML = i+1;
					} );
			} ).draw();
	}

	applyDatatables( '.mysql_dataTables' );
	applyDatatables( '.ansible_dataTables' );
	applyDatatables( '.redmine_dataTables' );
	applyDatatables( '.selenium_dataTables' );
	applyDatatables( '.openvswitch_dataTables' );
	applyDatatables( '.stonith_dataTables' );
	applyDatatables( '.opendaylight_dataTables' );
	applyDatatables( '.unsubscribe_dataTables' );

	if ( $( '.select2' ).length ) {
		$( '.select2' ).select2( {
			'placeholder' : 'Select an OSS'
		} );
	}
});

/**
 * SERVICE PAGE - Auto Build page
 * Get the clicked number in image
 *
 */
$( document ).ready( function () {
	$( '.area-number' ).click( function ( e ) {
		e.preventDefault();

		var clicked = $( this ).data( 'id' );

		$( '.devopsTable tr' ).removeClass( 'highlight-tr' );

		if ( clicked !== 'one' && clicked !== 'two' ) {
			window.location.href = '#' + clicked;
		}

		if ( clicked === 'one' ) {
			$( '.one' ).each( function () {
				$( this ).addClass( 'highlight-tr' );
			} );
		}

		if ( clicked === 'two' ) {
			$( '.two' ).each( function () {
				$( this ).addClass( 'highlight-tr' );
			} );
		}

		if ( clicked === 'three' ) {
			$( '.three' ).each( function () {
				$( this ).addClass( 'highlight-tr' );
			} );
		}

		if ( clicked === 'four' ) {
			$( '.four' ).each( function () {
				$( this ).addClass( 'highlight-tr' );
			} );
		}

		if ( clicked === 'five' ) {
			$( '.five' ).each( function () {
				$( this ).addClass( 'highlight-tr' );
			} );
		}

		if ( clicked === 'six' ) {
			$( '.six' ).each( function () {
				$( this ).addClass( 'highlight-tr' );
			} );
		}

		if ( clicked === 'seven' ) {
			$( '.seven' ).each( function () {
				$( this ).addClass( 'highlight-tr' );
			} );
		}

		if ( clicked === 'eight' ) {
			$( '.eight' ).each( function () {
				$( this ).addClass( 'highlight-tr' );
			} );
		}

		if ( clicked === 'nine' ) {
			$( '.nine' ).each( function () {
				$( this ).addClass( 'highlight-tr' );
			} );
		}

		if ( clicked === 'ten' ) {
			$( '.ten' ).each( function () {
				$( this ).addClass( 'highlight-tr' );
			} );
		}

		if ( clicked === 'elev' ) {
			$( '.elev' ).each( function () {
				$( this ).addClass( 'highlight-tr' );
			} );
		}

		if ( clicked === 'twel' ) {
			$( '.twel' ).each( function () {
				$( this ).addClass( 'highlight-tr' );
			} );
		}

		if ( clicked === 'thir' ) {
			$( '.thir' ).each( function () {
				$( this ).addClass( 'highlight-tr' );
			} );
		}

		if ( clicked === 'fourt' ) {
			$( '.fourt' ).each( function () {
				$( this ).addClass( 'highlight-tr' );
			} );
		}
	} );
} );

/**
 * Get page visits and display only in Home Page
 *
 */
$( document ).ready( function () {
	"use strict";

	var href = window.location.href;
	var path = href.split( '/oss-tc/portal/' );

	if ( path[ 1 ] === '' ) {
		$.ajax( {
			url     : ajaxUrl + '?action=get_page_visits',
			type    : 'GET',
			success : function ( data ) {
				document.getElementById( 'counter' ).innerHTML = data;
				$( '#views' ).removeClass( 'hidden' );
			}
		} );
	} else {
		if ( !$( '#views' ).hasClass( 'hidden' ) ) {
			$( '#views' ).addClass( 'hidden' );
		}
	}
} );

/**
 * BUG PATCHES - UNSUBSCRIBE FUNCTION
 *
 */
$( document ).ready( function () {
	"use strict";

	$('#unsubscribe-modal').on( 'show.bs.modal', function () {
		clearSubscriptionFields();
	} );

	if ( $( '#users' ).length ) {
		$('#users').typeahead( {
			'onSelect'      : function ( selected ) {
				handleSelect( selected )
			},
			// 'ajax'          : '../api/bug-patches/get-all-subscribers.php',
			'ajax'          : ajaxUrl + '?action=get_all_subscribers',
			'displayField'  : 'nameAndUserid',
			'valueField'    : 'user_id'
		} );

		$( '#users' ).on( 'keydown', function ( e ) {
			selectedUser = '';
		} );
	}

	if ( $( '#clear' ).length ) {
		$( '#clear' ).on( 'click', function () {
			clearSubscriptionFields();
		} );
	}

	if ( $( '#checkUsernameEmail' ).length ) {
		$( '#checkUsernameEmail' ).on( 'click', function () {
			var email  = $( '#unsubscribe_email' ).val();
			var userid = $( '#users' ).val();
			var form   = $( '#unsubscribe_form' )[ 0 ];
			var data   = new FormData( form );

			data.append( 'action', 'check_username_and_email' );

			if ( ( !selectedUser && !userid && !email ) || ( selectedUser && !email ) || ( !selectedUser && !userid && email ) || ( !selectedUser && userid && !email ) ) {
				return toggleMessages( true, 'Please input details for User Id/Name and Email.', '.unsubscribe-error', '.unsubscribe-success' );
			}

			if ( email && !validateEmail( email ) ) {
				return toggleMessages( true, 'Please enter a valid email address', '.unsubscribe-error', '.unsubscribe-success' );
			}

			if ( !selectedUser && userid && email ) {
				return toggleMessages( true, 'Record not found.', '.unsubscribe-error', '.unsubscribe-success' );
			}

			toggleMessages( false, '', '.unsubscribe-error', '.unsubscribe-success' );

			$.ajax( {
				// url         : '../api/bug-patches/check-username-and-email.php',
				url         : ajaxUrl,
				enctype     : 'multipart/form-data',
				data        : data,
				processData : false,
				contentType : false,
				cache       : false,
				type        : 'POST',
				success     : function( data ) {
					var result = JSON.parse( data );

					if ( result ) {
						$( '#unsubscribe_email' ).prop( 'readonly', true );
						$( '#users' ).prop( 'readonly', true );
						$( '#checkUsernameEmail' ).prop( 'disabled', true );

						return getAllOss( result.user_id );
					}
					return toggleMessages( true, 'Record not found.', '.unsubscribe-error', '.unsubscribe-success' );
				}
			} );
		} );
	}
} );

/**
 * Show unsubscribe modal
 *
 */
$( document ).ready( function () {
	"use strict";

	$('#form-unsubscribe').click( function () {
			$('#unsubscribe-modal').modal('show');
	} );
} );

/**
 * Apply datepicker to dates in Bug Patches
 *
 */
$( document ).ready( function() {
	"use strict";

	$( '.duration' ).datepicker( {
		format: "mm/dd/yyyy",
		autoclose: true
	} );
} );

/**
 * BUG PATCHES - SUBSCRIBE FUNCTION
 *
 */

$( document ).ready( function () {
	"use strict";

	$( '#form-subscribe' ).click( function () {
		var form = $("#subscribe_form")[ 0 ];
		// Create an FormData object
		var fields = [];
		var data   = new FormData( form );

		data.append( 'action', 'subscribe' );

		$( '.validateFields' ).filter( function() {
			if ( !$( this ).val() ) {
				fields.push( $( this )[ 0 ].id );
			}
		} );

		if ( fields.length ) {
			var empty = fields.map( function( value, key ) {
				return SUBSCRIPTION_CONST[ fields[ key ] ];
			} );

			return toggleMessages( true, 'Please provide details for ' + empty.join( ', ' ) + '.', '.subscription-error', '.subscription-success' );
		}

		if ( !validateEmail( $( '#email' ).val() ) ) {
			return toggleMessages( true, 'Please enter a valid email address', '.subscription-error', '.subscription-success' );
		}

		if ( $( '#start_date' ).val() > $( '#end_date' ).val() ) {
			return toggleMessages( true, 'Please enter a valid duration date. Start date must be less than the end date.', '.subscription-error', '.subscription-success' );
		}

		$(".loading").show();
		$("#form-subscribe").attr("disabled", "disabled");
		$.ajax({
				// url         : '../api/bug-patches/subscribe.php',
				url         : ajaxUrl,
				enctype     : 'multipart/form-data',
				data        : data,
				processData : false,
				contentType : false,
				cache       : false,
				type        : 'POST',
				success     : function(data) {
					toggleMessages( false, 'Thank you for subscribing! We\'ll give you updates about your selected OSS.', '.subscription-error', '.subscription-success' );
				    $(".loading").hide();
				    $("#name").val(" ");
				    $("#email").val(" ");
				    $("#start_date").val(" ");
				    $("#end_date").val(" ");
				    $("#oss").val(" ");
				}
		});
	} );
} );

/**
 * TECHNICAL INFORMATION - SUBSCRIBE FUNCTION
 *
 */

$( document ).ready( function () {
	"use strict";

	$( '#techinfo_submit' ).click( function () {
		var form = $("#techinfo_form")[ 0 ];
		// Create an FormData object
		var fields = [];
		var data   = new FormData( form );

		data.append( 'action', 'subscribetechinfo' );

		if ( !$( '#techinfo_name' ).val() ) {
			return toggleMessages( true, 'Please enter your name.', '.techinfo-error', '.techinfo-success' );
		}

		if ( !validateEmail( $( '#techinfo_email' ).val() ) ) {
			return toggleMessages( true, 'Please enter a valid email address.', '.techinfo-error', '.techinfo-success' );
		}

        $(".loading").show();
        $("#techinfo_submit").attr("disabled", "disabled");
		$.ajax({
				url         : ajaxUrl,
				enctype     : 'multipart/form-data',
				data        : data,
				processData : false,
				contentType : false,
				cache       : false,
				type        : 'POST',
				success     : function(data) {
					$(".text").show();
					toggleMessages( false, 'Thank you for subscribing in our mail magazine!', '.techinfo-error', '.techinfo-success' );
                    $(".loading").hide();
                    $( '#techinfo_name' ).val(" ");
                    $( '#techinfo_email' ).val(" ");


				}
		});
	} );
} );

/**
 * Display tooltip in Menu section -> Home Page
 *
 */
$( document ).ready( function () {
	"use strict";

	if ( $('[data-toggle="tooltip"]').length ) {
		$('[data-toggle="tooltip"]').tooltip();
	}
} );

$( document ).ready( function () {
  "use strict";

	$('#myTabs a').click(function (e) {
		e.preventDefault()
		$(this).tab('show')
	})
} );

$( document ).ready( function() {
	$( '.target-link' ).click( function ( e ) {
		window.location.href = '#' + $( this ).data( 'id' );
	} );
} );

/**
 * MySQL Cluster Slides -> Knowledge
 *
 */
$( document ).ready( function() {
	"use strict";
	//part 1 carousel
	//part 1 carousel
	for ( var i = 2; i <= 23; i++ ) {
		$( '.part1-carousel' ).append( '<div class="item"><div class="col-md-12 text-center"><!-- IMAGE --><img src="'+siteUrl+'/assets/images/knowledge/mysqlcluster/part1/Slide'+i+'.jpg" alt="" width="320" height="320"></div></div>' );
	}
	//part 2 carousel
	for ( var i = 2; i <= 37; i++ ) {
		$( '.part2-carousel' ).append( '<div class="item"><div class="col-md-12 text-center"><!-- IMAGE --><img src="'+siteUrl+'/assets/images/knowledge/mysqlcluster/part2/Slide'+i+'.jpg" alt="" width="320" height="320"></div></div>' );
	}
	//part 3 carousel
	for ( var i = 2; i <= 27; i++ ) {
		$( '.part3-carousel' ).append( '<div class="item"><div class="col-md-12 text-center"><!-- IMAGE --><img src="'+siteUrl+'/assets/images/knowledge/mysqlcluster/part3/Slide'+i+'.jpg" alt="" width="320" height="320"></div></div>' );
	}
	//part 4 carousel
	for ( var i = 2; i <= 13; i++ ) {
		$( '.part4-carousel' ).append( '<div class="item"><div class="col-md-12 text-center"><!-- IMAGE --><img src="'+siteUrl+'/assets/images/knowledge/mysqlcluster/part4/Slide'+i+'.jpg" alt="" width="320" height="320"></div></div>' );
	}
	//version carousel
	for ( var i = 2; i <= 22; i++ ) {
		$( '.version-carousel' ).append( '<div class="item"><div class="col-md-12 text-center"><!-- IMAGE --><img src="'+siteUrl+'/assets/images/knowledge/mysqlcluster/version/Slide'+i+'.jpg" alt="" width="320" height="320"></div></div>' );
	}

	//partitioning carousel
	for ( var i = 2; i <= 17; i++ ) {
		$( '.partitioning-carousel' ).append( '<div class="item"><div class="col-md-12 text-center"><!-- IMAGE --><img src="'+siteUrl+'/assets/images/knowledge/mysqlcluster/partition/Slide'+i+'.jpg" alt="" width="320" height="320"></div></div>' );
	}

	//performance carousel
	for ( var i = 2; i <= 18; i++ ) {
		$( '.performance-carousel' ).append( '<div class="item"><div class="col-md-12 text-center"><!-- IMAGE --><img src="'+siteUrl+'/assets/images/knowledge/mysqlcluster/performance/Slide'+i+'.jpg" alt="" width="320" height="320"></div></div>' );
	}

	//scaling carousel
	for ( var i = 2; i <= 18; i++ ) {
		$( '.scaling-carousel' ).append( '<div class="item"><div class="col-md-12 text-center"><!-- IMAGE --><img src="'+siteUrl+'/assets/images/knowledge/mysqlcluster/scaling/Slide'+i+'.jpg" alt="" width="320" height="320"></div></div>' );
	}

	//detection carousel
	for ( var i = 2; i <= 30; i++ ) {
		$( '.detection-carousel' ).append( '<div class="item"><div class="col-md-12 text-center"><!-- IMAGE --><img src="'+siteUrl+'/assets/images/knowledge/mysqlcluster/detection/Slide'+i+'.jpg" alt="" width="320" height="320"></div></div>' );
	}

	//recovery carousel
	for ( var i = 2; i <= 12; i++ ) {
		$( '.recovery-carousel' ).append( '<div class="item"><div class="col-md-12 text-center"><!-- IMAGE --><img src="'+siteUrl+'/assets/images/knowledge/mysqlcluster/recovery/Slide'+i+'.jpg" alt="" width="320" height="320"></div></div>' );
	}

	//master carousel
	for ( var i = 2; i <= 19; i++ ) {
		$( '.master-carousel' ).append( '<div class="item"><div class="col-md-12 text-center"><!-- IMAGE --><img src="'+siteUrl+'/assets/images/knowledge/mysqlcluster/master/Slide'+i+'.png" alt="" width="320" height="320"></div></div>' );
	}
} );

/**
 * Menu Appear and Hide
 *
 */
$(document).ready(function() {

	"use strict";

	var href = window.location.href;
	var path = href.split( '/oss-tc/portal/' );

	// Show nav bar if it is not main page
	if ( path[ 1 ] !== '' ) {
	  $("#original").css({
		  'margin-top': '0px',
		  'opacity': '1'
	  })
	  $("#original .navbar-nav>li>a").css({
		  'padding-top': '15px'
	  });
	  $("#original .navbar-brand img").css({
		  'height': '35px'
	  });
	  $("#original .navbar-brand img").css({
		  'padding-top': '0px'
	  });
	  $("#original").css({
		  'background-color': 'white',
		  'border': '1px solid #ddd'
	  });
	}

	$(window).scroll(function() {

		"use strict";

		if ( path[ 1 ] === '' ) {
		  if ($(window).scrollTop() ) {
			  $("#original").css({
				  'margin-top': '0px',
				  'opacity': '1'
			  })
			  $("#original .navbar-nav>li>a").css({
				  'padding-top': '15px'
			  });
			  $("#original .navbar-brand img").css({
				  'height': '35px'
			  });
			  $("#original .navbar-brand img").css({
				  'padding-top': '0px'
			  });
			  $("#original").css({
				  'background-color': 'white',
				  'border': '1px solid #ddd'
			  });
		  }
		}
	});
});

/**
 * Menu section: active
 *
 */
$(document).ready(function() {

	"use strict";

	$(".navbar-nav li a").click(function() {

		"use strict";

		$(".navbar-nav li a").parent().removeClass("active");
		$(this).parent().addClass("active");
	});
});

/**
 * Highlight Menu on scroll
 *
 */
$(document).ready(function() {

	"use strict";

	$(window).scroll(function() {

		"use strict";

		$(".page").each(function() {

			"use strict";

			var bb = $(this).attr("id");
			var hei = $(this).outerHeight();
			var grttop = $(this).offset().top - 70;
			if ($(window).scrollTop() > grttop - 1 && $(window).scrollTop() < grttop + hei - 1) {
				var uu = $(".navbar-nav li a[href='#" + bb + "']").parent().addClass("active");
			} else {
				var uu = $(".navbar-nav li a[href='#" + bb + "']").parent().removeClass("active");
			}
		});
	});
});

/**
 * Smooth menu scroll
 *
 */
$(function() {

	"use strict";

  var href = window.location.href;
  var path1 = href.split( '/knowledge/' );
  var path2 = href.split( '/tool/' );

	if ( $('a[href*=#]:not([href=#]):not(.carousel-control)').length && path1.length < 2 && path2.length < 2 ) {
		$('a[href*=#]:not([href=#]):not(.carousel-control)').click(function() {
			if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {
				var target = $(this.hash);
				target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
				if (target.length) {
					$('html,body').animate({
						scrollTop: target.offset().top
					}, 1000);
					return false;
				}
			}
		});
	}
});

/**
 * Fixed Home screen height
 *
 */
$(document).ready(function() {

	"use strict";

	setInterval(function() {
		"use strict";
				if ( $(".home-container").length ) {
					var widnowHeight = $(window).height();
					var containerHeight = $(".home-container").height();
					var padTop = widnowHeight - containerHeight;
					$(".home-container").css({

							'padding-top': Math.round(padTop / 2) + 'px',
							'padding-bottom': Math.round(padTop / 2) + 'px'
					});
				}
	}, 10)
});

/**
 * Parallax
 *
 */
$(document).ready(function() {

	"use strict";

	$(window).bind('load', function() {
		"use strict";
		parallaxInit();
	});

	function parallaxInit() {
			"use strict";
			if ( $('.home-parallax').length ) {
				$('.home-parallax').parallax("30%", 0.1);
			}
			if ( $('.subscribe-parallax').length ) {
				$('.subscribe-parallax').parallax("30%", 0.1);
			}
			if ( $('.testimonial').length ) {
				$('.testimonial').parallax("10%", 1);
			}
	}
});

/**
 * Wow JS
 *
 */
$(document).ready(function() {
	"use strict";

	new WOW().init();
});

/**
 * Responsive Video
 *
 */
$(document).ready(function() {

	"use strict";

	// Basic FitVids Test
	$(".video").fitVids();
});

/**
 * Contact Form Validation
 *
 */
$(document).ready(function() {

	"use strict";

	var fileSize;

	// Get file size and convert to mb
	$( '#file_attach' ).bind( 'change', function () {
		var file = this.files[ 0 ];

		fileSize = file.size / 1024 / 1024;
	} );

	// Handle cp_availability input
	$( '#cp_availability' ).change( function () {
	  var val = $( this ).val();

	  if ( val === 'yes' || val === 'na' ) {
			return $( '.form_submit_question_answer' ).removeAttr( 'disabled' );
	  }

	  return $( '.form_submit_question_answer' ).attr( 'disabled', true );
	} );

	// Submit the form
	$( '.confirm-question-answer-btn' ).click( function () {
	  // close confirmation modal
	  $( '#confirmation-modal' ).modal( 'hide' );

	  var form = $("#question_answer_form")[ 0 ];
	  // Create an FormData object
	  var data = new FormData( form );

			// Create action variable for wordpress requirement
			data.append( 'action', 'inquiry_email' );

	  // disable send button and change the text
	  $( '.form_submit_question_answer' ).attr( 'disabled', true );
	  $( '.form_submit_question_answer' ).text( 'SENDING...' );

	  $.ajax({
		  url: ajaxUrl,
		  enctype: 'multipart/form-data',
		  data: data,
		  processData: false,
		  contentType: false,
		  cache: false,
		  type: 'POST',
		  success: function(data) {
			  $(".Sucess").show();
			  $(".Sucess").fadeIn(2000);
			  $(".Sucess").html("<i class='fa fa-check'></i> Dear <b>" + $("#requester").val() + "</b> Thank you for your inquiry we will respond to you as soon as possible!");

			  $("#division").val("");
			  $("#project_name").val("");
			  $("#requester").val("");
			  $("#target_oss").val("");
			  $("#oss_version").val("");
			  $("#due_date").val("");
			  $("#file_attach").val("");
			  $("#title").val("");
			  $("#message").val("");
			  $("#emails").tagsinput('removeAll');
			  $('#cp_availability').val('no');

			  // enable send button and reset the text
			  $( '.form_submit_question_answer' ).attr( 'disabled', true );
			  $( '.form_submit_question_answer' ).text( 'SEND MESSAGE' );

			  $(".form_error .error-message").addClass("hide").removeClass("show");
		  }
	  });
	} );

	// Question and Answer submit form
	$( '.form_submit_question_answer' ).click( function() {

	  "use strict";

	  var division = $("#division").val();
	  var project = $("#project_name").val();
	  var requestedBy = $("#requester").val();
	  var emails = $("#emails").tagsinput('items');
	  var targetOss = $("#target_oss").val();
	  var ossVer = $("#oss_version").val();
	  var dueDate = $("#due_date").val();
	  var message = $("#message").val();

	  $(".Sucess").html('');

	  if (!division) {
		  $(".form_error .error-message")[ 0 ].innerHTML = 'Please enter division';
		  $(".form_error .error-message").addClass("show").removeClass("hide");
		  return false;
	  } else {
		  $(".form_error .error-message").addClass("hide").removeClass("show");
	  }

	  if (!project) {
		  $(".form_error .error-message")[ 0 ].innerHTML = 'Please enter project';
		  $(".form_error .error-message").addClass("show").removeClass("hide");
		  return false;
	  } else {
		  $(".form_error .error-message").addClass("hide").removeClass("show");
	  }

	  if (!requestedBy) {
		  $(".form_error .error-message")[ 0 ].innerHTML = 'Please enter requester name';
		  $(".form_error .error-message").addClass("show").removeClass("hide");
		  return false;
	  } else {
		  $(".form_error .error-message").addClass("hide").removeClass("show");
	  }

	  if (!emails.length) {
		  $(".form_error .error-message")[ 0 ].innerHTML = 'Please enter your email';
		  $(".form_error .error-message").addClass("show").removeClass("hide");
		  return false;
	  } else {
		  for (var i = 0; i < emails.length; i++) {
			if ( !validateEmail( emails[i] ) ) {
			  $(".form_error .error-message")[ 0 ].innerHTML = 'Please enter valid email';
			  $(".form_error .error-message").addClass("show").removeClass("hide");
			  return false;
			}
		  }
		  $(".form_error .error-message").addClass("hide").removeClass("show");
	  }

	  if (!targetOss) {
		  $(".form_error .error-message")[ 0 ].innerHTML = 'Please enter target OSS';
		  $(".form_error .error-message").addClass("show").removeClass("hide");
		  return false;
	  } else {
		  $(".form_error .error-message").addClass("hide").removeClass("show");
	  }

	  if (!ossVer) {
		  $(".form_error .error-message")[ 0 ].innerHTML = 'Please enter OSS version';
		  $(".form_error .error-message").addClass("show").removeClass("hide");
		  return false;
	  } else {
		  $(".form_error .error-message").addClass("hide").removeClass("show");
	  }

	  if (!dueDate) {
		  $(".form_error .error-message")[ 0 ].innerHTML = 'Please enter due date';
		  $(".form_error .error-message").addClass("show").removeClass("hide");
		  return false;
	  } else {
		  $(".form_error .error-message").addClass("hide").removeClass("show");
	  }

	  if (fileSize && fileSize > 5) {
		  $(".form_error .error-message")[ 0 ].innerHTML = 'The file size exceeds 5mb';
		  $(".form_error .error-message").addClass("show").removeClass("hide");
		  return false;
	  } else {
		  $(".form_error .error-message").addClass("hide").removeClass("show");
	  }

	  if (!message) {
		  $(".form_error .error-message")[ 0 ].innerHTML = 'Please enter your message';
		  $(".form_error .error-message").addClass("show").removeClass("hide");
		  return false;
	  } else {
		  $(".form_error .error-message").addClass("hide").removeClass("show");
	  }

	  // show confirmation modal
	  $( '#confirmation-modal' ).modal( 'show' );
	} );

	// Remove attributes of send button
	$(".form_clear_question_answer").click( function () {
	  $("#emails").tagsinput('removeAll');
	  return $( '.form_submit_question_answer' ).attr( 'disabled', true );
	} );

	$(".form_submit").click(function() {

		"use strict";

		var name = $("#name").val();
		var emaild = $("#email").val();
		var subject = $("#subject").val();
		var message = $("#message").val();
		var testEmail = /^[A-Z0-9._%+-]+@([A-Z0-9-]+\.)+[A-Z]{2,4}$/i;
		if (!name) {
			$(".form_error .name_error").addClass("show").removeClass("hide");
			return false;
		} else {
			$(".form_error .name_error").addClass("hide").removeClass("show");
		}
		if (!emaild) {
			$(".form_error .email_error").addClass("show").removeClass("hide");
			return false;
		} else {
			$(".form_error .email_error").addClass("hide").removeClass("show");
			if (testEmail.test(emaild)) {
				$(".form_error .email_val_error").addClass("hide").removeClass("show");
			} else {
				$(".form_error .email_val_error").addClass("show").removeClass("hide");
				return false;
			}
		}
		if (!message) {
			$(".form_error .message_error").addClass("show").removeClass("hide");
			return false;
		} else {
			$(".form_error .message_error").addClass("hide").removeClass("show");
		}
		if (name && emaild && message) {
			$.ajax({
				url: 'contact.php',
				data: {
					name: name,
					emaild: emaild,
					subject: subject,
					message: message
				},
				type: 'POST',
				success: function(data) {
					$(".Sucess").show();
					$(".Sucess").fadeIn(2000);
					$(".Sucess").html("<i class='fa fa-check'></i> Dear <b>" + name + "</b> Thank you for your inquiry we will respond to you as soon as possible!");
					$("#Name").val("");
					$("#Email").val("");
					$("#Subject").val("");
					$("#Message").val("");
					$(".form_error .name_error, .form_error .email_error, .form_error .email_val_error, .form_error .message_error").addClass("hide").removeClass("show");
					$("#name").val("");
					$("#email").val("");
					$("#subject").val("");
					$("#title").val("");
					$("#message").val("");
				}
			});
		}
		return false;
	});
});


var fileSrc;

/**
 * Show Download Form Modal
 */
function showDownloadFormModal ( src ) {
  $('#download-modal').modal('show');
  fileSrc = src;
}

/**
 * TOOL Download modal
 *
 */
$(document).ready(function() {

		"use strict";

		// CALL AJAX to save data and download file
		$('.confirm-download-btn').click( function () {
				var downloadBtn = $( this );
				var division = $("#division").val();
				var project = $("#project").val();
				var name = $("#name").val();
				var email = $("#email").val();

				var form = $("#download_file_form")[ 0 ];
				// Create an FormData object
				var data   = new FormData( form );

			// Create action variable for wordpress requirement
			data.append( 'action', 'download_file' );

				$(".Sucess").html('');

				if (!division) {
						$(".form_error .error-message")[ 0 ].innerHTML = 'Please select division';
						$(".form_error .error-message").addClass("show").removeClass("hide");
						return false;
				} else {
						$(".form_error .error-message").addClass("hide").removeClass("show");
				}

				if (!project) {
						$(".form_error .error-message")[ 0 ].innerHTML = 'Please enter project';
						$(".form_error .error-message").addClass("show").removeClass("hide");
						return false;
				} else {
						$(".form_error .error-message").addClass("hide").removeClass("show");
				}

				if (!name) {
						$(".form_error .error-message")[ 0 ].innerHTML = 'Please enter name';
						$(".form_error .error-message").addClass("show").removeClass("hide");
						return false;
				} else {
						$(".form_error .error-message").addClass("hide").removeClass("show");
				}

				if (!email) {
						$(".form_error .error-message")[ 0 ].innerHTML = 'Please enter your email';
						$(".form_error .error-message").addClass("show").removeClass("hide");
						return false;
				} else {
						if ( !validateEmail(email) ) {
							$(".form_error .error-message")[ 0 ].innerHTML = 'Please enter valid email';
							$(".form_error .error-message").addClass("show").removeClass("hide");
							return false;
						}
						$(".form_error .error-message").addClass("hide").removeClass("show");
				}

				// Disable button
				$( downloadBtn ).attr( 'disabled', true );

				$.ajax({
						url: ajaxUrl,
						enctype: 'multipart/form-data',
						data: data,
						processData: false,
						contentType: false,
						cache: false,
						type: 'POST',
						success: function(data) {
							var message = "";

							// parse http result
							data = JSON.parse(data);

							if( data.success ) {
								// clear fields
								clearDownloadForm();

								window.open(siteUrl + '/' + fileSrc, '_self');

								$('#download-modal').modal('hide');
							} else {
								message = "<i class='fa fa-times' aria-hidden='true'></i> Something went wrong!";
							}

							$(".Sucess").show();
							$(".Sucess").fadeIn(2000);
							$(".Sucess").html( message );

							// enable send button and reset the text
							$( downloadBtn ).attr( 'disabled', false );

							$(".form_error .error-message").addClass("hide").removeClass("show");
						}
					});

		} );

		// Clear download file form
		function clearDownloadForm() {
			$("#division").val("");
			$("#project").val("");
			$("#name").val("");
			$("#email").val("");
		}

		// Clear download file form
		$('.clear-download-btn').click( function () {
			clearDownloadForm();
		} );

} );

/**
 * Smooth scroll
 *
 */
$(document).ready(function() {

	"use strict";

	var scrollAnimationTime = 1200,
		scrollAnimation = 'easeInOutExpo';
	$('a.scrollto').bind('click.smoothscroll', function(event) {
		event.preventDefault();
		var target = this.hash;
		$('html, body').stop().animate({
			'scrollTop': $(target).offset().top
		}, scrollAnimationTime, scrollAnimation, function() {
			window.location.hash = target;
		});
	});
	//COUNTER
	$('.counter_num').counterUp({
		delay: 10,
		time: 2000
	});
});
