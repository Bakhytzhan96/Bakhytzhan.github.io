/**
 * File customizer.js.
 *
 * Theme Customizer enhancements for a better user experience.
 *
 * Contains handlers to make Theme Customizer preview reload changes asynchronously.
 */

( function( $ ) {

	// Site title and description.
	wp.customize( 'blogname', function( value ) {
		value.bind( function( to ) {
			$( '.site-title a' ).text( to );
		} );
	} );
	wp.customize( 'blogdescription', function( value ) {
        value.bind( function( to ) {
            $( '.site-description' ).text( to );
        } );
    } );

    wp.customize( 'blog_page_title', function( value ) {
        value.bind( function( to ) {
            $( '.titlebar .header-title' ).text( to );
        } );
    } );
    wp.customize( 'padding_top', function( value ) {
        value.bind( function( newval ) {
            $( '.titlebar' ).css( 'padding-top', newval + '%' );
        } );
    } );
    wp.customize( 'padding_botton', function( value ) {
        value.bind( function( newval ) {
            $( '.titlebar' ).css( 'padding-bottom', newval + '%' );
        } );
    } );

	wp.customize( 'logo_max_width', function( value ) {
		value.bind( function( newval ) {
			$( '.site-branding .site-logo, .site-logo' ).css( 'max-width', newval + 'px' );
		} );
	} );

	wp.customize( 'container_max_width', function( value ) {
		value.bind( function( newval ) {
			$( '.container' ).css( 'max-width', newval + 'px' );
		} );
	} );
    wp.customize( 'follow_title', function( value ) {
        value.bind( function( to ) {
            $( '.site-footer .footer-social label' ).html( to );
        } );
    } );

	/* Header topbar */
	wp.customize( 'topbar_layout', function( value ) {
		value.bind( function( newval ) {
			if ( newval == 'full' ) {
				$( '.topbar > div' ).removeClass( 'container' );
				$( '.topbar > div' ).addClass( 'container-fluid' );
			} else {
				$( '.topbar > div' ).removeClass( 'container-fluid' );
				$( '.topbar > div' ).addClass( 'container' );
			}
		} );
	} );

	/* Header main */
	wp.customize( 'header_main_layout', function( value ) {
		value.bind( function( newval ) {
			if ( newval == 'full' ) {
				$( '.header-default > div, .header-top > div' ).removeClass( 'container' );
				$( '.header-default > div, .header-top > div' ).addClass( 'container-fluid' );
			} else {
				$( '.header-default > div, .header-top > div' ).removeClass( 'container-fluid' );
				$( '.header-default > div, .header-top > div' ).addClass( 'container' );
			}
		} );
	} );

	


	/* Topbar */
    wp.customize( 'show_topbar', function( value ) {
        value.bind( function( newval ) {
            if ( newval == true ) {
                $( '.topbar' ).hide();
            } else {
                $( '.topbar' ).show();
            }
        });
    } );
    // hide the login on topbar
    wp.customize( 'show_login', function( value ) {
        value.bind( function( newval ) {
            if ( newval == true ) {
                $( '.login_url' ).hide();
            } else {
                $( '.login_url' ).show();
            }
        });
    } );
    wp.customize( 'show_register', function( value ) {
        value.bind( function( newval ) {
            if ( newval == true ) {
                $( '.register_url' ).hide();
            } else {
                $( '.register_url' ).show();
            }
        });
    } );
    wp.customize( 'show_logout', function( value ) {
        value.bind( function( newval ) {
            if ( newval == true ) {
                $( '.logout_url' ).hide();
            } else {
                $( '.logout_url' ).show();
            }
        });
    });
    wp.customize( 'show_wc_cart', function( value ) {
        value.bind( function( newval ) {
            if ( newval == true ) {
                $( '.topbar .cart-contents' ).hide();
            } else {
                $( '.topbar .cart-contents' ).show();
            }
        });
    });
    wp.customize( 'cart_font_size', function( value ) {
        value.bind( function( newval ) {
            $( '.topbar .cart-contents i' ).css('font-size', newval + 'px');
        });
    });
    wp.customize( 'cart_color', function( value ) {
        value.bind( function( newval ) {
            $( '.topbar .cart-contents' ).css('color', newval );
            $('.cart-contents .sp-count').css('background', newval );
        });
    });

    /* hide post meta */
    wp.customize( 'hide_featured_image', function( value ) {
        value.bind( function( newval ) {
            if ( newval == true ) {
                $( '.post-featured-image' ).hide();
            } else {
                $( '.post-featured-image' ).show();
            }
        });
    } );
    wp.customize( 'show_category', function( value ) {
        value.bind( function( newval ) {
            if ( newval == true ) {
                $( '.cat-links' ).hide();
            } else {
                $( '.cat-links' ).show();
            }
        });
    } );
    wp.customize( 'show_date', function( value ) {
        value.bind( function( newval ) {
            if ( newval == true ) {
                $( '.posted-on' ).hide();
            } else {
                $( '.posted-on' ).show();
            }
        });
    } );
    wp.customize( 'show_author', function( value ) {
        value.bind( function( newval ) {
            if ( newval == true ) {
                $( '.byline' ).hide();
            } else {
                $( '.byline' ).show();
            }
        });
    } );
    wp.customize( 'show_tag', function( value ) {
        value.bind( function( newval ) {
            if ( newval == true ) {
                $( '.tags-links' ).hide();
            } else {
                $( '.tags-links' ).show();
            }
        });
    } );


	/* Footer Widget layout */
	wp.customize( 'footer_width', function( value ) {
		value.bind( function( newval ) {
			if ( newval == 'full' ) {
				$( '#footer' ).removeClass( 'container' );
				$( '#footer' ).addClass( 'container-fluid' );
			} else {
				$( '#footer' ).removeClass( 'container-fluid' );
				$( '#footer' ).addClass( 'container' );
			}
		} );
	} );


	/* Hide footer socials */
	wp.customize( 'hide_footer_social', function( value ) {
		value.bind( function( newval ) {
			if ( newval == true ) {
				$( '.footer-connect' ).css( 'display', 'none' );
			} else {
				$( '.footer-connect' ).css( 'display', 'block' );
			}
		} );
	} );

	// Header text color.
	wp.customize( 'header_textcolor', function( value ) {
		value.bind( function( to ) {
			if ( 'blank' === to ) {
				$( '.site-title, .site-description' ).css( {
					'clip': 'rect(1px, 1px, 1px, 1px)',
					'position': 'absolute'
				} );
			} else {
				$( '.site-title, .site-description' ).css( {
					'clip': 'auto',
					'position': 'relative'
				} );
				$( '.site-title a, .site-description' ).css( {
					'color': to
				} );
			}
		} );
	} );
} )( jQuery );
