<?php
class Loginmodel extends CI_Model
{

	public function isValidate($username,$password)
	{
		$q=$this->db->where(['username'=>$username,'Password'=>$password])
					->get('users');

					if($q->num_rows())
					{
						return $q->row()->id;
					}
					else
					{
						return false;
					}
	}
	public function articlelist($limit,$offset)
	{

		$id=$this->session->userdata('id');
		$qu=$this->db->select()
					->from('articles')
					->where(['user_id'=>$id])
					->limit($limit,$offset)
					->get();
					//print_r($q);	
					return $qu->result();
	}
	public function find_article($articleid)
	{
		$q=$this->db->select(['article_title','article_body','id'])
				->where('id',$articleid)
				 ->get('articles');
				 return $q->row();
	}
	public function update_article($articleid,Array $article)
	{
		return $this->db->where('id',$articleid)
				->update('articles',$article);
	}
	public function num_rows()
	{
		$id=$this->session->userdata('id');
		$qu=$this->db->select()
					->from('articles')
					->where(['user_id'=>$id])
					->get();
					//print_r($q);	
					return $qu->num_rows();	
	}
	public function all_articlelist($limit,$offset)
	{
		$query=$this->db->select()
					->from('articles')
					->limit($limit,$offset)
					->get();

					return $query->result();
	}
	public function all_articles_count()
	{
		$q=$this->db->select()
				->from('articles')
				->get();
				return $q->num_rows();
	}
	public function add_articles($array)
	{
		return $this->db->insert('articles',$array);
	}
	public function add_user($array)
	{
		return $this->db->insert('users',$array);			
	}
	public function del($id)
	{
		return $this->db->delete('articles',['id'=>$id]);
	}
	public function get_reset_token()
	{
		$this->db->where('reset_password');
		$result=$this->db->get('users');
		return $result->row();
	}
	public function reset_password()
	{
		$this->db->where('reset_password',$this->input->post('token'));
		$result=$this->db->get('users');
		$result=$result->row();
		if(!empty($result))
		{
			$data=array('password'=>md5($this->input->post('new_pass')),'reset_password'=>'');
			$this->db->where('id',$result->id);
			$this->db->update('users',$data);
			return true;
		}
		else
		{
			return false;
		}
	}
} 

?>