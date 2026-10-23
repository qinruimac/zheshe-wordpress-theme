<?php
if (!defined('ABSPATH')) exit;

if (post_password_required()) {
  echo '<p class="text-center text-muted py-4">' . __('Enter password to view comments.', 'prism') . '</p>';
  return;
}
?>

<div id="comments" class="comments-area">
  <h4 class="mb-3"><i class="bi bi-chat-dots me-2"></i><?php _e('Comments', 'prism'); ?> (<?php echo get_comments_number(); ?>)</h4>

  <?php if (have_comments()) : ?>
    <div class="comment-list">
      <?php
      wp_list_comments(array(
        'style' => 'div',
        'type' => 'comment',
        'avatar_size' => 48,
        'format' => 'html5',
        'reply_text' => '<i class="bi bi-reply"></i> ' . __('Reply', 'prism'),
      ));
      ?>
    </div>

    <?php the_comments_pagination(array(
      'prev_text' => '«',
      'next_text' => '»',
    )); ?>

  <?php else : ?>
    <p class="text-muted"><?php _e('No comments yet. Be the first!', 'prism'); ?></p>
  <?php endif; ?>

  <?php
  comment_form(array(
    'title_reply' => '<h5 class="mb-3">' . __('Leave a Comment', 'prism') . '</h5>',
    'title_reply_to' => '<h5 class="mb-3">' . __('Reply to %s', 'prism') . '</h5>',
    'cancel_reply_link' => __('Cancel Reply', 'prism'),
    'label_submit' => __('Post Comment', 'prism'),
    'comment_field' => '<div class="mb-3"><textarea id="comment" name="comment" class="form-control" rows="4" placeholder="' . esc_attr__('Write your comment...', 'prism') . '" required></textarea></div>',
    'fields' => array(
      'author' => '<div class="mb-3"><input id="author" name="author" type="text" class="form-control" placeholder="' . esc_attr__('Name', 'prism') . '" required></div>',
      'email' => '<div class="mb-3"><input id="email" name="email" type="email" class="form-control" placeholder="' . esc_attr__('Email', 'prism') . '" required></div>',
      'url' => '<div class="mb-3"><input id="url" name="url" type="url" class="form-control" placeholder="' . esc_attr__('Website (optional)', 'prism') . '"></div>',
    ),
    'submit_button' => '<button name="%1$s" type="submit" id="%2$s" class="%3$s">%4$s</button>',
    'submit_field' => '<div class="text-end">%1$s %2$s</div>',
    'class_submit' => 'btn btn-primary',
  ));
  ?>
</div>