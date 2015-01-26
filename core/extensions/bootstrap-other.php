<?php

/**
 * File Security Check
 */
if ( ! empty( $_SERVER['SCRIPT_FILENAME'] ) && basename( __FILE__ ) == basename( $_SERVER['SCRIPT_FILENAME'] ) ) {
    die ( 'You do not have sufficient permissions to access this page!' );
}

/**
 * Parse the thumbnail HTML to adjust the output to meet bootstrap HTML/CSS structure
 */
function get_the_image_anchor_class( $html, $post_id, $post_thumbnail_id ) {

    if ( ! $html )
        return;

    $dom = new DOMDocument();

    @$dom->loadHTML(mb_convert_encoding($html, 'HTML-ENTITIES', 'UTF-8'));

    $x = new DOMXPath($dom);

    foreach($x->query("//a") as $node) {   
        $node->setAttribute("class","thumbnail");
    }

    foreach($x->query("//img") as $node) {   

        $classes = explode(" ", $node->attributes->getNamedItem("class")->nodeValue);

        $new_classes = array();

        if ( ! empty( $classes ) ) {

            $new_classes = array_diff( $classes, array('thumbnail') );

        }

        if ( ! empty ( $new_classes ) ) {

            $new_classes = implode(" ", $new_classes );

            $node->setAttribute("class", $new_classes );

        }

    }

    $newHtml = preg_replace('~<(?:!DOCTYPE|/?(?:html|body))[^>]*>\s*~i', '', $dom->saveHTML());

    return $newHtml;

}

add_filter( 'post_thumbnail_html', 'get_the_image_anchor_class', 99, 3);

/**
 * Parse the avatar HTML to adjust the output to meet bootstrap HTML/CSS structure
 */
function avatar_img_circle_class( $html ) {

    if ( ! $html )
        return;

    $dom = new DOMDocument();

    @$dom->loadHTML(mb_convert_encoding($html, 'HTML-ENTITIES', 'UTF-8'));

    $x = new DOMXPath($dom);

    foreach($x->query("//img") as $node) {   
        $classes = $node->getAttribute( "class" );
        $classes .= ' img-circle';
        $node->setAttribute( "class" , $classes );
    }

    $newHtml = preg_replace('~<(?:!DOCTYPE|/?(?:html|body))[^>]*>\s*~i', '', $dom->saveHTML());

    return $newHtml;

}

add_filter('get_avatar', 'avatar_img_circle_class', 10, 1 );

/**
 * Parse the reply link HTML to adjust the output to meet bootstrap HTML/CSS structure
 */
function add_bootstrap_btn_class( $html, $args, $comment, $post ) {

    if ( ! $html )
        return;

    $dom = new DOMDocument();

    @$dom->loadHTML(mb_convert_encoding($html, 'HTML-ENTITIES', 'UTF-8'));

    $x = new DOMXPath($dom);

    foreach($x->query("//a") as $node) {   
        $classes = $node->getAttribute( "class" );
        $classes .= ' btn btn-default btn-sm';
        $node->setAttribute( "class" , $classes );
    }

    $newHtml = preg_replace('~<(?:!DOCTYPE|/?(?:html|body))[^>]*>\s*~i', '', $dom->saveHTML());

    return $newHtml;

}

add_filter('comment_reply_link', 'add_bootstrap_btn_class', 10, 4 );

/**
 * Parse the cleaner gallery HTML to adjust the output to meet bootstrap HTML/CSS structure
 */
function cleaner_gallery_anchor_class( $html, $attachment_id, $attr, $cleaner_gallery_instance ) {

    if ( ! $html )
        return;

    $dom = new DOMDocument();

    @$dom->loadHTML(mb_convert_encoding($html, 'HTML-ENTITIES', 'UTF-8'));

    $x = new DOMXPath($dom);

    foreach($x->query("//a") as $node) {   
        $node->setAttribute("class","thumbnail");
    }

    $newHtml = preg_replace('~<(?:!DOCTYPE|/?(?:html|body))[^>]*>\s*~i', '', $dom->saveHTML());

    return $newHtml;

}

