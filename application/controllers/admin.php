<?php
class Admin extends MY_Controller
{
	public function welcome()
	{
		
		$this->load->model('loginmodel');
		$this->load->library('pagination');
		$config=[
					'base_url'=>base_url('admin/welcome'),
					'per_page'=>3,
					'total_rows'=>$this->loginmodel->num_rows(),

					 'full_tag_open'=>"<ul class='pagination'>",
        'full_tag_close'=>"</ul>",
        'next_tag_open' =>"<li>",
        'next_tag_close' =>"</li>",
        'prev_tag_open' =>"<li>",
        'prev_tag_close' =>"</li>",
        'num_tag_open' =>"<li>",
        'num_tag_close' =>"<li>",
        'cur_tag_open' =>"<li class='active'><a>",
        'cur_tag_close' =>"</a></li>"
				];
		$this->pagination->initialize($config);

		$articles=$this->loginmodel->articlelist($config['per_page'],$this->uri->segment(3));
		$this->load->view('Admin/dashboard',['articles'=>$articles]); 
	}
	public function adduser()
	{
		$this->load->view('admin/add_article');
	}
	public function userValidation()
	{
		if($this->form_validation->run('add_article_rules'))
		{
			$post=$this->input->post();
			$this->load->model('loginmodel');
			if($this->loginmodel->add_articles($post))
			{
				$this->session->set_flashdata('msg','Article Added Successfully!!');
				$this->session->set_flashdata('msg_class','alert-success');
			}
			else
			{
				$this->session->set_flashdata('msg','Article Not Added Please try again');
				$this->session->set_flashdata('msg_class','alert-danger');		
			}
			return redirect('admin/welcome');
		}
		else
		{
			$this->load->view('admin/add_article');
		}
	}
	public function updatearticle($article_id)
	{
		
		if($this->form_validation->run('add_article_rules'))
		{
			$post=$this->input->post();
			//$articleid=$post['article_id'];
			$this->load->model('loginmodel');
			if($this->loginmodel->update_article($article_id,$post))
			{
				$this->session->set_flashdata('msg','Article Update Successfully!!');
				$this->session->set_flashdata('msg_class','alert-success');
			}
			else
			{
				$this->session->set_flashdata('msg','Article Not Update Please try again');
				$this->session->set_flashdata('msg_class','alert-danger');		
			}
			return redirect('admin/welcome');
		}
		else
		{
			  $this->edituser($article_id);
		}
	}
	public function edituser($id)
	{
			$this->load->model('loginmodel');
			$article=$this->loginmodel->find_article($id);
				$this->load->view('admin/edit_article',['article'=>$article]);
	}
	public function delarticles()
	{
		$id=$this->input->post('id');
			$this->load->model('loginmodel');
			if($this->loginmodel->del($id))
			{
				$this->session->set_flashdata('msg','Delete Successfully!!');
				$this->session->set_flashdata('msg_class','alert-success');
			}
			else
			{
				$this->session->set_flashdata('msg',' Please try again');
				$this->session->set_flashdata('msg_class','alert-danger');		
			}
			return redirect('admin/welcome');
	}
	
	public function logout()
	{
		$this->session->unset_userdata('id');
		return redirect('login');	
	}
	public function register()
	{
		$this->load->view('admin/register');
	}
	public function change_pass()
	{
		$this->form_validation->set_rules('new_pass','new password','required');
		$this->form_validation->set_rules('confm_pass','confirm password','required');
		if($this->form_validation->run()==FALSE)
		{
			$this->load->model('loginmodel');
			$data['exist']=$this->loginmodel->get_reset_token();
			$this->load->view('admin/change_pass',$data);	
		}
		else
		{
			$result=$this->loginmodel->reset_paaword();
			$this->session->flashdata('success','Password has beeb change');
			redirect('login');
		}

		
	}
	
}

?>