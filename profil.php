<?phpasds
/**
 * RenEngine
 *
 *
 * @package		RenEngine
 * @author		Dariusz Tatka
 * @copyright	Copyright (c) 2011
 * @license		http://renengine@
 * @link		http://renengine@
 * @since		Version 0.1
 * @filesource
 */
class Profil extends CI_Controller {

       function __construct()
       {
            parent::__construct();
            $this->load->model('profil_m');
			$this->load->model('user_m');
			$this->load->model('login');
			$this->load->helper('date','url');
			$this->output->enable_profiler(TRUE);

       }

		function index(){
			if($this->login->checkLoginStatus() == true) {
			
				$this->load->view('nag');
				$user_id = $this->session->userdata('login_id');
				if($user_id == 0){
					$user_id = '1';
				}
				$query = $this->profil_m->getProfilById($user_id);
									if ($query->num_rows() > 0)
								 	{
										$this->load->view('profil_t', array('result' => $query->result()));


									}
				$this->load->view('stopka');
			} else {
				$this->load->helper('url');
				redirect('user');
			}
		}


		function id(){
			$user_id = $this->uri->segment(3, 0);
			if($user_id == 0){
				$user_id = '1';
			}
			$query = $this->profil_m->getProfilById($user_id);
								if ($query->num_rows() > 0)
							 	{
									$this->load->view('nag');
									$this->load->view('profil_t', array('result' => $query->result()));
								

								}
			$query = $this->profil_m->getUserPhoto($user_id);
				if ($query->num_rows() > 0)
				{					
				
				$this->load->view('profil_photo', array('result' => $query->result()));
				$this->load->view('stopka');

				}
		}
		
		function galeria(){
			$user_id = $this->uri->segment(3, 0);
			if($user_id == 0){
				$user_id = '1';
			}
			$query = $this->profil_m->getGaleriaById($user_id);
								if ($query->num_rows() > 0)
							 	{
									$this->load->view('nag');
									$this->load->view('galeria_t', array('result' => $query->result()));
									$this->load->view('stopka');
								

								}
			
		}											
}
?>