add_filter( 'cleaner_gallery_image', 'cleaner_gallery_anchor_class', 99, 4);

/**
 * Modify comment form to work better with bootstrap styles
 */
function bootstrap_comment_form_args( $args ) {

    $post_id = get_the_ID();
    $commenter = wp_get_current_commenter();
    $user = wp_get_current_user();
    $user_identity = $user->exists() ? $user->display_name : '';
    $req      = get_option( 'require_name_email' );
    $aria_req = ( $req ? " aria-required='true'" : '' );
    $html5    = 'html5';

    $fields   =  array(
        'author' => '<div class="form-group comment-form-author">' . '<label for="author">' . __( 'Name', hybrid_get_parent_textdomain() ) . ( $req ? ' <span class="required">*</span>' : '' ) . '</label> ' .
                    '<input id="author" class="form-control" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30"' . $aria_req . ' /></div>',
        'email'  => '<div class="form-group comment-form-email"><label for="email">' . __( 'Email', hybrid_get_parent_textdomain() ) . ( $req ? ' <span class="required">*</span>' : '' ) . '</label> ' .
                    '<input id="email" class="form-control" name="email" ' . ( $html5 ? 'type="email"' : 'type="text"' ) . ' value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30"' . $aria_req . ' /></div>',
        'url'    => '<div class="form-group comment-form-url"><label for="url">' . __( 'Website', hybrid_get_parent_textdomain() ) . '</label> ' .
                    '<input id="url" class="form-control" name="url" ' . ( $html5 ? 'type="url"' : 'type="text"' ) . ' value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="30" /></div>',
    );

    $args = array(
        'fields'               => $fields,
        'comment_field'        => '<div class="form-group comment-form-comment"><label for="comment">' . _x( 'Comment', 'noun', hybrid_get_parent_textdomain() ) . '</label> <textarea id="comment" class="form-control" name="comment" cols="45" rows="8" aria-required="true"></textarea></div>',
        'must_log_in'          => '<p class="must-log-in">' . sprintf( __( 'You must be <a href="%s">logged in</a> to post a comment.' ), wp_login_url( apply_filters( 'the_permalink', get_permalink( $post_id ) ) ) ) . '</p>',
        'logged_in_as'         => '<p class="logged-in-as">' . sprintf( __( 'Logged in as <a href="%1$s">%2$s</a>. <a href="%3$s" title="Log out of this account">Log out?</a>' ), get_edit_user_link(), $user_identity, wp_logout_url( apply_filters( 'the_permalink', get_permalink( $post_id ) ) ) ) . '</p>',
        'comment_notes_before' => '',
        'comment_notes_after'  => '',
        'id_form'              => 'commentform',
        'id_submit'            => 'submit',
        'name_submit'          => 'submit',
        'title_reply'          => __( 'Leave a Reply', hybrid_get_parent_textdomain() ),
        'title_reply_to'       => __( 'Leave a Reply to %s', hybrid_get_parent_textdomain() ),
        'cancel_reply_link'    => __( 'Cancel reply', hybrid_get_parent_textdomain() ),
        'label_submit'         => __( 'Post Comment', hybrid_get_parent_textdomain() ),
        'format'               => 'html5',
    );

    return $args;

}

add_filter( 'comment_form_defaults', 'bootstrap_comment_form_args', 15 );

/**
 * Modify the password protected post form to work better for bootstrap styling
 */
