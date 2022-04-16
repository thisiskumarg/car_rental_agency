<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Model extends CI_Model {

    public function __construct() {
        
        parent::__construct();
        $this->load->database();
    }

    public function available_cars_today() {

        date_default_timezone_set('Asia/Kolkata');
        $this->db->select('end_date');
        $this->db->from('cars');
        $this->db->where('rent_status', 1);
        $sql = $this->db->get()->result_array();
        $num = $this->db->where('rent_status', 1)->from('cars')->count_all_results();
        if($num > 0) {
            if(date('Y-m-d') > $sql[0]['end_date']) {

                $updatedata['customer_register_id'] = '';
                $updatedata['rent_days'] = '';
                $updatedata['start_date'] = '';
                $updatedata['end_date'] = '';
                $updatedata['rent_status'] = 0;
                $updatedata['modified_on'] = date('Y-M-d H:i:s A');

                $this->db->update('cars', $updatedata, array('rent_status' => 1));
            }
        }
    }

    public function index($register_id, $role) {

        if($role == 'Agency') {

            return $this->db->get_where('cars', array('agency_register_id' => $register_id, 'rent_status' => 0))->result_array();
        } else {

            return $this->db->get_where('cars', array('rent_status' => 0))->result_array();
        }
    }

    public function signup() {

        extract($this->input->post());

        if($role == 'Agency') {
            
            $unique = 'AGEN000';
        } else if($role == 'Customer') {

            $unique = 'CUST000';
        }
        date_default_timezone_set('Asia/Kolkata');
        $uni_date = date('ymdHis');
        $register_id = $unique.$uni_date;

        $data['register_id'] = $register_id;
        $data['role'] = $role;
        $data['name'] = $name;
        $data['address'] = $addr;
        $data['mobile'] = $mobile;
        $data['mail'] = $mail;
        $data['passwrd'] = $pwd;
        $data['created_on'] = date('Y-M-d H:i:s A');

        if(!empty($name) && !empty($addr) && !empty($mobile) && !empty($mail) && !empty($pwd)) {

            $sql1 = $this->db->get_where('users', array('mobile' => $mobile));
            $sql2 = $this->db->get_where('users', array('mail' => $mail));
            if($sql1->num_rows() == 0 && $sql2->num_rows() == 0) {

                $this->db->insert('users', $data);
                return 1;
            } else {

                return 2;
            }
        } else {

            return 0;
        }
    }

    public function signin() {

        extract($this->input->post());
        
        if(!empty($mail) && !empty($pwd)) {
            $sql1 = $this->db->get_where('users', array('mail' => $mail));
            if($sql1->num_rows() > 0) {

                $sql2 = $this->db->get_where('users', array('mail' => $mail, 'passwrd' => $pwd));
                if($sql2->num_rows() > 0) {

                    return $sql2->result_array();
                } else {

                    return 2;
                }
            } else {

                return 3;
            }
        } else {

            return 0;
        }
    }

    public function get_profile_data($register_id) {

        return $this->db->get_where('users', array('register_id' => $register_id))->result_array();
    }

    public function update_profile_data($register_id) {

        extract($this->input->post());

        date_default_timezone_set('Asia/Kolkata');
        $data['name'] = $name;
        $data['address'] = $addr;
        $data['mobile'] = $mobile;
        $data['mail'] = $mail;
        $data['passwrd'] = $pwd;
        $data['modified_on'] = date('Y-M-d H:i:s A');

        if(!empty($name) && !empty($addr) && !empty($mobile) && !empty($mail) && !empty($pwd)) {

            $this->db->select('register_id');
            $this->db->from('users');
            $this->db->where("(`mobile` = '$mobile' OR `mail` = '$mail')");
            $this->db->where('register_id !=', $register_id);
            $sql1 = $this->db->get();
            if($sql1->num_rows() == 0) {

                $this->db->update('users', $data, array('register_id' => $register_id));
                return 1;
            } else {

                return 2;
            }
        } else {

            return 0;
        }
    }

    public function add_car($register_id) {

        extract($this->input->post());

        $unique = 'CAR000';
        date_default_timezone_set('Asia/Kolkata');
        $uni_date = date('ymdHis');
        $vehicle_id = $unique.$uni_date;

        $data['agency_register_id'] = $register_id;
        $data['vehicle_id'] = $vehicle_id;
        $data['vehicle_model'] = $vehicle_model;
        $data['vehicle_number'] = $vehicle_number;
        $data['seating_capacity'] = $seat_capacity;
        $data['rent_per_day'] = $day_rent;
        $data['created_on'] = date('Y-M-d H:i:s A');

        if(!empty($vehicle_model) && !empty($vehicle_number) && !empty($seat_capacity) && !empty($day_rent)) {

            $sql1 = $this->db->get_where('cars', array('vehicle_model' => $vehicle_model));
            $sql2 = $this->db->get_where('cars', array('vehicle_number' => $vehicle_number));
            if($sql1->num_rows() == 0 && $sql2->num_rows() == 0) {

                $this->db->insert('cars', $data);
                return 1;
            } else {

                return 2;
            }
        } else {

            return 0;
        }
    }

    public function get_car_details($vehicle_id) {

        return $this->db->get_where('cars', array('vehicle_id' => $vehicle_id))->result_array();
    }

    public function update_car_details($vehicle_id) {

        extract($this->input->post());

        date_default_timezone_set('Asia/Kolkata');
        $data['vehicle_model'] = $vehicle_model;
        $data['vehicle_number'] = $vehicle_number;
        $data['seating_capacity'] = $seat_capacity;
        $data['rent_per_day'] = $day_rent;
        $data['modified_on'] = date('Y-M-d H:i:s A');

        if(!empty($vehicle_model) && !empty($vehicle_number) && !empty($seat_capacity) && !empty($day_rent)) {

            $this->db->select('vehicle_id');
            $this->db->from('cars');
            $this->db->where('vehicle_number', $vehicle_number);
            $this->db->where('vehicle_id !=', $vehicle_id);
            $sql1 = $this->db->get();
            if($sql1->num_rows() == 0) {

                $this->db->update('cars', $data, array('vehicle_id' => $vehicle_id));
                return 1;
            } else {

                return 2;
            }
        } else {

            return 0;
        }
    }

    public function rent_car($register_id, $vehicle_id) {

        extract($this->input->post());

        $this->db->select('agency_register_id, rent_per_day');
        $this->db->from('cars');
        $this->db->where('vehicle_id', $vehicle_id);
        $sql1 = $this->db->get()->result_array();
        $agency_reg_id = $sql1[0]['agency_register_id'];
        $rentperday = $sql1[0]['rent_per_day'];

        $unique = 'ENTR000';
        date_default_timezone_set('Asia/Kolkata');
        $uni_date = date('ymdHis');
        $entry_id = $unique.$uni_date;
        
        $entrydata['entry_id'] = $entry_id;
        $entrydata['agency_register_id'] = $agency_reg_id;
        $entrydata['vehicle_id'] = $vehicle_id;
        $entrydata['customer_register_id'] = $register_id;
        $entrydata['rent_per_day'] = $rentperday;
        $entrydata['rent_days'] = $rent_days;
        $entrydata['total_rent'] = $rentperday * $rent_days;
        $entrydata['start_date'] = $start_date;
        $entrydata['end_date'] = date('Y-m-d', strtotime($start_date.' + '.$rent_days.' days'));
        $entrydata['created_on'] = date('Y-M-d H:i:s A');

        $data['customer_register_id'] = $register_id;
        $data['rent_days'] = $rent_days;
        $data['start_date'] = $start_date;
        $data['end_date'] = date('Y-m-d', strtotime($start_date.' + '.$rent_days.' days'));
        $data['rent_status'] = 1;
        $data['modified_on'] = date('Y-M-d H:i:s A');

        if(!empty($rent_days) && !empty($start_date)) {

            $this->db->update('cars', $data, array('vehicle_id' => $vehicle_id));
            $this->db->insert('customer_booked_cars', $entrydata);
            return 1;
        } else {

            return 0;
        }
    }

    public function all_booked_cars($register_id) {

        $this->db->select('*');
        $this->db->from('cars');
        $this->db->join('users', 'users.register_id = cars.customer_register_id');
        $this->db->where('cars.rent_status', 1);
        $this->db->where('cars.agency_register_id', $register_id);
        return $this->db->get()->result_array();
    }

    public function my_booked_cars($register_id) {

        return $this->db->get_where('cars', array('customer_register_id' => $register_id, 'rent_status' => 1))->result_array();
    }
}


?>