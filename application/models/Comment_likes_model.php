<?php

/**
 * Created by PhpStorm.
 * User: mr.incognito
 * Date: 27.01.2020
 * Time: 10:10
 */
class Comment_likes_model extends CI_Emerald_Model
{
    const CLASS_TABLE = 'comment_likes';


    /** @var int */
    protected $user_id;
    /** @var int */
    protected $comment_id;
    /** @var int */
    protected $amount;

    /** @var string */
    protected $time_created;
    /** @var string */
    protected $time_updated;

    // generated
    protected $comment;
    protected $user;


    /**
     * @return int
     */
    public function get_user_id(): int
    {
        return $this->user_id;
    }

    /**
     * @param int $user_id
     *
     * @return bool
     */
    public function set_user_id(int $user_id)
    {
        $this->user_id = $user_id;
        return $this->save('user_id', $user_id);
    }

    /**
     * @return int
     */
    public function get_comment_id(): int
    {
        return $this->comment_id;
    }

    /**
     * @param int $comment_id
     *
     * @return bool
     */
    public function set_comment_id(int $comment_id)
    {
        $this->comment_id = $comment_id;
        return $this->save('comment_id', $comment_id);
    }

    /**
     * @return int
     */
    public function get_amount(): int
    {
        return $this->amount;
    }

    /**
     * @param int $amount
     *
     * @return bool
     */
    public function set_amount(int $amount)
    {
        $this->amount = $amount;
        return $this->save('amount', $amount);
    }

    /**
     * @return string
     */
    public function get_time_created(): string
    {
        return $this->time_created;
    }

    /**
     * @param string $time_created
     *
     * @return bool
     */
    public function set_time_created(string $time_created)
    {
        $this->time_created = $time_created;
        return $this->save('time_created', $time_created);
    }

    /**
     * @return string
     */
    public function get_time_updated(): string
    {
        return $this->time_updated;
    }

    /**
     * @param string $time_updated
     *
     * @return bool
     */
    public function set_time_updated(int $time_updated)
    {
        $this->time_updated = $time_updated;
        return $this->save('time_updated', $time_updated);
    }

    // generated

    /**
     * @return Comment_model
     * @throws Exception
     */
    public function get_comment(): Comment_model
    {
        $this->is_loaded(TRUE);

        if (empty($this->comment)) {
            try {
                $this->comment = new Comment_model($this->get_comment_id());
            } catch (Exception $exception) {
                $this->comment = new Comment_model();
            }
        }
        return $this->comment;
    }

    /**
     * @return User_model
     * @throws Exception
     */
    public function get_user(): User_model
    {
        $this->is_loaded(TRUE);

        if (empty($this->user)) {
            try {
                $this->user = new User_model($this->get_user_id());
            } catch (Exception $exception) {
                $this->user = new User_model();
            }
        }
        return $this->user;
    }

    function __construct($id = NULL)
    {
        parent::__construct();

        $this->set_id($id);
    }

    public function reload(bool $for_update = FALSE)
    {
        parent::reload($for_update);

        return $this;
    }

    public static function create(array $data)
    {
        App::get_ci()->s->from(self::CLASS_TABLE)->insert($data)->execute();
        return new static(App::get_ci()->s->get_insert_id());
    }

    public function delete()
    {
        $this->is_loaded(TRUE);
        App::get_ci()->s->from(self::CLASS_TABLE)->where(['id' => $this->get_id()])->delete()->execute();
        return (App::get_ci()->s->get_affected_rows() > 0);
    }

    /**
     * @param int $comment_id
     * @return self[]
     */
    public static function get_all_by_comment_id(int $comment_id)
    {
        $data = App::get_ci()->s
            ->from(self::CLASS_TABLE)
            ->where(['comment_id' => $comment_id])
            ->many();

        $ret = [];

        foreach ($data as $i) {
            $ret[] = (new self())->set($i);
        }

        return $ret;
    }

    /**
     * @param self|self[] $data
     * @param string $preparation
     * @return int
     * @throws Exception
     */
    public static function preparation($data, $preparation = 'default')
    {
        switch ($preparation) {
            case 'full_amount':
                return self::_preparation_full_amount($data);
            default:
                throw new Exception('undefined preparation type');
        }
    }


    /**
     * @param self[] $data
     * @return int
     */
    private static function _preparation_full_amount($data)
    {
        $ret = 0;

        foreach ($data as $d) {
            $ret += $d->get_amount();
        }

        return $ret;
    }
}
