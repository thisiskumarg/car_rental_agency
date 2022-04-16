<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	public function __construct() {
		
		parent::__construct();
		$this->load->helper(array('url', 'form', 'html'));
		$this->load->model('Model');
		$this->load->library('session');
	}

	public function register() {

		$header['user'] = $_GET['name'];
		$header['title'] = $header['user'].' | Register';
		$this->load->view('header', $header);
		$this->load->view('register');
		$this->load->view('footer');
	}

	public function login() {

		$header['title'] = 'Login';
		$this->load->view('header', $header);
		$this->load->view('login');
		$this->load->view('footer');
	}

	public function signup() {

		$res = $this->Model->signup();
		echo $res;
	}

	public function signin() {

		$res = $this->Model->signin();
		if($res == 0) {

			echo 0;
		} elseif($res == 2) {

			echo 2;
		} elseif($res == 3) {

			echo 3;
		} else {

			$session_data = array(
				'id' => $res[0]['id'],
				'register_id' => $res[0]['register_id'],
				'role' => $res[0]['role']
			);

			$this->session->set_userdata($session_data);
			echo 1;
		}
	}

	public function index() {

		$this->Model->available_cars_today();

		if($this->session->has_userdata('id')) {
			$register_id = $this->session->userdata('register_id');
			$role = $this->session->userdata('role');
			$data['allcarsdata'] = $this->Model->index($register_id, $role);
			$data['role'] = $role;
		} else {

			$data['allcarsdata'] = $this->Model->index(null, null);
		}
		
		$header['title'] = 'Home | Car Rental Agency';
		$this->load->view('header', $header);
		$this->load->view('index', $data);
		$this->load->view('footer');
	}

	public function get_profile_data() {

		if($this->session->has_userdata('id')) {

			$register_id = $this->session->userdata('register_id');
			$data['get_profile'] = $this->Model->get_profile_data($register_id);

			$header['title'] = 'Profile';
			$this->load->view('header', $header);
			$this->load->view('get_profile', $data);
			$this->load->view('footer');
		} else {

			redirect('welcome/login/');
		}
	}
	
	public function edit_profile_data() {

		if($this->session->has_userdata('id')) {

			$register_id = $this->session->userdata('register_id');
			$data['get_profile'] = $this->Model->get_profile_data($register_id);

			$header['title'] = 'Edit Profile';
			$this->load->view('header', $header);
			$this->load->view('edit_profile', $data);
			$this->load->view('footer');
		} else {

			redirect('welcome/login/');
		}
	}

	public function update_profile_data() {

		if($this->session->has_userdata('id')) {

			$register_id = $this->session->userdata('register_id');
			$res = $this->Model->update_profile_data($register_id);
			echo $res;
		} else {

			redirect('welcome/login/');
		}
	}

	public function add_car_form() {

		if($this->session->has_userdata('id')) {

			$role = $this->session->userdata('role');
			if($role == 'Agency') {
			
				$header['title'] = 'Add Car';
				$this->load->view('header', $header);
				$this->load->view('add_car_form');
				$this->load->view('footer');
			} else {

				$error['title'] = 'User Page Error';
				$this->load->view('page_error', $error);
			}
		} else {

			redirect('welcome/login/');
		}
	}

	public function add_car() {

		if($this->session->has_userdata('id')) {

			$register_id = $this->session->userdata('register_id');
			$res = $this->Model->add_car($register_id);
			echo $res;
		} else {

			redirect('welcome/login/');
		}
	}

	public function edit_car_form($vehicle_id) {

		if($this->session->has_userdata('id')) {

			$role = $this->session->userdata('role');
			if($role == 'Agency') {

				$data['car_details'] = $this->Model->get_car_details($vehicle_id);

				$header['title'] = 'Edit Car';
				$this->load->view('header', $header);
				$this->load->view('edit_car_form', $data);
				$this->load->view('footer');
			} else {

				$error['title'] = 'User Page Error';
				$this->load->view('page_error', $error);
			}
		} else {

			redirect('welcome/login/');
		}
	}

	public function update_car_details($vehicle_id) {

		if($this->session->has_userdata('id')) {

			$res = $this->Model->update_car_details($vehicle_id);
			echo $res;
		} else {

			redirect('welcome/login/');
		}
	}

	public function all_booked_cars() {

		if($this->session->has_userdata('id')) {

			$role = $this->session->userdata('role');
			if($role == 'Agency') {

				$register_id = $this->session->userdata('register_id');
				$data['allbooked_cars'] = $this->Model->all_booked_cars($register_id);

				$header['title'] = 'Your Booked Cars';
				$this->load->view('header', $header);
				$this->load->view('all_booked_cars', $data);
				$this->load->view('footer');
			} else {

				$error['title'] = 'User Page Error';
				$this->load->view('page_error', $error);
			}
		} else {

			redirect('welcome/login/');
		}
	}

	public function rent_car($vehicle_id) {

		if($this->session->has_userdata('id')) {

			$register_id = $this->session->userdata('register_id');
			$res = $this->Model->rent_car($register_id, $vehicle_id);
			echo $res;
		} else {

			redirect('welcome/login/');
		}
	}

	public function my_booked_cars() {

		if($this->session->has_userdata('id')) {

			$role = $this->session->userdata('role');
			if($role == 'Customer') {

				$register_id = $this->session->userdata('register_id');
				$data['booked_cars'] = $this->Model->my_booked_cars($register_id);

				$header['title'] = 'Your Booked Cars';
				$this->load->view('header', $header);
				$this->load->view('my_booked_cars', $data);
				$this->load->view('footer');
			} else {

				$error['title'] = 'User Page Error';
				$this->load->view('page_error', $error);
			}
		} else {

			redirect('welcome/login/');
		}
	}

	public function logout() {

		if($this->session->has_userdata('id')) {
			
			$this->session->unset_userdata(array('id', 'register_id', 'role'));
			$this->session->sess_destroy();
		}
		redirect('welcome/login/');
	}
}
