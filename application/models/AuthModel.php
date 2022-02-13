<?php

class AuthModel extends CI_Model
{
	public function sendMail($msg, $email, $subject, $logo, $signout, $sender)
	{
		$localhost = array('::1', '127.0.0.1', 'localhost');
		$protocol = 'mail';
		if (in_array($_SERVER['REMOTE_ADDR'], $localhost)) {
			$protocol = 'smtp';
		}
		// ##############################################################
		// parameters
		// ##############################################################
		$mailToSend = ' 
				<html> 
				<head>    
					<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
				    <link href="https://fonts.googleapis.com/css?family=Roboto:400,500,400italic,300italic,300,500italic,700,700italic,900,900italic" rel="stylesheet" type="text/css">  
					<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
				    <style>
				    	.theme-bg-primary-darken {
							background-color: none; 
						}
						.card{
							border:1px solid #333;
						}
						.card-white{
							border:1px solid #fff;
						}
						.card .card-body {
							padding: 10px;
						}
						.bg-dark{
							background-color:#333;
							color:#fff;
						}
						.container,
						.container-fluid,
						.container-xxl,
						.container-xl,
						.container-lg,
						.container-md,
						.container-sm {
							width: 100%;  
							background-color:#f5f5f5;
						} 
						.section-intro{
							padding:5px 10px 5px 10px;
						} 
					thead tr{
				    	font-weight:bolder;
				    	padding:10px;
				    	color:#000; 
				    }
				    tbody tr{
				    	background: #f5f5f5;
				    	padding:10px;
				    	color:#333;
				    	border:1px solid #333;
				    }
				    tbody tr:hover{
				    	background: #ffffff;
				    	padding:10px;
				    	color:#333;
				    }
					.blink_me { 
					  animation: blinker 1s linear infinite;
					}

					@keyframes blinker {
					  50% {
					    opacity: 0.5;
					  }
					}
						.footer {
							background: #d7117e;
							padding:10px;
							text-align:center;
							color:#fff; 
						}
						.py-5 {
							padding-top: 3rem !important;
							padding-bottom: 3rem !important;
						}
						.font-weight-bold {
							font-weight: 700 !important;
							text-align: center;
						}
						.mb-3 {
							margin-bottom: 1rem !important;
						}
						.mx-auto {
							margin-right: auto !important;
							margin-left: auto !important;
						}
						.mb-5 {
							margin-bottom: 3rem !important;
						}
						.text-secondary {
							color: #58677c !important;
						}
						.copyright{
							font-size:12px;
						}
						.flex-display{
							display:flex;
							overflow:auto;
						}
						 
				    </style>
				</head>

				<body>  
					<div class="container"> 
						<a class="nav-link nav-index" href="">' . $logo . '</a>
					</div>   
					<hr>
					<hr><br>

					<section class="skills-section section py-3">
						<div class="container"> 
							<div class="section-intro mx-auto text-center mb-5 text-secondary">' . $msg . '</div> 
							<footer class="footer text-light text-center"> 
							' . $signout . '
								<small class="copyright"> Copyright &copy;' . date('Y') . '<br> </small>
							</footer> 
						</div> 
					</section>  
                </body>
            	</html> ';
		// ##############################################################
		$config = array(
			'protocol' => $protocol,
			'smtp_host' => "ssl://smtp.googlemail.com",
			'smtp_port' => 465,
			'smtp_timeout' => 20,
			'smtp_user' => "",
			'smtp_pass' => "",
			'mailtype' => "html",
			'starttls' => true,
			'crlf' => "\r\n",
			'newline' => "\r\n",
		);
		$this->load->library('email');
		$this->email->initialize($config);
		$this->email->from("NO REPLY");
		$this->email->to($email);
		$this->email->subject($subject);
		$this->email->message($mailToSend);
		$flag = $this->email->send();
		if ($flag) {
			return $flag;
		} else {
			return false;
		}
	}


	function sendEmail()
	{
		$output = '';
		$sender = $this->input->post('sender');
		$subject = $this->input->post('subject');
		$email = $this->security->sanitize_filename($this->input->post('receipient'));
		$msg = $this->input->post('mailBody');
		$logo = '<img src="' . base_url() . 'assets/images/foozaweb.png" alt="logo" style="max-height:40px;">';
		$signout = "Foozaweb Tech";

		if ($email === "ALL" || $email === 'all') {
			$query = $this->db->get('jobs')->result_array();
			foreach ($query as $value) {
				$email = $value['cEmail'];
				if ($this->sendMail($msg, $email, $subject, $logo, $signout, $sender)) {
					$output .= "Sent to " . $email . "<br>";
				}
			}
			return $output;
		} else {
			if ($this->sendMail($msg, $email, $subject, $logo, $signout, $sender)) {
				return true;
			} else {
				return false;
			}
		}
	}



