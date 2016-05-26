<?php
class Auth extends CI_Controller {
	
	function __construct(){
		parent::__construct();
	}
	
	public function token(){
		$url = $this->input->get('url');
		
		$this->smarty->assign('url', $url);
		$this->smarty->display('login.html');
	}
	
	public function check(){
		session_start();
		$this->load->library('redis');
		$this->load->library('session');
		
		$url = $this->input->post('url');
		$token = $this->input->post('token');
		$key = $this->redis->get('tmpkey');
		
		if($token == $key){
			$this->session->set_userdata('token', 'yes');
			echo "<script>window.location.href='index.php?controller=orders&method=check'</script>";
		} else {
			$this->smarty->assign('url', $url);
			$this->smarty->display('login.html');			
		}
	}
}
?>