<?php
/**
 * Adds a meta box to the post editing screen
 */
function seller_custom_meta() {
    add_meta_box( 'seller_meta', __( 'Display Options', 'seller' ), 'seller_meta_callback', 'page','side','high' );
}
add_action( 'add_meta_boxes', 'seller_custom_meta' );

/**
 * Outputs the content of the meta box
 */
 
function seller_meta_callback( $post ) {
    wp_nonce_field( basename( __FILE__ ), 'seller_nonce' );
    $seller_sellerd_meta = get_post_meta( $post->ID );
    ?>
    
    <p>
	    <div class="seller-row-content">
	        <label for="enable-slider">
	            <input type="checkbox" name="enable-slider" id="enable-slider" value="yes" <?php if ( isset ( $seller_sellerd_meta['enable-slider'] ) ) checked( $seller_sellerd_meta['enable-slider'][0], 'yes' ); ?> />
	            <?php _e( 'Enable Slider', 'seller' )?>
	        </label>
	        
	        <label for="enable-showcase">
	            <input type="checkbox" name="enable-showcase" id="enable-showcase" value="yes" <?php if ( isset ( $seller_sellerd_meta['enable-slider'] ) ) checked( $seller_sellerd_meta['enable-showcase'][0], 'yes' ); ?> />
	            <?php _e( 'Enable Showcase', 'seller' )?>
	        </label>
	        
	        
	        <br />
	        <label for="enable-sqbx">
	            <input type="checkbox" name="enable-sqbx" id="enable-sqbx" value="yes" <?php if ( isset ( $seller_sellerd_meta['enable-sqbx'] ) ) checked( $seller_sellerd_meta['enable-sqbx'][0], 'yes' ); ?> />
	            <?php _e( 'Enable Square Boxes and Slider(Products)', 'seller' )?>
	        </label>
	        <br />
	        <label for="enable-coverflow">
	            <input type="checkbox" name="enable-coverflow" id="enable-coverflow" value="yes" <?php if ( isset ( $seller_sellerd_meta['enable-coverflow'] ) ) checked( $seller_sellerd_meta['enable-coverflow'][0], 'yes' ); ?> />
	            <?php _e( 'Enable CoverFlow(Products)', 'seller' )?>
	        </label>
	        <br />
	        <label for="enable-sqbx-posts">
	            <input type="checkbox" name="enable-sqbx-posts" id="enable-sqbx-posts" value="yes" <?php if ( isset ( $seller_sellerd_meta['enable-sqbx-posts'] ) ) checked( $seller_sellerd_meta['enable-sqbx-posts'][0], 'yes' ); ?> />
	            <?php _e( 'Enable Square Boxes and Slider(Posts)', 'seller' )?>
	        </label>
	        <br />
	        <label for="enable-carousel">
	            <input type="checkbox" name="enable-carousel" id="enable-carousel" value="yes" <?php if ( isset ( $seller_sellerd_meta['enable-carousel'] ) ) checked( $seller_sellerd_meta['enable-carousel'][0], 'yes' ); ?> />
	            <?php _e( 'Enable Carousel', 'seller' )?>
	        </label>
	        <br />
	        <label for="enable-grid">
	            <input type="checkbox" name="enable-grid" id="enable-grid" value="yes" <?php if ( isset ( $seller_sellerd_meta['enable-grid'] ) ) checked( $seller_sellerd_meta['enable-grid'][0], 'yes' ); ?> />
	            <?php _e( 'Enable Grid', 'seller' )?>
	        </label>
	        <br />
	        <label for="enable-coverflow-posts">
	            <input type="checkbox" name="enable-coverflow-posts" id="enable-coverflow-posts" value="yes" <?php if ( isset ( $seller_sellerd_meta['enable-coverflow-posts'] ) ) checked( $seller_sellerd_meta['enable-coverflow-posts'][0], 'yes' ); ?> />
	            <?php _e( 'Enable CoverFlow (Posts)', 'seller' )?>
	        </label>
	        <br />
	        <label for="hide-title">
	            <input type="checkbox" name="hide-title" id="hide-title" value="yes" <?php if ( isset ( $seller_sellerd_meta['hide-title'] ) ) checked( $seller_sellerd_meta['hide-title'][0], 'yes' ); ?> />
	            <?php _e( 'Hide Page Title', 'seller' )?>
	        </label>
	        <br />
	        <label for="enable-full-width">
	            <input type="checkbox" name="enable-full-width" id="enable-full-width" value="yes" <?php if ( isset ( $seller_sellerd_meta['enable-full-width'] ) ) checked( $seller_sellerd_meta['enable-full-width'][0], 'yes' ); ?> />
	            <?php _e( 'Enable Full Width', 'seller' )?>
	        </label>
	    </div>
	</p>
 
    <?php
}


