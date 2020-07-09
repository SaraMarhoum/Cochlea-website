<?php if ( ! defined( 'ABSPATH' ) ) { die( 'Direct access forbidden.' ); }
// this file with "website" field enabled:
// http://pastebin.com/raw/ncvL3fxG
?>


<!-- Single comment -->
<?php  if ( post_password_required() ) { return; }
function wph_jo_single_comment( $comment, $args, $depth ) {

	if(in_array($comment->comment_type, array('pingback', 'trackback'))) return; ?>

	<article <?php comment_class('row'); ?> id="comment-<?php comment_ID(); ?>">
		<!-- author photo -->
		<div class="avatar-col hidden-xs hidden-sm col-md-1">
			<?php echo get_avatar( $comment, 100 ) ?>
		</div>

		<!-- comment text & info -->
		<div class="comment-col col-xs-12 col-md-11">
			<header>
				<div class="name"><?php echo esc_html(get_comment_author( $comment )) ?></div>
				<time datetime="<?php comment_time('Y-m-d h:i') ?>"><?php comment_time('F m, Y \a\t g:i A') ?></time>
			</header>

			<div class="text"><?php comment_text() ?></div>

			<footer>
				<?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
				<?php edit_comment_link( esc_html__( 'Edit', 'jo-theme' ), ' ' ); ?>

				<?php if($comment->comment_approved == '0') : ?><div class="text-muted"><?php echo esc_html__('Your comment is awaiting moderation.', 'jo-theme') ?></div><?php endif ?>
			</footer>

			<div class="line visible-xs visible-sm"></div>
		</div>

		<!-- separator -->
		<div class="line visible-md visible-lg"></div>
	</article>
<?php } ?>


<!-- Block title (comments count) -->
<h1 class="block-title" data-count="<?php echo get_comments_number() ?>">
	<span><?php wph_jo_comment_count() ?></span>
</h1>


<!-- Block inner -->
<div class="content-inner">
	<?php if ( have_comments() ) : ?>

		<!-- Comments flow -->
		<?php wp_list_comments( array(
			'max_depth' => 3,
			'callback'  => 'wph_jo_single_comment'
		) ); ?>

		<!-- Comments navigation -->
		<?php wph_jo_theme_comments_nav(); ?>

	<?php endif; ?>


	<!-- If there is no comments -->
	<?php if ( ! comments_open() ) : ?>
		<p class="nodata-error"><?php echo esc_html__( 'Comments are closed.', 'jo-theme' ); ?></p>

	<?php elseif ( ! have_comments() ): ?>
		<p class="nodata-error"><?php echo esc_html__( 'Here is no comments for now.', 'jo-theme' ); ?></p>

	<?php endif; ?>


	<!-- "Add comment" form -->
	<?php
	$commenter = wp_get_current_commenter();
	$req       = get_option( 'require_name_email' );
	$aria_req  = ( $req ? " aria-required='true'" : '' );

	$args = array(
		'class_form' => 'comment-form wph-form',
		'fields'     => apply_filters(
			'comment_form_default_fields', array(
				'author' => '<div class="row"><div class="form-group col-xs-12 col-sm-6">'.
				            '<input id="author" class="form-control" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '"' . $aria_req . ' placeholder="' . esc_html__('Your name', 'jo-theme') . '" />'.
				            '</div>',

				'email'  => '<div class="form-group col-xs-12 col-sm-6">' .
				            '<input id="email" class="form-control" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) . '"' . $aria_req . ' placeholder="' . esc_html__('Email', 'jo-theme') . '" />'  .
				            '</div></div>',
			)
		),
		'comment_field' => '<div class="form-group">'.
		                   '<textarea id="comment" class="form-control" name="comment" rows="5" aria-required="true" required placeholder="' .  esc_html__('Type your message here', 'jo-theme') . '"></textarea>' .
		                   '</div>',

		'comment_notes_before' => '',
		'comment_notes_after'  => '',
		'class_submit'         => 'btn btn-primary btn-lg form-submit',

		'title_reply_to'       => esc_html__( 'Leave a reply to %s', 'jo-theme' ),
		'cancel_reply_link'    => esc_html__( 'Cancel', 'jo-theme' ),
		'title_reply'          => esc_html__( 'Leave a reply', 'jo-theme' )
	); ?>

	<div class="comment-form"><?php comment_form($args); ?></div>
</div>