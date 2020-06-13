<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class MY_Controller extends CI_Controller
{
    const HTTP_OK = 200;
    const HTTP_BAD = 400;
    const HTTP_UNAUTHORIZED = 401;
    const HTTP_FORBIDDEN = 403;
    const HTTP_SERVER_ERROR = 500;

    public function __construct()
    {
        parent::__construct();
    }

    public function post($index = NULL)
    {
        $stream_clean = App::get_ci()->security->xss_clean(App::get_ci()->input->raw_input_stream);

        $post = json_decode($stream_clean, TRUE);

        return $index === NULL ? $post : $post[$index];
    }

    public function __destruct()
    {

    }
}