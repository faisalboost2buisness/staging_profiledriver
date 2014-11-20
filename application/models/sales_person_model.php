<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once(dirname(__FILE__).'/../core/MY_Model.php');
class Sales_person_model extends MY_Model
{
    protected $_table = 'sales_person';

    function get_all()
    {
        $this->db->select($this->_table.'.*,registration.*')
             ->join('registration', $this->_table.'.registration_id= registration.registration_id',"LEFT");

        $this->db->order_by('created_on', 'DESC');
        $result =$this->db->get($this->_table)->result();
        //echo '<pre>SQl Query: '.$this->db->last_query().'</pre>';
        //exit;

        return $result;
    }

    function get($id)
    {
        return $this->db->select($this->_table.'.*,registration.*')
            ->join('registration', $this->_table.'.registration_id= registration.registration_id',"LEFT")
            ->where(array($this->_table.'.registration_id' => $id))
            ->get($this->_table)
            ->row();
    }

    public function get_by($key, $value = '')
    {
        $this->db->select($this->_table.'.*,registration.*')
             ->join('registration', $this->_table.'.registration_id= registration.registration_id',"LEFT");
        if (is_array($key))
        {
            $this->db->where($this->_table.'.'.$key);
        }
        else
        {
            $this->db->where($this->_table.'.'.$key, $value);
        }

        $result = $this->db->get($this->_table)->row();
        //echo '<pre>SQl Query: '.$this->db->last_query().'</pre>';
        return $result;
    }

    function get_many_by($params = array())
    {

        // Limit the results based on 1 number or 2 (2nd is offset)
        if (isset($params['limit']) && is_array($params['limit']))
            $this->db->limit($params['limit'][0], $params['limit'][1]);
        elseif (isset($params['limit']))
            $this->db->limit($params['limit']);

        $result = $this->get_all();
        //echo 'Last Query: '.$this->db->last_query();
        //exit;
        return $result;
    }

    function get_one_by($params = array())
    {
        $this->db->select($this->_table.'.*,registration.*')
            ->join('registration', $this->_table.'.user_id = registration.id','left');


        if (array_key_exists('user_id', $params))
        {
            $this->db->like('registration.registration_id', $params['registration_id']);
        }

        if (array_key_exists('first_name', $params))
        {
            $this->db->like('registration.first_name', $params['first_name']);
        }

        if (array_key_exists('last_name', $params))
        {
            $this->db->like('registration.last_name', $params['last_name']);
        }

        if (array_key_exists('email', $params))
        {
            $this->db->like('registration.email_id', $params['email']);
        }

        $result = $this->db->get($this->_table)->row();
        //echo 'Last Query: '.$this->db->last_query();
        //exit;
        return $result;
    }

    function count_by($params = array())
    {
        $this->db->select($this->_table.'.*');


        if (array_key_exists('registration_id', $params))
        {
            $this->db->like('registration.registration_id', $params['registration_id']);
        }

        if (array_key_exists('first_name', $params))
        {
            $this->db->like('registration.first_name', $params['first_name']);
        }

        if (array_key_exists('last_name', $params))
        {
            $this->db->like('registration.last_name', $params['last_name']);
        }

        if (array_key_exists('email', $params))
        {
            $this->db->like('registration.email_id', $params['email']);
        }

        $result = $this->db->count_all_results($this->_table);
        //echo $this->db->last_query();
        return $result;
    }

}
