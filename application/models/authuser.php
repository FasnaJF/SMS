<?php

/**
 * Created by PhpStorm.
 * User: Mohammed
 * Date: 2/6/2015
 * Time: 6:03 AM
 */
class Authuser extends MY_Model
{

    protected $_table = 'authuser';

    public function add($user)
    {
        if (isset($user['address'])) {
            $id = $this->getIdByAddress($user['address']);
            if ($id) {
                return $id;
            }
        }
        return $this->insert($user);
    }

    public function getIdByAddress($address)
    {
        $user = $this->get_by(array('address' => $address));
        if (empty($user)) {
            return 0;
        }
        return $user->id;
    }

    public function getIdByPin($pin)
    {
        $user = $this->get_by(array('pin' => $pin));
        if (empty($user)) {
            return 0;
        }
        return $user->id;
    }

    public function getAll()
    {
        return $this->get_many_by(array('flag' => STATUS_ACTIVE));
    }

    public function getPending()
    {
        return $this->get_many_by(array('flag' => STATUS_PENDING));
    }


}