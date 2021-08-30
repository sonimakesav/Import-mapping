<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Maincontroller extends CI_Controller {

	public function __construct() {

		parent::__construct();
		$this->load->library('form_validation');
		$this->load->model('Mainmodel');
		$this->load->library('session');
		$this->load->helper('custom');
	}

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html



	//	 */

	public function index() {
		$result = $this->Mainmodel->get_employeeDetails();
		$data['data'] = $result;
		$this->load->view('index', $data);

	}
	public function upload() {
		$this->load->view('upload');

	}

	public function add_employee() {

		$employee_data = array(
			'employee_name' => $_POST['e_name'],
			'employee_code' => isset($_POST['code']) ? $_POST['code'] : "",
			'dob' => isset($_POST['dob']) ? date("Y-m-d", strtotime($_POST['dob'])) : "",
			'experience' => isset($_POST['exp']) ? $_POST['exp'] : "",

		);
		$result = $this->Mainmodel->add_employee($employee_data);
		if ($result) {

			redirect('Maincontroller/index');

		} else {
			echo "error";
		}
	}

	// public function import_csv() {
	// 	$this->load->library('Csvimport');
	// 	//Check file is uploaded in tmp folder
	// 	if (is_uploaded_file($_FILES['file']['tmp_name'])) {
	// 		//validate whether uploaded file is a csv file
	// 		$csvMimes = array('application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'text/x-comma-separated-values');
	// 		$mime = get_mime_by_extension($_FILES['file']['name']);
	// 		$fileArr = explode('.', $_FILES['file']['name']);
	// 		$ext = end($fileArr);
	// 		echo $ext;
	// 		echo $mime;
	// 		if (($ext == 'csv') && in_array($mime, $csvMimes)) {
	// 			$file = $_FILES['file']['tmp_name'];
	// 			$csvData = $this->csvimport->get_array($file);
	// 			$headerArr = array("Name", "Code", "Department", "DOB", "Join Date");
	// 			if (!empty($csvData)) {
	// 				//Validate CSV headers
	// 				$csvHeaders = array_keys($csvData[0]);
	// 				$headerMatched = 1;
	// 				foreach ($headerArr as $header) {
	// 					if (!in_array(trim($header), $csvHeaders)) {
	// 						echo $header;
	// 						$headerMatched = 0;
	// 					}
	// 				}
	// 				if ($headerMatched == 0) {
	// 					$this->session->set_flashdata("error_msg", "CSV headers are not matched.");
	// 					// redirect('Maincontroller/index');
	// 				} else {
	// 					foreach ($csvData as $row) {
	// 						$employee_data = array(
	// 							"employee_name" => $row['Name'],
	// 							"employee_code" => $row['Code'],
	// 							"dob" => date('Y-m-d', strtotime(str_replace('/', '-', $row['DOB']))),
	// 							"experience" => date('Y-m-d', strtotime(str_replace('/', '-', $row['Join Date']))),
	// 						);
	// 						$result = $this->Mainmodel->add_employee($employee_data);
	// 					}
	// 					$this->session->set_flashdata("success_msg", "CSV File imported successfully.");
	// 					redirect('Maincontroller/index');
	// 				}
	// 			}
	// 		} else {
	// 			$this->session->set_flashdata("error_msg", "Please select CSV file only.");
	// 			redirect('Maincontroller/index');
	// 		}
	// 	} else {
	// 		$this->session->set_flashdata("error_msg", "Please select a CSV file to upload.");
	// 		redirect('Maincontroller/index');
	// 	}
	// }

	public function import_csv() {
		$this->load->library('Csvimport');
		//Check file is uploaded in tmp folder
		if (is_uploaded_file($_FILES['file']['tmp_name'])) {
			//validate whether uploaded file is a csv file
			$csvMimes = array('application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'text/x-comma-separated-values');
			$mime = get_mime_by_extension($_FILES['file']['name']);
			$fileArr = explode('.', $_FILES['file']['name']);
			$ext = end($fileArr);
			if (($ext == 'csv') && in_array($mime, $csvMimes)) {
				$file = $_FILES['file']['tmp_name'];
				$csvData = $this->csvimport->get_array($file);
				$headerArr = array("Name", "Code", "Department", "DOB", "Join Date");
				if (!empty($csvData)) {
					//Validate CSV headers
					$csvHeaders = array_keys($csvData[0]);
					if (count($csvHeaders) <= 5) {
						$this->session->set_flashdata("error_msg", "Minium 5 headers needed.");
						redirect('Maincontroller/upload');
					}
					$headerMatched = 1;
					foreach ($headerArr as $header) {
						if (!in_array(trim($header), $csvHeaders)) {
							echo $header;
							$headerMatched = 0;
						}
					}
					if ($headerMatched == 0) {
						$this->session->set_flashdata("error_msg", "CSV headers are not matched.");
						redirect('Maincontroller/upload');
					} else {
						// $data['csv_data'] = $csvData;
						$this->session->set_userdata('csv', json_encode($csvData));
						// $this->load->view('mapping', $data);
						redirect('Maincontroller/mapping', 'refresh');

					}
				}
			} else {
				$this->session->set_flashdata("error_msg", "Please select CSV file only.");
				redirect('Maincontroller/upload');
			}
		} else {
			$this->session->set_flashdata("error_msg", "Please select a CSV file to upload.");
			redirect('Maincontroller/upload');
		}
	}

	public function upload_mapped_data() {
		$csvData = json_decode($_POST['csv'], TRUE);

		foreach ($csvData as $row) {
			$employee_data = array(
				$_POST['first'] => isset($row['Name']) ? $row['Name'] : "",
				$_POST['second'] => isset($row['Code']) ? $row['Code'] : "",
				$_POST['third'] => isset($row['DOB']) ? date('Y-m-d', strtotime(str_replace('/', '-', $row['DOB']))) : "",
				$_POST['forth'] => isset($row['Join Date']) ? date('Y-m-d', strtotime(str_replace('/', '-', $row['Join Date']))) : "",
			);
			$result = $this->Mainmodel->add_employee($employee_data);

		}
		// redirect('Maincontroller/index', 'refresh');
		// redirect(base_url('Maincontroller/index'), 'refresh');
	}

	public function mapping() {
		$this->load->view('mapping');

	}
}
