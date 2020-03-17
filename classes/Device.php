<?php

/**
 * [<description>].
 *
 * @category [<category>]
 *
 * @author Ishtiyaq Husain <ishtiyaq.husain@gmail.com>
 * @copyright 2017 Ishtiyaq Husain
 * @license GPL http://ishtiyaq.com/license
 *
 * @version Release: 1.0.0
 *
 * @link http://ishtiyaq.com
 * @since File available since Release 1.0.0
 */
class Device
{
    private $_db;

    public function __construct($user = null)
    {
        $this->_db = DB::getInstance();
    }

    public function create($fields = array())
    {
        if (!$this->_db->insert('smc_device', $fields)) {
            throw new Exception('There was problem creating new record.');
        }
    }

    public function update($fields = array(), $id = null)
    {
        if (!$this->_db->update('smc_device', $id, $fields)) {
            throw new Exception('There was problem updating.');
        }
    }

    public function delete($where)
    {
        if (!$this->_db->delete('smc_device', $where)) {
            throw new Exception('There was problem deleting.');
        }
    }

    public function lastId()
    {
        return $this->_db->lastId();
    }

    public function find($where)
    {
        $data = $this->_db->get('smc_device', $where);

        if ($data->count()) {
            return $data->results();
        }

        return false;
    }
}