function bootstrap_password_form() {

    global $post;

    $label = 'pwbox-' . ( empty($post->ID) ? rand() : $post->ID );

    $output = '<form action="' . esc_url( site_url( 'wp-login.php?action=postpass', 'login_post' ) ) . '" class="post-password-form form-inline" method="post" role="form"><p>' . __( 'This content is password protected. To view it please enter your password below:', hybrid_get_parent_textdomain() ) . '</p><div class="form-group"><label for="' . $label . '" class="sr-only">' . __( 'Password:', hybrid_get_parent_textdomain() ) . '</label><input name="post_password" id="' . $label . '" type="password" class="form-control" size="20" placeholder="' . __( 'Password:', hybrid_get_parent_textdomain() ) . '" /></div><div class="form-group"><button type="submit" class="btn btn-default" name="Submit" >' . esc_attr__( 'Submit', hybrid_get_parent_textdomain() ) . '</button></div></form>';

    return $output;

}

add_filter( 'the_password_form', 'bootstrap_password_form' );


/**
 * Modify the calendar widget styling to work better for bootstrap styling
 */
function bootstrap_caledar_widget( $html ) {

    if ( ! $html )
        return;

    $dom = new DOMDocument();

    @$dom->loadHTML(mb_convert_encoding($html, 'HTML-ENTITIES', 'UTF-8'));

    $x = new DOMXPath($dom);

    foreach($x->query("//table") as $node) {   
        $node->setAttribute("class","table table-striped");
    }

    $newHtml = preg_replace('~<(?:!DOCTYPE|/?(?:html|body))[^>]*>\s*~i', '', $dom->saveHTML());

    return $newHtml;
 
}

add_filter( 'get_calendar', 'bootstrap_caledar_widget' );


/**
 * Use bootstrap badge styling for category counts e.g. in the category widget
 */
function bootstrap_count_badges($links) {

    //woocommerce already has a span with a count class
    if ( strpos( $links ,'<span class="count">' ) !== false) {
        
        $links = str_replace('<span class="count">', '<span class="badge">', $links);
        
        $links = str_replace( array('(',')') , '', $links);

    } else {

        $links = str_replace('</a> (', '</a> <span class="badge">', $links);
    
        $links = str_replace(')', '</span>', $links);

    }

    return $links;

}

//add_filter('wp_list_categories', 'bootstrap_count_badges');



/**
 * Check if bbpress is active
 **/
