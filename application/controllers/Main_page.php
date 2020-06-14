<?php

/**
 * Created by PhpStorm.
 * User: mr.incognito
 * Date: 10.11.2018
 * Time: 21:36
 */
class Main_page extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();

        App::get_ci()->load->model('User_model');
        App::get_ci()->load->model('Login_model');
        App::get_ci()->load->model('Post_model');

        if (is_prod()) {
            die('In production it will be hard to debug! Run as development environment!');
        }
    }

    public function index()
    {
        $user = User_model::get_user();


        App::get_ci()->load->view('main_page', ['user' => User_model::preparation($user, 'default')]);
    }

    public function get_all_posts()
    {
        $posts = Post_model::preparation(Post_model::get_all(), 'main_page');
        return $this->response_success(['posts' => $posts]);
    }

    public function get_post($post_id)
    { // or can be $this->input->post('news_id') , but better for GET REQUEST USE THIS

        $post_id = intval($post_id);

        if (empty($post_id)) {
            return $this->response_error(CI_Core::RESPONSE_GENERIC_WRONG_PARAMS);
        }

        try {
            $post = new Post_model($post_id);
        } catch (EmeraldModelNoDataException $ex) {
            return $this->response_error(CI_Core::RESPONSE_GENERIC_NO_DATA);
        }


        $posts = Post_model::preparation($post, 'full_info');
        return $this->response_success(['post' => $posts]);
    }


    public function comment()
    {
        if (!User_model::is_logged()) {
            return $this->response_error(CI_Core::RESPONSE_GENERIC_NEED_AUTH);
        }

        $post_id = trim($this->post('post_id'));
        $message = trim($this->post('message'));

        if (empty($post_id) || empty($message)) {
            return $this->response_error(CI_Core::RESPONSE_GENERIC_WRONG_PARAMS);
        }

        try {
            $post = new Post_model($post_id);
        } catch (EmeraldModelNoDataException $ex) {
            return $this->response_error(CI_Core::RESPONSE_GENERIC_NO_DATA);
        }

        Comment_model::create([
            'user_id' => User_model::get_user()->get_id(),
            'assign_id' => $post_id,
            'text' => $message,
        ]);

        $posts = Post_model::preparation($post, 'full_info');

        return $this->response_success(['post' => $posts]);
    }


    public function login()
    {
        $credentials = [
            'email' => trim($this->post('login')),
            'password' => trim($this->post('password')),
        ];

        if (empty($credentials['email']) || empty($credentials['password'])) {
            return $this->response_error(CI_Core::RESPONSE_GENERIC_WRONG_PARAMS);
        }

        $user = App::get_ci()->s
            ->from(User_model::CLASS_TABLE)
            ->where($credentials)
            ->select('id')
            ->one();

        if (!isset($user['id'])) {
            return $this->response_error(CI_Core::RESPONSE_GENERIC_WRONG_PARAMS);
        }

        Login_model::start_session($user['id']);

        return $this->response_success(['user' => $user['id']]);
    }


    public function logout()
    {
        Login_model::logout();
        redirect(site_url('/', 'http'));
    }

    public function add_money()
    {
        if (!User_model::is_logged()) {
            return $this->response_error(CI_Core::RESPONSE_GENERIC_NEED_AUTH);
        }

        $sum = trim($this->post('sum'));

        if (empty($sum)) {
            return $this->response_error(CI_Core::RESPONSE_GENERIC_WRONG_PARAMS);
        }

        $user = User_model::get_user();

        $balance = $user->get_wallet_balance() + floatval($sum);
        $total_refilled = $user->get_wallet_total_refilled() + floatval($sum);

        $user->set_wallet_balance($balance);
        $user->set_wallet_total_refilled($total_refilled);

        $user->reload(TRUE);

        return $this->response_success(['amount' => $balance]);
    }

    public function buy_boosterpack()
    {
        // todo: add money to user logic
        return $this->response_success(['amount' => rand(1, 55)]);
    }


    public function like()
    {
        if (!User_model::is_logged()) {
            return $this->response_error(CI_Core::RESPONSE_GENERIC_NEED_AUTH);
        }

        $assign_id = trim($this->post('assign_id'));

        if (empty($assign_id)) {
            return $this->response_error(CI_Core::RESPONSE_GENERIC_WRONG_PARAMS);
        }

        try {
            $post = new Post_model($assign_id);
        } catch (EmeraldModelNoDataException $ex) {
            return $this->response_error(CI_Core::RESPONSE_GENERIC_NO_DATA);
        }

        $user = User_model::get_user();

        App::get_ci()->s->start_trans();

        $balance = $user->get_likes_balance() - 1;

        if ($balance < 0) {
            return $this->response_error('insufficient funds');
        }

        $user_like = App::get_ci()->s
            ->from(Post_likes_model::CLASS_TABLE)
            ->where('user_id', $user->get_id())
            ->where('post_id', $post->get_id())
            ->one();

        if (empty($user_like)) {
            Post_likes_model::create([
                'user_id' => $user->get_id(),
                'post_id' => $post->get_id(),
                'amount' => 1,
            ]);
        } else {
            $user_like = (new Post_likes_model())->set($user_like);
            $amount = 1 + $user_like->get_amount();
            $user_like->set_amount($amount);
            $user_like->reload(TRUE);
        }

        $user->set_likes_balance($balance);

        $post->reload();

        $likes = Post_likes_model::preparation($post->get_likes(), 'full_amount');

        App::get_ci()->s->commit();

        return $this->response_success(['likes' => $likes]);
    }

    public function like_comment()
    {
        if (!User_model::is_logged()) {
            return $this->response_error(CI_Core::RESPONSE_GENERIC_NEED_AUTH);
        }

        $comment_id = trim($this->post('comment_id'));

        if (empty($comment_id)) {
            return $this->response_error(CI_Core::RESPONSE_GENERIC_WRONG_PARAMS);
        }

        try {
            $comment = new Comment_model($comment_id);
        } catch (EmeraldModelNoDataException $ex) {
            return $this->response_error(CI_Core::RESPONSE_GENERIC_NO_DATA);
        }

        $user = User_model::get_user();

        App::get_ci()->s->start_trans();

        $balance = $user->get_likes_balance() - 1;

        if ($balance < 0) {
            return $this->response_error('insufficient funds');
        }

        $user_like = App::get_ci()->s
            ->from(Comment_likes_model::CLASS_TABLE)
            ->where('user_id', $user->get_id())
            ->where('comment_id', $comment->get_id())
            ->one();

        if (empty($user_like)) {
            Comment_likes_model::create([
                'user_id' => $user->get_id(),
                'comment_id' => $comment->get_id(),
                'amount' => 1,
            ]);
        } else {
            $user_like = (new Comment_likes_model())->set($user_like);
            $amount = 1 + $user_like->get_amount();
            $user_like->set_amount($amount);
            $user_like->reload(TRUE);
        }

        $user->set_likes_balance($balance);

        $comment->reload();

        $likes = Comment_likes_model::preparation($comment->get_likes(), 'full_amount');

        App::get_ci()->s->commit();

        return $this->response_success(['likes' => $likes]);
    }

}
