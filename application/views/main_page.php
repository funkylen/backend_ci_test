<? App::get_ci()->load->view('base/header'); ?>

<div class="main">
    <? App::get_ci()->load->view('components/posts'); ?>
</div>

<? App::get_ci()->load->view('components/modals/auth'); ?>
<? App::get_ci()->load->view('components/modals/post'); ?>
<? App::get_ci()->load->view('components/modals/add_money'); ?>
<? App::get_ci()->load->view('components/modals/boosterpack_success'); ?>
<? App::get_ci()->load->view('components/modals/boosterpack_error'); ?>
<? App::get_ci()->load->view('components/modals/balance_history'); ?>

<? App::get_ci()->load->view('base/footer'); ?>


