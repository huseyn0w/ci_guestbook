<?php

$auth_error = $this->session->flashdata('LOGIN_FAIL');

require_template_part('header', $auth_error ); ?>


    <!-- Main Content -->
    <div class="container">
      <div class="row">

<?php  if(empty($reviews)): ?>
    <div class="col-lg-8 col-md-10 mx-auto">
        <h2>No reviews, you can add new one.</h2>
    </div>


<?php else:

    foreach ($reviews as $review):

?>

        <div class="col-lg-8 col-md-10 mx-auto">
          <div class="post-preview">
            <a href="<?php echo BASE_URL ?>reviews/show/<?php echo $review->id ?>">
              <h2 class="post-title">
                <?php echo $review->header; ?>
              </h2>
              <h3 class="post-subtitle">
                  <?php echo $review->excerpt; ?>
              </h3>
            </a>
            <p class="post-meta">Posted by
              <a href="<?php echo BASE_URL ?>users/<?php echo $review->author_name; ?>"><?php echo $review->author_name; ?></a>
              on <?php echo $review->created_date; ?>
            </p>
          </div>
        </div>

 <?php endforeach; endif; ?>


      </div>
        <!-- Pager -->
        <div class="clearfix">
            <a class="btn btn-primary float-right" href="#">Older Posts &rarr;</a>
        </div>
    </div>

    <hr>

<?php require_template_part('footer') ?>