<?php

  //session_start(); //we need to start session in order to access it through CI

  Class autenticacion extends CI_Controller {

    public function __construct() {
      parent::__construct();

      // Load form helper library
      $this->load->helper('form');

      // Load form validation library
      $this->load->library('form_validation');

      // Load database
      $this->load->model('login_database');

      $this->load->helper('url');
    }

    // Show login page
    public function index() {
      $this->load->view('login_form');
    }

    // Show registration page
    public function user_registration_show() {
      $this->load->view('registration_form');
    }

    // Validate and store registration data in database
    public function new_user_registration() {

      // Check validation for user input in SignUp form
      $this->form_validation->set_rules('email_value', 'Email', 'trim|required');
      $this->form_validation->set_rules('password', 'Password', 'trim|required');

      if ($this->form_validation->run() == FALSE) {
        $this->load->view('registration_form');
      } else {
        $data = array(
        'correo' => $this->input->post('email_value'),
        'clave' => $this->input->post('password')
        );
        $result = $this->login_database->registration_insert($data);
        if ($result == TRUE) {
        $data['message_display'] = 'Registration Successfully !';
        $this->load->view('login_form', $data);
        } else {
        $data['message_display'] = 'Username already exist!';
        $this->load->view('registration_form', $data);
        }
      }
    }

    // Check for user login process
    public function user_login_process() {

      $this->form_validation->set_rules('email', 'Correo', 'trim|required');
      $this->form_validation->set_rules('password', 'Password', 'trim|required');

      if ($this->form_validation->run() == FALSE) {
        if(isset($this->session->userdata['logged_in'])){
          echo "
          <script>
            window.location = '" .base_url() ."web'
          </script>";
        }else{
          $this->load->view('login_form');
        }
      } else {
        $data = array(
        'correo' => $this->input->post('email'),
        'clave' => $this->input->post('password')
        );
        $result = $this->login_database->login($data);
        if ($result == TRUE) {

        $username = $this->input->post('email');
        $result = $this->login_database->read_user_information($username);
        if ($result != false) {
        $session_data = array(
        'email' => $result[0]->correo,
        );
        // Add user data in session
        $this->session->set_userdata('logged_in', $session_data);
        //$this->load->('web');
        echo "
        <script>
          window.location = '" .base_url() ."web'
        </script>";
        }
        } else {
        $data = array(
        'error_message' => 'Invalid Username or Password'
        );
        $this->load->view('login_form', $data);
        }
      }
    }

    // Logout from admin page
    public function logout() {

      // Removing session data
      $sess_array = array(
      'username' => ''
      );
      $this->session->unset_userdata('logged_in', $sess_array);
      $data['message_display'] = 'Successfully Logout';
      $this->load->view('login_form', $data);
    }

  }

?>