/**
 * Saves the custom meta input
 */
function seller_meta_save( $post_id ) {
 
    // Checks save status
    $is_autosave = wp_is_post_autosave( $post_id );
    $is_revision = wp_is_post_revision( $post_id );
    $is_valid_nonce = ( isset( $_POST[ 'seller_nonce' ] ) && wp_verify_nonce( $_POST[ 'seller_nonce' ], basename( __FILE__ ) ) ) ? 'true' : 'false';
 
    // Exits script depending on save status
    if ( $is_autosave || $is_revision || !$is_valid_nonce ) {
        return;
    }
 
    // Checks for input and sanitizes/saves if needed
    if( isset( $_POST[ 'meta-text' ] ) ) {
        update_post_meta( $post_id, 'meta-text', sanitize_text_field( $_POST[ 'meta-text' ] ) );
    }
    
    // Checks for input and saves
	if( isset( $_POST[ 'enable-slider' ] ) ) {
	    update_post_meta( $post_id, 'enable-slider', 'yes' );
	} else {
	    update_post_meta( $post_id, 'enable-slider', '' );
	}
	
	if( isset( $_POST[ 'enable-showcase' ] ) ) {
	    update_post_meta( $post_id, 'enable-showcase', 'yes' );
	} else {
	    update_post_meta( $post_id, 'enable-showcase', '' );
	}
	
	// Checks for input and saves
	if( isset( $_POST[ 'enable-sqbx' ] ) ) {
	    update_post_meta( $post_id, 'enable-sqbx', 'yes' );
	} else {
	    update_post_meta( $post_id, 'enable-sqbx', '' );
	}
	
	// Checks for input and saves
	if( isset( $_POST[ 'enable-carousel' ] ) ) {
	    update_post_meta( $post_id, 'enable-carousel', 'yes' );
	} else {
	    update_post_meta( $post_id, 'enable-carousel', '' );
	}
	
	// Checks for input and saves
	if( isset( $_POST[ 'enable-grid' ] ) ) {
	    update_post_meta( $post_id, 'enable-grid', 'yes' );
	} else {
	    update_post_meta( $post_id, 'enable-grid', '' );
	}
	
	// Checks for input and saves
	if( isset( $_POST[ 'enable-coverflow' ] ) ) {
	    update_post_meta( $post_id, 'enable-coverflow', 'yes' );
	} else {
	    update_post_meta( $post_id, 'enable-coverflow', '' );
	}
	
	// Checks for input and saves
	if( isset( $_POST[ 'enable-sqbx-posts' ] ) ) {
	    update_post_meta( $post_id, 'enable-sqbx-posts', 'yes' );
	} else {
	    update_post_meta( $post_id, 'enable-sqbx-posts', '' );
	}
	
	// Checks for input and saves
	if( isset( $_POST[ 'enable-coverflow-posts' ] ) ) {
	    update_post_meta( $post_id, 'enable-coverflow-posts', 'yes' );
	} else {
	    update_post_meta( $post_id, 'enable-coverflow-posts', '' );
	}
	 
	// Checks for input and saves
	if( isset( $_POST[ 'hide-title' ] ) ) {
	    update_post_meta( $post_id, 'hide-title', 'yes' );
	} else {
	    update_post_meta( $post_id, 'hide-title', '' );
	}
	
	// Checks for input and saves
	if( isset( $_POST[ 'enable-full-width' ] ) ) {
	    update_post_meta( $post_id, 'enable-full-width', 'yes' );
	} else {
	    update_post_meta( $post_id, 'enable-full-width', '' );
	}
 
}
add_action( 'save_post', 'seller_meta_save' );