<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mainmodel extends CI_model {
	public function __construct() {
		parent::__construct();
		$this->load->database();
	}

	public function add_employee($arr) {
		return $this->db->insert('employee_details', $arr);
	}

	public function get_employeeDetails() {
		$this->db->select('employee_name as name , employee_code as code, dob, 	experience as exp');
		$this->db->from('employee_details');
		return $this->db->get()->result_array();

	}

	public function get_user() {
		$session_data = $this->session->userdata('test');

		$this->db->select('*');
		$this->db->from('user_master');
		$this->db->where('id', $session_data[0]['id']);
		return $this->db->get()->result_array();

	}

	public function user_sel($id) {
		$this->db->select('*');
		$this->db->from('user_master');
		$this->db->where('id', $id);
		return $this->db->get()->result_array();
	}
	public function user_update($data, $id) {
		$this->db->where('id', $id);
		return $this->db->update('user_master', $data);
	}

	public function login($logarray) {
		$this->db->select('*');
		$this->db->from('user_master');
		$this->db->where('username', $logarray['username']);
		$this->db->where('password', $logarray['password']);
		$this->db->or_where('email_id', $logarray['email_id']);
		$this->db->where('password', $logarray['password']);
		return $this->db->get()->result_array();
	}

	public function project($projectarray) {
		// print_r($projectarray);
		return $this->db->insert('project', $projectarray);

	}

	public function project_loop() {
		$session_data = $this->session->userdata('test');
//        $qry="select count(*) as total from public.project where user_id=$userid";
		$userid = $session_data[0]['id'];
		$this->db->select('count(*) as total');
		$this->db->from('project');
		$this->db->where('user_id', $userid);
		$this->db->where('is_child', false);
		return $this->db->get()->result_array();
	}
	public function project_userid() {
		$session_data = $this->session->userdata('test');
//        $qry="select count(*) as total from public.project where user_id=$userid";
		$userid = $session_data[0]['id'];
		$this->db->select('*');
		$this->db->from('project');
		$this->db->where('user_id', $userid);
		$this->db->where('is_child', false);
		$this->db->order_by('project_id', 'DESC');

		return $this->db->get()->result_array();

	}
	public function countproject() {
		$session_data = $this->session->userdata('test');
		$userid = $session_data[0]['id'];
		$this->db->select('*');
		$this->db->from('project');
		$this->db->where('user_id', $userid);
		$this->db->where('parent_id', 0);

		return $this->db->get()->result_array();

	}

	public function get_main_project() {

		$this->db->select('*');
		$this->db->from('project');

		$this->db->where('parent_id', 0);

		return $this->db->get()->result_array();

	}

	public function get_subproject_under_project($projectid) {

		$this->db->select('*');
		$this->db->from('project');

		$this->db->where('is_child', true);
		$this->db->where('parent_id', $projectid);
		return $this->db->get()->result_array();
	}

	public function subproject($subprojectarray) {
		return $this->db->insert('sub_project', $subprojectarray);
		/*$lastid= $this->db->insert_id();

			        $this->db->select( '*');
			        $this->db->from('project');
			        $this->db->where('project_id',$lastid) ;
		*/
//        return $this->db->get()->result_array();
	}

	public function subproject_loop($projectid) {
		$session_data = $this->session->userdata('test');
//        $qry="select count(*) as total from public.project where user_id=$userid";
		$userid = $session_data[0]['id'];
		$this->db->select('count(*) as total');
		$this->db->from('project');
		$this->db->where('user_id', $userid);
		$this->db->where('is_child', true);
		$this->db->where('parent_id', $projectid);
		return $this->db->get()->result_array();
	}

	public function subproject_loop1($projectid) {
		$session_data = $this->session->userdata('test');
//        $qry="select count(*) as total from public.project where user_id=$userid";
		$userid = $session_data[0]['id'];
		$this->db->select('*');
		$this->db->from('project');
		$this->db->where('user_id', $userid);
		$this->db->where('project_id', $projectid);
		$k = $this->db->get()->result_array();
		$total_subproject = $k[0]['is_child'];
		if ($total_subproject == 't') {
			$prt = $k[0]['parent_id'];
			//subproject_loop1($prt);
			return $this->subproject_loop1($prt);
		} else {
			return $k;
		}

	}

	public function subproject_userid($projectid) {
		$session_data = $this->session->userdata('test');
//        $qry="select count(*) as total from public.project where user_id=$userid";
		$userid = $session_data[0]['id'];
		$this->db->select('*');
		$this->db->from('project');
		$this->db->where('user_id', $userid);
		$this->db->where('is_child', true);
		$this->db->where('parent_id', $projectid);
		return $this->db->get()->result_array();
	}

	public function mile_stone($milestonearray) {
//        print_r($milestonearray);

		return $this->db->insert('mile_stone', $milestonearray);
	}

	public function get_milestone($projectid) {
//        $projectid= $milestonearray['project_id'];

		$this->db->select('count(*) as total');
		$this->db->from('mile_stone');
		$this->db->where('project_id', $projectid);

		return $this->db->get()->result_array();
	}

	public function milestone_data($projectid) {
		$this->db->select('*');
		$this->db->from('mile_stone');
		$this->db->where('project_id', $projectid);

		return $this->db->get()->result_array();
	}
	public function site($sitearray) {
		return $this->db->insert('site', $sitearray);
	}

	public function milestone($milearray) {
		return $this->db->insert('mile_stone', $milearray);
	}
	public function get_project() {
		$session_data = $this->session->userdata('test');
//        $qry="select count(*) as total from public.project where user_id=$userid";
		$userid = $session_data[0]['id'];
		$this->db->select('*');
		$this->db->from('project');
		$this->db->where('user_id', $userid);
		return $this->db->get()->result_array();
	}
	public function get_site() {
		$this->db->select('*');
		$this->db->from('site');
		return $this->db->get()->result_array();
	}

	public function project_exists($projectname) {
		echo $projectname;

		$this->db->where('project_name', $projectname);
		$query = $this->db->get('project');
//   print_r($query);
		if ($query->num_rows() > 0) {

			return false;
		} else {

			return true;
		}
	}

	public function template($arr) {
		$this->db->insert('template', $arr);
		return $lastid = $this->db->insert_id('template_template_code_seq');
//	$this->db->select('*');
		//        $this->db->from('template');
		//	 $this->db->where('template_code',$lastid) ;
		//		return $this->db->get()->result_array();

	}
	public function template_item($arr) {
		$this->db->insert('template_it', $arr);
		return $lastid = $this->db->insert_id('template_it_template_code_seq');

	}
	public function get_all_template() {
		$session_data = $this->session->userdata('test');
//        $qry="select count(*) as total from public.project where user_id=$userid";
		$userid = $session_data[0]['id'];
		$this->db->select('*');
		$this->db->from('template');
		$this->db->where('user_id', $userid);
		return $this->db->get()->result_array();
	}
	public function get_all_template_item() {
		$session_data = $this->session->userdata('test');
//        $qry="select count(*) as total from public.project where user_id=$userid";
		$userid = $session_data[0]['id'];
		$this->db->select('*');
		$this->db->from('template_it');
		$this->db->where('user_id', $userid);
		return $this->db->get()->result_array();
	}
	public function template_id($templatecode) {
		$this->db->select('*');
		$this->db->from('template');
		$this->db->where('template_code', $templatecode);
		return $this->db->get()->result_array();
	}
	public function get_template($templatecode) {
//        $projectid= $milestonearray['project_id'];

		$this->db->select('count(*) as total');
		$this->db->from('template');
		$this->db->where('template_code', $templatecode);

		return $this->db->get()->result_array();
	}
	public function get_all_templateitem($templatecode) {
//        $projectid= $milestonearray['project_id'];

		$this->db->select('count(*) as total');
		$this->db->from('template_it');
		$this->db->where('template_code', $templatecode);

		return $this->db->get()->result_array();
	}
	public function template_data($templatecode) {
		$this->db->select('*');
		$this->db->from('template_it');
		$this->db->where('template_code', $templatecode);

		return $this->db->get()->result_array();
	}
	public function row_delete($templateid) {

		$this->db->where('template_code', $templateid);
		return $this->db->delete('template');

	}
	public function it_delete($templateid) {

		$this->db->where('template_code', $templateid);
		return $this->db->delete('template_it');

	}
	public function getall_items($result) {
		$this->db->select('*');
		$this->db->from('template_it');
		$this->db->where('template_item_code', $result);

		return $this->db->get()->result_array();
	}
	function getall_items_under_itemcode($templatecode) {
		$this->db->select('*');
		$this->db->from('template_it');
		$this->db->where('template_code', $templatecode);

		return $this->db->get()->result_array();
	}

	public function template_item_delete($templateitcode) {
		//echo $templateitcode;
		//		echo "zdxfcgvhbjnk";
		$this->db->where('template_item_code', $templateitcode);
		return $this->db->delete('template_it');
	}

	public function template_item_update($data, $templateid) {

		$this->db->where('template_item_code', $templateid);
		return $this->db->update('template_it', $data);

	}
	public function template_update($data, $templateid) {
		$this->db->where('template_code', $templateid);
//		print_r (data);
		return $this->db->update('template', $data);

	}

	public function stafftype($stafftypearray) {
		$this->db->insert('staff_type', $stafftypearray);
		$insert_id = $this->db->insert_id('staff_type_staff_type_code_seq');

		return $insert_id;

	}
	public function get_stafftype() {
		$session_data = $this->session->userdata('test');
//        $qry="select count(*) as total from public.project where user_id=$userid";
		$userid = $session_data[0]['id'];
		$this->db->select('*');
		$this->db->from('staff_type');
		$this->db->where('user_id', $userid);
		return $this->db->get()->result_array();
	}
	public function stafftype_del($stafftypeid) {
		$this->db->where('staff_type_code', $stafftypeid);
		return $this->db->delete('staff_type');
	}
	public function stafftype_sel($stafftypeid = null) {
		$this->db->select('*');
		$this->db->from('staff_type');
		$this->db->where('staff_type_code', $stafftypeid);
		return $this->db->get()->result_array();
	}
	public function stafftype_update($data, $stafftypeid) {
		$this->db->where('staff_type_code', $stafftypeid);
		return $this->db->update('staff_type', $data);
	}
	public function get_staff() {
		$session_data = $this->session->userdata('test');
//        $qry="select count(*) as total from public.project where user_id=$userid";
		$userid = $session_data[0]['id'];
		$this->db->select('*');
		$this->db->from('staff');
		$this->db->where('user_id', $userid);

		return $this->db->get()->result_array();
	}

	public function get_all_staff() {

		$this->db->select('*');
		$this->db->from('staff');
		// $this->db->where('user_id',$userid);

		return $this->db->get()->result_array();
	}

	public function staff($staffarray) {
		return $this->db->insert('staff', $staffarray);

	}
	public function staff_project_map_insert($arr) {
		return $this->db->insert('staff_project_map', $arr);
	}
	public function staff_project_map_sel() {
		$this->db->select('*');
		$this->db->from('staff_project_map');
//              $this->db->where('staff_code',$staffid) ;
		return $this->db->get()->result_array();
	}

	public function get_new_expense_sl_no() {
		$SQL = "SELECT * from public.get_new_expense_sl_no();";
		$query = $this->db->query($SQL);
		$res = $query->result_array();
//    print_r($res);
		return $res;
	}
	public function expense_entry($expensearray) {
		return $this->db->insert('expense_entry', $expensearray);
	}

	public function get_staff_project_map($projectid) {
//        $projectid= $milestonearray['project_id'];

		$this->db->select('count(*) as total');
		$this->db->from('staff_project_map');
		$this->db->where('project_id', $projectid);

		return $this->db->get()->result_array();
	}

	public function staff_project_map_data($projectid) {
		$this->db->select('*');
		$this->db->from('staff_project_map');
		$this->db->where('project_id', $projectid);

		return $this->db->get()->result_array();
	}
	public function staff_project_map_data_del($staffprojectid) {
		$this->db->where('staff_project_id', $staffprojectid);
		return $this->db->delete('staff_project_map');

	}

	public function staff_name_exist($projectid) {
		$session_data = $this->session->userdata('test');
//        $qry="select count(*) as total from public.project where user_id=$userid";
		$userid = $session_data[0]['id'];
		$SQL = "select staff_code,staff_name from staff where user_id='$userid' and  staff_code not in (select staff_id as staff_code from staff_project_map spm,staff s where spm.staff_id=s.staff_code and spm.project_id='$projectid')";

		$query = $this->db->query($SQL);

		return $res = $query->result_array();
		//print_r($res);

	}

	public function get_staffname($staffid) {
		$this->db->select('staff_name');
		$this->db->from('staff');
		$this->db->where('staff_code', $staffid);

		return $this->db->get()->result_array();
	}

	public function milstone_status_insert($statusarray) {
		return $this->db->insert('milestone_status', $statusarray);
	}
	public function get_milestone_status() {
		$session_data = $this->session->userdata('test');
//        $qry="select count(*) as total from public.project where user_id=$userid";
		$userid = $session_data[0]['id'];
		$this->db->select('*');
		$this->db->from('milestone_status');
		// $this->db->where('user_id',$userid) ;
		return $this->db->get()->result_array();
	}

	public function milstone_status_delete($statusid) {
		$this->db->where('milestone_status_id', $statusid);
		return $this->db->delete('milestone_status');

	}

	public function milestone_status_sel($statusid) {
		$this->db->select('*');
		$this->db->from('milestone_status');
		$this->db->where('milestone_status_id', $statusid);
		return $this->db->get()->result_array();
	}

	public function milestone_status_update($data, $statusid) {
		$this->db->where('milestone_status_id', $statusid);
		return $this->db->update('milestone_status', $data);
	}

	public function lead_milestone_status_update($data, $id) {
		$this->db->where('lead_mile_status_id', $id);
		return $this->db->update('lead_milestone_status', $data);
	}

	public function milestones_delete($milestoneid) {
		$this->db->where('milestone_id', $milestoneid);
		return $this->db->delete('mile_stone');

	}

	public function milestone_update($data, $statusid) {
		$this->db->where('milestone_id', $statusid);
		return $this->db->update('mile_stone', $data);
	}

	public function get_milestones($statusid) {
		$this->db->select('*');
		$this->db->from('mile_stone');
		$this->db->where('milestone_id', $statusid);
		return $this->db->get()->result_array();
	}

	public function stafflogin($stafflogarray) {
//                 print_r($stafflogarray);
		$this->db->select('*');
		$this->db->from('staff');
//	   			$this->db->join('preference', 'preference.supervisor_stafftype = staff.staff_type_code');
		// $this->db->where('user_id',$stafflogarray['user_id']) ;
		//              $this->db->where('staff_type_code',$stafflogarray['staff_type_code']) ;
		$this->db->where('username', $stafflogarray['username']);
		$this->db->where('password', $stafflogarray['password']);
		return $this->db->get()->result_array();
	}

	public function getall_staff_project_map($staff_code) {
		$session_data = $this->session->userdata('test1');
		$staff_code = $session_data[0]['staff_code'];
		$this->db->select('*');
		$this->db->from('project');
		$this->db->join('staff_project_map', 'project.project_id = staff_project_map.project_id');
		$this->db->where('staff_project_map.staff_id', $staff_code);
		$this->db->where('project.is_child', false);
		return $this->db->get()->result_array();
	}

	public function getall_staff_project_map1($staff_code) {

		$session_data = $this->session->userdata('test1');
		$staff_code = $session_data[0]['staff_code'];
		$this->db->select('*');
		$this->db->from('project');

		$this->db->where('is_child', true);
		return $this->db->get()->result_array();
	}
	public function getall_milestone() {
		$this->db->select('*');
		$this->db->from('mile_stone');
		return $this->db->get()->result_array();
	}
	public function status_entry($arr) {
		return $this->db->insert('status_entry', $arr);
	}
	public function status_entry_deletion($milestoneid) {
		$this->db->where('milestone_id', $milestoneid);
		return $this->db->delete('status_entry');
	}

	public function current_status($milestone_id) {

		$SQL = "SELECT public.get_status_code($milestone_id) as st;";

		$query = $this->db->query($SQL);
		$res = $query->result_array();
		$res1 = $res[0]['st'];
		return $res1;

	}
	public function get_status_entry() {
		$this->db->select('*');
		$this->db->from('status_entry');
		return $this->db->get()->result_array();
	}

	public function get_all_workentry() {
		$session_data = $this->session->userdata('test');
		$id = $session_data[0]['id'];
		$session_data = $this->session->userdata('test1');
		$staff_id = $session_data[0]['staff_code'];
		$this->db->select('*');
		$this->db->from('work_entry');
		// $this->db->where('project_id',$project_id) ;
		$this->db->where('staff_id', $staff_id);

		return $this->db->get()->result_array();
	}
	public function workentry($workentryarray) {
		$this->db->insert('work_entry', $workentryarray);
		$this->db->select('*');
		$this->db->from('work_entry');
		return $this->db->get()->result_array();
	}

	public function workentry_sel($work_id) {

		$this->db->select('*');
		$this->db->from('work_entry');

		$this->db->where('id', $work_id);

		return $this->db->get()->result_array();
	}

	public function work_del($workid) {

		$this->db->where('id', $workid);
		return $this->db->delete('work_entry');

	}

	public function get_workentry_project($id) {
// $session_data = $this->session->userdata('test');
		//  $id=$session_data[0]['id'];
		$session_data = $this->session->userdata('test1');
		$staff_id = $session_data[0]['staff_code'];
		$this->db->select('*');
		$this->db->from('work_entry');
		$this->db->where('project_id', $id);
		//$this->db->where('staff_id',$staff_id) ;

		return $this->db->get()->result_array();
	}

	public function get_workentry_date_project($id, $time) {
// $session_data = $this->session->userdata('test');
		//  $id=$session_data[0]['id'];
		$session_data = $this->session->userdata('test1');
		$staff_id = $session_data[0]['staff_code'];
		$this->db->select('*');
		$this->db->from('work_entry');
		$this->db->where('project_id', $id);
		$this->db->where('created_at', $time);

		return $this->db->get()->result_array();
	}

	/*public function get_staff()
		        {
		                  $this->db->select('*');
		              $this->db->from('staff');
		return $this->db->get()->result_array();
	*/
	public function staff_del($staffid) {
		$this->db->where('staff_code', $staffid);
		return $this->db->delete('staff');
	}
	public function staff_sel($staffid = null) {
		$this->db->select('*');
		$this->db->from('staff');
		$this->db->where('staff_code', $staffid);
		return $this->db->get()->result_array();
	}
	public function staff_update($data, $staffid) {
		$this->db->where('staff_code', $staffid);
		return $this->db->update('staff', $data);
	}

	public function budget($budgetarray) {
		return $this->db->insert('budget', $budgetarray);

	}

	public function projectid($projectid) {
		$this->db->select('parent_id');
		$this->db->from('project');
		$parent = $this->db->where('project_id', $projectid);
		return $this->db->get()->result_array();
	}

	public function get_all_budget($projectid) {
		$session_data = $this->session->userdata('test');
		$userid = $session_data[0]['id'];
		$this->db->select('*');
		$this->db->from('budget');
		$this->db->where('user_id', $userid);
		$this->db->where('project_code', $projectid);

		return $this->db->get()->result_array();

	}

	public function get_project_name($projectid) {
		$session_data = $this->session->userdata('test');
		$userid = $session_data[0]['id'];
		$this->db->select('project_name');
		$this->db->from('project');
		$this->db->where('project_id', $projectid);
		$this->db->where('user_id', $userid);

		return $this->db->get()->result_array();
	}
	public function get_weeklyy_project_name($projectid) {
		//   $session_data = $this->session->userdata('test');
		// $userid=$session_data[0]['id'];
		$this->db->select('project_name');
		$this->db->from('project');
		$this->db->where('project_id', $projectid);
		// $this->db->where('user_id',$userid);

		return $this->db->get()->result_array();
	}

	public function project_name($projectid) {
		$session_data = $this->session->userdata('test');
		$userid = $session_data[0]['id'];
		$this->db->select('project_name');
		$this->db->from('project');
		$this->db->where('project_id', $projectid);
		// $this->db->where('user_id',$userid);

		return $this->db->get()->result_array();
	}

	public function get_staff_type_name($stafftype) {
		$session_data = $this->session->userdata('test');
		$userid = $session_data[0]['id'];
		$this->db->select('*');
		$this->db->from('staff_type');
		$this->db->where('staff_type_code', $stafftype);
		$this->db->where('user_id', $userid);
		return $this->db->get()->result_array();
	}
	public function leads($leadsarray) {

		return $this->db->insert('leads', $leadsarray);
		// $lastid= $this->db->insert_id();

		//       $this->db->select( '*');
		//       $this->db->from('leads');
		//       $this->db->where('lead_id',$lastid) ;

		//       return $this->db->get()->result_array();
	}

	public function get_all_leads() {
		$session_data = $this->session->userdata('test');
		$userid = $session_data[0]['id'];
		$this->db->select('*');
		$this->db->from('leads');
		$this->db->where('modified_by', $userid);
		$this->db->where('created_by', $userid);
		$this->db->where('convert_to_client', 'FALSE');
		return $this->db->get()->result_array();
	}
	public function lead_sel($leadid) {
		$session_data = $this->session->userdata('test');
		$userid = $session_data[0]['id'];
		$this->db->select('*');
		$this->db->from('leads');
		$this->db->where('lead_id', $leadid);
		$this->db->where('modified_by', $userid);
		$this->db->where('created_by', $userid);
		return $this->db->get()->result_array();
	}

	public function leads_update($data, $leadid) {
		$this->db->where('lead_id', $leadid);
		return $this->db->update('leads', $data);
	}

	public function lead_delete($leadid) {

		$this->db->where('lead_id', $leadid);
		return $this->db->delete('leads');

	}

	public function get_lead_name($leadid) {
		$session_data = $this->session->userdata('test');
		$userid = $session_data[0]['id'];
		$this->db->select('*');
		$this->db->from('leads');
		$this->db->where('lead_id', $leadid);
//               $this->db->where('user_id',$userid);
		return $this->db->get()->result_array();
	}

	public function client($clientarray) {
		return $this->db->insert('clients', $clientarray);
	}
	public function get_all_clients() {
		$session_data = $this->session->userdata('test');
		$userid = $session_data[0]['id'];
		$this->db->select('*');
		$this->db->from('clients');
		$this->db->where('user_id', $userid);
		return $this->db->get()->result_array();
	}
	public function client_delete($clientid) {

		$this->db->where('client_id', $clientid);
		return $this->db->delete('clients');

	}

	public function client_sel($clientid) {
		$session_data = $this->session->userdata('test');
		$userid = $session_data[0]['id'];
		$this->db->select('*');
		$this->db->from('clients');
		$this->db->where('client_id', $clientid);
		$this->db->where('user_id', $userid);
		return $this->db->get()->result_array();
	}

	public function clients_update($data, $clientid) {
		$this->db->where('client_id', $clientid);
		return $this->db->update('clients', $data);
	}

	public function get_document() {
		$session_data = $this->session->userdata('test');
		$userid = $session_data[0]['id'];
		$this->db->select('*');
		$this->db->from('document_type');
//               $this->db->where('document_type_id',$docid);
		// $this->db->where('user_id',$userid);
		return $this->db->get()->result_array();
	}

	public function get_document_user_id() {
		$session_data = $this->session->userdata('test');
		$userid = $session_data[0]['id'];
		$this->db->select('*');
		$this->db->from('document_type');
//               $this->db->where('document_type_id',$docid);
		$this->db->where('user_id', $userid);
		return $this->db->get()->result_array();
	}

	public function document($documentarray) {

		return $this->db->insert('document_type', $documentarray);

	}
	public function doc_del($docid) {
		$this->db->where('document_id', $docid);
		return $this->db->delete('document_type');
	}
	public function documents_delete($docid) {

		$this->db->select('*');
		$this->db->from('documents');
		$result = $this->db->where('document_id', $docid);
		// $result[0]['target_name'];
		$k = $this->db->get()->result_array();
		$tname = $k[0]['target_name'];
		$path = $k[0]['path'];

		$this->db->where('document_id', $docid);
		unlink($path . $tname);
		return $this->db->delete('documents');
	}
	public function document_sel($docid) {
		$this->db->select('*');
		$this->db->from('document_type');
		$this->db->where('document_id', $docid);
		return $this->db->get()->result_array();
	}
	public function doc_update($data, $docid) {
		$this->db->where('document_id', $docid);
		return $this->db->update('document_type', $data);
	}
	public function get_drawing() {
		// $session_data = $this->session->userdata('test');
		// $userid=$session_data[0]['id'];
		$this->db->select('*');
		$this->db->from('drawing_type');
		// $this->db->where('user_id',$userid);
		return $this->db->get()->result_array();

	}

	public function get_drawing_user_id() {
		$session_data = $this->session->userdata('test');
		$userid = $session_data[0]['id'];
		$this->db->select('*');
		$this->db->from('drawing_type');
		$this->db->where('user_id', $userid);
		return $this->db->get()->result_array();

	}

	public function drawing($drawingarray) {
		return $this->db->insert('drawing_type', $drawingarray);

	}
	public function draw_del($drawid) {
		$this->db->where('drawing_id', $drawid);
		return $this->db->delete('drawing_type');
	}
	public function drawing_sel($drawid) {
		$this->db->select('*');
		$this->db->from('drawing_type');
		$this->db->where('drawing_id', $drawid);
		return $this->db->get()->result_array();
	}
	public function draw_update($data, $drawid) {
		$this->db->where('drawing_id', $drawid);
		return $this->db->update('drawing_type', $data);
	}
	public function insert_documents($destdoc) {
		return $this->db->insert('documents', $destdoc);
	}
	public function insert_images($destimage) {
		return $this->db->insert('drawings', $destimage);
	}

	public function get_all_drawings() {
		$this->db->select('*');
		$this->db->from('drawings');
		//$this->db->where('project_id',$projectid);
		return $this->db->get()->result_array();
	}

	public function drawing_delete($drawid) {
		$this->db->select('*');
		$this->db->from('drawings');
		$result = $this->db->where('drawing_id', $drawid);
		// $result[0]['target_name'];
		$k = $this->db->get()->result_array();
		$tname = $k[0]['target_name'];
		$path = $k[0]['path'];

		$this->db->where('drawing_id', $drawid);
		unlink($path . $tname);
		return $this->db->delete('drawings');

	}

	public function getdocument($projectid) {
		$this->db->select('*');
		$this->db->from('documents');
		$this->db->where('project_id', $projectid);
		return $this->db->get()->result_array();
	}
	public function get_all_document() {
		$this->db->select('*');
		$this->db->from('documents');
		// $this->db->where('project_id',$projectid);
		return $this->db->get()->result_array();
	}

	public function get_document_name($docid) {
		$session_data = $this->session->userdata('test');
		$userid = $session_data[0]['id'];
		$this->db->select('*');
		$this->db->from('document_type');
		$this->db->where('document_type_id', $docid);
		// $this->db->where('user_id',$userid);
		return $this->db->get()->result_array();
	}

	public function get_documents_name($docid) {
		$session_data = $this->session->userdata('test');
		$userid = $session_data[0]['id'];
		$this->db->select('*');
		$this->db->from('document_type');
		$this->db->where('document_id', $docid);
		// $this->db->where('user_id',$userid);
		return $this->db->get()->result_array();
	}

	public function getdrawing($projectid) {
		$this->db->select('*');
		$this->db->from('drawings');
		$this->db->where('project_id', $projectid);
		return $this->db->get()->result_array();
	}
	public function get_drawing_name($drawid) {
		$session_data = $this->session->userdata('test');
		$userid = $session_data[0]['id'];
		$this->db->select('*');
		$this->db->from('drawing_type');
		$this->db->where('drawing_type_id', $drawid);
		//$this->db->where('user_id',$userid);
		return $this->db->get()->result_array();
	}

	public function get_drawings_name($drawid) {
		$session_data = $this->session->userdata('test');
		$userid = $session_data[0]['id'];
		$this->db->select('*');
		$this->db->from('drawing_type');
		$this->db->where('drawing_id', $drawid);
		//$this->db->where('user_id',$userid);
		return $this->db->get()->result_array();
	}

	public function labourtype($labourtype) {
		return $this->db->insert('labour_type', $labourtype);
	}
	public function laboursupplier($laboursupplier) {
		return $this->db->insert('labour_supplier', $laboursupplier);

	}
	public function get_labourtype() {
		$session_data = $this->session->userdata('test');
//        $qry="select count(*) as total from public.project where user_id=$userid";
		$userid = $session_data[0]['id'];
		$this->db->select('*');
		$this->db->from('labour_type');
		$this->db->where('user_id', $userid);
		return $this->db->get()->result_array();
	}
	public function get_laboursupplier() {
		$session_data = $this->session->userdata('test');
//        $qry="select count(*) as total from public.project where user_id=$userid";
		$userid = $session_data[0]['id'];
		$this->db->select('*');
		$this->db->from('labour_supplier');
		$this->db->where('user_id', $userid);
		return $this->db->get()->result_array();
	}
	public function labour($labour) {
		return $this->db->insert('labour', $labour);
	}
	public function get_labour() {
		$session_data = $this->session->userdata('test');
//        $qry="select count(*) as total from public.project where user_id=$userid";
		$userid = $session_data[0]['id'];
		$this->db->select('*');
		$this->db->from('labour');
		$this->db->where('user_id', $userid);
		return $this->db->get()->result_array();
	}
	public function labour_type_del($labour_type_id) {
		$this->db->where('labour_type_id', $labour_type_id);
		return $this->db->delete('labour_type');
	}
	public function labour_supplier_del($labour_supplier_id) {
		$this->db->where('labour_supplier_code', $labour_supplier_id);
		return $this->db->delete('labour_supplier');
	}
	public function labour_del($labour_id) {
		$this->db->where('labour_id', $labour_id);
		return $this->db->delete('labour');
	}
	public function labourtype_sel($labour_type_id) {
		$this->db->select('*');
		$this->db->from('labour_type');
		$this->db->where('labour_type_id', $labour_type_id);
		return $this->db->get()->result_array();
	}

	public function labourtype_update($data, $labour_type_id) {
		$this->db->where('labour_type_id', $labour_type_id);
//			print_r ($data);
		return $this->db->update('labour_type', $data);
	}
	public function laboursupplier_sel($labour_supplier_id) {
		$this->db->select('*');
		$this->db->from('labour_supplier');
		$this->db->where('labour_supplier_code', $labour_supplier_id);
		return $this->db->get()->result_array();
	}
	public function laboursupplier_update($data, $labour_supplier_code) {
		$this->db->where('labour_supplier_code', $labour_supplier_code);
//			print_r ($data);
		return $this->db->update('labour_supplier', $data);
	}
	public function labour_sel($labour_id) {
		$this->db->select('*');
		$this->db->from('labour');
		$this->db->where('labour_id', $labour_id);
		return $this->db->get()->result_array();
	}
	public function labour_update($data, $labour_id) {
		$this->db->where('labour_id', $labour_id);
//			print_r ($data);
		return $this->db->update('labour', $data);
	}

	public function labourtype_sel_name($labour_type_id) {
		$this->db->select('labour_type_name');
		$this->db->from('labour_type');
		$this->db->where('labour_type_id', $labour_type_id);
		return $this->db->get()->result_array();
	}
	public function laboursupplier_sel_name($labour_supplier_id) {
		$this->db->select('labour_supplier_name');
		$this->db->from('labour_supplier');
		$this->db->where('labour_supplier_code', $labour_supplier_id);
		return $this->db->get()->result_array();
	}
	public function store($store) {
		return $this->db->insert('store', $store);
	}
	public function get_store() {
		$session_data = $this->session->userdata('test');
//        $qry="select count(*) as total from public.project where user_id=$userid";
		$userid = $session_data[0]['id'];
		$this->db->select('*');
		$this->db->from('store');
		$this->db->where('user_id', $userid);
		return $this->db->get()->result_array();
	}
	public function store_del($store_id) {
		$this->db->where('store_id', $store_id);
		return $this->db->delete('store');
	}
	public function store_sel($storeid = null) {
		$this->db->select('*');
		$this->db->from('store');
		$this->db->where('store_id', $storeid);
		return $this->db->get()->result_array();
	}
	public function store_update($data, $storeid) {
		$this->db->where('store_id', $storeid);
//			print_r ($data);
		return $this->db->update('store', $data);
	}
	public function preference() {
//		$this->db->insert('preference',$preference);

		$session_data = $this->session->userdata('test');
//        $qry="select count(*) as total from public.project where user_id=$userid";
		$userid = $session_data[0]['id'];
		$this->db->select('count(*) as total');
		$this->db->from('preference');
		$this->db->where('user_id', $userid);
		return $this->db->get()->result_array();
	}
	public function preference_insert($preference) {
		$this->db->insert('preference', $preference);
	}

	public function preference_sel($prefer_id) {
		$this->db->select('*');
		$this->db->from('preference');
		$this->db->where('preference_id', $prefer_id);
		return $this->db->get()->result_array();
	}
	public function preference_update($data, $prefer_id) {
		$this->db->where('preference_id', $prefer_id);
//			print_r ($data);
		return $this->db->update('preference', $data);
	}
	public function get_preference() {
		$session_data = $this->session->userdata('test');
//        $qry="select count(*) as total from public.project where user_id=$userid";
		$userid = $session_data[0]['id'];
		$this->db->select('*');
		$this->db->from('preference');
		$this->db->where('user_id', $userid);
		return $this->db->get()->result_array();
	}
	public function stafftype_sel_name($staff_type_code) {
		$this->db->select('staff_type_name');
		$this->db->from('staff_type');
		$this->db->where('staff_type_code', $staff_type_code);
		return $this->db->get()->result_array();
	}
	public function stafflogin_stafftype() {
		$session_data = $this->session->userdata('test1');
		$userid = $session_data[0]['staff_code'];
		$this->db->select('staff_type_code');
		$this->db->from('staff');
//              $this->db->where('staff_type_code',$staff_type_code);
		$this->db->where('staff_code', $userid);
		return $this->db->get()->result_array();
	}
	public function stafflogin_preference() {
		$session_data = $this->session->userdata('test');
		$userid = $session_data[0]['id'];
		$this->db->select('supervisor_stafftype,user_id');
		$this->db->from('preference');
//              $this->db->where('staff_type_code',$staff_type_code);
		$this->db->where('user_id', 13);
		return $this->db->get()->result_array();
	}
	public function material($material) {
		$this->db->insert('materials', $material);
	}
	public function get_material() {
		$session_data = $this->session->userdata('test');
//        $qry="select count(*) as total from public.project where user_id=$userid";
		$userid = $session_data[0]['id'];
		$this->db->select('*');
		$this->db->from('materials');
		$this->db->where('user_id', $userid);
		return $this->db->get()->result_array();
	}
	public function material_del($material_id) {
		$this->db->where('material_id', $material_id);
		return $this->db->delete('materials');
	}
	public function material_sel($material_id = null) {
		$this->db->select('*');
		$this->db->from('materials');
		$this->db->where('material_id', $material_id);
		return $this->db->get()->result_array();
	}
	public function material_update($data, $material_id) {
		$this->db->where('material_id', $material_id);
//			print_r ($data);
		return $this->db->update('materials', $data);
	}
	public function get_headid() {
//		$session_data = $this->session->userdata('test');
		//        $qry="select count(*) as total from public.project where user_id=$userid";
		//        $userid=$session_data[0]['id'];
		$this->db->select('*');
		$this->db->from('heads');
//               $this->db->where('parent_id',$parent_id);
		return $this->db->get()->result_array();
	}

	public function head_group($group) {
//		 $this->db->insert('heads',$group);
		$this->db->insert('heads', $group);

	}

	public function parent_id($c_parent) {
		$SQL = "SELECT * from public.get_new_head_id('$c_parent');";

		$query = $this->db->query($SQL);
		$res = $query->result_array();
//		$res1=$res[0]['hid'];
		return $res;
//		print_r($res1);
		//		$res1=$res[0]['hid'];
		//		return $res;

	}

	public function get_head_name() {
		$this->db->select('head_name');
		$this->db->from('heads');
		$this->db->where('parent_id');
		return $this->db->get()->result_array();
	}
	public function head_name($headsid) {
//		echo $parentid;
		$this->db->select('*');
		$this->db->from('heads');
//		$this->db->where('is_group',false);
		//		$this->db->where('head_id',$headid);
		$this->db->where('is_master', true);
		return $this->db->get()->result_array();
	}
	public function sub_head_name($headid) {
//		print_r(sub_head_name);
		$this->db->select('*');
		$this->db->from('heads');
		$this->db->where('parent_id', $headid);
		return $this->db->get()->result_array();
	}
	public function detail($sub_headid) {
//		echo $sub_headid;
		$this->db->select('*');
		$this->db->from('heads');
		$this->db->where('parent_id', $sub_headid);
		return $this->db->get()->result_array();
	}
	public function sub_detail($sub_headid1) {
//		echo $sub_headid;
		$this->db->select('*');
		$this->db->from('heads');
		$this->db->where('parent_id', $sub_headid1);
		return $this->db->get()->result_array();
	}
	public function get_heads($head) {
		$this->db->select('*');
		$this->db->from('heads');
		$this->db->where('head_id', $head);
		return $this->db->get()->result_array();
	}
	public function head_update($data, $head) {
		$this->db->where('head_id', $head);
		return $this->db->update('heads', $data);
	}
	public function get_head_supplier() {
		$this->db->select('*');
		$this->db->from('heads');
		$this->db->where('parent_id', 'B0201');
		return $this->db->get()->result_array();
	}
	public function supplier($supplier) {
		return $this->db->insert('dealers', $supplier);
//		 $lastid= $this->db->insert_id();
		//
		//        $this->db->select('*');
		//        $this->db->from('dealers');
		//        $this->db->where('dealer_id',$lastid) ;
		//
		//        return $this->db->get()->result_array();
	}
	public function supplier_head($head) {
		return $this->db->insert('heads', $head);
//		  $this->db->where('supplier_id',$lastid) ;
	}
	public function get_supplier() {
		$session_data = $this->session->userdata('test');
		$userid = $session_data[0]['id'];
		$this->db->select('*');
		$this->db->from('dealers');
		$this->db->where('user_id', $userid);
//		$this->db->where('parent_id','B0201');
		return $this->db->get()->result_array();
	}
	public function get_states() {
		$this->db->select('*');
		$this->db->from('states');
//		$this->db->where('parent_id','B0201');
		return $this->db->get()->result_array();
	}
	public function purchase($purchase) {
		return $this->db->insert('purchase', $purchase);
	}
	public function purchase_item($purchaseit) {
		return $this->db->insert('purchit', $purchaseit);
	}
//	public function purchase_amount($purchaseamt)
	//	{
	//		$this->db->select('*');
	//		$this->db->from('heads');
	//		$this->db->where('head_id','D0201');
	//		return $this->db->update('heads',$purchaseamt);
	//	}
	//	public function cash_amount($cashamt)
	//	{
	//		$this->db->select('*');
	//		$this->db->from('heads');
	//		$this->db->where('head_id','A0201');
	//		return $this->db->update('heads',$cashamt);
	//	}
	public function heads_add($amt) {
//		 print_r($amt);
		//		 $head = 'D0201';
		$amount = $amt['current_balance'];
		$head = $amt['head_id'];
		$this->db->set('current_balance', 'current_balance +' . $amount, FALSE);
		$this->db->where('head_id', $head);
		$this->db->update('heads');
	}
	public function heads_sub($amt) {
//		 print_r($amt);
		$amount = $amt['current_balance'];
		$head = $amt['head_id'];
		$this->db->set('current_balance', 'current_balance -' . $amount, FALSE);
		$this->db->where('head_id', $head);
		$this->db->update('heads');
	}
//	public function cash_add($amt)
	//	 {
	////		 $head = 'A0201';
	//		 $amount=$amt['current_balance'];
	//		 $head=$amt['head_id'];
	//		 $this->db->set('current_balance', 'current_balance -'.$amount , FALSE);
	//		 $this->db->where('head_id',$head);
	//		 $this->db->update('heads');
	//	 }
	//	public function supplier_add($amt)
	//	 {
	////		 print_r($amt);
	//		 $amount=$amt['current_balance'];
	//		 $head=$amt['head_id'];
	//		 $this->db->set('current_balance', 'current_balance +'.$amount , FALSE);
	//		 $this->db->where('head_id',$head);
	//		 $this->db->update('heads');
	//	 }

//	SELECT SUM(column_name)
	//FROM table_name
	//WHERE condition;
	//
	public function get_dealer($deal) {
//		print_r($deal);
		$this->db->select('*');
		$this->db->from('dealers');
		$this->db->where('dealer_id', $deal);
		return $this->db->get()->result_array();
	}

	public function get_parent($hid) {
		$SQL = "SELECT * from public.get_head_parent_id('$hid');";

		$query = $this->db->query($SQL);
		$res = $query->result_array();
//		print_r($res);
		$res1 = $res[0]['get_head_parent_id'];
//		print_r($res1);
		return $res;

//		$res1=$res[0]['hid'];
		//		return $res;

	}

	public function get_serialno() {
		$SQL = "SELECT * from public.get_new_purch_number();";
		$query = $this->db->query($SQL);
		$res = $query->result_array();
//		print_r($res);
		return $res;
	}
	public function get_serialnos() {
		$SQL = "SELECT * from public.get_new_grn_number();";
		$query = $this->db->query($SQL);
		$res = $query->result_array();
//		print_r($res);
		return $res;
	}
	public function material_delete($mat_id) {
		$this->db->where('item_code', $mat_id);
		return $this->db->delete('purchit');

	}

	public function stock_update($stock) {
		print_r($stock);
		$qty = $stock['quantity'];
		$matid = $stock['item_code'];
		$this->db->set('stock', 'stock +' . $qty, FALSE);
		$this->db->where('material_id', $matid);
		$this->db->update('materials');
	}

	public function grn($grn) {
		return $this->db->insert('grn_entry', $grn);
	}
	public function grn_item($grnit) {
		return $this->db->insert('grn_item', $grnit);
	}

	public function get_purchase() {
		$this->db->select('*');
		$this->db->from('purchase');
		$this->db->order_by('serial_no', 'ASC');

//		$this->db->where('parent_id','B0201');
		return $this->db->get()->result_array();
	}
	public function get_purchase_item($sno) {
//
		$SQL = " select * from purchit left outer join
purchase on purchit.serial_no = purchase.serial_no where purchase.invoice_no='$sno'";

		$query = $this->db->query($SQL);

		return $res = $query->result_array();

	}

	public function get_material_sel($material_id) {
		$this->db->select('*');
		$this->db->from('materials');
		$this->db->where('material_id', $material_id);
		return $this->db->get()->result_array();
	}

	public function get_purchase_slno($slno) {
		$this->db->select('*');
		$this->db->from('purchase');
		$this->db->where('invoice_no', $slno);
		$this->db->order_by('serial_no', 'ASC');

//		$this->db->where('parent_id','B0201');
		return $this->db->get()->result_array();
	}

	public function lastslno() {

	}
	public function get_grn_data($slno) {
		$this->db->select('*');
		$this->db->from('grn_entry');
		$this->db->where('serial_no', $slno);
		//$this->db->order_by('serial_no', 'ASC');
		return $this->db->get()->result_array();

	}
	public function get_grn_item($slno) {
		$this->db->select('*');
		$this->db->from('grn_item');
		$this->db->where('serial_no', $slno);
		//$this->db->order_by('serial_no', 'ASC');
		return $this->db->get()->result_array();

	}
	public function get_supplierses($id) {
		$this->db->select('*');
		$this->db->from('dealers');
		$this->db->where('dealer_id', $id);
		return $this->db->get()->result_array();
	}
	public function get_states_id($state) {
		$this->db->select('*');
		$this->db->from('states');
		$this->db->where('state_code', $state);
		return $this->db->get()->result_array();
	}

	public function prev_grn_update($data, $grnid) {
		$this->db->where('serial_no', $grnid);
		return $this->db->update('grn_entry', $data);
//
		//
		//
		//        $qty = $stock['quantity'];
		//		$matid = $stock['item_code'];
		//		$this->db->set('stock', 'stock +'.$qty , FALSE);
		//		$this->db->where('material_id',$matid);
		//		$this->db->update('materials');
	}

	public function prev_grnitem_update($data, $grn_id) {
		$this->db->where('serial_no', $grn_id);
		return $this->db->update('grn_item', $data);
//
		//
		//
		//        $qty = $stock['quantity'];
		//		$matid = $stock['item_code'];
		//		$this->db->set('stock', 'stock +'.$qty , FALSE);
		//		$this->db->where('material_id',$matid);
		//		$this->db->update('materials');
	}
	public function grn_store($grnpro) {
		return $this->db->insert('grn_pro', $grnpro);
	}

	public function get_serialnumber() {
		$SQL = "SELECT * from public.get_new_stock_number();";
		$query = $this->db->query($SQL);
		$res = $query->result_array();
//    print_r($res);
		return $res;
	}

	public function get_store_project($proid) {
		$session_data = $this->session->userdata('test');
		$userid = $session_data[0]['id'];
		$this->db->select('*');
		$this->db->from('store');
		$this->db->where('project_id', $proid);
		$this->db->where('user_id', $userid);
		return $this->db->get()->result_array();
	}
	public function stock_transfer($stock) {
		return $this->db->insert('stock_transfer', $stock);
		// return $lastid= $this->db->insert_id();
	}
	public function stock_item_transfer($stock) {
		return $this->db->insert('stock_item_transfer', $stock);
	}

	public function assets_slno() {
		$SQL = "SELECT * from public.get_new_assets_number();";
		$query = $this->db->query($SQL);
		$res = $query->result_array();
//    print_r($res);
		return $res;
	}
	public function insert_movable_assets($assets) {
		return $this->db->insert('movable_assets', $assets);
	}

	public function get_movable_assets() {
		$session_data = $this->session->userdata('test');
		$userid = $session_data[0]['id'];
		$this->db->select('*');
		$this->db->from('movable_assets');

		$this->db->where('user_id', $userid);
		return $this->db->get()->result_array();
	}

	public function movable_assets_del($assetid) {
		$this->db->select('*');
		$this->db->from('movable_assets');
		$result = $this->db->where('assets_id', $assetid);
		// $result[0]['target_name'];
		$k = $this->db->get()->result_array();
		$tname = $k[0]['photo_name'];
		$path = $k[0]['path'];
		$this->db->where('assets_id', $assetid);
		unlink($path . $tname);
		return $this->db->delete('movable_assets');
	}
	public function movable_assets_edit($assetid) {
		$session_data = $this->session->userdata('test');
		$userid = $session_data[0]['id'];
		$this->db->select('*');
		$this->db->from('movable_assets');
		$this->db->where('assets_id', $assetid);
		// $this->db->where('user_id',$userid);
		return $this->db->get()->result_array();
	}

	public function movable_assets_update($data, $assetsid) {
		$this->db->select('*');
		$this->db->from('movable_assets');
		$result = $this->db->where('assets_id', $assetsid);
		// $result[0]['target_name'];
		$k = $this->db->get()->result_array();
		$tname = $k[0]['photo_name'];
		$path = $k[0]['path'];

		$this->db->where('assets_id', $assetsid);
		unlink($path . $tname);
		return $this->db->update('movable_assets', $data);
	}

	public function assets_reg($assets) {
		return $this->db->insert('assets_reg', $assets);
	}

	public function assets_sql($assetid) {

		$SQL = " select qty from movable_assets where assets_id=$assetid";

		$query = $this->db->query($SQL);

		return $res = $query->result_array();
	}

	public function assets_sql1($assetid) {
		$sql = "select coalesce(SUM(qty),0) as nos from assets_reg where assets='$assetid' group by assets";
		$query = $this->db->query($sql);

		return $res = $query->result_array();
	}
	public function asset_rowcount() {

		$this->db->select('count(asset_reg_id) as rows');
		$this->db->from('assets_reg');

		$query = $this->db->get();
		foreach ($query->result() as $r) {
			return $r->rows;
		}
	}

	public function get_assets_project($proid) {
		$session_data = $this->session->userdata('test');
		$userid = $session_data[0]['id'];
		$sql = "select distinct ma.name,a.assets from assets_reg a,movable_assets ma where ma.assets_id=a.assets and a.user_id=$userid and a.project_code=$proid";
		$query = $this->db->query($sql);

		return $res = $query->result_array();
	}

	public function get_assets_qty($from_project, $assets_id) {

		$session_data = $this->session->userdata('test');
		$userid = $session_data[0]['id'];

		$sql = "select sum(qty) from assets_reg  where user_id=$userid and project_code=$from_project and assets=$assets_id";
		$query = $this->db->query($sql);

		return $res = $query->result_array();
	}

	public function get_project_workentry($proid) {
		$SQL = "select DATE(created_at) FROM work_entry where project_id= $proid group by DATE(created_at) order by date desc";
		// $SQL="select DATE(timestamp) FROM drawings where project_id= $proid group by DATE(timestamp)";

		$query = $this->db->query($SQL);
		$res = $query->result_array();
//    $res1=$res[0]['hid'];
		return $res;
	}
	public function getdrawingcount($proid, $date) {
		$qry = "select count(*) as total from public.drawings where project_id=$proid and DATE(timestamp)='$date'";

		$query = $this->db->query($qry);
		$res = $query->result_array();
//    $res1=$res[0]['hid'];
		return $res;
	}
	public function getdocumentcount($proid, $date) {
		$qry = "select count(*) as total from public.documents where project_id=$proid and DATE(timestamp)='$date'";

		$query = $this->db->query($qry);
		$res = $query->result_array();
//    $res1=$res[0]['hid'];
		return $res;
	}

	public function total_hours($proid, $date) {
		$qry = "select sum(drawing_hours) from work_entry where project_id=$proid and DATE(created_at)='$date'";

		$query = $this->db->query($qry);
		$res = $query->result_array();
//    $res1=$res[0]['hid'];
		return $res;

	}
	public function view_allwork_entry_date($project_id, $date) {
		$this->db->select('*');
		$this->db->from('work_entry');
		$this->db->where('project_id', $project_id);
		$this->db->where('DATE(created_at)', $date);
		return $this->db->get()->result_array();
	}
	public function work_hours_detail_view($id) {
		$this->db->select('*');
		$this->db->from('work_entry');
		// $this->db->where('project_id',$project_id);
		$this->db->where('id', $id);
		return $this->db->get()->result_array();
	}

	public function view_timeline_drawings($project_id, $date) {
		$this->db->select('*');
		$this->db->from('drawings');
		$this->db->where('project_id', $project_id);
		$this->db->where('DATE(timestamp)', $date);
		return $this->db->get()->result_array();
	}

	public function view_timeline_documents($project_id, $date) {
		$this->db->select('*');
		$this->db->from('documents');
		$this->db->where('project_id', $project_id);
		$this->db->where('DATE(timestamp)', $date);
		return $this->db->get()->result_array();
	}
	public function view_timeline_photo_vault($project_id, $date) {
		$this->db->select('*');
		$this->db->from('photo_vault');
		$this->db->where('project_id', $project_id);
		$this->db->where('date', $date);
		return $this->db->get()->result_array();
	}

	public function get_photo_vault_count($proid, $date) {
		$qry = "select count(*) as total from public.photo_vault where project_id=$proid and date='$date'";

		$query = $this->db->query($qry);
		$res = $query->result_array();
//    $res1=$res[0]['hid'];
		return $res;
	}
	public function add_lead_milestone($leadmilestonearray) {
		return $this->db->insert('milestone_temp', $leadmilestonearray);
	}
	public function insert_lead_documents($destdoc) {
		return $this->db->insert('lead_document_upload', $destdoc);
	}
	public function get_lead_documents($leadid) {

		$this->db->select('*');
		$this->db->from('lead_document_upload');
		$this->db->where('lead_id', $leadid);
		// $this->db->where('date',$date);
		return $this->db->get()->result_array();
	}
	public function count_get_lead_milestone($projectid) {
//        $projectid= $milestonearray['project_id'];

		$this->db->select('count(*) as total');
		$this->db->from('milestone_temp');
		$this->db->where('lead_id', $projectid);

		return $this->db->get()->result_array();
	}

	public function get_lead_milestone($leadid) {
		$this->db->select('*');
		$this->db->from('milestone_temp');
		$this->db->where('lead_id', $leadid);
		return $this->db->get()->result_array();
	}
	public function lead_milestone_status_insert($leadmilestatus) {
		return $this->db->insert('lead_milestone_status', $leadmilestatus);
	}
	public function get_lead_milestone_status() {
		$session_data = $this->session->userdata('test');
		$userid = $session_data[0]['id'];
		$this->db->select('*');
		$this->db->from('lead_milestone_status');
		$this->db->where('user_id', $userid);
		return $this->db->get()->result_array();
	}

	public function delete_lead_milestone($lead_mile_id) {
		$this->db->where('milestone_temp_id', $lead_mile_id);
		return $this->db->delete('milestone_temp');
	}
	public function get_lead_milestone_data() {
		$session_data = $this->session->userdata('test');
		$userid = $session_data[0]['id'];
		$this->db->select('*');
		$this->db->from('milestone_temp');
		$this->db->where('user_id', $userid);
		return $this->db->get()->result_array();
	}

	public function lead_milestone_current_status($mile_id) {

		$SQL = "select public.get_lead_status_code($mile_id) as st;";

		$query = $this->db->query($SQL);
		$res = $query->result_array();
		$res1 = $res[0]['st'];
		return $res1;

	}

	public function lead_status_entry($arr) {
		return $this->db->insert('lead_mile_status_entry', $arr);
	}
	public function delete_lead_mile_status($id) {
		$this->db->where('lead_mile_status_id', $id);
		return $this->db->delete('lead_mile_status_entry');
	}

	function get_staff_milestone($staff_parent_id, $project_id) {
		$SQL = "select * from mile_stone where staff_parent_id=$staff_parent_id and project_id=$project_id";

		$query = $this->db->query($SQL);
		$res = $query->result_array();

		return $res;
	}
	function get_team_main_milestones($project_id) {
		$SQL = "select * from mile_stone where staff_parent_id=0 and project_id=$project_id order by milestone_id DESC";

		$query = $this->db->query($SQL);
		$res1 = $query->result_array();

		return $res1;
	}
	function get_team_main_milestones_data($project_id) {
		$session_data = $this->session->userdata('test1');
		$staff_id = $session_data[0]['staff_code'];
		$SQL = "select * from mile_stone where  project_id=$project_id and staff_id=$staff_id";

		$query = $this->db->query($SQL);
		$res1 = $query->result_array();

		return $res1;
	}
	public function mom_member_delete($delt) {
		$this->db->where('member_present_id', $delt);
		return $this->db->delete('mom_member_present');
	}
	public function mom_discussion_delete($delt) {
		$this->db->where('mom_discussion_id', $delt);
		return $this->db->delete('mom_discussions');

	}
	public function get_last_mom_no() {
		$SQL = "SELECT * from get_new_mom_number();";
		$query = $this->db->query($SQL);
		$res = $query->result_array();

		return $res;

	}

	public function get_project_mom_no($project_id) {

		$this->db->select('max(mom_no)');
		$this->db->from('mom_master');
		$this->db->where('project_id', $project_id);
		return $this->db->get()->result_array();
		// $SQL="select max(mom_no) from mom_master where project_id=$project_id;";
		// $query = $this->db->query($SQL);
		// $res=$query->result_array();

		// return $res;

	}

	public function insert_mom_master($mom_array) {
		return $this->db->insert('mom_master', $mom_array);
	}
	public function add_mom_member($mom_member_array) {
		return $this->db->insert('mom_member_present', $mom_member_array);
	}
	public function add_mom_discussions($mom_discussions_array) {
		return $this->db->insert('mom_discussions', $mom_discussions_array);
	}
	public function mom_master_details() {
		$session_data = $this->session->userdata('test');
		$userid = $session_data[0]['id'];
		$this->db->select('*');
		$this->db->from('mom_master');
		$this->db->where('user_id', $userid);

		return $this->db->get()->result_array();
	}

	public function get_mom_data($mom_id) {
		$session_data = $this->session->userdata('test');
		$userid = $session_data[0]['id'];
		$this->db->select('*');
		$this->db->from('mom_master');
		$this->db->where('user_id', $userid);
		$this->db->where('mom_id', $mom_id);

		return $this->db->get()->result_array();
		//      $SQL=" select * from mom_master m, mom_member_present p,mom_discussions d   where m.mom_id = p.mom_id and m.mom_id=d.mom_id and m.mom_id=$mom_id";

		// $query = $this->db->query($SQL);
		// $res1=$query->result_array();

		// return $res1;

	}

	public function get_mom_member($mom_id) {
		$session_data = $this->session->userdata('test');
		$userid = $session_data[0]['id'];
		$this->db->select('*');
		$this->db->from('mom_member_present');
		// $this->db->where('user_id',$userid);
		$this->db->where('mom_id', $mom_id);

		return $this->db->get()->result_array();
		//      $SQL=" select * from mom_master m, mom_member_present p,mom_discussions d   where m.mom_id = p.mom_id and m.mom_id=d.mom_id and m.mom_id=$mom_id";

		// $query = $this->db->query($SQL);
		// $res1=$query->result_array();

		// return $res1;

	}

	public function getall_mom_member_items($mom_id) {
		$session_data = $this->session->userdata('test');
		$userid = $session_data[0]['id'];
		$this->db->select('*');
		$this->db->from('mom_member_present');
		// $this->db->where('user_id',$userid);
		$this->db->where('member_present_id', $mom_id);

		return $this->db->get()->result_array();

	}

	public function update_mom_member($data, $mom_id) {

		$this->db->where('member_present_id', $mom_id);
		return $this->db->update('mom_member_present', $data);

	}
	public function getall_mom_discussion_items($mom_id) {
		$session_data = $this->session->userdata('test');
		$userid = $session_data[0]['id'];
		$this->db->select('*');
		$this->db->from('mom_discussions');
		// $this->db->where('user_id',$userid);
		$this->db->where('mom_discussion_id', $mom_id);

		return $this->db->get()->result_array();

	}
	public function update_mom_discussion($data, $mom_discussion_id) {

		$this->db->where('mom_discussion_id', $mom_discussion_id);
		return $this->db->update('mom_discussions', $data);

	}

	public function get_mom_discussions($mom_id) {
		$session_data = $this->session->userdata('test');
		$userid = $session_data[0]['id'];
		$this->db->select('*');
		$this->db->from('mom_discussions');
		// $this->db->where('user_id',$userid);
		$this->db->where('mom_id', $mom_id);

		return $this->db->get()->result_array();
		//      $SQL=" select * from mom_master m, mom_member_present p,mom_discussions d   where m.mom_id = p.mom_id and m.mom_id=d.mom_id and m.mom_id=$mom_id";

		// $query = $this->db->query($SQL);
		// $res1=$query->result_array();

		// return $res1;

	}

	public function delete_mom_master($delt) {
		$this->db->where('mom_id', $delt);
		return $this->db->delete('mom_master');
	}
	public function delete_member_present($delt) {
		$this->db->where('mom_id', $delt);
		return $this->db->delete('mom_member_present');
	}
	public function delete_mom_discussions($delt) {
		$this->db->where('mom_id', $delt);
		return $this->db->delete('mom_discussions');
	}
	public function update_mom($data, $mom_id) {
		$this->db->where('mom_id', $mom_id);
		return $this->db->update('mom_master', $data);
	}

	public function get_staffs_site_report() {
		$session_data = $this->session->userdata('test1');
		$staff_id = $session_data[0]['staff_code'];

		$sql = "select * from staff EXCEPT(select * from staff where staff_code=$staff_id);";
		$query = $this->db->query($sql);

		$res = $query->result_array();

		return $res;

	}

	public function get_site_supervisor($projectid) {

		$session_data = $this->session->userdata('test1');
		$staff_id = $session_data[0]['staff_code'];
		$this->db->select('*');
		$this->db->from('staff_project_map');
		$this->db->where('project_id', $projectid);
		$this->db->where('staff_id', $staff_id);

		return $this->db->get()->result_array();
	}

	public function get_client_under_project($project_id) {
		$this->db->select('*');
		$this->db->from('clients');
		$this->db->where('project_id', $project_id);
		return $this->db->get()->result_array();
	}
	public function add_weekly_site_report($add_weekly_site_report) {
		return $this->db->insert('weekly_site_report', $add_weekly_site_report);
	}
// public function view_weekly_report($project_id)
	// {
	// $session_data = $this->session->userdata('test1');
	//           $staff_id=$session_data[0]['staff_code'];
	//  $this->db->select('*');
	//         $this->db->from('weekly_site_report');
	//         $this->db->where('project_id',$project_id) ;
	//         return $this->db->get()->result_array();
	// }
	public function view_weekly_report() {
		$session_data = $this->session->userdata('test1');
		$staff_id = $session_data[0]['staff_code'];
		$this->db->select('*');
		$this->db->from('weekly_site_report');
		//$this->db->where('project_id',$project_id) ;
		return $this->db->get()->result_array();
	}
	public function view_staff_weekly_report() {
		$session_data = $this->session->userdata('test1');
		$staff_id = $session_data[0]['staff_code'];
		$this->db->select('*');
		$this->db->from('weekly_site_report');
		$this->db->where('staff_id', $staff_id);
		return $this->db->get()->result_array();
	}
	public function update_weekly_report($reportArray, $weekly_site_id) {

		$this->db->where('weekly_site_id', $weekly_site_id);
		return $this->db->update('weekly_site_report', $reportArray);
	}
	public function get_client_name($clientid) {
		$this->db->select('*');
		$this->db->from('clients');
		$this->db->where('client_id', $clientid);
		return $this->db->get()->result_array();
	}
	public function delete_weekly_report($weekly_site_id) {
		$this->db->where('weekly_site_id', $weekly_site_id);
		return $this->db->delete('weekly_site_report');
	}
	public function get_weekly_report_under_id($weekly_site_id) {
		$this->db->select('*');
		$this->db->from('weekly_site_report');
		$this->db->where('weekly_site_id', $weekly_site_id);
		return $this->db->get()->result_array();
	}
	public function add_project_type($project_type_array) {
		return $this->db->insert('project_type', $project_type_array);
	}
	public function get_all_project_type() {
		$session_data = $this->session->userdata('test');
		$user_id = $session_data[0]['id'];
		$this->db->select('*');
		$this->db->from('project_type');
		$this->db->where('user_id', $user_id);
		return $this->db->get()->result_array();
	}

	public function delete_project_type($project_type_code) {
		$this->db->where('project_type_code', $project_type_code);
		return $this->db->delete('project_type');
	}
	public function get_project_type_id_details($project_type_code) {
		$session_data = $this->session->userdata('test');
		$user_id = $session_data[0]['id'];
		$this->db->select('*');
		$this->db->from('project_type');
		$this->db->where('user_id', $user_id);
		$this->db->where('project_type_code', $project_type_code);
		return $this->db->get()->result_array();
	}

	public function update_project_type($project_type_array, $project_type_code) {
		$this->db->where('project_type_code', $project_type_code);
		return $this->db->update('project_type', $project_type_array);
	}

	public function add_project_stages($project_stage_array) {
		return $this->db->insert('project_stages', $project_stage_array);
	}
	public function get_all_project_stages($project_type_code) {
		$session_data = $this->session->userdata('test');
		$user_id = $session_data[0]['id'];
		$this->db->select('*');
		$this->db->from('project_stages');
		$this->db->where('user_id', $user_id);
		$this->db->where('project_type_code', $project_type_code);
		return $this->db->get()->result_array();
	}
	public function delete_project_stage($stage_id) {
		$this->db->where('stage_id', $stage_id);
		return $this->db->delete('project_stages');
	}
	public function get_project_stage_id_details($stage_id) {
		$session_data = $this->session->userdata('test');
		$user_id = $session_data[0]['id'];
		$this->db->select('*');
		$this->db->from('project_stages');
		$this->db->where('user_id', $user_id);
		$this->db->where('stage_id', $stage_id);
		return $this->db->get()->result_array();
	}
	public function get_project_stage_depend_project_type($project_type_id) {
		$session_data = $this->session->userdata('test');
		$user_id = $session_data[0]['id'];
		$this->db->select('*');
		$this->db->from('project_stages');
		$this->db->where('user_id', $user_id);
		$this->db->where('project_type_code', $project_type_id);
		return $this->db->get()->result_array();
	}

	public function get_project_stage_depend_ptid($project_type_id) {

		$this->db->select('*');
		$this->db->from('project_stages');

		$this->db->where('project_type_code', $project_type_id);
		return $this->db->get()->result_array();
	}
	public function update_project_stage($project_stage_array, $stage_id) {
		$this->db->where('stage_id', $stage_id);
		return $this->db->update('project_stages', $project_stage_array);
	}

	public function add_project_drawings($project_drawing_array) {
		return $this->db->insert('project_drawings', $project_drawing_array);
	}

	public function get_all_project_drawings($stage_id, $project_type_code) {
		$session_data = $this->session->userdata('test');
		$user_id = $session_data[0]['id'];
		$this->db->select('*');
		$this->db->from('project_drawings');
		$this->db->where('user_id', $user_id);
		$this->db->where('stage_id', $stage_id);
		$this->db->where('project_type_code', $project_type_code);
		return $this->db->get()->result_array();
	}

	public function get_project_type_name($project_type_code) {
		$this->db->select('*');
		$this->db->from('project_type');
		$this->db->where('project_type_code', $project_type_code);
		return $this->db->get()->result_array();
	}

	public function get_project_stage($stage_id) {
		$this->db->select('*');
		$this->db->from('project_stages');
		$this->db->where('stage_id', $stage_id);
		return $this->db->get()->result_array();
	}
	public function delete_project_drawings($project_drawing_id) {
		$this->db->where('project_drawing_id', $project_drawing_id);
		return $this->db->delete('project_drawings');
	}

	public function get_project_drawing_id_details($drawing_id) {
		$session_data = $this->session->userdata('test');
		$user_id = $session_data[0]['id'];
		$this->db->select('*');
		$this->db->from('project_drawings');
		$this->db->where('user_id', $user_id);
		$this->db->where('project_drawing_id', $drawing_id);
		return $this->db->get()->result_array();
	}

	public function update_project_drawing($drawingarray, $drawing_id) {
		$this->db->where('project_drawing_id', $drawing_id);
		return $this->db->update('project_drawings', $drawingarray);
	}

	public function add_project_sub_drawings($drawingarray) {
		return $this->db->insert('project_sub_drawing', $drawingarray);
	}

	public function get_all_project_sub_drawings($drawing_id, $stage_id, $project_type_code1) {
		$session_data = $this->session->userdata('test');
		$user_id = $session_data[0]['id'];
		$this->db->select('*');
		$this->db->from('project_sub_drawing');
		$this->db->where('user_id', $user_id);
		$this->db->where('project_stage_id', $stage_id);
		$this->db->where('project_drawing_id', $drawing_id);
		$this->db->where('project_type_id', $project_type_code1);
		return $this->db->get()->result_array();
	}

	public function project_drawing_name($project_drawing_id) {
		$this->db->select('*');
		$this->db->from('project_drawings');
		$this->db->where('project_drawing_id', $project_drawing_id);

		return $this->db->get()->result_array();
	}
	public function delete_project_sub_drawings($sub_drawing_id) {
		$this->db->where('sub_drawing_id', $sub_drawing_id);
		return $this->db->delete('project_sub_drawing');
	}
	public function get_project_sub_drawings_details($subdrawing_id) {
		$this->db->select('*');
		$this->db->from('project_sub_drawing');
		$this->db->where('sub_drawing_id', $subdrawing_id);

		return $this->db->get()->result_array();
	}
	public function update_sub_drawing($drawingarray, $drawing_id) {
		$this->db->where('sub_drawing_id', $drawing_id);
		return $this->db->update('project_sub_drawing', $drawingarray);
	}
	public function add_project_meeting($meetingarray) {
		return $this->db->insert('project_meeting', $meetingarray);
	}

	public function get_pro_meeting_depend_stage_id($stage_id, $project_type_id) {
		$this->db->select('*');
		$this->db->from('project_meeting');
		$this->db->where('stage_id', $stage_id);
		$this->db->where('project_type_id', $project_type_id);
		$this->db->order_by('meeting_id', 'asc');

		return $this->db->get()->result_array();
	}

	public function project_meeting_name($meeting_id) {
		$this->db->select('*');
		$this->db->from('project_meeting');
		$this->db->where('meeting_id', $meeting_id);
		return $this->db->get()->result_array();
	}
	public function delete_project_meetings($meeting_id) {
		$this->db->where('meeting_id', $meeting_id);
		return $this->db->delete('project_meeting');
	}

	public function get_pro_draw_depend_stage_id($stage_id, $project_type_id) {
		$this->db->select('*');
		$this->db->from('project_drawings');
		$this->db->where('stage_id', $stage_id);
		$this->db->where('project_type_code', $project_type_id);

		return $this->db->get()->result_array();
	}

	public function get_pro_sub_draw_depend_drawing_id($drawing_id, $stage_id, $project_type_id, $sub_stage_id) {
		$this->db->select('*');
		$this->db->from('project_sub_drawing');
		$this->db->where('project_drawing_id', $drawing_id);
		$this->db->where('project_stage_id', $stage_id);
		$this->db->where('project_type_id', $project_type_id);
		$this->db->where('project_sub_stage', $sub_stage_id);

		return $this->db->get()->result_array();
	}

	public function get_project_meeting_id_details($meeting_id) {
		$this->db->select('*');
		$this->db->from('project_meeting');
		$this->db->where('meeting_id', $meeting_id);

		return $this->db->get()->result_array();
	}

	public function update_project_meeting($project_meeting_Array, $meeting_id) {
		$this->db->where('meeting_id', $meeting_id);
		return $this->db->update('project_meeting', $project_meeting_Array);
	}

	public function insert_expense_heads($expenseearray) {
		return $this->db->insert('expense_heads', $expenseearray);
	}
	public function gt_all_expens_heads() {
		$session_data = $this->session->userdata('test');
		$userid = $session_data[0]['id'];
		$this->db->select('*');
		$this->db->from('expense_heads');
		$this->db->order_by('head_id', 'ASC');
		$this->db->where('user_id', $userid);
		return $this->db->get()->result_array();
	}
	public function delete_expense($head_id) {
		$this->db->where('head_id', $head_id);
		return $this->db->delete('expense_heads');
	}

	public function update_expense_head($expenseArray, $head_id) {
		$this->db->where('head_id', $head_id);
		return $this->db->update('expense_heads', $expenseArray);
	}

	public function get_all_expense_entry() {
		$session_data = $this->session->userdata('test');
		$userid = $session_data[0]['id'];
		$this->db->select('*');
		$this->db->from('expense_entry');
		$this->db->order_by('expense_entry_id', 'ASC');
		$this->db->where('user_id', $userid);
		return $this->db->get()->result_array();
	}
	public function delete_expense_entry($expense_entry_id) {
		$this->db->where('expense_entry_id', $expense_entry_id);
		return $this->db->delete('expense_entry');
	}
	public function get_expense_heads_in_expense_entry($head_id) {
		$this->db->select('*');
		$this->db->from('expense_entry');
		$this->db->where('head_id', $head_id);
		return $this->db->get()->result_array();
	}
	public function edit_expense_entry($expense_entry_id) {
		$this->db->select('*');
		$this->db->from('expense_entry');
		$this->db->where('expense_entry_id', $expense_entry_id);
		return $this->db->get()->result_array();
	}

	public function update_expense_entry($expenseArray, $expense_entry_id) {
		$this->db->where('expense_entry_id', $expense_entry_id);
		return $this->db->update('expense_entry', $expenseArray);
	}
	public function add_settings($expensearray) {
		return $this->db->insert('ta_expense', $expensearray);
	}
	public function get_all_settings() {
		$session_data = $this->session->userdata('test');
		$userid = $session_data[0]['id'];
		$this->db->select('*');
		$this->db->from('settings');
		$this->db->order_by('setting_id', 'ASC');
		$this->db->where('user_id', $userid);
		return $this->db->get()->result_array();
	}
	public function delete_setting($setting_id) {
		$this->db->where('setting_id', $setting_id);
		return $this->db->delete('settings');
	}
	public function settings_edit($setting_id) {

		$SQL = "select * from settings s, expense_heads e where s.ta_head = e.head_id and s.setting_id=$setting_id";
		$query = $this->db->query($SQL);
		$res = $query->result_array();
//    print_r($res);
		return $res;
	}

	public function get_heads_except_id($head_id) {
		// $session_data = $this->session->userdata('test1');
		//   $staff_id=$session_data[0]['staff_code'];
		$session_data = $this->session->userdata('test');
		$userid = $session_data[0]['id'];

		$sql = "select * from expense_heads EXCEPT(select * from expense_heads where head_id=$head_id and user_id=$userid);";
		$query = $this->db->query($sql);

		$res = $query->result_array();

		return $res;

	}
// public function setting_update($settingarray,$setting_id)
	// {
	//   $this->db->where('setting_id', $setting_id);
	//   return  $this->db->update('settings',$settingarray);
	// }

	public function get_ta_expense() {
		$this->db->select('*');
		$this->db->from('ta_expense');

		return $this->db->get()->result_array();
	}
	public function get_ta_expense_head_details($ta_expense_id) {
		$this->db->select('*');
		$this->db->from('ta_expense');
		$this->db->where('ta_expense_id', $ta_expense_id);

		return $this->db->get()->result_array();
	}
	public function get_all_draw_for_transmittal($stage_id, $project_type_id, $drawing_id, $projectid) {
		$this->db->select('*');
		$this->db->from('drawings');
		$this->db->where('project_id', $projectid);
		$this->db->where('project_type_id', $project_type_id);
		$this->db->where('project_stage_id', $stage_id);
		$this->db->where('project_drawing_id', $drawing_id);

		return $this->db->get()->result_array();
	}

	public function get_drawing_depend_sub_draing($stage_id, $project_type_id, $drawing_id, $projectid, $sub_drawing_id) {
		$this->db->select('*');
		$this->db->from('drawings');
		$this->db->where('project_id', $projectid);
		$this->db->where('project_type_id', $project_type_id);
		$this->db->where('project_stage_id', $stage_id);
		$this->db->where('project_drawing_id', $drawing_id);
		$this->db->where('project_sub_drawing_id', $sub_drawing_id);

		return $this->db->get()->result_array();
	}

	public function get_transmital_serial_no() {
		$SQL = "SELECT * from public.get_new_trasmital_number();";
		$query = $this->db->query($SQL);
		$res = $query->result_array();
//    print_r($res);
		return $res;
	}
	public function add_transmital_master($transarray) {
		return $this->db->insert('transmital_master', $transarray);
	}

	public function add_transmital_item($transitemarray) {
		return $this->db->insert('transmittal_items', $transitemarray);
	}
	public function get_last_transmital_data() {
		$SQL = " SELECT * FROM transmital_master ORDER BY trans_master_id DESC LIMIT 1";
		$query = $this->db->query($SQL);
		$res = $query->result_array();
		return $res;

	}
	public function get_trasmital_item_data_master_id($trans_master_id) {
		$this->db->select('*');
		$this->db->from('transmittal_items');
		$this->db->where('trans_master_id', $trans_master_id);
		return $this->db->get()->result_array();
	}
	public function get_all_transmital_master($project_id) {
		$session_data = $this->session->userdata('test');
		$userid = $session_data[0]['id'];
		$this->db->select('*');
		$this->db->from('transmital_master');
		$this->db->where('project_id', $project_id);
		$this->db->where('user_id', $userid);
		$this->db->order_by('date', 'DESC');
		return $this->db->get()->result_array();
	}
	public function delete_transmital_master($trans_id) {
		$this->db->where('trans_master_id', $trans_id);
		return $this->db->delete('transmital_master');
	}
	public function delete_transmital_item($trans_id) {
		$this->db->where('trans_master_id', $trans_id);
		return $this->db->delete('transmittal_items');
	}
	public function get_all_transmital_data($trans_master_id) {
		$this->db->select('*');
		$this->db->from('transmital_master');
		// $this->db->join('transmittal_items', 'transmital_master.trans_master_id = transmittal_items.trans_master_id');
		$this->db->where('trans_master_id', $trans_master_id);
		return $this->db->get()->result_array();
	}
	public function get_staff_in_transmital($staff_id) {
		$SQL = "select * from staff s where  staff_code not in(select staff_id from transmital_master where staff_id=$staff_id)";
		$query = $this->db->query($SQL);
		$res = $query->result_array();
//    print_r($res);
		return $res;
	}
	public function update_transmital_master($transmasterarray, $transmaster_id) {
		$this->db->where('trans_master_id', $transmaster_id);
		return $this->db->update('transmital_master', $transmasterarray);
	}

	public function update_transmital_item($transmasterarray, $transitem_id) {
		$this->db->where('trans_item_id', $transitem_id);
		return $this->db->update('transmittal_items', $transmasterarray);
	}
	public function delete_lead_milestone_status($mile_id) {
		$this->db->where('lead_mile_status_id', $mile_id);
		return $this->db->delete('lead_milestone_status');

	}
	public function lead_milestone_status_sel($lead_milestone_status_sel) {
		$session_data = $this->session->userdata('test');
		$userid = $session_data[0]['id'];
		$this->db->select('*');
		$this->db->from('lead_milestone_status');
		$this->db->where('lead_mile_status_id', $lead_milestone_status_sel);
		return $this->db->get()->result_array();
	}

	// public function get_count_of_main_projects()
	// {

	// }
	// public function get_client_name()

// sonima functions starts here
	// public function group_estimate($estimate)
	//     {
	//             $this->db->select('*');
	//             $this->db->from('estimate_items');
	//               $this->db->where("(estimate_id=$estimate OR parent_id=$estimate)", NULL, FALSE) ;

	//     return $this->db->get()->result_array();
	//     }
	public function group_estimate($estimate) {
		$this->db->select('*');
		$this->db->from('estimate_items');
		$this->db->where('estimate_id', $estimate);

		return $this->db->get()->result_array();
	}
	public function group_estimate1($estimate) {
		$this->db->select('*');
		$this->db->from('estimate_items');
		$this->db->where('parent_id', $estimate);

		return $this->db->get()->result_array();
	}
	public function add_assign_staff($staff_assign) {
		return $this->db->insert('team_lead', $staff_assign);

	}
	public function get_mainteam_staff() {
		$this->db->select('*');
		$this->db->from('team_lead');
		$this->db->join('staff', 'team_lead.staff_id = staff.staff_code');
		$this->db->where('team_lead.level', 0);
		return $this->db->get()->result_array();
	}
	public function specfi_details($staff_id) {
		$this->db->select('*');
		$this->db->from('team_lead');
		$this->db->where('staff_id', $staff_id);
		return $this->db->get()->result_array();

	}
	public function get_maincode() {
		$SQL = "SELECT * from public.get_new_head_id('');";
		$query = $this->db->query($SQL);
		$res = $query->result_array();
//    print_r($res);
		return $res;
	}

	public function get_mainteam($staff_id) {
		$this->db->select('team_lead.*,staff.staff_name');
		$this->db->from('team_lead');
		$this->db->join('staff', 'team_lead.staff_id = staff.staff_code');
		// $this->db->where('team_lead.level',0);
		$this->db->where('team_lead.staff_id', $staff_id);
		return $this->db->get()->result_array();
	}
	public function get_substaff() {
		// echo "hh";
		$sql = "select staff_code,staff_name from staff where staff_code not in(select staff_id from team_lead where root='TRUE' OR parent_id='')";
		$query = $this->db->query($sql);

		$res = $query->result_array();

		return $res;

	}
	public function get_subcode($codid) {
		$SQL = "SELECT * from public.get_new_head_id('$codid');";
		$query = $this->db->query($SQL);
		$res = $query->result_array();
//    print_r($res);
		return $res;
	}
	public function get_sublist($sub) {
		$this->db->select('team_lead.*,staff.staff_name');
		$this->db->from('team_lead');
		$this->db->join('staff', 'team_lead.staff_id = staff.staff_code');
		// $this->db->where('team_lead.level',1);
		$this->db->where('team_lead.parent_id', $sub);
		// $this->db->where('team_lead.grp','TRUE');
		// $this->db->where('team_lead.parent_id!=""');
		return $this->db->get()->result_array();
	}

///

	public function details() {
//    $session_data = $this->session->userdata('test');
		//        $qry="select count(*) as total from public.project where user_id=$userid";
		//        $userid=$session_data[0]['id'];
		//     $this->db->select('*');
		//  $this->db->from('team_lead');
		// $this->db->where('parent_id',);
		// $this->db->where('group','');
		// return $this->db->get()->result_array();
		$sql = "select * from team_lead where grp='TRUE' AND parent_id!= ''";
		$query = $this->db->query($sql);

		$res = $query->result_array();

		return $res;
	}

	public function updatehead($data, $team) {
		$this->db->where('team_code', $team);
		return $this->db->update('team_lead', $data);
	}

	public function get_subproject_userid($projectid) {
		$session_data = $this->session->userdata('test');
//        $qry="select count(*) as total from public.project where user_id=$userid";
		$userid = $session_data[0]['id'];
		$this->db->select('*');
		$this->db->from('project');
		$this->db->where('user_id', $userid);
		$this->db->where('is_child', true);
		$this->db->where('parent_id', $projectid);
		return $this->db->get()->result_array();
	}

	public function get_mainstaff($staff_id) {
		// echo $staff_id;
		$sql = "select staff_code,staff_name from staff where staff_code not in(select staff_id from team_lead where staff_id!= '$staff_id') ";
		// $sql="select staff_code,staff_name from staff where staff_code not in(select staff_id from team_lead)";
		$query = $this->db->query($sql);

		$res = $query->result_array();

		return $res;

	}

	public function getsub($staff_id) {
		// echo $staff_id;
		$sql = "select * from team_lead t, staff s where t.staff_id=s.staff_code and t.parent_id='$staff_id'";
		// $sql="select staff_code,staff_name from staff where staff_code not in(select staff_id from team_lead)";
		$query = $this->db->query($sql);

		$res = $query->result_array();

		return $res;

	}
	public function getmemebers_details() {
		// echo $staff_id;
		// $sql="select * from team_lead t, staff s where t.staff_id=s.staff_code and s.staff_code not in(select staff_id from team_lead)";
		$sql = "select * from staff s where  staff_code not in(select staff_id from team_lead)";
		$query = $this->db->query($sql);

		$res = $query->result_array();

		return $res;

	}

	public function getmember($id_) {
		$this->db->select('*');
		$this->db->from('team_lead');
		$this->db->where('parent_id', $id_);
		return $this->db->get()->result_array();
	}
	public function getdetailsteam($id_) {
		$this->db->select('*');
		$this->db->from('team_lead');
		$this->db->where('team_lead_id', $id_);
		return $this->db->get()->result_array();
	}
	public function parent_in_project($sid) {
		$sql = "select count(*) as total from staff_project_map where staff_id=(select staff_id from team_lead where team_code='$sid')";
		$query = $this->db->query($sql);

		$res = $query->result_array();

		return $res;
	}
	public function member_delete($delt) {
		//echo $templateitcode;
		//    echo "zdxfcgvhbjnk";
		$this->db->where('team_lead_id', $delt);
		return $this->db->delete('team_lead');
	}
	public function getsublist($staff_id) {
		// echo $staff_id;
		$sql = "select * from team_lead t, staff s where t.staff_id=s.staff_code and t.parent_id='$staff_id'";
		// $sql="select staff_code,staff_name from staff where staff_code not in(select staff_id from team_lead)";
		$query = $this->db->query($sql);

		$res = $query->result_array();

		return $res;

	}
	public function get_member_under($headtsff, $id, $projectid) {
		$sql = "select team_code from team_lead where staff_id='$headtsff'";

		$query = $this->db->query($sql);

		$res = $query->result_array();
		// print_r($res);
		$teamcode = $res[0]['team_code'];
		$sql1 = "select staff_id from team_lead where parent_id='$teamcode'";

		$query1 = $this->db->query($sql1);

		$res1 = $query1->result_array();
		//print_r($res1);
		for ($i = 0; $i < count($res1); $i++) {
			echo $staff = $res1[$i]['staff_id'];
			$this->get_member_under($staff, $id, $projectid);
			$staff_project_map_Array = array('user_id' => $id,
				'staff_id' => $staff,
				'project_id' => $projectid,
				'enabled' => TRUE,
			);
			$this->db->insert('staff_project_map', $staff_project_map_Array);

		}

		// return $res;

	}
	public function delete_assign_staff($delt) {
		$this->db->where('staff_id', $delt);
		return $this->db->delete('staff_project_map');

	}
	public function get_count_assign($ptid) {
		$this->db->select('staff_id');
		$this->db->from('team_lead');
		$this->db->where('parent_id', $ptid);
		return $this->db->get()->result_array();

	}
//     public function check_assign_staff($st_id)
	//   {
	//         $sql="select * from staff_project_map where staff_id='$st_id'";
	//         $query = $this->db->query($sql);

//         $res=$query->result_array();
	//       return $res;

// }
	public function reassign_staff($st_id) {
		$sql = "select * from staff_project_map where staff_id=(select staff_id from team_lead where team_code=(select parent_id from team_lead where staff_id='$st_id'))";
		$query = $this->db->query($sql);

		$res = $query->result_array();
		return $res;

	}

	public function insert_submap($staff_project_map_Array) {
		return $this->db->insert('staff_project_map', $staff_project_map_Array);
	}

	public function checklistinsert($chklst_Array) {
		return $this->db->insert('checklist', $chklst_Array);
	}
// public function list_details_ets()
	// {
	// $sql="SELECT *   FROM estimate_values v,estimate_items i,estimate_cost c where c.estimate_id=i.estimate_id and c.estimate=v.estimate and i.parent_id IS NULL   order by c.estimate_id DESC";
	// $query = $this->db->query($sql);

// $res=$query->result_array();
	// return $res;
	// }
	//    public function subestimatelist($parent)
	// {
	// $sql="SELECT *   FROM estimate_values v,estimate_items i,estimate_cost c where c.estimate_id=i.estimate_id and c.estimate=v.estimate and i.parent_id=$parent   order by c.estimate_id DESC";
	// $query = $this->db->query($sql);

// $res=$query->result_array();
	// return $res;
	// }
	public function get_estimate_values($pid) {
		$this->db->select('*');
		$this->db->from('estimate_values');
		$this->db->where('estimate', $pid);
		return $this->db->get()->result_array();
	}
	public function get_estimatepvalues($pid) {
		$this->db->select('*');
		$this->db->from('estimate_values');
		$this->db->join('project', 'project.project_id = estimate_values.project_id');
		$this->db->where('estimate_values.estimate', $pid);
		return $this->db->get()->result_array();
	}
	public function view_estimate_cost($parent) {
		$sql = "SELECT *   FROM estimate_items i,estimate_cost c where c.estimate_id=i.estimate_id and c.estimate=$parent";
		$query = $this->db->query($sql);

		$res = $query->result_array();
		return $res;
	}

	public function subestimatelist($parent, $estimte) {
		$sql = "SELECT *   FROM estimate_values v,estimate_items i,estimate_cost c where c.estimate_id=i.estimate_id and c.estimate=v.estimate and i.parent_id=$parent and c.estimate=$estimte   order by c.estimate_id DESC";
		$query = $this->db->query($sql);

		$res = $query->result_array();
		return $res;
	}
	public function check_list_details() {
		$session_data = $this->session->userdata('test1');
		$staff_id = $session_data[0]['staff_code'];
		$this->db->select('*');
		$this->db->from('checklist');
		$this->db->join('mile_stone', 'checklist.milestone_id = mile_stone.milestone_id');
		$this->db->where('mile_stone.staff_id', $staff_id);
		return $this->db->get()->result_array();
	}
	public function list_details_ets() {
		$sql = "SELECT *   FROM estimate_values v,estimate_items i,estimate_cost c where c.estimate_id=i.estimate_id and c.estimate=v.estimate and i.parent_id IS NULL   order by c.estimate_id DESC";

		$query = $this->db->query($sql);

		$res = $query->result_array();
		return $res;
	}

	public function updatelist($data, $id) {
		$this->db->where('check_id', $id);
		return $this->db->update('checklist', $data);
	}
	public function checkedetails() {
		$session_data = $this->session->userdata('test1');
		$staff_id = $session_data[0]['staff_code'];
		$this->db->select('*');
		$this->db->from('checklist');
		$this->db->join('mile_stone', 'checklist.milestone_id = mile_stone.milestone_id');
		$this->db->where('mile_stone.staff_id', $staff_id);
		$this->db->where('checklist.checked', TRUE);
		return $this->db->get()->result_array();
	}
	public function delete_checklist($milestoneid) {
		$this->db->where('milestone_id', $milestoneid);
		return $this->db->delete('checklist');
	}
	public function list_details($mid) {
		$session_data = $this->session->userdata('test1');
		$staff_id = $session_data[0]['staff_code'];
		$this->db->select('*');
		$this->db->from('checklist');
		$this->db->join('mile_stone', 'checklist.milestone_id = mile_stone.milestone_id');
		$this->db->where('mile_stone.staff_parent_id', $staff_id);
		$this->db->where('mile_stone.milestone_id', $mid);
		return $this->db->get()->result_array();
	}

	public function checkde($id) {
		$this->db->select('*');
		$this->db->from('checklist');
		$this->db->where('milestone_id', $id);
		return $this->db->get()->result_array();

	}
	public function insert_dairy_type($typeentryArray) {
		return $this->db->insert('project_dairy_type', $typeentryArray);
	}
// 13.04.2018

	public function get_dairy_types() {
		$this->db->select('*');
		$this->db->from('project_dairy_type');
		return $this->db->get()->result_array();
	}

	public function insert_dairyentry($dairyentryArray) {
		return $this->db->insert('add_dairy', $dairyentryArray);
	}

	public function dairy_details($get_id) {
		$this->db->select('*');
		$this->db->from('add_dairy');
		$this->db->join('project_dairy_type', 'add_dairy.type_id = project_dairy_type.dairy_type_id');
		$this->db->join('staff', 'add_dairy.staff_id = staff.staff_code');
		$this->db->where('add_dairy.project_id', $get_id);
		$this->db->order_by('add_dairy.dairy_id', 'DESC');
		$this->db->limit(1);
		return $this->db->get()->result_array();
	}
	public function get_dairy_details($did) {
		$this->db->select('*');
		$this->db->from('add_dairy');
		$this->db->where('dairy_id', $did);
		return $this->db->get()->result_array();

	}

	public function dairy_update($dairyArray, $did) {
		$this->db->where('dairy_id', $did);
		return $this->db->update('add_dairy', $dairyArray);
	}

// 14.04.2018
	public function team_deldetails($tem) {
		$this->db->select('count(*) as total');
		$this->db->from('team_lead');
		$this->db->where('parent_id', $tem);
		return $this->db->get()->result_array();
	}

//       public function check_assign_staff($staff)
	//   {
	//                 $sql="select * from staff_project_map where staff_id='$staff'";
	//               $query = $this->db->query($sql);

//               $res=$query->result_array();
	//           return $res;

// }
	public function check_assign_staff($p_code) {
		$sql = "select * from staff s, staff_project_map p, team_lead t where s.staff_code= p.staff_id and t.staff_id= s.staff_code and t.team_code='$p_code'";
		$query = $this->db->query($sql);

		$res = $query->result_array();
		return $res;

	}
	public function type_details() {
		$this->db->select('*');
		$this->db->from('project_dairy_type');
		return $this->db->get()->result_array();

	}
	function get_milestones_staff($idpr) {
		$session_data = $this->session->userdata('test1');
		$staff_id = $session_data[0]['staff_code'];
		$SQL = "select * from mile_stone where project_id=$idpr and staff_id=$staff_id";

		$query = $this->db->query($SQL);
		$res1 = $query->result_array();

		return $res1;
	}
	public function get_dairytype_details($edid) {
		$this->db->select('*');
		$this->db->from('project_dairy_type');
		$this->db->where('dairy_type_id', $edid);
		return $this->db->get()->result_array();

	}
	public function update_dairytype() {
		$dryid = $_REQUEST['pro_id'];
		$dairytypeupdate_array = array('note' => $_POST['note11'],
			'color' => $_POST['color11'],
		);

		$result = $this->Mainmodel->dairytype_update($dairytypeupdate_array, $dryid);
		$this->load->view('project_dairy_type');
	}
	public function dairytype_update($dairytypeupdate_array, $dryid) {
		$this->db->where('dairy_type_id', $dryid);
		return $this->db->update('project_dairy_type', $dairytypeupdate_array);
	}
	public function delete_dairy_type($delt_id) {
		//echo $templateitcode;
		//       echo "zdxfcgvhbjnk";
		$this->db->where('dairy_type_id', $delt_id);
		return $this->db->delete('project_dairy_type');
	}
	public function delete_dairy_typedetails($delt_id) {
		//echo $templateitcode;
		//       echo "zdxfcgvhbjnk";
		$this->db->where('type_id', $delt_id);
		return $this->db->delete('add_dairy');
	}
	public function update_dairy() {
		$did = $_REQUEST['dary_id'];
		$pro = $_REQUEST['pro_id'];
		$dairyArray = array('description' => $_POST['description'],
		);

		$result = $this->Mainmodel->dairy_update($dairyArray, $did);
		// $data['a']=$result;
		redirect(base_url('Maincontroller/add_dairy?_pjid=' . $pro . ''), 'refresh');
	}
	public function insert_profile($profilentryArray) {
		return $this->db->insert('profile', $profilentryArray);
	}

// 20.04.2018
	public function profile_exsist($a) {
		$sql = "select count(*) as total,filled_name,filled_name1 from profile where project_id='$a' group by profile_id";
		$query = $this->db->query($sql);
		return $res = $query->result_array();
// $this->db->select( 'count(*) as total');
		// $this->db->from('profile');
		// $this->db->where('project_id',$a) ;

// return $this->db->get()->result_array();
	}
	public function site_exsist($a) {
		$this->db->select('filled_name1');
		$this->db->from('profile');
		$this->db->where('project_id', $a);

		return $this->db->get()->result_array();
	}

	public function get_profile_details($id_) {
		$this->db->select('*');
		$this->db->from('profile');
		$this->db->where('project_id', $id_);

		return $ar = $this->db->get()->result_array();
		// print_r($ar);
	}

	function get_assign_milestone($idpr) {
		$session_data = $this->session->userdata('test1');
		$staff_id = $session_data[0]['staff_code'];
		$SQL = "select * from mile_stone where     project_id=$idpr and staff_parent_id=$staff_id";

		$query = $this->db->query($SQL);
		$res1 = $query->result_array();

		return $res1;
	}

	public function stafflist_details($mid) {
		$session_data = $this->session->userdata('test1');
		$staff_id = $session_data[0]['staff_code'];
		$this->db->select('*');
		$this->db->from('checklist');
		$this->db->join('mile_stone', 'checklist.milestone_id = mile_stone.milestone_id');
		$this->db->where('mile_stone.staff_id', $staff_id);
		$this->db->where('mile_stone.milestone_id', $mid);
		return $this->db->get()->result_array();
	}

	public function stafflist_detailsad($mid) {
		$session_data = $this->session->userdata('test1');
		$staff_id = $session_data[0]['staff_code'];

		$this->db->select('*');
		$this->db->from('checklist');
		$this->db->join('mile_stone', 'checklist.milestone_id = mile_stone.milestone_id');
		$this->db->where('mile_stone.staff_parent_id', 0);
		$this->db->where('mile_stone.milestone_id', $mid);
		return $this->db->get()->result_array();
	}

	public function count_client_doc($lead) {
		$this->db->select('count(*) as total');
		$this->db->from('client_doccuments_details');
		$this->db->where('lead_id', $lead);
		return $this->db->get()->result_array();
	}

	public function insert_clintdoccuments($data1) {
		return $this->db->insert('client_doccuments', $data1);
	}

	public function insert_clent_docc($data) {
		return $this->db->insert('client_doccuments_details', $data);
	}
	public function count_drawing_doc($project_id) {
		$this->db->select('count(*) as total');
		$this->db->from('doc_drawing');
		$this->db->where('project_id', $project_id);
		return $this->db->get()->result_array();
	}
	public function fee_exsist($a) {
		$this->db->select('count(*) as total');
		$this->db->from('fee_structure');
		$this->db->where('project_id', $a);

		return $this->db->get()->result_array();
	}
	public function insert_fee_structure($feedetailsArray) {
		return $this->db->insert('fee_structure', $feedetailsArray);
	}
	public function fee_details($id) {
		$this->db->select('*');
		$this->db->from('fee_structure');
		$this->db->where('project_id', $id);

		return $this->db->get()->result_array();
	}
	public function approvalist_details() {
		$this->db->select('*');
		$this->db->from('approval_list');
		// $this->db->where('pro',$id) ;
		$this->db->order_by('ap_id', 'ASC');
		return $this->db->get()->result_array();
	}

	public function othrapdoc($id) {
		$this->db->select('*');
		$this->db->from('approvalit');
		$this->db->join('approvals', 'approvals.approval_code = approvalit.approve_code');
		$this->db->where('approvals.project_id', $id);
		$this->db->where('approvalit.approve_id', 6);
		return $this->db->get()->result_array();
	}

	public function othrapdoclist($id) {
		$this->db->select('*');
		$this->db->from('approval_doccuments');
		$this->db->where('approve_id', 6);
		// $this->db->join('approvals', 'approvals.approval_code = approvalit.approve_code');
		return $this->db->get()->result_array();
	}

	public function get_valdetails($id) {
		$this->db->select('*');
		$this->db->from('approvalit');
		// $this->db->join('approval_doccuments', 'approval_doccuments.approve_id = approvalit.approve_id');
		$this->db->where('approvalit.approve_id', $id);

		return $this->db->get()->result_array();
	}
	public function insert_doccuments($data1) {
		return $this->db->insert('approval_doccuments', $data1);
	}

	public function insert_approvals($data01) {
		return $this->db->insert('approvals', $data01);
	}
	public function insert_approvalit($data) {
		return $this->db->insert('approvalit', $data);
	}
	public function profile_update($profileArray, $id) {
		$this->db->where('project_id', $id);
		return $this->db->update('profile', $profileArray);
	}

	public function get_apprvcount($id, $pro) {
		$this->db->select('count(*) as total');
		$this->db->from('approvals');
		$this->db->where('approvals', $id);
		$this->db->where('project_id', $pro);
		return $this->db->get()->result_array();
	}
	public function upadte_fee($updatefeeArray, $id) {
		$this->db->where('project_id', $id);
		return $this->db->update('fee_structure', $updatefeeArray);
	}
	public function update_approval($datastatus, $ap_id) {
		$this->db->where('approvals', $ap_id);
		return $this->db->update('approvals', $datastatus);
	}

	public function clientdoc_details($id_lead) {
		$this->db->select('*');
		$this->db->from('client_doccuments_details');
		$this->db->where('lead_id', $id_lead);

		return $this->db->get()->result_array();
	}

	public function clientdocuments($doc_id) {
		$this->db->select('*');
		$this->db->from('client_doccuments');
		$this->db->where('doc_type_id', $doc_id);
		return $this->db->get()->result_array();
	}
	public function deltedocc($di) {
		$this->db->where('cl_id', $di);
		return $this->db->delete('client_doccuments');
	}

	public function update_approvalit($data, $code) {
		$this->db->where('approve_code', $code);
		return $this->db->update('approvalit', $data);
	}

	public function delete_docs($doc_id) {
		$this->db->where('doc_id', $doc_id);
		return $this->db->delete('approval_doccuments');
	}

	public function invoice_num() {
		$SQL = "SELECT * from public.get_new_invoice_number();";
		$query = $this->db->query($SQL);
		$res = $query->result_array();
		// print_r($res);
		return $res;
	}

	public function insert_invoicedetails($invoicedetails) {
		return $this->db->insert('invoice_details', $invoicedetails);
	}

	public function insert_invoice($invoice) {
		return $this->db->insert('invoice', $invoice);
	}

	public function get_invoice() {
		$session_data = $this->session->userdata('test');
		$userid = $session_data[0]['id'];
		// $this->db->select( '*');
		// $this->db->from('invoice');
		// $this->db->join('invoice_details', 'invoice.invoice_id = invoice_details.invoice_id');
		// // $this->db->where('approvals.project_id',$id) ;
		// return $this->db->get()->result_array();
		$sql = "select * from invoice_details   where user_id=$userid";
		$query = $this->db->query($sql);

		$res = $query->result_array();
		return $res;
	}
	public function get_invoice_data($invo_id) {
		$session_data = $this->session->userdata('test');
		$userid = $session_data[0]['id'];
		// $this->db->select( '*');
		// $this->db->from('invoice');
		// $this->db->join('invoice_details', 'invoice.invoice_id = invoice_details.invoice_id');
		// // $this->db->where('approvals.project_id',$id) ;
		// return $this->db->get()->result_array();
		$sql = "select * from invoice_details   where user_id=$userid and inovice_no=$invo_id";
		$query = $this->db->query($sql);

		$res = $query->result_array();
		return $res;
	}
	public function invoice_values($id) {

		$sql = "select * from invoice   where invoice_id=$id";
		$query = $this->db->query($sql);

		$res = $query->result_array();
		return $res;
	}
	public function estimate_num() {
		$SQL = "SELECT * from public.get_estimate_number();";
		$query = $this->db->query($SQL);
		$res = $query->result_array();
		//print_r($res);
		return $res;
	}

	public function add_estimate_items($item_details) {
		return $this->db->insert('estimate_items', $item_details);
	}
	public function estimate_items() {
		$this->db->select('*');
		$this->db->from('estimate_items');
		// $this->db->where('sub_item',true) ;
		return $this->db->get()->result_array();
	}
	public function sub_estimate_items($estimate) {
		$this->db->select('*');
		$this->db->from('estimate_items');
		$this->db->where('parent_id', $estimate);
		return $this->db->get()->result_array();
	}
	public function get_estitem($parent) {
		$this->db->select('*');
		$this->db->from('estimate_items');
		$this->db->where('estimate_id', $parent);
		return $this->db->get()->result_array();
	}
	public function update_estimatedetails($estimate, $estimate_id) {
		$this->db->where('estimate_id', $estimate_id);
		return $this->db->update('estimate_items', $estimate);
	}

	public function details_estimate() {
		$this->db->select('*');
		$this->db->from('estimate_items');
		$this->db->where('parent_id', NULL);
		$this->db->order_by('estimate_id', 'ASC');
		return $this->db->get()->result_array();
	}
	public function insert_estimatedetails($estimatedetails) {
		return $this->db->insert('estimate_values', $estimatedetails);
	}
	public function insert_estimatecost($estimatearray) {
		return $this->db->insert('estimate_cost', $estimatearray);
	}

	public function ta_exist($staff) {
//               $projectid= $milestonearray['project_id'];

		$this->db->select('count(*) as total');
		$this->db->from('tb_ta');
		$this->db->where('staff_id', $staff);

		return $this->db->get()->result_array();
	}

	public function assign_staff_project($staff) {
		$SQL = "select * from staff_project_map m, project s where m.project_id = s.project_id and m.staff_id=$staff";
		$query = $this->db->query($SQL);
		return $res = $query->result_array();
	}

	public function insert_ta($ta) {
		return $this->db->insert('tb_ta', $ta);
	}
	public function dete_estmcost($pid) {
		$this->db->where('estimate_id', $pid);
		return $this->db->delete('estimate_cost');

	}
	public function dete_estmvalues($pid) {
		$this->db->where('estimate_id', $pid);
		return $this->db->delete('values');

	}

	public function insert_ta_details($detailsTa) {
		// print_r($detailsTa);
		return $this->db->insert('ta_details', $detailsTa);
	}

	public function get_main_allowance($staff_id) {
		$this->db->select('*');
		$this->db->from('tb_ta');
		$this->db->where('staff_id', $staff_id);
// $this->db->where('ta_id',$ta) ;
		return $this->db->get()->result_array();
	}
	public function get_main_allowance_details($staff_id, $ta) {
		$this->db->select('*');
		$this->db->from('tb_ta');
		$this->db->where('staff_id', $staff_id);
		$this->db->where('ta_id', $ta);
		return $this->db->get()->result_array();
	}

	public function app_docs($id) {
		$this->db->select('*');
		$this->db->from('approval_doccuments');
		$this->db->where('approve_id', $id);
		return $this->db->get()->result_array();
	}
	public function app_documents($id) {
		$this->db->select('*');
		$this->db->from('approval_doccuments');
		$this->db->where('approval_code', $id);
		return $this->db->get()->result_array();
	}

	public function insert_drawing_doc($data) {
		return $this->db->insert('doc_drawing', $data);
	}

	public function insert_drawingdoc($data1) {
		return $this->db->insert('drawing_prepare_doc', $data1);
	}

	public function submission_docs($project) {
		$this->db->select('*');
		$this->db->from('doc_drawing');
// $this->db->join('client_doccuments', 'client_doccuments_details.doc_type_id = client_doccuments.doc_type_id');
		$this->db->where('project_id', $project);
		return $this->db->get()->result_array();
	}
	public function drawingdocuments($doc_drawid) {
		$this->db->select('*');
		$this->db->from('drawing_prepare_doc');
		$this->db->where('doc_draw_id', $doc_drawid);
		return $this->db->get()->result_array();
	}

	public function deltedrawdocc($di) {
		$this->db->where('pre_id', $di);
		return $this->db->delete('drawing_prepare_doc');
	}
	public function get_max_id($get_id) {
		$sql = "SELECT MAX(dairy_id) FROM add_dairy where project_id=$get_id";
		$query = $this->db->query($sql);

		$res = $query->result_array();
		return $res;
	}
	public function get_mincount($get_id, $daiy_id) {
		$sql1 = "SELECT MIN(dairy_id) AS next_number FROM add_dairy WHERE project_id=$get_id AND dairy_id > $daiy_id";
// echo $sql1="SELECT MIN(dairy_id) AS next_number FROM add_dairy WHERE dairy_id > $daiy_id";
		$query1 = $this->db->query($sql1);

		$res1 = $query1->result_array();
		return $res1;
	}
	public function get_min_id($get_id) {
		$sql = "SELECT MIN(dairy_id) FROM add_dairy where project_id=$get_id";
		$query = $this->db->query($sql);

		$res = $query->result_array();
		return $res;
	}
	public function get_maxcount($get_id, $daiy_id) {
		$sql1 = "SELECT MAX(dairy_id) AS next_numbera FROM add_dairy WHERE   project_id=$get_id AND dairy_id < $daiy_id ";
// echo $sql1="SELECT MIN(dairy_id) AS next_number FROM add_dairy WHERE dairy_id > $daiy_id";
		$query1 = $this->db->query($sql1);

		$res1 = $query1->result_array();
		return $res1;
	}
	public function nextdairy_details($get_id, $diary) {
		$this->db->select('*');
		$this->db->from('add_dairy');
		$this->db->join('project_dairy_type', 'add_dairy.type_id = project_dairy_type.dairy_type_id');
		$this->db->join('staff', 'add_dairy.staff_id = staff.staff_code');
		$this->db->where('add_dairy.project_id', $get_id);
		$this->db->where('add_dairy.dairy_id', $diary);
		return $this->db->get()->result_array();
	}
	public function diary_count($get_id) {
		$this->db->select('count(*) as total');
		$this->db->from('add_dairy');
		$this->db->where('add_dairy.project_id', $get_id);
		return $this->db->get()->result_array();
	}

	public function update_invoice($invoicedetails, $invo) {
		$this->db->where('invoice_id', $invo);
		return $this->db->update('invoice_details', $invoicedetails);
	}
	public function update_values($invoice, $id) {
		$this->db->where('id_invoice', $id);
		return $this->db->update('invoice', $invoice);
	}
	public function add_profile_details($profileArry) {
//               print_r($milestonearray);

		return $this->db->insert('profile_details', $profileArry);
	}
	public function add_consultantdetails($consultantArry) {
//               print_r($milestonearray);

		return $this->db->insert('tb_consultant', $consultantArry);
	}
	public function add_persondetails($contactArry) {
//               print_r($milestonearray);

		return $this->db->insert('tb_contactperson', $contactArry);
	}
	public function add_subcontratordetails($subcontractArry) {
//               print_r($milestonearray);

		return $this->db->insert('tb_contractors', $subcontractArry);
	}
	public function get_consultantdetails($type, $pro) {
		$this->db->select('*');
		$this->db->from('tb_consultant');
		$this->db->where('project_id', $pro);
		$this->db->where('consultant_type_id', $type);
		return $this->db->get()->result_array();
	}
	public function update_consultant($data, $id) {
		$this->db->where('consultant_id', $id);
		return $this->db->update('tb_consultant', $data);
	}
	public function get_contact_person($pro) {
		$this->db->select('*');
		$this->db->from('tb_contactperson');
		$this->db->where('project_id', $pro);
		return $this->db->get()->result_array();
	}

	public function get_contratorsdetails() {
		$this->db->select('*');
		$this->db->from('tb_contractors');
		// $this->db->where('project_id',$pro);
		return $this->db->get()->result_array();
	}
	public function delete_contractor($pid) {
		$this->db->where('contractor_id', $pid);
		return $this->db->delete('tb_contractors');

	}
	public function get_details_consultant($consultant) {
		$this->db->select('*');
		$this->db->from('tb_consultant');
		$this->db->where('consultant_id', $consultant);
		return $this->db->get()->result_array();
	}

	public function get_details_contractor($contractor) {
		$this->db->select('*');
		$this->db->from('tb_contractors');
		$this->db->where('contractor_id', $contractor);
		return $this->db->get()->result_array();
	}
	public function update_contractor($data, $id) {
		$this->db->where('contractor_id', $id);
		return $this->db->update('tb_contractors', $data);
	}
	public function get_details_person($person) {
		$this->db->select('*');
		$this->db->from('tb_contactperson');
		$this->db->where('person_id', $person);
		return $this->db->get()->result_array();
	}
	public function update_person($data, $id) {
		$this->db->where('person_id', $id);
		return $this->db->update('tb_contactperson', $data);
	}
	public function delete_person($pid) {
		$this->db->where('person_id', $pid);
		return $this->db->delete('tb_contactperson');

	}
	public function delete_consutant($pid) {
		$this->db->where('consultant_id', $pid);
		return $this->db->delete('tb_consultant');

	}
	public function get_allowance($ta) {
		$this->db->select('*');
		$this->db->from('ta_details');
		$this->db->where('ta_id', $ta);
// $this->db->where('staff_id',$id) ;
		return $this->db->get()->result_array();
	}
	public function delete_ta($id) {
		$this->db->where('ta_id', $id);
		return $this->db->delete('tb_ta');

	}
	public function delete_tadetails($id) {
		$this->db->where('ta_id', $id);
		return $this->db->delete('ta_details');

	}
	public function get_tallowance($id) {
		$this->db->select('*');
		$this->db->from('tb_ta');
		$this->db->where('ta_id', $id);
		return $this->db->get()->result_array();
	}
	public function get_tallowance_details($id) {
		$SQL = "select * from ta_details d, project p where d.project_id = p.project_id and d.ta_id=$id";
		$query = $this->db->query($SQL);
		return $res = $query->result_array();
	}
	public function update_ta_details($updatedetails, $id) {
		$this->db->where('details_id', $id);
		return $this->db->update('ta_details', $updatedetails);
	}
	public function update_ta($taarry, $ta) {
		$this->db->where('ta_id', $ta);
		return $this->db->update('tb_ta', $taarry);
	}
	public function get_allcalenderevents() {

		$this->db->select('*');
		$this->db->from('tb_calender');

		return $ar = $this->db->get()->result_array();
		// print_r($ar);
	}

	public function add_calenderevents($arr) {
		return $this->db->insert('tb_calender', $arr);
	}

	public function update_calender($data, $id) {
		$this->db->where('calenderid', $id);
		return $this->db->update('tb_calender', $data);
	}

	public function delete_calender($id) {
		$this->db->where('calenderid', $id);
		return $this->db->delete('tb_calender');
	}
	public function add_siteprofile($sitedata, $project) {
		$this->db->where('project_id', $project);
		return $this->db->update('profile', $sitedata);
	}

	public function all_consultant($id) {
		$this->db->select('*');
		$this->db->from('tb_consultant');
		$this->db->where('project_id', $id);
		return $this->db->get()->result_array();
	}
	public function get_profiledetails($pro) {
		$this->db->select('*');
		$this->db->from('profile_details');
		$this->db->where('project_id', $pro);
		return $this->db->get()->result_array();
	}

	// 11.07.2018
	public function detailsprofile($id) {
		$this->db->select('count(*)');
		$this->db->from('profile_details');
		$this->db->where('project_id', $id);
		return $this->db->get()->result_array();
	}
	public function get_detailsprofile($id) {
		$this->db->select('*');
		$this->db->from('profile_details');
		$this->db->where('project_id', $id);
		return $this->db->get()->result_array();
	}
	public function updateprofile_details($data, $id) {
		$this->db->where('project_id', $id);
		return $this->db->update('profile_details', $data);
	}
	public function delte_approvals($doc_id) {
		$this->db->where('approval_code', $doc_id);
		return $this->db->delete('approvals');
	}
	public function delte_approvalit($doc_id) {
		$this->db->where('approve_code', $doc_id);
		return $this->db->delete('approvalit');
	}
	public function get_expense_head_details_head_id($head_id) {
		$this->db->select('*');
		$this->db->from('expense_heads');
		$this->db->where('head_id', $head_id);
		return $this->db->get()->result_array();
	}
	public function setting_update($settingarray, $ta_expense_id) {
		$this->db->where('ta_expense_id', $ta_expense_id);
		return $this->db->update('ta_expense', $settingarray);
	}
	public function get_staff_type_except_stafftype_code($staff_type_code) {
		$session_data = $this->session->userdata('test1');
		$staff_id = $session_data[0]['staff_code'];

		$sql = "select * from  staff_type  EXCEPT(select * from staff_type where staff_type_code=$staff_type_code)";
		$query = $this->db->query($sql);

		$res = $query->result_array();

		return $res;

	}
	public function isthere_value($id) {
//        $projectid= $milestonearray['project_id'];

		$this->db->select('count(*) as total');
		$this->db->from('estimate_cost');
		$this->db->where('estimate_id', $id);

		return $this->db->get()->result_array();
	}
	public function delte_estimate($eid) {
		$this->db->where('estimate_id', $eid);
		return $this->db->delete('estimate_items');
	}
	public function countestm($id) {
		$SQL = "select count(*) from estimate_items where parent_id=(select parent_id from estimate_items where estimate_id=$id)";
		$query = $this->db->query($SQL);
		return $res = $query->result_array();
	}

	public function get_estimatecost($id) {
		$this->db->select('*');
		$this->db->from('estimate_cost');
		$this->db->where('cost_estim_id', $id);
		return $this->db->get()->result_array();
	}
	public function delete_estimatecost($id) {
		$this->db->where('estimate', $id);
		return $this->db->delete('estimate_cost');
	}
	public function delete_estimatevalues($id) {
		$this->db->where('estimate', $id);
		return $this->db->delete('estimate_values');
	}

	public function update_estimatevalues($estimatedetails, $estimate) {
		$this->db->where('estimate', $estimate);
		return $this->db->update('estimate_values', $estimatedetails);
	}

	public function edit_estimatedetails($estimatedetails, $estimate) {
		$this->db->where('estimate', $estimate);
		return $this->db->update('estimate_values', $estimatedetails);
	}

	public function edit_estimatecost($estimatearray, $estimate_id) {
		$this->db->where('estimate_id', $estimate_id);
		return $this->db->update('estimate_cost', $estimatearray);
	}

	public function listestim($id) {
		$SQL = "select * from estimate_value where estimate=$id";
		$query = $this->db->query($SQL);
		return $res = $query->result_array();
	}
	public function listestim12($id) {
		$SQL = "select * from estimate_value where estimate=$id";
		$query = $this->db->query($SQL);
		return $res = $query->result_array();
	}

	public function lead_documents_delete($leaddoc_id) {
		$this->db->where('lead_doc_list_id', $leaddoc_id);
		return $this->db->delete('lead_document_list');
	}
	public function get_all_projectdetails($id) {
		$this->db->select('*');
		$this->db->from('profile_details');
		$this->db->where('project_id', $id);
		return $this->db->get()->result_array();
	}
	public function get_mainteam_under_staff($staff_id) {
		$this->db->select('*');
		$this->db->from('team_lead');
		$this->db->join('staff', 'team_lead.staff_id = staff.staff_code');
		// $this->db->where('team_lead.level',1);
		$this->db->where('staff_id', $staff_id);
		$res = $this->db->get()->result_array();
		// print_r($res);
		if ($res) {
			$teamcode = $res[0]['team_code'];

			$this->db->select('*');
			$this->db->from('team_lead');
			$this->db->join('staff', 'team_lead.staff_id = staff.staff_code');
			// $this->db->where('team_lead.level',1);
			$this->db->where('parent_id', $teamcode);
			return $res1 = $this->db->get()->result_array();
		}

	}
	public function get_team_lead_parent_id_report($a) {

		$session_data = $this->session->userdata('test1');
		$staff_id = $session_data[0]['staff_code'];
		$this->db->select('*');
		$this->db->from('team_lead');
		$this->db->join('staff', 'team_lead.staff_id = staff.staff_code');
		// $this->db->where('team_lead.level',1);
		$this->db->where('staff_id', $a);
		$res = $this->db->get()->result_array();
		// print_r($res);
		if ($res) {
			$parent_id = $res[0]['parent_id'];

			$this->db->select('*');
			$this->db->from('team_lead');
			$this->db->join('staff', 'team_lead.staff_id = staff.staff_code');
			// $this->db->where('team_lead.level',1);
			$this->db->where('team_code', $parent_id);
			return $res1 = $this->db->get()->result_array();

		}

	}

	public function get_projects_projectid($project_id) {
		$this->db->select('*');
		$this->db->from('project');
		$this->db->where('project_id', $project_id);

		return $this->db->get()->result_array();
	}

	public function get_projects_project_id($project_id) {

		$this->db->select('*');
		$this->db->from('project');
		$this->db->where('project_id', $project_id);

		return $this->db->get()->result_array();

	}
	// 21.07.2018
	public function add_type($data) {
		// print_r($projectarray);
		return $this->db->insert('consultant_type', $data);

	}
	public function consultanttype() {

		$this->db->select('*');
		$this->db->from('consultant_type');
		return $this->db->get()->result_array();

	}
	public function get_allconsultance() {
		$this->db->select('*');
		$this->db->from('tb_consultant');
		return $this->db->get()->result_array();
	}
	public function get_typename($id) {
		$this->db->select('type_name');
		$this->db->from('consultant_type');
		$this->db->where('c_type_id', $id);
		return $this->db->get()->result_array();
	}
	public function get_consultant() {
		$this->db->select('*');
		$this->db->from('tb_consultant');
		// $this->db->where('c_type_id',$id) ;
		return $this->db->get()->result_array();
	}
	public function add_assign_consultant($assignConsultant) {
		return $this->db->insert('assign_consultant', $assignConsultant);
	}
	public function get_addedconsultant($id) {
		$this->db->select('*');
		$this->db->from('assign_consultant');
		$this->db->join('tb_consultant', 'tb_consultant.consultant_id = assign_consultant.consultant_id');
		$this->db->join('consultant_type', 'consultant_type.c_type_id = tb_consultant.consultant_type_id');
		$this->db->where('assign_consultant.project_id', $id);
		return $this->db->get()->result_array();
	}
	public function get_addedcontractor($id) {
		$this->db->select('*');
		$this->db->from('assign_contractor');
		$this->db->join('tb_contractors', 'tb_contractors.contractor_id = assign_contractor.assign_contractor_id');
		// $this->db->join('consultant_type', 'consultant_type.c_type_id = tb_consultant.consultant_type_id');
		$this->db->where('assign_contractor.project_id', $id);
		return $this->db->get()->result_array();
	}
	public function deleteConsutant1($id) {
		$this->db->where('assignConsultant_id', $id);
		return $this->db->delete('assign_consultant');
	}
	public function get_contractor() {
		$this->db->select('*');
		$this->db->from('tb_contractors');
		// $this->db->where('c_type_id',$id) ;
		return $this->db->get()->result_array();
	}
	public function add_assign_contractor($assignContractor) {
		return $this->db->insert('assign_contractor', $assignContractor);
	}
	// select * from tb_ta t,ta_details d where t.ta_id=d.ta_id and staff_id=8 and month='05/2018'
	public function monthvalues($mth, $staff) {
		$this->db->select('*');
		$this->db->from('tb_ta');
		$this->db->join('ta_details', 'ta_details.ta_id = tb_ta.ta_id');
		$this->db->where('month', $mth);
		$this->db->where('staff_id', $staff);
		return $this->db->get()->result_array();
	}
	public function assign_staff_project11($staff, $id) {
		$SQL = "select * from staff_project_map m, project s where m.project_id = s.project_id and m.staff_id=$staff and s.project_id=$id";
		$query = $this->db->query($SQL);
		return $res = $query->result_array();
	}

	public function deleteinvoice($di) {
		$this->db->where('id_invoice', $di);
		return $this->db->delete('invoice');
	}

	public function estim_data() {
		$this->db->select('*');
		$this->db->from('estimate_values');
		return $this->db->get()->result_array();

	}
	public function deleteestimatecost($id) {
		$this->db->where('estimate_id', $id);
		return $this->db->delete('estimate_cost');
	}
	public function monthlysalary($mth) {
		// $SQL="select * from salary_details where salary_id=(select salary_id from salary_entry where month_year='$mth')";
		$SQL = "select * from salary_details d,staff s where d.staff=s.staff_code and salary_id=(select salary_id from salary_entry where month_year='$mth')";
		$query = $this->db->query($SQL);
		return $res = $query->result_array();
	}
// public function monthlysalary($mth)
	//     {
	//        $SQL1="select salary_id from salary_entry where month_year='$mth'";
	// $query1 = $this->db->query($SQL1);
	//  $res1=$query1->result_array();
	// for($i=0;$i<count($res1);$i++)
	//       {
	//        $id= $res1[$i]['salary_id'];
	//             $SQL="select * from salary_details where salary_id=$id";
	// $query = $this->db->query($SQL);
	// return $res=$query->result_array();
	//   }

	// }
	public function insert_salary_data($data) {
		return $this->db->insert('salary_entry', $data);
	}
	public function insert_salarydetails($data) {
		return $this->db->insert('salary_details', $data);
	}
	public function get_perticularstaff($id) {
		$session_data = $this->session->userdata('test');
//        $qry="select count(*) as total from public.project where user_id=$userid";
		$userid = $session_data[0]['id'];
		$this->db->select('*');
		$this->db->from('staff');
		$this->db->where('user_id', $userid);
		$this->db->where('staff_code', $id);

		return $this->db->get()->result_array();
	}
	public function deletesalary($di) {
		$this->db->where('salarydetails_id', $di);
		return $this->db->delete('salary_details');
	}
	public function get_allsalarydetails() {
		$this->db->select('*');
		$this->db->from('salary_entry');
		// $this->db->where('c_type_id',$id) ;
		return $this->db->get()->result_array();
	}
	public function deletesalaryentry($id) {
		$this->db->where('salary_id', $id);
		return $this->db->delete('salary_entry');
	}
	public function deletesalarydetails($id) {
		$this->db->where('salary_id', $id);
		return $this->db->delete('salary_details');
	}
	public function getsalaryrecord($id) {
		$this->db->select('*');
		$this->db->from('salary_entry');
		$this->db->where('salary_id', $id);
		return $this->db->get()->result_array();
	}

	public function getsalaryrecorddetails($id) {
		$this->db->select('*');
		$this->db->from('salary_details');
		$this->db->where('salary_id', $id);
		return $this->db->get()->result_array();
	}

	public function update_salary_data($data, $id) {
		$this->db->where('salary_id', $id);
		return $this->db->update('salary_entry', $data);
	}
	public function update_salarydetails($data, $id) {
		$this->db->where('salarydetails_id', $id);
		return $this->db->update('salary_details', $data);
	}

// 31/07/2018
	public function insert_lead_documents_list($destdoc) {
		return $this->db->insert('lead_document_list', $destdoc);
	}

	public function get_all_lead_document_list($lead_doc_id) {
		$this->db->select('*');
		$this->db->from('lead_document_list');
		$this->db->where('lead_doc_id', $lead_doc_id);

		return $this->db->get()->result_array();
	}

	public function get_all_project_sub_drawing_under_stage_id($stage_id, $project_type_code) {
		$this->db->select('*');
		$this->db->from('project_sub_stage');
		$this->db->where('stage_id', $stage_id);
		$this->db->where('project_type_code', $project_type_code);

		return $this->db->get()->result_array();
	}
	public function add_project_sub_stage($project_substage_array) {
		return $this->db->insert('project_sub_stage', $project_substage_array);
	}

	public function get_project_sub_stage($sub_stage_id) {
		$this->db->select('*');
		$this->db->from('project_sub_stage');

		$this->db->where('sub_stage_id', $sub_stage_id);

		return $this->db->get()->result_array();
	}
	public function update_project_substage($project_stage_Array, $sub_stage_id) {
		$this->db->where('sub_stage_id', $sub_stage_id);
		return $this->db->update('project_sub_stage', $project_stage_Array);
	}
	public function delete_project_sub_stage($sub_stage_id) {
		$this->db->where('sub_stage_id', $sub_stage_id);
		return $this->db->delete('project_sub_stage');
	}

	public function last_photo_vault($project_id) {

		$sql = "select max(vault_id) from  photo_vault  where project_id=$project_id";
		$query = $this->db->query($sql);

		$res = $query->result_array();

		$last_id = $res[0]['max'];

		$sql2 = "select * from  photo_vault  where vault_id=$last_id";
		$query2 = $this->db->query($sql2);

		$res2 = $query2->result_array();
		return $res2;
	}
	public function get_job_number() {
		//   $SQL="SELECT * from ";
		//   $query = $this->db->query($SQL);
		//   $res=$query->result_array();
		// // print_r($res);
		//   return $res;
	}

	public function get_all_staff_transmital_master($project_id) {
		$session_data = $this->session->userdata('test1');
		$staff_code = $session_data[0]['staff_code'];
		$this->db->select('*');
		$this->db->from('transmital_master');
		$this->db->where('project_id', $project_id);
		$this->db->where('staff_id', $staff_code);
		$this->db->order_by('date', 'DESC');
		return $this->db->get()->result_array();
	}

// 21/07/0218

	public function get_all_projects() {
		$this->db->select('*');
		$this->db->from('project');

		return $this->db->get()->result_array();
	}

	public function get_all_clients_data() {
		$this->db->select('*');
		$this->db->from('clients');

		return $this->db->get()->result_array();
	}

	public function get_project_type_work_entry($project_id) {
		$this->db->select('*');
		$this->db->from('project');
		$this->db->where('project_id', $project_id);

		return $this->db->get()->result_array();
	}
	public function get_project_sub_stage_depend_ptid($project_type_code, $stage_id) {
		$this->db->select('*');
		$this->db->from('project_sub_stage');
		$this->db->where('project_type_code', $project_type_code);
		$this->db->where('stage_id', $stage_id);

		return $this->db->get()->result_array();
	}

	public function get_pro_draw_depend_sub_stage_id($sub_stage_id, $stage_id, $project_type_id) {
		$this->db->select('*');
		$this->db->from('project_drawings');
		$this->db->where('project_type_code', $project_type_id);
		$this->db->where('stage_id', $stage_id);
		$this->db->where('sub_stage_id', $sub_stage_id);

		return $this->db->get()->result_array();
	}

	public function get_sub_stage_name($sub_stage_id) {
		$this->db->select('*');
		$this->db->from('project_sub_stage');
		$this->db->where('sub_stage_id', $sub_stage_id);

		return $this->db->get()->result_array();
	}

	public function get_all_project_drawings_under_stage($stage_id, $project_type_code, $sub_stage_id) {
		$session_data = $this->session->userdata('test');
		$user_id = $session_data[0]['id'];
		$this->db->select('*');
		$this->db->from('project_drawings');
		// $this->db->where('user_id',$user_id) ;
		$this->db->where('stage_id', $stage_id);
		$this->db->where('project_type_code', $project_type_code);
		$this->db->where('sub_stage_id', $sub_stage_id);
		return $this->db->get()->result_array();
	}
	public function get_pro_meeting_depend_sub_stage_id($stage_id, $project_type_id, $sub_stage_id) {
		$this->db->select('*');
		$this->db->from('project_meeting');
		$this->db->where('stage_id', $stage_id);
		$this->db->where('project_type_id', $project_type_id);
		$this->db->where('sub_stage_id', $sub_stage_id);
		$this->db->order_by('meeting_id', 'asc');

		return $this->db->get()->result_array();
	}

	public function update_workentryaction($workentryArray, $work_id) {
		$this->db->where('id', $work_id);
		return $this->db->update('work_entry', $workentryArray);
	}
	public function add_staff_master($masterarray) {
		return $this->db->insert('staff_master', $masterarray);
	}
	public function add_staff_experiense($staff_experiencearray) {
		return $this->db->insert('staff_experience', $staff_experiencearray);
	}
	public function add_staff_qualification($staff_qualificationarray) {
		return $this->db->insert('staff_qualification', $staff_qualificationarray);
	}

	public function staff_profile_details($staff_id) {
		$this->db->select('*');
		$this->db->from('staff_master');
		$this->db->where('staff_id', $staff_id);

		return $this->db->get()->result_array();

	}

	public function staff_qualification_details($staff_id) {
		$this->db->select('*');
		$this->db->from('staff_qualification');
		$this->db->where('staff_id', $staff_id);

		return $this->db->get()->result_array();
	}
	public function staff_experiences_details($staff_id) {
		$this->db->select('*');
		$this->db->from('staff_experience');
		$this->db->where('staff_id', $staff_id);
		return $this->db->get()->result_array();
	}
	public function update_staff_qualification($arr, $qualid) {
		$this->db->where('staff_qualification_id', $qualid);
		return $this->db->update('staff_qualification', $arr);
	}
	public function update_staff_experiense($exp_Arrays, $expId) {
		$this->db->where('experiense_id', $expId);
		return $this->db->update('staff_experience', $exp_Arrays);
	}
	public function update_staff_profile($assetsArray, $master_id) {
		$this->db->where('master_id', $master_id);
		return $this->db->update('staff_master', $assetsArray);
	}
	public function delete_staff_qualification($qualid) {
		$this->db->where('staff_qualification_id', $qualid);
		return $this->db->delete('staff_qualification');
	}
	public function delete_staff_experiences($exp_id) {
		$this->db->where('experiense_id', $exp_id);
		return $this->db->delete('staff_experience');
	}
	public function add_staff_cv($arr) {
		return $this->db->insert('staff_cv', $arr);
	}

	public function add_staff_certificate($arr) {
		return $this->db->insert('staff_certificate', $arr);
	}
	public function get_staff_cv($staff_id) {
		$this->db->select('*');
		$this->db->from('staff_cv');
		$this->db->where('staff_id', $staff_id);
		return $this->db->get()->result_array();
	}
	public function get_staff_certificate($cv_id) {
		$this->db->select('*');
		$this->db->from('staff_certificate');
		$this->db->where('cv_id', $cv_id);
		return $this->db->get()->result_array();
	}
	public function monthlyallowance($mth) {
		// $this->db->select('*');
		// $this->db->from('salary_entry');
		//     $this->db->where('month_year',$mth) ;
		// return $this->db->get()->result_array();
		$session_data = $this->session->userdata('test1');
		$staff_code = $session_data[0]['staff_code'];
		$SQL = "select * from ta_details where ta_id=(select ta_id from tb_ta where month='$mth' and staff_id=$staff_code)";
		$query = $this->db->query($SQL);
		return $res = $query->result_array();
	}

	public function assign_staff_projectthat($id, $staff) {
		$SQL = "select * from staff_project_map m, project p where m.project_id = p.project_id and m.staff_id=$staff and p.project_id=$id";
		$query = $this->db->query($SQL);
		return $res = $query->result_array();
	}
	public function insert_permit($permit, $project) {
		$this->db->where('project_id', $project);
		return $this->db->update('profile_details', $permit);
	}
	public function profile_exist($id) {
		$this->db->select('count(*)');
		$this->db->from('profile_details');
		$this->db->where('project_id', $id);
		return $this->db->get()->result_array();
	}
	public function get_permision($id) {
		$this->db->select('permit');
		$this->db->from('profile_details');
		$this->db->where('project_id', $id);
		return $this->db->get()->result_array();
	}
	public function checkstat($project, $apid) {

		$sql = "select  COUNT(DISTINCT status) as tot from  approvals where project_id=$project and approvals=$apid and status='3'";
		$query = $this->db->query($sql);

		return $res = $query->result_array();
	}
	public function filter_details($st, $fr, $to) {
		$sql = "select * from staff s, work_entry w,project p  where s.staff_code= w.staff_id and  w.project_id= p.project_id and date(w.created_at) between '$fr' and '$to' and w.staff_id=$st";
		$query = $this->db->query($sql);

		return $res = $query->result_array();

	}
	public function get_logo_details() {
		$this->db->select('logo');
		$this->db->from('ta_expense');
		// $this->db->where('estimate_id', $estimate) ;
		return $this->db->get()->result_array();
	}

	public function add_photo_vault($data) {
		return $this->db->insert('photo_vault', $data);
	}
	public function get_project_details($id) {
		$sql = "select * from staff s, add_dairy d  where s.staff_code= d.staff_id and  d.project_id= $id";
		$query = $this->db->query($sql);

		return $res = $query->result_array();
	}
	public function getthat_dairy($dairy, $project) {
		$sql = "select * from staff s, add_dairy d,project_dairy_type t where s.staff_code= d.staff_id and d.type_id=t.dairy_type_id and  d.project_id= $project and d.dairy_id=$dairy";
		$query = $this->db->query($sql);

		return $res = $query->result_array();
	}
	public function photo_vault($project) {
		$this->db->select('*');
		$this->db->from('photo_vault');
		$this->db->where('project_id', $project);

		return $this->db->get()->result_array();
	}
	public function photovault_update($photovalt, $vault_id) {
		$this->db->where('vault_id', $vault_id);
		return $this->db->update('photo_vault', $photovalt);
	}
	public function get_estimate($id) {
		$sql = "select * from estimate_cost c, estimate_items i where c.estimate_id= i.estimate_id  and parent_id=$id";
		$query = $this->db->query($sql);

		return $res = $query->result_array();
	}
	public function get_parent_estimate($id) {
		$sql = "select * from estimate_cost where estimate_id=$id";
		$query = $this->db->query($sql);

		return $res = $query->result_array();
	}
	public function update_tot($data, $id) {
		$this->db->where('estimate', $id);
		return $this->db->update('estimate_values', $data);
	}

	public function get_branch() {

		$this->db->select('*');
		$this->db->from('ta_expense');
		// $this->db->where('id',$session_data[0]['id']);
		return $this->db->get()->result_array();

	}
	public function get_estimate_data($etm) {
		$session_data = $this->session->userdata('test');
		$userid = $session_data[0]['id'];
		// $this->db->select( '*');
		// $this->db->from('invoice');
		// $this->db->join('invoice_details', 'invoice.invoice_id = invoice_details.invoice_id');
		// // $this->db->where('approvals.project_id',$id) ;
		// return $this->db->get()->result_array();
		$sql = "select * from estimate_values where user_id=$userid and estimate=$etm";
		$query = $this->db->query($sql);

		$res = $query->result_array();
		return $res;
	}
	public function estimate_values($id) {

		$sql = "select * from estimate_cost   where estimate=$id";
		$query = $this->db->query($sql);

		$res = $query->result_array();
		return $res;
	}
	public function pro_type($id) {

		$sql = "select * from project p, project_type t where p.project_type_id= t.project_type_code and p.project_id=$id";
		$query = $this->db->query($sql);

		$res = $query->result_array();
		return $res;
	}
	public function delete_trans_item($delt_id) {
		$this->db->where('trans_item_id', $delt_id);
		return $this->db->delete('transmittal_items');
	}
	public function get_allowance_project($project_id) {
		$sql = "select s.project_name,s.project_id from ta_details d, project s where d.project_id= s.project_id and d.project_id=$project_id";
		$query = $this->db->query($sql);

		$res = $query->result_array();
		return $res;
	}
	public function get_allstaff_details($id) {
		$this->db->select('*');
		$this->db->from('staff_master');
		$this->db->where('staff_id', $id);
		return $this->db->get()->result_array();
		// $sql="select * from  staff_master m,staff_experience e, staff_qualification q where m.staff_id= e.staff_id and m.staff_id= q.staff_id and m.staff_id=$id";
		//          $query = $this->db->query($sql);

		//          $res=$query->result_array();
		//      return $res;

	}
	public function get_staffexperience_details($id) {
		$this->db->select('*');
		$this->db->from('staff_experience');
		$this->db->where('staff_id', $id);
		return $this->db->get()->result_array();

	}
	public function get_staff_qualification_details($id) {
		$this->db->select('*');
		$this->db->from('staff_qualification');
		$this->db->where('staff_id', $id);
		return $this->db->get()->result_array();

	}
	public function get_current_status($id) {
		$this->db->select('*');
		$this->db->from('photo_vault');
		$this->db->where('project_id', $id);
		return $this->db->get()->result_array();

	}
	public function delete_leaddoc($leaddoc_id) {
		$this->db->where('lead_doc_id', $leaddoc_id);
		return $this->db->delete('lead_document_upload');
	}
}
