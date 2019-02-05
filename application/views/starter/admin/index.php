<?php
if(!is_logged_in() || get_current_status() !== 7){
  redirect(BASE_URL);
}
defined('BASEPATH') OR exit('No direct script access allowed');


require_template_part('admin/header');

?>


  <body id="page-top">

    <nav class="navbar navbar-expand navbar-dark bg-dark static-top">

      <a class="navbar-brand mr-1" href="#">Admin panel</a>

      <button class="btn btn-link btn-sm text-white order-1 order-sm-0" id="sidebarToggle" href="#">
        <i class="fas fa-bars"></i>
      </button>

      <!-- Navbar -->
      <ul class="navbar-nav ml-auto mr-0 mr-md-3 my-2 my-md-0">

        <li class="nav-item dropdown no-arrow">
          <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-user-circle fa-fw"></i>
          </a>
          <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
            <a class="dropdown-item" href="#">Settings</a>
            <a class="dropdown-item" href="#">Activity Log</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">Logout</a>
          </div>
        </li>
      </ul>

    </nav>

    <div id="wrapper">

    <?php require_template_part('admin/sidebar') ?>

      <div id="content-wrapper">

        <div class="container-fluid">

          <!-- Breadcrumbs-->
          <ol class="breadcrumb">
            <li class="breadcrumb-item">
              <a href="#">Dashboard</a>
            </li>
            <li class="breadcrumb-item active">Overview</li>
          </ol>

            <?php if($count_reviews === 0 && empty($reviews)): ?>
            <div class="row">
                <div class="col-12">
                    Welcome! There aren't any new reviews.
                </div>
            </div>
            <?php else: ?>


     <?php if($count_reviews > 0): ?>

          <!-- Icon Cards-->
          <div class="row">
            <div class="col-xl-3 col-sm-6 mb-3">
              <div class="card text-white bg-primary o-hidden h-100">
                <div class="card-body">
                  <div class="card-body-icon">
                    <i class="fas fa-fw fa-comments"></i>
                  </div>
                  <div class="mr-5">
                      <span class="message_count"><?php echo $count_reviews ?></span>
                      New Review<?php if($count_reviews > 1): ?>s<?php endif; ?>!
                  </div>
                </div>
                <a class="card-footer text-white clearfix small z-1" href="#">
                  <span class="float-left">View All reviews</span>
                  <span class="float-right">
                    <i class="fas fa-angle-right"></i>
                  </span>
                </a>
              </div>
            </div>
          </div>
     <?php endif; ?>


        <?php if(!empty($reviews)): ?>
          <!-- DataTables Example -->
          <div class="new-reviews card mb-3">
            <div class="card-header">
              <i class="fas fa-table"></i>
              Unapproved reviews</div>
            <div class="card-body">
              <div class="table-responsive">
                  <table class="reviews-table table">
                      <thead>
                        <tr>
                            <th>Title</th>
                            <th>Excerpt</th>
                            <th>Created Date</th>
                            <th>Author</th>
                            <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php foreach($reviews as $review): ?>
                        <tr>
                            <td><?php echo $review->header ?></td>
                            <td><?php echo $review->excerpt ?></td>
                            <td><?php echo $review->created_date ?></td>
                            <td><a href="<?php echo BASE_URL ?>users/<?php echo $review->author_username ?>" target="_blank"><?php echo $review->author_username ?></a></td>
                            <td>
                                <a href="<?php echo BASE_URL ?>full/<?php echo $review->id ?>" class="btn btn-primary">See full post</a>
                                <button type="button" data-approveID="<?php echo $review->id ?>" class="approve-review btn btn-success">Approve</button>
                                <button type="button" data-deleteID="<?php echo $review->id ?>" class="delete-review btn btn-danger">Delete</button>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                      </tbody>
                  </table>
              </div>
            </div>
            <div class="card-footer small text-muted">Updated now.</div>
          </div>
          <?php endif; endif; ?>

        </div>
        <!-- /.container-fluid -->

<?php

    $data['csrf_token_name'] = $csrf_token_name;
    $data['csrf_hash'] = $csrf_hash;

    require_template_part('admin/footer', $data);
?>