if ( in_array( 'bbpress/bbpress.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {

    add_filter( 'bbp_get_dropdown', 'bootstrap_bbpress_dropdowns', 10, 2);
    add_filter( 'bbp_get_form_topic_type_dropdown', 'bootstrap_bbpress_dropdowns', 10, 2);
    add_filter( 'bbp_get_form_topic_status_dropdown', 'bootstrap_bbpress_dropdowns', 10, 2);

    remove_action( 'bbp_template_notices', 'bbp_notice_edit_user_success' );
    add_action( 'bbp_template_notices', 'bootstrap_bbpress_notice_edit_user_success' );

    remove_action( 'bbp_template_notices', 'bbp_notice_edit_user_is_super_admin', 2 );
    add_action( 'bbp_template_notices', 'bootstrap_bbpress_notice_edit_user_is_super_admin', 2 );

    add_filter( 'bbp_get_forum_pagination_links', 'bootstrap_bbpress_pagination_links', 10, 2);
    add_filter( 'bbp_get_topic_pagination_links', 'bootstrap_bbpress_pagination_links', 10, 2);
    add_filter( 'bbp_get_search_pagination_links', 'bootstrap_bbpress_pagination_links', 10, 2);

    add_filter( 'bbp_get_topic_pagination', 'bootstrap_bbpress_pagination_links_topics', 10, 2);

    add_action( 'widgets_init', 'bbpress_bootstrap_default_widgets', 11 );

}


function bootstrap_bbpress_pagination_links( $html, $r = '' ) {

    if ( ! $html )
        return;

    $dom = new DOMDocument();

    @$dom->loadHTML(mb_convert_encoding($html, 'HTML-ENTITIES', 'UTF-8'));

    $x = new DOMXPath($dom);

    //replace span tags with anchor tags
    foreach($x->query("//span") as $node) {

        $new_a = $dom->createElement('a', $node->nodeValue );

        if ( strpos( $node->getAttribute('class'),'current') !== false ) {
            $new_a->setAttribute('class','active');
        } else {
            $new_a->setAttribute('class','disabled');
        }

        $new_a->setAttribute('href','#');

        $node->parentNode->replaceChild($new_a, $node);

    }

    //wrap anchor tags with list item tags
    foreach($x->query("//a") as $node) {

        $new_a = $dom->createElement('a', $node->nodeValue );
        $new_a->setAttribute('href', $node->getAttribute('href') );

        $new_li = $dom->createElement('li');

        if ( $node->getAttribute('class') == 'active' )
            $new_li->setAttribute('class','active');

        if ( $node->getAttribute('class') == 'disabled' )
            $new_li->setAttribute('class','disabled');

        $new_li->appendChild($new_a);

        $node->parentNode->replaceChild($new_li, $node);

    }

    $newHtml = preg_replace('~<(?:!DOCTYPE|/?(?:html|body))[^>]*>\s*~i', '', $dom->saveHTML());

    return $newHtml;
 
}

function bootstrap_bbpress_pagination_links_topics( $html, $r = '' ) {

    if ( ! $html )
        return;

    $dom = new DOMDocument();

    @$dom->loadHTML(mb_convert_encoding($html, 'HTML-ENTITIES', 'UTF-8'));

    $x = new DOMXPath($dom);

    //wrap anchor tags with list item tags
    foreach($x->query("//a") as $node) {

        $new_a = $dom->createElement('a', $node->nodeValue );
        $new_a->setAttribute('href', $node->getAttribute('href') );

        $new_li = $dom->createElement('li');

        $new_li->appendChild($new_a);

        $node->parentNode->replaceChild($new_li, $node);

    }

    $newHtml = preg_replace('~<(?:!DOCTYPE|/?(?:html|body))[^>]*>\s*~i', '', $dom->saveHTML());

    return $newHtml;
 
}

function bootstrap_bbpress_dropdowns( $html, $r ) {

    if ( ! $html )
        return;

    $dom = new DOMDocument();

    @$dom->loadHTML(mb_convert_encoding($html, 'HTML-ENTITIES', 'UTF-8'));

    $x = new DOMXPath($dom);

    foreach($x->query("//select") as $node) {   
        $node->setAttribute("class","form-control");
    }

    $newHtml = preg_replace('~<(?:!DOCTYPE|/?(?:html|body))[^>]*>\s*~i', '', $dom->saveHTML());

    return $newHtml;
 
}

function bootstrap_bbpress_notice_edit_user_is_super_admin() {
    if ( is_multisite() && ( bbp_is_single_user() || bbp_is_single_user_edit() ) && current_user_can( 'manage_network_options' ) && is_super_admin( bbp_get_displayed_user_id() ) ) : ?>

    <div class="alert alert-warning">
        <?php bbp_is_user_home() || bbp_is_user_home_edit() ? esc_html_e( 'You have super admin privileges.', 'bbpress' ) : esc_html_e( 'This user has super admin privileges.', 'bbpress' ); ?>
    </div>

<?php endif;
}

function bootstrap_bbpress_notice_edit_user_success() {
    if ( isset( $_GET['updated'] ) && ( bbp_is_single_user() || bbp_is_single_user_edit() ) ) : ?>

    <div class="alert alert-success">
        <?php esc_html_e( 'User updated.', 'bbpress' ); ?>
    </div>

    <?php endif;
}

/**
 * Copy of bbp_edit_user_display_name from bbPress core with additional "form-control" class on select field
 */
function bootstrap_bbpress_edit_user_display_name() {
    $bbp            = bbpress();
    $public_display = array();
    $public_display['display_username'] = $bbp->displayed_user->user_login;

    if ( !empty( $bbp->displayed_user->nickname ) )
        $public_display['display_nickname']  = $bbp->displayed_user->nickname;

    if ( !empty( $bbp->displayed_user->first_name ) )
        $public_display['display_firstname'] = $bbp->displayed_user->first_name;

    if ( !empty( $bbp->displayed_user->last_name ) )
        $public_display['display_lastname']  = $bbp->displayed_user->last_name;

    if ( !empty( $bbp->displayed_user->first_name ) && !empty( $bbp->displayed_user->last_name ) ) {
        $public_display['display_firstlast'] = $bbp->displayed_user->first_name . ' ' . $bbp->displayed_user->last_name;
        $public_display['display_lastfirst'] = $bbp->displayed_user->last_name  . ' ' . $bbp->displayed_user->first_name;
    }

    if ( !in_array( $bbp->displayed_user->display_name, $public_display ) ) // Only add this if it isn't duplicated elsewhere
        $public_display = array( 'display_displayname' => $bbp->displayed_user->display_name ) + $public_display;

    $public_display = array_map( 'trim', $public_display );
    $public_display = array_unique( $public_display ); ?>

    <select name="display_name" id="display_name" class="form-control">

    <?php foreach ( $public_display as $id => $item ) : ?>

        <option id="<?php echo $id; ?>" value="<?php echo esc_attr( $item ); ?>"<?php selected( $bbp->displayed_user->display_name, $item ); ?>><?php echo $item; ?></option>

    <?php endforeach; ?>

    </select>

<?php
}

/**
 * Copy of bbp_edit_user_blog_role from bbPress core with additional "form-control" class on select field
 */
function bootstrap_bbpress_edit_user_blog_role() {

    // Return if no user is being edited
    if ( ! bbp_is_single_user_edit() )
        return;

    // Get users current blog role
    $user_role  = bbp_get_user_blog_role( bbp_get_displayed_user_id() );

    // Get the blog roles
    $blog_roles = bbp_get_blog_roles(); ?>

    <select name="role" id="role" class="form-control">
        <option value=""><?php esc_html_e( '&mdash; No role for this site &mdash;', 'bbpress' ); ?></option>

        <?php foreach ( $blog_roles as $role => $details ) : ?>

            <option <?php selected( $user_role, $role ); ?> value="<?php echo esc_attr( $role ); ?>"><?php echo translate_user_role( $details['name'] ); ?></option>

        <?php endforeach; ?>

    </select>

    <?php
}

/**
 * Copy of bbp_edit_user_forums_role from bbPress core with additional "form-control" class on select field
 */
function bootstrap_bbpress_edit_user_forums_role() {

    // Return if no user is being edited
    if ( ! bbp_is_single_user_edit() )
        return;

    // Get the user's current forum role
    $user_role     = bbp_get_user_role( bbp_get_displayed_user_id() );

    // Get the folum roles
    $dynamic_roles = bbp_get_dynamic_roles();

    // Only keymasters can set other keymasters
    if ( ! bbp_is_user_keymaster() )
        unset( $dynamic_roles[ bbp_get_keymaster_role() ] ); ?>

    <select name="bbp-forums-role" id="bbp-forums-role"  class="form-control">
        <option value=""><?php esc_html_e( '&mdash; No role for these forums &mdash;', 'bbpress' ); ?></option>

        <?php foreach ( $dynamic_roles as $role => $details ) : ?>

            <option <?php selected( $user_role, $role ); ?> value="<?php echo esc_attr( $role ); ?>"><?php echo translate_user_role( $details['name'] ); ?></option>

        <?php endforeach; ?>

    </select>

    <?php
}

/**
 * Replace default bbpress widgets with bootstrap modified versions if needed
 */
function bbpress_bootstrap_default_widgets() {
     
    unregister_widget('BBP_Login_Widget');
    register_widget('BBP_Bootstrap_Login_Widget');

}

/**
 * Default bbPress Login Widget - modified with bootstrap classes
 *
 * Adds a widget which displays the login form
 *
  * @uses WP_Widget
 */
class BBP_Bootstrap_Login_Widget extends WP_Widget {

    /**
     * bbPress Login Widget
     *
     * Registers the login widget
     *
     * @since bbPress (r2827)
     *
     * @uses apply_filters() Calls 'bbp_login_widget_options' with the
     *                        widget options
     */
    public function __construct() {
        $widget_ops = apply_filters( 'bbp_login_widget_options', array(
            'classname'   => 'bbp_widget_login',
            'description' => __( 'A simple login form with optional links to sign-up and lost password pages.', 'bbpress' )
        ) );

        parent::__construct( false, __( '(bbPress) Login Widget', 'bbpress' ), $widget_ops );
    }

    /**
     * Register the widget
     *
     * @since bbPress (r3389)
     *
     * @uses register_widget()
     */
    public static function register_widget() {
        register_widget( 'BBP_Login_Widget' );
    }

    /**
     * Displays the output, the login form
     *
     * @since bbPress (r2827)
     *
     * @param mixed $args Arguments
     * @param array $instance Instance
     * @uses apply_filters() Calls 'bbp_login_widget_title' with the title
     * @uses get_template_part() To get the login/logged in form
     */
    public function widget( $args = array(), $instance = array() ) {

        // Get widget settings
        $settings = $this->parse_settings( $instance );

        // Typical WordPress filter
        $settings['title'] = apply_filters( 'widget_title', $settings['title'], $instance, $this->id_base );

        // bbPress filters
        $settings['title']    = apply_filters( 'bbp_login_widget_title',    $settings['title'],    $instance, $this->id_base );
        $settings['register'] = apply_filters( 'bbp_login_widget_register', $settings['register'], $instance, $this->id_base );
        $settings['lostpass'] = apply_filters( 'bbp_login_widget_lostpass', $settings['lostpass'], $instance, $this->id_base );

        echo $args['before_widget'];

        if ( !empty( $settings['title'] ) ) {
            echo $args['before_title'] . $settings['title'] . $args['after_title'];
        }

        if ( !is_user_logged_in() ) : ?>

            <form role="form" method="post" action="<?php bbp_wp_login_action( array( 'context' => 'login_post' ) ); ?>" class="bbp-login-form">
                <fieldset>
                    <legend><?php _e( 'Log In', 'bbpress' ); ?></legend>

                    <div class="bbp-username form-group">
                        <label for="user_login"><?php _e( 'Username', 'bbpress' ); ?>: </label>
                        <input type="text" name="log" value="<?php bbp_sanitize_val( 'user_login', 'text' ); ?>" size="20" id="user_login" class="form-control" tabindex="<?php bbp_tab_index(); ?>" />
                    </div>

                    <div class="bbp-password form-group">
                        <label for="user_pass"><?php _e( 'Password', 'bbpress' ); ?>: </label>
                        <input type="password" name="pwd" value="<?php bbp_sanitize_val( 'user_pass', 'password' ); ?>" size="20" id="user_pass" class="form-control" tabindex="<?php bbp_tab_index(); ?>" />
                    </div>

                    <div class="bbp-remember-me checkbox">
                        <label for="rememberme"><input type="checkbox" name="rememberme" value="forever" <?php checked( bbp_get_sanitize_val( 'rememberme', 'checkbox' ), true, true ); ?> id="rememberme" tabindex="<?php bbp_tab_index(); ?>" /> <?php _e( 'Remember Me', 'bbpress' ); ?></label>
                    </div>

                    <div class="form-group">

                        <?php do_action( 'login_form' ); ?>

                        <button type="submit" name="user-submit" id="user-submit" tabindex="<?php bbp_tab_index(); ?>" class="btn btn-default"><?php _e( 'Log In', 'bbpress' ); ?></button>

                        <?php bbp_user_login_fields(); ?>

                    </div>

                    <?php if ( !empty( $settings['register'] ) || !empty( $settings['lostpass'] ) ) : ?>

                        <div class="bbp-login-links">

                            <?php if ( !empty( $settings['register'] ) ) : ?>

                                <a href="<?php echo esc_url( $settings['register'] ); ?>" title="<?php esc_attr_e( 'Register', 'bbpress' ); ?>" class="bbp-register-link"><?php _e( 'Register', 'bbpress' ); ?></a>

                            <?php endif; ?>

                            <?php if ( !empty( $settings['lostpass'] ) ) : ?>

                                <a href="<?php echo esc_url( $settings['lostpass'] ); ?>" title="<?php esc_attr_e( 'Lost Password', 'bbpress' ); ?>" class="bbp-lostpass-link"><?php _e( 'Lost Password', 'bbpress' ); ?></a>

                            <?php endif; ?>

                        </div>

                    <?php endif; ?>

                </fieldset>
            </form>

        <?php else : ?>

            <div class="bbp-logged-in">
                <a href="<?php bbp_user_profile_url( bbp_get_current_user_id() ); ?>" class="submit user-submit"><?php echo get_avatar( bbp_get_current_user_id(), '40' ); ?></a>
                <h4><?php bbp_user_profile_link( bbp_get_current_user_id() ); ?></h4>

                <?php bbp_logout_link(); ?>
            </div>

        <?php endif;

        echo $args['after_widget'];
    }

    /**
     * Update the login widget options
     *
     * @since bbPress (r2827)
     *
     * @param array $new_instance The new instance options
     * @param array $old_instance The old instance options
     */
    public function update( $new_instance, $old_instance ) {
        $instance             = $old_instance;
        $instance['title']    = strip_tags( $new_instance['title'] );
        $instance['register'] = esc_url_raw( $new_instance['register'] );
        $instance['lostpass'] = esc_url_raw( $new_instance['lostpass'] );

        return $instance;
    }

    /**
     * Output the login widget options form
     *
     * @since bbPress (r2827)
     *
     * @param $instance Instance
     * @uses BBP_Login_Widget::get_field_id() To output the field id
     * @uses BBP_Login_Widget::get_field_name() To output the field name
     */
    public function form( $instance = array() ) {

        // Get widget settings
        $settings = $this->parse_settings( $instance ); ?>

        <p>
            <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:', 'bbpress' ); ?>
            <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $settings['title'] ); ?>" /></label>
        </p>

        <p>
            <label for="<?php echo $this->get_field_id( 'register' ); ?>"><?php _e( 'Register URI:', 'bbpress' ); ?>
            <input class="widefat" id="<?php echo $this->get_field_id( 'register' ); ?>" name="<?php echo $this->get_field_name( 'register' ); ?>" type="text" value="<?php echo esc_url( $settings['register'] ); ?>" /></label>
        </p>

        <p>
            <label for="<?php echo $this->get_field_id( 'lostpass' ); ?>"><?php _e( 'Lost Password URI:', 'bbpress' ); ?>
            <input class="widefat" id="<?php echo $this->get_field_id( 'lostpass' ); ?>" name="<?php echo $this->get_field_name( 'lostpass' ); ?>" type="text" value="<?php echo esc_url( $settings['lostpass'] ); ?>" /></label>
        </p>

        <?php
    }

    /**
     * Merge the widget settings into defaults array.
     *
     * @since bbPress (r4802)
     *
     * @param $instance Instance
     * @uses bbp_parse_args() To merge widget settings into defaults
     */
    public function parse_settings( $instance = array() ) {
        return bbp_parse_args( $instance, array(
            'title'    => '',
            'register' => '',
            'lostpass' => ''
        ), 'login_widget_settings' );
    }
}

