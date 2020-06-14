<?php
/**
 * Created by PhpStorm.
 * User: vladlengil
 * Date: 15.06.20
 * Time: 1:47
 */

class Log_model extends CI_Emerald_Model
{
    const CLASS_TABLE = 'log';
    const TYPE_ADD_MONEY = 0;
    const TYPE_BUY_BOOSTERPACK = 1;


    /** @var int */
    protected $type;
    /** @var string */
    protected $message;

    /** @var string */
    protected $time_created;
    /** @var string */
    protected $time_updated;

    /**
     * @return int
     */
    public function get_type(): int
    {
        return $this->type;
    }

    /**
     * @param int $type
     */
    public function set_type(int $type)
    {
        $this->type = $type;
        $this->save('type', $type);
    }

    /**
     * @return int
     */
    public function get_message(): int
    {
        if (is_string($this->message)) {
            $this->message = json_decode($this->message, TRUE);
        }

        return $this->message;
    }

    /**
     * @param string $message
     */
    public function set_message(string $message)
    {
        $this->message = $message;
        $this->save('message', json_encode($message));
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
    public function set_time_updated(string $time_updated)
    {
        $this->time_updated = $time_updated;
        return $this->save('time_updated', $time_updated);
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
     * @return self[]
     * @throws Exception
     */
    public static function get_all()
    {
        $data = App::get_ci()->s->from(self::CLASS_TABLE)->many();
        $ret = [];
        foreach ($data as $i) {
            $ret[] = (new self())->set($i);
        }
        return $ret;
    }

    /**
     * @param User_model $user
     * @param float $sum
     * @throws Exception
     */
    public static function add_money(User_model $user, float $sum)
    {
        self::create([
            'type' => self::TYPE_ADD_MONEY,
            'message' => json_encode([
                'user' => User_model::preparation($user, 'log'),
                'sum' => $sum,
            ]),
        ]);
    }

    public static function buy_boosterpack(User_model $user, Boosterpack_model $boosterpack, int $amount)
    {
        self::create([
            'type' => self::TYPE_BUY_BOOSTERPACK,
            'message' => json_encode([
                'user' => User_model::preparation($user, 'log'),
                'boosterpack' => Boosterpack_model::preparation($boosterpack),
                'amount' => $amount,
            ]),
        ]);
    }
}