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
class APIKey
{
    private $_db;

    public function __construct()
    {
        $this->_db = DB::getInstance();
    }

    public function create($fields = array())
    {
        if (!$this->_db->insert('smc_api_keys', $fields)) {
            throw new Exception('There was problem creating new patients.');
        }
    }

    public function update($fields = array(), $id = null)
    {
        if (!$this->_db->update('smc_api_keys', $id, $fields)) {
            throw new Exception('There was problem updating.');
        }
    }

    public function delete($where)
    {
        if (!$this->_db->delete('smc_api_keys', $where)) {
            throw new Exception('There was problem deleting.');
        }
    }

    public function lastId()
    {
        return $this->_db->lastId();
    }

    public function find($where)
    {
        $data = $this->_db->get('smc_api_keys', $where);

        if ($data->count()) {
            return $data->results();
        }

        return false;
    }

    public function validateAPIKey($api_key)
    {
        $sql = "SELECT * FROM smc_api_keys WHERE apikey = '".$api_key."'
                    AND active_status = 1";

        $data = $this->_db->exec_sql($sql);

        if ($data->count()) {
            return $data->results();
        }

        return false;
    }

    public function getAccessHistory()
    {
	    $date = date("Y-m-d", strtotime("-7 days"));
        $sql = "SELECT count(smc_api_keys.id) as a,
                        CAST(smc_api_access_history.date_created AS DATE) as y,
                        smc_api_keys.api_service_id FROM smc_api_access_history
                    INNER JOIN smc_api_keys ON smc_api_access_history.api_key_id = smc_api_keys.id
                        WHERE CAST(smc_api_access_history.date_created AS DATE) >= '".$date."'
                                GROUP BY api_service_id, CAST(smc_api_access_history.date_created AS DATE)";

		$data = $this->_db->exec_sql($sql);

        if ($data->count()) {
            return $data->results();
        }

        return false;
    }
}
