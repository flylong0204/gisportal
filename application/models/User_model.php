<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User_model extends CI_Model
{
	function __construct()
    {
        parent::__construct();
    }


    public function get_users()
    {
        $this->db->order_by('user_name', 'ASC');
        $query = $this->db->get('users');
        return $query->result_array();
    }

    /*
     * Return users with selected field (true/false) meaning permission to use given project id
     */
    public function get_users_with_project_flag($project_id) {

        $sql = "select user_id, user_name, user_email, display_name, ";
        if ($project_id != null){
            $sql = $sql . $project_id . " = ANY(project_ids) selected";
        } else{
            $sql = $sql . "false selected";
        }
        $sql = $sql . " FROM users WHERE admin = false order by user_email";
        $query = $this->db->query($sql);

        return $query->result_array();
    }

    function get_user($key, $pwd)
    {
        $this->db->where('user_email', $key);
        $this->db->or_where('user_name', $key);
        $user = $this->db->get('users')->result();

        $pass = password_verify($pwd, $user[0]->user_password_hash);

        if ($pass) {
            return $user;
        } else {
            return null;
        }
    }

//	function get_user_by_name($key) {
//		$this->db->where('user_name', $key);
//		$query = $this->db->get('users');
//
//		return $query->result();
//	}

	// get user
	function get_user_by_id($id)
	{
		$this->db->where('user_id', $id);
        $query = $this->db->get('users');
		return $query->result()[0];
	}
	
	// insert
	function insert_user($data)
    {
		return $this->db->insert('users', $data);
	}

    function update_user($id, $sql)
    {
        //$this->db->where('user_id', $id);
        //$this->db->update('users', $data);

        $sql.= " WHERE user_id = ".$id;

        //returns bool
        $result = $this->db->query('UPDATE users SET '.$sql);
    }

	public function save_user($data)
    {
		$id = $data['user_id'];

		//if ($id != null){
			$this->db->where('user_id',$id);
			$this->db->update('users',$data);
			return $id;
		//}

		//unset($data['id']);
		//$this->db->insert('clients', $data);

		//return $this->db->insert_id();
}
    //TODO fix this
	function get_projectusers($userid)
	{
        $sql = "select p.id, p.name, p.display_name, c.display_name client_name, case when  u.user_id is null then false else true end selected
		from projects p left join clients c on c.id = p.client_id left join users u on p.id = ANY(project_ids) and u.user_id = " . $userid . " order by p.display_name";

		$query = $this->db->query($sql);

        return $query->result_array();

	}

	public function delete_user($id)
    {
        $this->db->where('user_id', $id);
        $this->db->delete('users');
    }

    public function clear_print($name)
    {
        $this->db->where('user_name', $name);
        $this->db->delete('users_print');
    }
}