	function access($loginId, $password)
	{
		$sessionArray = '';
		$hashedPassword = "";
		// $loginpassword = $this->bcrypt->hashPassword($password); 

		$this->db->where('email', $loginId);
		$this->db->or_where('phone', $loginId);
		$query = $this->db->get('chbadmin');
		$hashedPassword = $query->row_array()['password'];

		if ($query->num_rows() > 0) {
			if ($this->bcrypt->checkPassword($password, $hashedPassword)) {
				$row = $query->row();
				$accountType = $row->accountType;
				$email = $row->email;
				$uniqueId = $row->uniqueId;
				$emailStatus = $row->emailStatus;
				$accountStatus = $row->accountStatus;
				$position = $row->position;

				if ($emailStatus == '0') {
					$sender = "CHB ADMIN";
					$subject = "New Account";
					$msg = "<h1>Dear " . $row->name . ", We welcome you to CHB Luxury. Kindly click <a href='" . base_url() . "auth/vE/" . $uniqueId . "'>Here</a> to verify your email address</h1>";
					$logo = '<img src="' . base_url() . 'dist/images/favicon.ico" alt="logo" style="max-height:90px;">';
					$signout = "CHB ADMIN";
					$this->sendMail($msg, $email, $subject, $logo, $signout, $sender);

					$this->session->set_flashdata('alert_danger', 'Email Address hasn\'t been verified. we have sent you a mail which contains verification link. kindly check your email and verify your email address.');
					return false;
				}

				if ($accountStatus == '0') {
					$this->session->set_flashdata('alert_danger', 'Your CHB Luxury Account hasn\'t been verified. kindly check back in in a short while.');
					return false;
				}

				if ($accountStatus == '2') {
					$this->session->set_flashdata('alert_danger', 'Your Account has been temporarily suspended. You cannot login until your account is resolved');
					return false;
				}

				if ($accountStatus == '3') {
					$this->session->set_flashdata('alert_danger', 'Account not found');
					return false;
				}

				if ($accountStatus == '1' && $emailStatus == '1' && $position == 'Sales') {
					$this->db->where('uniqueId', $uniqueId);
					$this->db->update('chbadmin', array('loginStatus' => '1', 'lastLogin' => date('d M Y H:i:s a')));

					$this->db->where('unique_id', $uniqueId);
					$this->db->update('users', array('status' => 'Active now'));

					$this->db->insert('chb_activity', array('activity' => $row->name . ' logged in', 'uniqueId' => $uniqueId, 'act_date' => date('d M Y H:i:s a')));

					$sessionArray = array('uniqueId' => $uniqueId, 'accountType' => $accountType, 'chb_chat_email' => $email, 'chbEmail' => $email, 'chbAuth' => true);
					$this->session->set_userdata($sessionArray);

					$data['screen_locked'] = $this->session->userdata('screen_locked');
					$this->session->unset_userdata('screen_locked');
					return true;
				}
				if ($accountStatus == '1' && $emailStatus == '1' && $position != 'Sales') {
					$this->session->set_flashdata('alert_danger', 'Access denied. Please login via <a href="https://admin.chbluxury.com.ng">chb managers panel</a>');
					return false;
				}
			} else {
				$this->session->set_flashdata('alert_danger', 'Login ID Found, but you have Entered a wrong Password Can\'t remember your password? <a href="' . base_url() . 'auth/passwordAuth">Recover it here...</a>');
				return false;
			}
		} else {
			$this->session->set_flashdata('alert_danger', 'Invalid Login details');
			return false;
		}
	}

	function thereIsAnActivity($activity)
	{
		$uniqueId = $this->session->userdata('uniqueId');
		$row = $this->db->get_where('chbadmin', array('uniqueId' => $uniqueId))->row_array();
		$name = $row['name'];
		return $this->db->insert('chb_activity', array('activity' => $name . ' ' . $activity, 'uniqueId' => $uniqueId, 'act_date' => date('d M Y H:i:s a')));
	}

	function logout()
	{
		$uniqueId = $this->session->userdata('uniqueId');

		$this->db->where('unique_id', $uniqueId);
		$this->db->update('users', array('status' => 'Offline now'));

		$this->db->where('uniqueId', $uniqueId);
		return $this->db->update('chbadmin', array('loginStatus' => '0'));
	}

