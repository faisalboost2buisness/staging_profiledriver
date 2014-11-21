<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->library('ion_auth');
		$this->load->library('form_validation');
		$this->load->helper('url');

		$this->form_validation->set_error_delimiters($this->config->item('error_start_delimiter', 'ion_auth'), $this->config->item('error_end_delimiter', 'ion_auth'));

		$this->lang->load('auth');
		$this->load->helper('language');
	}

	//redirect if needed, otherwise display the user list
	function index()
	{

		if (!$this->ion_auth->logged_in())
		{
			//redirect them to the login page
			redirect('auth/login', 'refresh');
		}
		/*elseif (!$this->ion_auth->is_admin()) //remove this elseif if you want to enable this for non-admins
		{
			//redirect them to the home page because they must be an administrator to view this
			return show_error('You must be an administrator to view this page.');
		}*/
		else
		{
			//set the flash data error message if there is one
			$this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');

			//list the users
			$this->data['users'] = $this->ion_auth->users()->result();
			foreach ($this->data['users'] as $k => $user)
			{
				$this->data['users'][$k]->groups = $this->ion_auth->get_users_groups($user->id)->result();
			}

			$this->_render_page('auth/index', $this->data);
		}
	}

    //forgot password
    function forgot_password_ajax()
    {
        header('Content-type: application/json');
        if($this->input->is_ajax_request()){
            $this->form_validation->set_rules('email', 'Email Address', 'required');
            if ($this->form_validation->run() == false)
            {
                //setup the input
                $this->data['email'] = array('name' => 'email',
                    'id' => 'email',
                );
                //set any errors and display the form
                $error_message = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
                echo json_encode(array('success' => false,'message'=> $error_message));
                exit;
            }
            else
            {
                //run the forgotten password method to email an activation code to the user
                $forgotten = $this->ion_auth->forgotten_password($this->input->post('email'));

                if ($forgotten)
                { //if there were no errors
                    echo json_encode(array('success' => true,'message'=> $this->ion_auth->messages()));
                    exit;
                }
                else
                {
                    echo json_encode(array('success' => false,'message'=> $this->ion_auth->errors()));
                    exit;
                }
            }
        }
        echo json_encode(array('success' => false,'message'=> 'Invalid request method'));
        exit;
    }


    /**
     * login_ajax()
     * This function is added to handel ajax based login
     */
    public function login_ajax(){
        header('Content-type: application/json');
        if($this->input->is_ajax_request()){
            //validate form input
            $this->form_validation->set_rules('identity', 'Identity', 'required');
            $this->form_validation->set_rules('password', 'Password', 'required');

            if ($this->form_validation->run() == true)
            {
                //check to see if the user is logging in
                //check for "remember me"
                $remember = (bool) $this->input->post('remember');
                if ($this->ion_auth->login($this->input->post('identity'), $this->input->post('password'), $remember))
                {
                    //if the login is successful
                    //send success message
                    echo json_encode(array('success' => true,'message'=> $this->ion_auth->messages(),'user'=>$this->session->userdata('username')));
                    return;
                }
                else
                {
                    //if the login was un-successful
                    //send failure message
                    echo json_encode(array('success' => false,'message'=> $this->ion_auth->errors()));
                    return;
                }
            }
            else
            {
                //the user is not logging in so send failure message
                //set error message
                $error_message = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
                echo json_encode(array('success' => false,'message'=> $error_message,'validation' => 'failed'));
                return;

            }
        }
        echo json_encode(array('success' => false,'message'=> 'Invalid request method'));
        return;
    }
	//log the user in
	function login()
	{
		$this->data['title'] = "Login";

		//validate form input
		$this->form_validation->set_rules('identity', 'Identity', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required');

		if ($this->form_validation->run() == true)
		{
			//check to see if the user is logging in
			//check for "remember me"
			$remember = (bool) $this->input->post('remember');

			if ($this->ion_auth->login($this->input->post('identity'), $this->input->post('password'), $remember))
			{
				//if the login is successful
				//redirect them back to the home page
				$this->session->set_flashdata('message', $this->ion_auth->messages());
				redirect('/', 'refresh');
			}
			else
			{
				//if the login was un-successful
				//redirect them back to the login page
				$this->session->set_flashdata('message', $this->ion_auth->errors());
				redirect('auth/login', 'refresh'); //use redirects instead of loading views for compatibility with MY_Controller libraries
			}
		}
		else
		{
			//the user is not logging in so display the login page
			//set the flash data error message if there is one
			$this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');

			$this->data['identity'] = array('name' => 'identity',
				'id' => 'identity',
				'type' => 'text',
				'value' => $this->form_validation->set_value('identity'),
			);
			$this->data['password'] = array('name' => 'password',
				'id' => 'password',
				'type' => 'password',
			);
            $this->data['email'] = array('name' => 'email',
                'id' => 'email',
            );
            $this->load->library('template');
			//$this->_render_page('auth/login', $this->data);
            $this->template->load('default', 'auth/login', $this->data);
		}
	}

	//log the user out
	function logout()
	{
		$this->data['title'] = "Logout";

		//log the user out
		$logout = $this->ion_auth->logout();

		//redirect them to the login page
		$this->session->set_flashdata('message', $this->ion_auth->messages());
		redirect('auth/login', 'refresh');
	}

	//change password
	function change_password()
	{
		$this->form_validation->set_rules('old', $this->lang->line('change_password_validation_old_password_label'), 'required');
		$this->form_validation->set_rules('new', $this->lang->line('change_password_validation_new_password_label'), 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']|matches[new_confirm]');
		$this->form_validation->set_rules('new_confirm', $this->lang->line('change_password_validation_new_password_confirm_label'), 'required');

		if (!$this->ion_auth->logged_in())
		{
			redirect('auth/login', 'refresh');
		}

		$user = $this->ion_auth->user()->row();

		if ($this->form_validation->run() == false)
		{
			//display the form
			//set the flash data error message if there is one
			$this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');

			$this->data['min_password_length'] = $this->config->item('min_password_length', 'ion_auth');
			$this->data['old_password'] = array(
				'name' => 'old',
				'id'   => 'old',
				'type' => 'password',
			);
			$this->data['new_password'] = array(
				'name' => 'new',
				'id'   => 'new',
				'type' => 'password',
				'pattern' => '^.{'.$this->data['min_password_length'].'}.*$',
			);
			$this->data['new_password_confirm'] = array(
				'name' => 'new_confirm',
				'id'   => 'new_confirm',
				'type' => 'password',
				'pattern' => '^.{'.$this->data['min_password_length'].'}.*$',
			);
			$this->data['user_id'] = array(
				'name'  => 'user_id',
				'id'    => 'user_id',
				'type'  => 'hidden',
				'value' => $user->id,
			);

			//render
			$this->_render_page('auth/change_password', $this->data);
		}
		else
		{
			$identity = $this->session->userdata('identity');

			$change = $this->ion_auth->change_password($identity, $this->input->post('old'), $this->input->post('new'));

			if ($change)
			{
				//if the password was successfully changed
				$this->session->set_flashdata('message', $this->ion_auth->messages());
				$this->logout();
			}
			else
			{
				$this->session->set_flashdata('message', $this->ion_auth->errors());
				redirect('auth/change_password', 'refresh');
			}
		}
	}

	//forgot password
	function forgot_password()
	{  
		//setting validation rules by checking wheather identity is username or email
		if($this->config->item('identity', 'ion_auth') == 'username' )
		{
		   $this->form_validation->set_rules('email', $this->lang->line('forgot_password_username_identity_label'), 'required');	
		}
		else
		{
		   $this->form_validation->set_rules('email', $this->lang->line('forgot_password_validation_email_label'), 'required|valid_email');	
		}
		
		
		if ($this->form_validation->run() == false)
		{
			//setup the input
			$this->data['email'] = array('name' => 'email',
				'id' => 'email',
			);

			if ( $this->config->item('identity', 'ion_auth') == 'username' ){
				$this->data['identity_label'] = $this->lang->line('forgot_password_username_identity_label');
			}
			else
			{
				$this->data['identity_label'] = $this->lang->line('forgot_password_email_identity_label');
			}

			//set any errors and display the form
			$this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
			$this->_render_page('auth/forgot_password', $this->data);
		}
		else
		{
			// get identity from username or email
			if ( $this->config->item('identity', 'ion_auth') == 'username' ){
				$identity = $this->ion_auth->where('username', strtolower($this->input->post('email')))->users()->row();
			}
			else
			{
				$identity = $this->ion_auth->where('email', strtolower($this->input->post('email')))->users()->row();
			}
	            	if(empty($identity)) {
	            		
	            		if($this->config->item('identity', 'ion_auth') == 'username')
		            	{
                                   $this->ion_auth->set_message('forgot_password_username_not_found');
		            	}
		            	else
		            	{
		            	   $this->ion_auth->set_message('forgot_password_email_not_found');
		            	}

		                $this->session->set_flashdata('message', $this->ion_auth->messages());
                		redirect("auth/forgot_password", 'refresh');
            		}

			//run the forgotten password method to email an activation code to the user
			$forgotten = $this->ion_auth->forgotten_password($identity->{$this->config->item('identity', 'ion_auth')});

			if ($forgotten)
			{
				//if there were no errors
				$this->session->set_flashdata('message', $this->ion_auth->messages());
				redirect("auth/login", 'refresh'); //we should display a confirmation page here instead of the login page
			}
			else
			{
				$this->session->set_flashdata('message', $this->ion_auth->errors());
				redirect("auth/forgot_password", 'refresh');
			}
		}
	}

	//reset password - final step for forgotten password
	public function reset_password($code = NULL)
	{
		if (!$code)
		{
			show_404();
		}

		$user = $this->ion_auth->forgotten_password_check($code);

		if ($user)
		{
			//if the code is valid then display the password reset form

			$this->form_validation->set_rules('new', $this->lang->line('reset_password_validation_new_password_label'), 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']|matches[new_confirm]');
			$this->form_validation->set_rules('new_confirm', $this->lang->line('reset_password_validation_new_password_confirm_label'), 'required');

			if ($this->form_validation->run() == false)
			{
				//display the form

				//set the flash data error message if there is one
				$this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');

				$this->data['min_password_length'] = $this->config->item('min_password_length', 'ion_auth');
				$this->data['new_password'] = array(
					'name' => 'new',
					'id'   => 'new',
				'type' => 'password',
					'pattern' => '^.{'.$this->data['min_password_length'].'}.*$',
				);
				$this->data['new_password_confirm'] = array(
					'name' => 'new_confirm',
					'id'   => 'new_confirm',
					'type' => 'password',
					'pattern' => '^.{'.$this->data['min_password_length'].'}.*$',
				);
				$this->data['user_id'] = array(
					'name'  => 'user_id',
					'id'    => 'user_id',
					'type'  => 'hidden',
					'value' => $user->id,
				);
				$this->data['csrf'] = $this->_get_csrf_nonce();
				$this->data['code'] = $code;

				//render
				$this->_render_page('auth/reset_password', $this->data);
			}
			else
			{
				// do we have a valid request?
				if ($this->_valid_csrf_nonce() === FALSE || $user->id != $this->input->post('user_id'))
				{

					//something fishy might be up
					$this->ion_auth->clear_forgotten_password_code($code);

					show_error($this->lang->line('error_csrf'));

				}
				else
				{
					// finally change the password
					$identity = $user->{$this->config->item('identity', 'ion_auth')};

					$change = $this->ion_auth->reset_password($identity, $this->input->post('new'));

					if ($change)
					{
						//if the password was successfully changed
						$this->session->set_flashdata('message', $this->ion_auth->messages());
						$this->logout();
					}
					else
					{
						$this->session->set_flashdata('message', $this->ion_auth->errors());
						redirect('auth/reset_password/' . $code, 'refresh');
					}
				}
			}
		}
		else
		{
			//if the code is invalid then send them back to the forgot password page
			$this->session->set_flashdata('message', $this->ion_auth->errors());
			redirect("auth/forgot_password", 'refresh');
		}
	}


	//activate the user
	function activate($id, $code=false)
	{
		if ($code !== false)
		{
			$activation = $this->ion_auth->activate($id, $code);
		}
		else if ($this->ion_auth->is_admin())
		{
			$activation = $this->ion_auth->activate($id);
		}

		if ($activation)
		{
			//redirect them to the auth page
			$this->session->set_flashdata('message', $this->ion_auth->messages());
			redirect("auth", 'refresh');
		}
		else
		{
			//redirect them to the forgot password page
			$this->session->set_flashdata('message', $this->ion_auth->errors());
			redirect("auth/forgot_password", 'refresh');
		}
	}

	//deactivate the user
	function deactivate($id = NULL)
	{
		$id = (int) $id;

		$this->load->library('form_validation');
		$this->form_validation->set_rules('confirm', $this->lang->line('deactivate_validation_confirm_label'), 'required');
		$this->form_validation->set_rules('id', $this->lang->line('deactivate_validation_user_id_label'), 'required|alpha_numeric');

		if ($this->form_validation->run() == FALSE)
		{
			// insert csrf check
			$this->data['csrf'] = $this->_get_csrf_nonce();
			$this->data['user'] = $this->ion_auth->user($id)->row();

			$this->_render_page('auth/deactivate_user', $this->data);
		}
		else
		{
			// do we really want to deactivate?
			if ($this->input->post('confirm') == 'yes')
			{
				// do we have a valid request?
				if ($this->_valid_csrf_nonce() === FALSE || $id != $this->input->post('id'))
				{
					show_error($this->lang->line('error_csrf'));
				}

				// do we have the right userlevel?
				if ($this->ion_auth->logged_in() && $this->ion_auth->is_admin())
				{
					$this->ion_auth->deactivate($id);
				}
			}

			//redirect them back to the auth page
			redirect('auth', 'refresh');
		}
	}

    /**
     * getAdditionalData
     * This function is added to handle saving of data of dealership, auto brand , trainer and sales person in their
     * respective tables i.e. dealership, auto_brands, trainer and sales_person. This function takes membership type as
     * parameter and decide on its bases to what data to be catched from POST array into an array and then it returns
     * that array back to calling functions, which are create_user() and edit_user().
     * @param $membership_type
     * @return array
     */
    private function getAdditionalData($membership_type){

        $additional_data = array();

        if(in_array($membership_type,array('sub_admin','account_managers'))){

            $additional_data = array(
                'first_name'            => $this->input->post('first_name'),
                'last_name'             => $this->input->post('last_name'),
                'contact_phoneno'       => $this->input->post('contact_phoneno'),
                'contact_phone_number'  => $this->input->post('contact_phoneno'),
                'email'                 => $this->input->post('email'),
            );
        }

        if(in_array($membership_type,array('trainer'))){

            $additional_data = array(
                'first_name'            => $this->input->post('first_name'),
                'last_name'             => $this->input->post('last_name'),
                'phone_number1'         => $this->input->post('contact_phoneno'),
                'phone_number2'         => $this->input->post('contact_phoneno2'),
                'contact_phone_number'  => $this->input->post('contact_phoneno'),
                'email'                 => $this->input->post('email'),
            );
        }

        if(in_array($membership_type,array('sales_person'))){

            $additional_data = array(
                'first_name'            => $this->input->post('first_name'),
                'last_name'             => $this->input->post('last_name'),
                'email'                 => $this->input->post('email'),
                'contact_phone_number'  => $this->input->post('contact_phoneno'),
            );
        }

        if(in_array($membership_type,array('dealership','auto_brand'))){
            $additional_data = array(
                'first_name'            => $this->input->post('first_name'),
                'last_name'             => $this->input->post('last_name'),
                'company_name'          => $this->input->post('company_name'),
                'contact_phone_number'  => $this->input->post('contact_phoneno'),
                'company_phonenumber'   => $this->input->post('company_phonenumber'),
                'contact_person'        => $this->input->post('first_name') . ' ' .$this->input->post('last_name'),
                'company_website'       => $this->input->post('company_website'),
                'masterbrand'           => implode(",",$this->input->post('masterbrand')),
                'city'                  => $this->input->post('city'),
                'zipcode'               => $this->input->post('zipcode'),
                'state'                 => ($this->input->post('country') == 'Canada') ? $this->input->post('canadastate') : $this->input->post('state'),
                'country'               => $this->input->post('country'),
                'address'               => $this->input->post('address'),
            );
        }

        if($membership_type == 'dealership'){
            $additional_data = array_merge($additional_data,array('dealership_email' => $this->input->post('dealership_email'),
                                                                  'data_source' => $this->input->post('data_source')));
        }

        if($membership_type == 'auto_brand'){
            $additional_data = array_merge($additional_data,array('job_position' => $this->input->post('job_position')));
        }

        $additional_data = array_merge($additional_data,array('created_id' => $this->input->post('created_id'),'usertype'=> $membership_type,));

        return $additional_data;

    }

    /**
     * setFieldsData()
     * This private function is added to handle data population in registration form fields incase of any error returned
     * to registration form or incase of editing any existing user type. This function takes membership type to decide
     * which type of data is to be fetched from db, registration_id to get the data for particular user, if user data is
     * found it sets array indexes which are then used in registration view for showing user data in registration form.
     * If setFieldsData() is used in create_user() function registraiton_id is null by default and in case of any error
     * returned by server to registration page, it gets data from POST array and sets them as variables which are then
     * subsequently used in registration form to show the data.

     * @param $membership_type
     * @param null $registration_id
     * @param null $tables
     */
    private function setFieldsData($membership_type,$registration_id = null,$tables = null){

        $this->load->model(array('dealership_model','auto_brand_model','sales_person_model','trainer_model','registration_model'));

        if($registration_id != null){

            $model = $tables[$membership_type];
            if($model == 'autobrand') $model = 'auto_brand';
            $user = $this->{$model.'_model'}->get_by('registration_id',$registration_id);
            /*echo '<pre>';
            print_r($user);
            exit('</pre>');*/
        }

        if(in_array($membership_type,array('dealership','auto_brand','trainer','sub_admin','admin','sales_person','account_managers'))) {

            $this->data['first_name'] = $this->form_validation->set_value('first_name', (!is_null($registration_id)) ? $user->first_name : '');
            $this->data['last_name'] = $this->form_validation->set_value('last_name', (!is_null($registration_id)) ? $user->last_name : '');
            $this->data['contact_phoneno'] = $this->form_validation->set_value('contact_phoneno', (!is_null($registration_id)) ? $user->contact_phone_number : '');
            $this->data['email_id'] = $this->form_validation->set_value('email', (!is_null($registration_id)) ? $user->email_id : '');
            $this->data['email'] = $this->form_validation->set_value('email', (!is_null($registration_id)) ? $user->email_id : '');
            $this->data['password'] = '';
            $this->data['password_confirm'] = '';
        }

        if(in_array($membership_type,array('dealership','auto_brand'))) {

            $this->data['company_name'] = $this->form_validation->set_value('company_name', (!is_null($registration_id)) ? $user->company_name : '');
            $this->data['masterbrand'] = $this->form_validation->set_value('masterbrand', (!is_null($registration_id)) ? explode(",",$user->masterbrand) : '');
            $this->data['zipcode'] = $this->form_validation->set_value('zipcode', (!is_null($registration_id)) ? $user->zipcode : '');
            $this->data['canadastate'] = $this->form_validation->set_value('canadastate', (!is_null($registration_id)) ? $user->state : '');
            $this->data['country'] = $this->form_validation->set_value('country', (!is_null($registration_id)) ? $user->country : '');
            $this->data['address'] = $this->form_validation->set_value('address', (!is_null($registration_id)) ? $user->address : '');
            $this->data['city'] = $this->form_validation->set_value('city', (!is_null($registration_id)) ? $user->city : '');
            $this->data['company_website'] = $this->form_validation->set_value('company_website', (!is_null($registration_id)) ? $user->company_website : '');
            $this->data['company_phonenumber'] = $this->form_validation->set_value('company_phonenumber', (!is_null($registration_id)) ? $user->company_phonenumber : '');
        }

        if($membership_type == 'dealership'){

            $this->data['data_source'] = $this->form_validation->set_value('data_source', (!is_null($registration_id)) ? $user->data_source : '');
            $this->data['email'] = $this->form_validation->set_value('email', (!is_null($registration_id)) ? $user->email_id : '');
            $this->data['dealership_email'] = $this->form_validation->set_value('dealership_email', (!is_null($registration_id)) ? $user->dealership_email : '');
        }

        if($membership_type == 'auto_brand') {
            $this->data['job_position'] = $this->form_validation->set_value('job_position', (!is_null($registration_id)) ? $user->job_position : '');
        }

        if($membership_type == 'trainer'){
            $this->data['contact_phoneno2'] = $this->form_validation->set_value('contact_phoneno2', (!is_null($registration_id)) ? $user->phone_number2 : '');
            //$this->data['phone_number1'] = $this->form_validation->set_value('contact_phoneno', (!is_null($registration_id)) ? $user->contact_phone_number : '');

        }

    }

    /**
     * validateRegistrationData
     * This function adds validation rules to data posted by registration form, membership type_type parameter is used to
     * decide which fields are to be validated for which user type. $tables variable is for geting registration tables
     * and $edit variable is exclude password and email validation because they are explicitly validated in edit_user()
     * function of auth controller.
     * @param $membership_type
     * @param $tables
     * @param bool $edit
     */
    private function validateRegistrationData($membership_type,$tables,$edit = false){


        if(in_array($membership_type,array('auto_brand','trainer','sub_admin','admin','sales_person','account_managers'))) {

            $this->form_validation->set_rules('first_name', 'First Name', 'required|xss_clean');
            $this->form_validation->set_rules('last_name', 'Last Name', 'required|xss_clean');
            $this->form_validation->set_rules('contact_phoneno', 'Contact Number', 'xss_clean');
            if(!$edit) {
                $this->form_validation->set_rules('password', 'Password', 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']|matches[confirm_password]');
                $this->form_validation->set_rules('confirm_password', 'Confirm Password', 'required');
                $this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[' . $tables['users'] . '.email_id]');
            }
        }

        if(in_array($membership_type,array('dealership','auto_brand'))) {

            $this->form_validation->set_rules('company_name', 'Dealership Name', 'required|xss_clean');
            $this->form_validation->set_rules('masterbrand', 'Manufacturer', 'required|xss_clean');
            $this->form_validation->set_rules('zipcode', 'Postal Code', 'required|xss_clean');
            $this->form_validation->set_rules('canadastate', 'Province', 'required|xss_clean');
            $this->form_validation->set_rules('country', 'Country', 'required|xss_clean');
            $this->form_validation->set_rules('address', 'Address', 'required|xss_clean');
        }

        if($membership_type == 'dealership'){
            $this->form_validation->set_rules('data_source', 'Data Source', 'required|xss_clean');
            $this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[' . $tables['users'] . '.email_id]');
            if(!$edit)
                $this->form_validation->set_rules('dealership_email', 'Dealership Email', 'required|valid_email');
        }

        if($membership_type == 'auto_brand'){
            $this->form_validation->set_rules('job_position', 'Job Position', 'required|xss_clean');

        }

    }

	//create a new user
	function create_user($membership_type)
	{

		$this->data['title'] = 'Exclusive Private Sale Inc-Register';;

        $this->load->model("main_model");
        $this->load->model("settings_model");
        $this->load->model('login_model');
        $this->load->model('dealership_model');

        $this->data['states'] = $this->main_model->Canadian_provinces();
        $this->data['us_states'] = $this->main_model->getusstates();
        $this->data['menu'] = $this->login_model->loginauth();

        if (!$this->ion_auth->logged_in() || !$this->ion_auth->is_admin())
		{
			redirect('auth', 'refresh');

		}

		$tables = $this->config->item('tables','ion_auth');

		//validate form input
		$this->validateRegistrationData($membership_type,$tables);

		if ($this->form_validation->run() == true)
		{
			$username = strtolower($this->input->post('first_name')) . ' ' . strtolower($this->input->post('last_name'));
			$email    = strtolower($this->input->post('email'));
			$password = $this->input->post('password');
			$additional_data = $this->getAdditionalData($membership_type);
            $group = $this->ion_auth->getGroupName($membership_type);
            //print_r($group);
		}

		if ($this->form_validation->run() == true && $registration_id = $this->ion_auth->register($membership_type, $password, $email, $additional_data,array($group->id)))
		{
			//check to see if we are creating the user
			//redirect them back to the admin page

            if($registration_id && $membership_type == 'dealership'){
                $date=date('Y-m-d',time());
                $company_name = str_replace(" ","",trim($this->input->post('company_name')));
                $folder_name = ( $company_name .'-'. $registration_id.'-'.$date);

                $base_path = $this->config->item('rootpath');
                $targetPath='/home/advantage/'.$base_path.'/clients/'.$folder_name.'/';
                $file_path='/home/advantage/'.$base_path.'/clients/'.$folder_name.'/';
                if(!is_dir($targetPath)){
                    mkdir($file_path, 0755);
                }

                $this->dealership_model->setPrimaryKey('registration_id');
                $this->dealership_model->update($registration_id,array('folder_name' => $folder_name));

                $data = array(
                    'first_name'   => $username,
                    'email'         => $email,
                    'password'      => $password,
                );

                $message = $this->load->view('auth/email/dealership.tpl.php', $data, true);

                $admin_email_id= $this->config-> item('admin_address');
                $subject='Welcome to Exclusive Private Sale.Inc';

                $this->main_model->HTMLemail($email,$admin_email_id,'',$subject,$message);

            }

			$this->session->set_flashdata('message', $this->ion_auth->messages());
            redirect(base_url().'dashboard/1');
		}
		else
		{
			//display the create user form
			//set the flash data error message if there is one
			$this->data['message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));

            $this->setFieldsData($membership_type);

            $this->data['data'] = $this->data;
            $this->data['membership_type'] = $membership_type;
            $this->data['segment'] = 'upload';
            $this->data['user'] = "";

            $template = (in_array($membership_type,array('sub_admin','account_managers','trainer','sales_person'))) ? 'internal_user' : $membership_type;
            $this->template->load('admin', 'register/'.$template, $this->data);
        }
	}

	//edit a user
	function edit_user($id)
	{
        $this->data['title'] = 'Exclusive Private Sale Inc-View Profile';;

        $this->load->model("main_model");
        $this->load->model("settings_model");
        $this->load->model('login_model');
        $this->load->model('dealership_model');

        $this->data['states'] = $this->main_model->Canadian_provinces();
        $this->data['us_states'] = $this->main_model->getusstates();
        $this->data['menu'] = $this->login_model->loginauth();



        if (!$this->ion_auth->logged_in() || (!$this->ion_auth->is_admin() && !($this->ion_auth->user()->row()->registration_id == $id)))
		{
			redirect('auth', 'refresh');
		}

		$user = $this->ion_auth->user($id)->row();
        $membership_type = $user->usertype;
        $tables = $this->config->item('tables','ion_auth');

        $this->setFieldsData($membership_type,$user->registration_id,$tables);

		$groups=$this->ion_auth->groups()->result_array();
		$currentGroups = $this->ion_auth->get_users_groups($id)->result();

		//validate form input
        $this->validateRegistrationData($membership_type,$tables,true);


		if (isset($_POST) && !empty($_POST))
		{
			// do we have a valid request?
			/*if ($this->_valid_csrf_nonce() === FALSE || $id != $this->input->post('id'))
			{
				show_error($this->lang->line('error_csrf'));
			}*/

			//update the password if it was posted
			if ($this->input->post('password'))
			{
                $this->form_validation->set_rules('password', 'Password', 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']|matches[confirm_password]');
                $this->form_validation->set_rules('confirm_password', 'Confirm Password', 'required');
			}

			if ($this->form_validation->run() === TRUE)
			{
				$data = array(
					'first_name'             => $this->input->post('first_name'),
					'last_name'              => $this->input->post('last_name'),
                    'contact_phone_number'   => $this->input->post('contact_phoneno'),
					'email_id'               => $this->input->post('email'),
				);

                $additional_data = $this->getAdditionalData($membership_type);

				//update the password if it was posted
				if ($this->input->post('password'))
				{
					$data['password'] = $this->input->post('password');
				}

				

				// Only allow updating groups if user is admin
				if ($this->ion_auth->is_admin())
				{
					//Update the groups user belongs to
					$groupData = $this->input->post('groups');

					if (isset($groupData) && !empty($groupData)) {

						$this->ion_auth->remove_from_group('', $id);

						foreach ($groupData as $grp) {
							$this->ion_auth->add_to_group($grp, $id);
						}

					}
				}
				
			   //check to see if we are updating the user
			   if($this->ion_auth->update($user->registration_id, $data,$additional_data,$membership_type))
			    {
			    	//redirect them back to the admin page if admin, or to the base url if non admin
				    $this->session->set_flashdata('message', $this->ion_auth->messages() );
				    /*if ($this->ion_auth->is_admin())
					{
                        //echo 'admin';
						redirect('dashboard', 'refresh');
					}
					else
					{
                        echo 'not admin';
						//redirect('/', 'refresh');
					}*/
                    //$this->session->set_flashdata('message', $this->ion_auth->messages());
                    redirect(base_url().'dashboard/1');

			    }
			    else
			    {
			    	//redirect them back to the admin page if admin, or to the base url if non admin
				    $this->session->set_flashdata('message', $this->ion_auth->errors() );
				    /*if ($this->ion_auth->is_admin())
					{
                        echo 'not updated admin';
                        //redirect('auth', 'refresh');
					}
					else
					{
						//redirect('/', 'refresh');
                        echo 'not updated not admin';
					}*/

                    redirect(base_url().'dashboard/1');

			    }		
				
			}
		}

		//display the edit user form
		$this->data['csrf'] = $this->_get_csrf_nonce();

		//set the flash data error message if there is one
		$this->data['message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));

		//pass the user to the view
		$this->data['user'] = $user;
		$this->data['groups'] = $groups;
		$this->data['currentGroups'] = $currentGroups;


		//$this->_render_page('auth/edit_user', $this->data);
        $this->data['data']            = $this->data;
        //print_r($this->data);exit;
        $this->data['membership_type'] = $membership_type;
        $this->data['segment']         = 'upload';
        $this->data['user']            = $user;

        $template = (in_array($membership_type,array('sub_admin','admin','account_managers','trainer','sales_person'))) ? 'internal_user' : $membership_type;
        $this->template->load('admin', 'register/'.$template, $this->data);
	}

	// create a new group
	function create_group()
	{
		$this->data['title'] = $this->lang->line('create_group_title');

		if (!$this->ion_auth->logged_in() || !$this->ion_auth->is_admin())
		{
			redirect('auth', 'refresh');
		}

		//validate form input
		$this->form_validation->set_rules('group_name', $this->lang->line('create_group_validation_name_label'), 'required|alpha_dash|xss_clean');
		$this->form_validation->set_rules('description', $this->lang->line('create_group_validation_desc_label'), 'xss_clean');

		if ($this->form_validation->run() == TRUE)
		{
			$new_group_id = $this->ion_auth->create_group($this->input->post('group_name'), $this->input->post('description'));
			if($new_group_id)
			{
				// check to see if we are creating the group
				// redirect them back to the admin page
				$this->session->set_flashdata('message', $this->ion_auth->messages());
				redirect("auth", 'refresh');
			}
		}
		else
		{
			//display the create group form
			//set the flash data error message if there is one
			$this->data['message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));

			$this->data['group_name'] = array(
				'name'  => 'group_name',
				'id'    => 'group_name',
				'type'  => 'text',
				'value' => $this->form_validation->set_value('group_name'),
			);
			$this->data['description'] = array(
				'name'  => 'description',
				'id'    => 'description',
				'type'  => 'text',
				'value' => $this->form_validation->set_value('description'),
			);

			$this->_render_page('auth/create_group', $this->data);
		}
	}

	//edit a group
	function edit_group($id)
	{
		// bail if no group id given
		if(!$id || empty($id))
		{
			redirect('auth', 'refresh');
		}

		$this->data['title'] = $this->lang->line('edit_group_title');

		if (!$this->ion_auth->logged_in() || !$this->ion_auth->is_admin())
		{
			redirect('auth', 'refresh');
		}

		$group = $this->ion_auth->group($id)->row();

		//validate form input
		$this->form_validation->set_rules('group_name', $this->lang->line('edit_group_validation_name_label'), 'required|alpha_dash|xss_clean');
		$this->form_validation->set_rules('group_description', $this->lang->line('edit_group_validation_desc_label'), 'xss_clean');

		if (isset($_POST) && !empty($_POST))
		{
			if ($this->form_validation->run() === TRUE)
			{
				$group_update = $this->ion_auth->update_group($id, $_POST['group_name'], $_POST['group_description']);

				if($group_update)
				{
					$this->session->set_flashdata('message', $this->lang->line('edit_group_saved'));
				}
				else
				{
					$this->session->set_flashdata('message', $this->ion_auth->errors());
				}
				redirect("auth", 'refresh');
			}
		}

		//set the flash data error message if there is one
		$this->data['message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));

		//pass the user to the view
		$this->data['group'] = $group;

		$this->data['group_name'] = array(
			'name'  => 'group_name',
			'id'    => 'group_name',
			'type'  => 'text',
			'value' => $this->form_validation->set_value('group_name', $group->name),
		);
		$this->data['group_description'] = array(
			'name'  => 'group_description',
			'id'    => 'group_description',
			'type'  => 'text',
			'value' => $this->form_validation->set_value('group_description', $group->description),
		);

		$this->_render_page('auth/edit_group', $this->data);
	}


	function _get_csrf_nonce()
	{
		$this->load->helper('string');
		$key   = random_string('alnum', 8);
		$value = random_string('alnum', 20);
		$this->session->set_flashdata('csrfkey', $key);
		$this->session->set_flashdata('csrfvalue', $value);

		return array($key => $value);
	}

	function _valid_csrf_nonce()
	{
		if ($this->input->post($this->session->flashdata('csrfkey')) !== FALSE &&
			$this->input->post($this->session->flashdata('csrfkey')) == $this->session->flashdata('csrfvalue'))
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}

	function _render_page($view, $data=null, $render=false)
	{

		$this->viewdata = (empty($data)) ? $this->data: $data;

		$view_html = $this->load->view($view, $this->viewdata, $render);

		if (!$render) return $view_html;
	}

}