	function vE($id)
	{
		$this->db->where('uniqueId', $id);
		return $this->db->update('chbadmin', array('emailStatus' => '1'));
	}



	function getLoginAccount()
	{
		$uniqueId = $this->session->userdata('uniqueId');
		$this->db->join('chb_offices', 'chb_offices.office_id = chbadmin.office', 'left');
		return $this->db->get_where('chbadmin', array('chbadmin.uniqueId' => $uniqueId))->row_array();
	}

	function change_password()
	{
		$hashedPassword = "";
		$uniqueId = $this->session->userdata('uniqueId');
		$newPassword = $this->bcrypt->hashPassword($this->input->post('newPassword'));
		$staffPassword = $this->input->post('staffPassword');

		$this->db->where('uniqueId', $uniqueId);
		$query = $this->db->get('chbadmin');
		$hashedPassword = $query->row_array()['password'];

		if ($this->bcrypt->checkPassword($staffPassword, $hashedPassword)) {
			$this->db->where(array('unique_id' => $uniqueId));
			$this->db->update('users', array('password' => md5($this->input->post('newPassword'))));

			$this->thereIsAnActivity("Updated account Password");
			$this->db->where('uniqueId', $uniqueId);
			$this->session->set_flashdata('alert_success', 'Account Password successfully changed');
			return $this->db->update('chbadmin', array('password' => $newPassword));
		} else {
			$this->session->set_flashdata('alert_danger', 'Current Password is not correct');
			return false;
		}
	}


	function otp()
	{
		$otp = random_string('alnum', 5);
		$email = $this->input->post('email');
		$query  = $this->db->get_where('chbadmin', array('email' => $email));
		if ($query->num_rows() > 0) {
			$row = $query->row();
			$email = $row->email;
			$this->session->set_userdata(array('otp' => $otp));


			$msg = '<div style="overflow:auto;" class="card">
						<p></p>
						<div class="card-white">
							<div class="card-body" style="text-align:center;">
							Hello ' . $row->firstname . ' ' . $row->lastname . ', <br>
							Passwords are security measures to personalize your accounts with different platforms. Your password ensures your account privacy. Maintaining a password  ensures your privacy.
								<h1>You have requested a new password for your account, <br> kindly use the code below for authentication<br> (' . $otp . ') </h1>
							</div>
						</div>
					</div>';
			$sender = 'CHB LUXURY';
			$email = $row->email;
			$subject = 'Recover Password';
			$logo = '<img src="' . base_url() . 'images/logo.jpg" alt="logo" style="max-height:90px;">';
			$signout = '<div class="card-white">
				<div class="card-body">
					For further enquiries, please visit our <a href="' . base_url() . '">website</a> or send a mail to <b>store@chbluxury.com</b>
					<p><small>This mail was sent to ' . $row->email . ' from chbluxury.</p>
				</div>
			</div>';
			if ($this->sendMail($msg, $email, $subject, $logo, $signout, $sender)) {
				return $otp;
			} else {
				return 'mail_failed';
			}
		} else {
			return 'email_not_found';
		}
	}

	function recover_password()
	{
		$email = $this->input->post('email');
		$password = $this->bcrypt->hashPassword($this->input->post('password'));
		$query = $this->db->get_where('chbadmin', array('email' => $email));
		if ($query->num_rows() > 0) {
			$this->db->where('email', $email);
			$this->db->update('chbadmin', array('password' => $password));

			$this->db->where('email', $email);
			$this->db->update('users', array('password' => md5($this->input->post('password'))));

			$msg = '<div style="overflow:auto;" class="card">
						<p></p>
						<div class="card-white">
							<div class="card-body" style="text-align:center;">
								<h1>
									Hello, this is to inform you that your account password has been successfully changed.
								</h1>
							</div>
						</div>
					</div>';
			$sender = 'CHB LUXURY';
			$subject = 'Recover Password';
			$logo = '<img src="' . base_url() . 'images/logo.jpg" alt="logo" style="max-height:90px;">';
			$signout = '<div class="card-white">
				<div class="card-body">
					For further enquiries, please visit our <a href="' . base_url() . '">website</a> or send a mail to <b>store@chbluxury.com</b>
					<p><small>This mail was sent to ' . $email . ' from chbluxury.</p>
				</div>
			</div>';
			$this->sendMail($msg, $email, $subject, $logo, $signout, $sender);
			$this->session->set_flashdata('alert_success', 'Password Successfully Changed.');
			return true;
		}
	}
}
