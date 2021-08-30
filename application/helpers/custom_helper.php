<?php
defined('BASEPATH') OR exit('No direct script access allowed');

//		$this->load->model('Mainmodel');
//		$this->load->library('session');
function projects()
{
    $CI=get_instance();
    $CI->load->model('Mainmodel');
   $data= $CI->Mainmodel->project_loop();
    $total_project=$data[0]['total'];
    if($total_project>0)
    {
         $data_project=$CI->Mainmodel->project_userid();
        return $data_project;
    }
   
    
  
       // return $data;
}
function get_countprojects()
{
    $CI=get_instance();
    $CI->load->model('Mainmodel');
   
    
    
         $data_project=$CI->Mainmodel->countproject();
         $data=count($data_project);
        return $data;
    
   
    
  
       // return $data;
}
function subprojects($projectid)
{
   
    $CI=get_instance();
    $CI->load->model('Mainmodel');
   $data= $CI->Mainmodel->subproject_loop($projectid);
    $total_subproject=$data[0]['total'];
    if($total_subproject>0)
    {
         $data_subproject=$CI->Mainmodel->subproject_userid($projectid);
        return $data_subproject;
    }
   
    
 

}

function subprojects1($projectid)
{
   
    $CI=get_instance();
    $CI->load->model('Mainmodel');
   $data= $CI->Mainmodel->subproject_loop1($projectid);
    return $data;

}


function milestones($projectid)
{
    $CI=get_instance();
    $CI->load->model('Mainmodel');
    $data= $CI->Mainmodel->get_milestone($projectid);
//    print_r($data);
     $total_milestone=$data[0]['total'];
    
//    print_r($total_milestone);
    if($total_milestone>0)
    {
        $data_milestone=$CI->Mainmodel->milestone_data($projectid); 
//        print_r($data_milestone);
        return $data_milestone;
    }
	
	
}


function staff_project_map($projectid)
{
    $CI=get_instance();
    $CI->load->model('Mainmodel');
    $data= $CI->Mainmodel->get_staff_project_map($projectid);
//    print_r($data);
     $total_staff_map=$data[0]['total'];
    
//    print_r($total_milestone);
    if($total_staff_map>0)
    {
        $data_staff_project=$CI->Mainmodel->staff_project_map_data($projectid); 
//        print_r($data_milestone);
        return $data_staff_project;
    }
}
function get_staff_name($staffid)
{
	$CI=get_instance();
    $CI->load->model('Mainmodel');
	return $result = $CI->Mainmodel->get_staffname($staffid);
	
}
function get_milestones($statusid)
{
	 $CI=get_instance();
    $CI->load->model('Mainmodel');
    $data= $CI->Mainmodel->get_milestones($statusid);
	return $data;
}


function get_staff_project_map($staff_code)
{
      $CI=get_instance();
      $CI->load->model('Mainmodel');
      $data= $CI->Mainmodel->getall_staff_project_map($staff_code);
      return $data;
}

function status()
{
        $CI=get_instance();
      $CI->load->model('Mainmodel');
      $data= $CI->Mainmodel->get_milestone_status();
      return $data;
}

function get_count_of_clients()
{
  $CI=get_instance();
      $CI->load->model('Mainmodel');
      $data= $CI->Mainmodel->get_all_clients();
      $count_data=count($data);
      return $count_data;
  
}
function get_staff_project_map1($staff_code)
{
      $CI=get_instance();
      $CI->load->model('Mainmodel');
      $data= $CI->Mainmodel->getall_staff_project_map1($staff_code);
      return $data;
}
function get_count_of_staffs()
{
   $CI=get_instance();
      $CI->load->model('Mainmodel');
      $data= $CI->Mainmodel->get_staff();
      $count_staff=count($data);
      return $count_staff;
  
}

   function get_milestone()
{
        $CI=get_instance();
      $CI->load->model('Mainmodel');
      $data= $CI->Mainmodel->getall_milestone();
      return $data;
}

function get_status_name($staffid)
{
	$CI=get_instance();
    $CI->load->model('Mainmodel');
	return $result = $CI->Mainmodel->get_status_name($staffid);
}

function current_status($milestone_id)
{
	$CI=get_instance();
    $CI->load->model('Mainmodel');
	return $result = $CI->Mainmodel->current_status($milestone_id);
	
}




function status_entry()
{
	$CI=get_instance();
    $CI->load->model('Mainmodel');
	return $result = $CI->Mainmodel->get_status_entry();
	
}


function get_project_name($projectid)
{
	$CI=get_instance();
    $CI->load->model('Mainmodel');
	return $result = $CI->Mainmodel->get_project_name($projectid);
	
}

function get_weeklyy_project_name($projectid)
{
  $CI=get_instance();
    $CI->load->model('Mainmodel');
  return $result = $CI->Mainmodel->get_weeklyy_project_name($projectid);
  
}
function get_site_supervisor($projectid)
{
  $CI=get_instance();
    $CI->load->model('Mainmodel');
  return $result = $CI->Mainmodel->get_site_supervisor($projectid);
}


function get_supervisor_name($user_id)
{
  $CI=get_instance();
    $CI->load->model('Mainmodel');
  return $result = $CI->Mainmodel->user_sel($user_id);
  
}

function get_client_under_project($projectid)
{
  $CI=get_instance();
    $CI->load->model('Mainmodel');
  return $result = $CI->Mainmodel->get_client_under_project($projectid);
}


function get_client_name($client_id)
{
  $CI=get_instance();
    $CI->load->model('Mainmodel');
  return $result = $CI->Mainmodel->get_client_name($client_id);
}


function get_stafftype_name($stafftype)
{
	$CI=get_instance();
    $CI->load->model('Mainmodel');
	return $result = $CI->Mainmodel->get_staff_type_name($stafftype);
	
}
function get_lead_name($leadid)
{
	$CI=get_instance();
    $CI->load->model('Mainmodel');
	return $result = $CI->Mainmodel->get_lead_name($leadid);
	
}
function leads($leadid)
{
	$CI=get_instance();
    $CI->load->model('Mainmodel');
	return $result = $CI->Mainmodel->lead_sel($leadid);
	
}
function get_all_leads()
{
  $CI=get_instance();
    $CI->load->model('Mainmodel');
  return $result = $CI->Mainmodel->get_all_leads();
}

function get_document($projectid)
{
    $CI=get_instance();
    $CI->load->model('Mainmodel');
	return $result = $CI->Mainmodel->getdocument($projectid);
}
function get_doc_name($docid)
{
    $CI=get_instance();
    $CI->load->model('Mainmodel');
	return $result = $CI->Mainmodel->get_documents_name($docid);
}
function get_drawing($projectid)
{
    $CI=get_instance();
    $CI->load->model('Mainmodel');
	return $result = $CI->Mainmodel->getdrawing($projectid);
}
function getdrawingcount($projectid,$date)
{
    $CI=get_instance();
    $CI->load->model('Mainmodel');
  return $result = $CI->Mainmodel->getdrawingcount($projectid,$date);
}

// function get_drawing_name($drawid)
// {
//     $CI=get_instance();
//     $CI->load->model('Mainmodel');
// 	return $result = $CI->Mainmodel->get_drawings_name($drawid);
// }
function get_labour_type($labour_type_id)
{
    $CI=get_instance();
    $CI->load->model('Mainmodel');
	return $result = $CI->Mainmodel->labourtype_sel_name($labour_type_id);
} 
function get_laboursupplier($labour_supplier_id)
{
    $CI=get_instance();
    $CI->load->model('Mainmodel');
	return $result = $CI->Mainmodel->laboursupplier_sel_name($labour_supplier_id);
} 
function get_staff_type_name($staff_type_code)
{
    $CI=get_instance();
    $CI->load->model('Mainmodel');
	return $result = $CI->Mainmodel->stafftype_sel_name($staff_type_code);
} 
function stafflogin_stafftype()
{
	$CI=get_instance();
    $CI->load->model('Mainmodel');
	return $result = $CI->Mainmodel->stafflogin_stafftype();
}
function stafflogin_preference()
{
	$CI=get_instance();
    $CI->load->model('Mainmodel');
	return $result = $CI->Mainmodel->stafflogin_preference();
}
function heads()
{
	$CI=get_instance();
    $CI->load->model('Mainmodel');
	return $result = $CI->Mainmodel->get_headid();
	
}
function head_name($headsid)
{
	$CI=get_instance();
    $CI->load->model('Mainmodel');
	return $result = $CI->Mainmodel->head_name($headsid);
}
function sub_head_name($headid)
{
	$CI=get_instance();
    $CI->load->model('Mainmodel');
	return $result = $CI->Mainmodel->sub_head_name($headid);
	
}
function detail($sub_headid)
{
	$CI=get_instance();
    $CI->load->model('Mainmodel');
	return $result = $CI->Mainmodel->detail($sub_headid);
}

function sub_detail($sub_headid1)
{
	$CI=get_instance();
    $CI->load->model('Mainmodel');
	return $result = $CI->Mainmodel->sub_detail($sub_headid1);
}

function get_heads($head)
{
	$CI=get_instance();
    $CI->load->model('Mainmodel');
	return $result = $CI->Mainmodel->get_heads($head);
}
function get_purch_item($slno)
{
	$CI=get_instance();
    $CI->load->model('Mainmodel');
	return $result = $CI->Mainmodel->get_purchase_item($slno);
}
function get_material_item($material_id)
{
	$CI=get_instance();
    $CI->load->model('Mainmodel');
	return $result = $CI->Mainmodel->get_material_sel($material_id);
}
function get_grn_data($sl_no)
{
	$CI=get_instance();
    $CI->load->model('Mainmodel');
	return $result = $CI->Mainmodel->get_grn_data($sl_no);
}
  function get_grn_item($slno)
 {
     $CI=get_instance();
    $CI->load->model('Mainmodel');
	return $result = $CI->Mainmodel->get_grn_item($slno);
 }
function get_states()
 {
     $CI=get_instance();
    $CI->load->model('Mainmodel');
	return $result = $CI->Mainmodel->get_states();
 }
function get_material()
 {
     $CI=get_instance();
    $CI->load->model('Mainmodel');
	return $result = $CI->Mainmodel->get_material();
 }
function get_supplier()
 {
     $CI=get_instance();
    $CI->load->model('Mainmodel');
	return $result = $CI->Mainmodel->get_supplier();
 }
function get_supplierses($id)
 {
     $CI=get_instance();
    $CI->load->model('Mainmodel');
	return $result = $CI->Mainmodel->get_supplierses($id);
 }
function get_states_id($sid)
 {
     $CI=get_instance();
    $CI->load->model('Mainmodel');
	return $result = $CI->Mainmodel->get_states_id($sid);
 }
function get_dealer($dealerid)
 {
     $CI=get_instance();
    $CI->load->model('Mainmodel');
	return $result = $CI->Mainmodel->get_dealer($dealerid);
 }

 function project_name($projectid)
 {
     $CI=get_instance();
    $CI->load->model('Mainmodel');
  return $result = $CI->Mainmodel->project_name($projectid);
 }

function timeline_project($projectid)
 {
     $CI=get_instance();
    $CI->load->model('Mainmodel');

  return $result = $CI->Mainmodel->get_project_workentry($projectid);
 }


 function timeline_project_date($projectid,$time)
 {
     $CI=get_instance();
    $CI->load->model('Mainmodel');
  return $result = $CI->Mainmodel->get_workentry_date_project($projectid,$time);
 }
 function total_hours($projectid,$time)
 {
  $CI=get_instance();
    $CI->load->model('Mainmodel');
  return $result = $CI->Mainmodel->total_hours($projectid,$time);
 }

  function total_drawing($projectid,$time)
 {
  $CI=get_instance();
    $CI->load->model('Mainmodel');
  return $result = $CI->Mainmodel->getdrawingcount($projectid,$time);
 }

  function total_documents($projectid,$time)
 {
  $CI=get_instance();
    $CI->load->model('Mainmodel');
  return $result = $CI->Mainmodel->getdocumentcount($projectid,$time);
 }
 function view_allwork_entry_date($projectid,$date)
 {
  $CI=get_instance();
    $CI->load->model('Mainmodel');
  return $result = $CI->Mainmodel->view_allwork_entry_date($projectid,$date);
 }

 function view_timeline_drawings($projectid,$date)
 {
  $CI=get_instance();
    $CI->load->model('Mainmodel');
  return $result = $CI->Mainmodel->view_timeline_drawings($projectid,$date);
 }
  function view_timeline_documents($projectid,$date)
 {
  $CI=get_instance();
    $CI->load->model('Mainmodel');
  return $result = $CI->Mainmodel->view_timeline_documents($projectid,$date);
 }
   function view_timeline_photo_vault($projectid,$date)
 {
  $CI=get_instance();
    $CI->load->model('Mainmodel');
  return $result = $CI->Mainmodel->view_timeline_photo_vault($projectid,$date);
 }
   function get_photo_vault_count($projectid,$date)
 {
  $CI=get_instance();
    $CI->load->model('Mainmodel');
  return $result = $CI->Mainmodel->get_photo_vault_count($projectid,$date);
 }
 function get_lead_documents($leadid)
 {
  $CI=get_instance();
    $CI->load->model('Mainmodel');
  return $result = $CI->Mainmodel->get_lead_documents($leadid);
 }
function get_lead_milestone($leadid)
{


 $CI=get_instance();
    $CI->load->model('Mainmodel');
    $data= $CI->Mainmodel->count_get_lead_milestone($leadid);
//    print_r($data);
     $total_milestone=$data[0]['total'];
    
//    print_r($total_milestone);
    if($total_milestone>0)
    {
        $data_milestone=$CI->Mainmodel->get_lead_milestone($leadid); 
//        print_r($data_milestone);
        return $data_milestone;
    }




  // $CI=get_instance();
  //   $CI->load->model('Mainmodel');
  // return $result = $CI->Mainmodel->get_lead_milestone($leadid);
}
 function lead_milestone_current_status($mid)
{
  $CI=get_instance();
    $CI->load->model('Mainmodel');
  return $result = $CI->Mainmodel->lead_milestone_current_status($mid);
  
}
 function get_lead_milestone_status()
{
  $CI=get_instance();
    $CI->load->model('Mainmodel');
  return $result = $CI->Mainmodel->get_lead_milestone_status();
  
}

function document_sel($docid)
{
$CI=get_instance();
    $CI->load->model('Mainmodel');
  return $result = $CI->Mainmodel->document_sel($docid);
}

function lead_sel($leadid)
{
  $CI=get_instance();
    $CI->load->model('Mainmodel');
  return $result = $CI->Mainmodel->lead_sel($leadid);
}
function get_mainteam_under_staff($staff_id)
{
  $CI=get_instance();
    $CI->load->model('Mainmodel');
  return $result = $CI->Mainmodel->get_mainteam_under_staff($staff_id);
}




function get_team_staff_milestones($staff_parent_id,$projectid)
{
    $CI=get_instance();
    $CI->load->model('Mainmodel');
    $data= $CI->Mainmodel->get_staff_milestone($staff_parent_id,$projectid);
    return $data;

  
  
}
function get_team_main_milestones($projectid)
{
    $CI=get_instance();
    $CI->load->model('Mainmodel');
    $data= $CI->Mainmodel->get_team_main_milestones($projectid);
    return $data;

  
  
}
function get_team_main_staff_milestones($projectid)
{
    $CI=get_instance();
    $CI->load->model('Mainmodel');
    $data= $CI->Mainmodel->get_team_main_milestones($projectid);
    return $data;

  
  
}
function team_milestone($projectid)
{
    $CI=get_instance();
    $CI->load->model('Mainmodel');
    $data= $CI->Mainmodel->get_team_main_milestones_data($projectid);
    return $data;

  
  
}
// function get_all_workentry($projectid)
// {
//   $CI=get_instance();
//     $CI->load->model('Mainmodel');
//     $data= $CI->Mainmodel->get_all_workentry($projectid);
//     return $data;
// }
function get_project_type_name($projecttypeid)
{
  $CI=get_instance();
    $CI->load->model('Mainmodel');
    $data= $CI->Mainmodel->get_project_type_name($projecttypeid);
    return $data;
}
function get_project_stage($stage_id)
{
  $CI=get_instance();
    $CI->load->model('Mainmodel');
    $data= $CI->Mainmodel->get_project_stage($stage_id);
    return $data;
}
function get_all_project_drawings_under_stage_id($stage_id,$project_type_code)
{
  $CI=get_instance();
    $CI->load->model('Mainmodel');
    $data= $CI->Mainmodel->get_all_project_drawings($stage_id,$project_type_code);
    return $data;
}
function get_all_project_stages($project_type_code)
{
  $CI=get_instance();
    $CI->load->model('Mainmodel');
    $data= $CI->Mainmodel->get_all_project_stages($project_type_code);
    return $data;
}

// function view_weekly_report($project_code)
// {
//   $CI=get_instance();
//     $CI->load->model('Mainmodel');
//     $data= $CI->Mainmodel->view_weekly_report($project_code);
//     return $data;
// }

function get_all_project_sub_drawings($drawing_id,$stage_id,$project_type_code1)
{
  $CI=get_instance();
    $CI->load->model('Mainmodel');
    $data= $CI->Mainmodel->get_all_project_sub_drawings($drawing_id,$stage_id,$project_type_code1);
    return $data;
}

function project_drawing_name($project_drawing_id)
{
  $CI=get_instance();
    $CI->load->model('Mainmodel');
    $data= $CI->Mainmodel->project_drawing_name($project_drawing_id);
    return $data;
}

function project_sub_drawing_name($project_sub_drawing_id)
{
  $CI=get_instance();
    $CI->load->model('Mainmodel');
    $data= $CI->Mainmodel->get_project_sub_drawings_details($project_sub_drawing_id);
    return $data;
}


function get_checked_by_spinner()
{
  
}

function get_team_lead_parent_id_report($staff_id)
{
  $CI=get_instance();
    $CI->load->model('Mainmodel');
    $data= $CI->Mainmodel->get_team_lead_parent_id_report($staff_id);
    return $data;
}
function get_pro_meeting_depend_stage_id($stage_id,$project_type_code)
{
  $CI=get_instance();
    $CI->load->model('Mainmodel');
    $data= $CI->Mainmodel->get_pro_meeting_depend_stage_id($stage_id,$project_type_code);
    return $data;
}

function project_meeting_name($meeting_id)
{
  $CI=get_instance();
    $CI->load->model('Mainmodel');
    $data= $CI->Mainmodel->project_meeting_name($meeting_id);
    return $data;
}
function get_expense_head_details_head_id($head_id)
{
   $CI=get_instance();
    $CI->load->model('Mainmodel');
    $data= $CI->Mainmodel->get_expense_head_details_head_id($head_id);
    return $data;
}

function get_heads_except_id($head_id)
{
    $CI=get_instance();
    $CI->load->model('Mainmodel');
    $data= $CI->Mainmodel->get_heads_except_id($head_id);
    return $data;
}
function get_ta_expense_head_details($ta_expense_id)
{
  $CI=get_instance();
    $CI->load->model('Mainmodel');
    $data= $CI->Mainmodel->get_ta_expense_head_details($ta_expense_id);
    return $data;
}
function get_trasmital_item_data_master_id($trans_master_id)
{
  $CI=get_instance();
    $CI->load->model('Mainmodel');
    $data= $CI->Mainmodel->get_trasmital_item_data_master_id($trans_master_id);
    return $data;
}
function get_all_transmital_master($project_id)
{
  $CI=get_instance();
    $CI->load->model('Mainmodel');
    $data= $CI->Mainmodel->get_all_transmital_master($project_id);
    return $data;
}

function get_all_transmital_data($trans_master_id)
{
  $CI=get_instance();
    $CI->load->model('Mainmodel');
    $data= $CI->Mainmodel->get_all_transmital_data($trans_master_id);
    return $data;
}
function get_staff_in_transmital($staff_id)
{
  $CI=get_instance();
    $CI->load->model('Mainmodel');
    $data= $CI->Mainmodel->get_staff_in_transmital($staff_id);
    return $data;
}

function get_main_project()
{
   $CI=get_instance();
    $CI->load->model('Mainmodel');
    $data= $CI->Mainmodel->get_main_project();
    return $data;
}

function get_subproject_under_project($project_id)
{
  $CI=get_instance();
    $CI->load->model('Mainmodel');
    $data= $CI->Mainmodel->get_subproject_under_project($project_id);
    return $data;
}
// function get_expense_heads_in_expense_entry($head_id)
// {
//   $CI=get_instance();
//     $CI->load->model('Mainmodel');
//     $data= $CI->Mainmodel->get_expense_heads_in_expense_entry($head_id);
//     return $data;
// }

////sonima


// function get_doc_count($lead)
// {
//   $CI=get_instance();
//       $CI->load->model('Mainmodel');
//   return $result = $CI->Mainmodel->count_client_doc($lead);
  
// }



function get_sub1($sub)
{

    
$CI=get_instance();
      $CI->load->model('Mainmodel');
    $result = $CI->Mainmodel->sub_estimate_items($sub);

?>
                      <ul class="sub-menus">
                              <?php
                            foreach ($result as $main) {
                                $head= $main['estimate_id'];
                
              ?>
                              <li class="has-children">
                                      <input type="checkbox" name ="sub-group-<?php echo $main['estimate_id'];?>" id="sub-group-<?php echo $main['estimate_id'];?>">
                                      <label class="estimate" for="sub-group-<?php echo $main['estimate_id'];?>"><?php echo $main['item_name'];?>
                                                                        <?php
        if($main['sub_item']=='f' && $main['is_isset']=='1' )
                              {
                                  ?>
                                                                      <span class="team-span">
                                                                              <button class="btn btn-primary btn-icon itemdet" parnt="<?php echo $main['estimate_id'];?>"><i class="fa fa-plus"></i></button>
                                                                              <button class="btn btn-warning btn-icon edititemdet" editparnt="<?php echo $main['estimate_id'];?>" "><i class="fa fa-pencil"></i></button>
                                                                                  <button class="btn btn-danger btn-icon deltitemdet" det="<?php echo $main['estimate_id'];?>"> <i class="fa fa-trash"></i> </button>
                                                                      </span>
                                                                      <?php
      }
      else{
      ?>
      <span class="team-span">
        <button class="btn btn-primary btn-icon itemdet" parnt="<?php echo $main['estimate_id'];?>"> <i class="fa fa-plus"></i> </button>
        </span>
        <?php
        }?>
                                      </label>

                              <?php
                              if($main['sub_item']==TRUE)
                              {
                              $code= $main['estimate_id'];
                              $sublist= get_sub1($code);
                      }
                              ?>

                              </li>
                                <?php
              }
              ?>
                      </ul>
<?php
}


 function get_subestimatelist($estimate)
{
          $CI=get_instance();
          $CI->load->model('Mainmodel');
          $data= $CI->Mainmodel->subestimatelist($estimate);
          return $data;
}


 function allowance_exsist($staff)
{
  $CI=get_instance();
      $CI->load->model('Mainmodel');
  return $result = $CI->Mainmodel->ta_exist($staff);
  
}
function get_staff_details()
 {
     $CI=get_instance();
    $CI->load->model('Mainmodel');
  return $result = $CI->Mainmodel->getmemebers_details();
 }
 function get_mainteam_staff()
 {
     $CI=get_instance();
    $CI->load->model('Mainmodel');
  return $result = $CI->Mainmodel->get_mainteam_staff();
 }
 function get_mainteam_code()
 {
     $CI=get_instance();
    $CI->load->model('Mainmodel');
  return $result = $CI->Mainmodel->get_maincode();
 }

function get_editdetails_estimate1($id)
{
          $CI=get_instance();
          $CI->load->model('Mainmodel');
          $data= $CI->Mainmodel->list_details_ets($id);
          return $data;
}
function get_details_estimate1($id)
{
          $CI=get_instance();
          $CI->load->model('Mainmodel');
          $data= $CI->Mainmodel->listestim($id);
          return $data;
}
function get_detailsesti($id)
{
          $CI=get_instance();
          $CI->load->model('Mainmodel');
          $data= $CI->Mainmodel->listestim12($id);
          return $data;
}
function get_editdetails_estimate2($id,$estimate)
{
          $CI=get_instance();
          $CI->load->model('Mainmodel');
          $data= $CI->Mainmodel->subestimatelist($id,$estimate);
          return $data;
}

 ///
 function get_substaff()
 {
     $CI=get_instance();
    $CI->load->model('Mainmodel');
  return $result = $CI->Mainmodel->get_substaff();
 }
 function test_fun()
 {
  echo "hai";
 }
 // function get_deatils($projectid)
 // {
 //     $CI=get_instance();
 //    $CI->load->model('Mainmodel');
 //  return $result = $CI->Mainmodel->get_deatils($projectid);
 // }


function get_main_projects()
{
   
    $CI=get_instance();
    $CI->load->model('Mainmodel');
   $data= $CI->Mainmodel->project_userid();
    
    return $data;

}


function get_sub_projects($id)
{
   
    $CI=get_instance();
    $CI->load->model('Mainmodel');
   $data= $CI->Mainmodel->get_subproject_userid($id);
    
    return $data;

}




  function list_sublist($sub)
 {
  echo $sub;
     $CI=get_instance();
    $CI->load->model('Mainmodel');
  return $result = $CI->Mainmodel->get_sublist($sub);
 }
  function details()
 {
     $CI=get_instance();
    $CI->load->model('Mainmodel');
  return $result = $CI->Mainmodel->details();
 }
 function get_sub($sub)
 {

   
$CI=get_instance();
    $CI->load->model('Mainmodel');
   $result = $CI->Mainmodel->get_sublist($sub);

?>
            <ul class="sub-menus">
                <?php
               foreach ($result as $main) {
                 $head= $main['team_code'];
         
        ?>
                <li class="has-children">
                    <input type="checkbox" name ="sub-group-<?php echo $main['staff_id'];?>" id="sub-group-<?php echo $main['staff_id'];?>">
                    <label class="estimate" for="sub-group-<?php echo $main['staff_id'];?>"><?php echo $main['staff_name'];?><span class="team-span"><button class="btn btn-primary btn-icon grp" mid="<?php echo $main['staff_id'];?>"><i class="fa fa-plus"></i></button>


                <button class="btn btn-warning btn-icon update" onclick="location.href='<?php echo base_url('Maincontroller/team_edit?id='.$head.'')?>'" sub="<?php echo $main['staff_id'];?>" subcod="<?php echo $head;?>"><i class="fa fa-pencil"></i></button></span></label>

                <?php
                if($main['grp']==TRUE)
                {
                $code= $main['team_code'];
                $sublist= get_sub($code);
            }
                ?>

                </li>
                 <?php
        }
        ?>
            </ul>
<?php
}
 function get_mainstaff()
 {
     $CI=get_instance();
    $CI->load->model('Mainmodel');
  return $result = $CI->Mainmodel->get_substaff();
 }
  function get_member($id_)
 {
     $CI=get_instance();
    $CI->load->model('Mainmodel');
  return $result = $CI->Mainmodel->get_sublist($id_);
 }
function get_checklist_details()
{
    
      $CI=get_instance();
      $CI->load->model('Mainmodel');
    $data= $CI->Mainmodel->check_list_details();
      return $data;

}
   function get_check($id)
{
    
      $CI=get_instance();
      $CI->load->model('Mainmodel');
    $data= $CI->Mainmodel->checkde($id);
      return $data;

}

 // 13.04.2018
function get_types()
{
              $CI=get_instance();
          $CI->load->model('Mainmodel');
          $data= $CI->Mainmodel->get_dairy_types();
          return $data;
}
function get_dairy_entries($get_id)
{
    
      $CI=get_instance();
      $CI->load->model('Mainmodel');
    $data= $CI->Mainmodel->dairy_details($get_id);
      
      return $data;

}
// 14.04.2018
function get_team_deldetails($tem)
{
    
      $CI=get_instance();
      $CI->load->model('Mainmodel');
    $data= $CI->Mainmodel->team_deldetails($tem);
      
      return $data;

}
function get_type_details()
{
    
      $CI=get_instance();
      $CI->load->model('Mainmodel');
    $data= $CI->Mainmodel->type_details();
      
      return $data;

}
// 18.04.2018
function get_milestones_staff($idpr)
{
  $CI=get_instance();
      $CI->load->model('Mainmodel');
  return $result = $CI->Mainmodel->get_milestones_staff($idpr);
  
}
function check_profile_exsist($a)
{
  $CI=get_instance();
      $CI->load->model('Mainmodel');
  return $result = $CI->Mainmodel->profile_exsist($a);
  
}
function get_site_count($a)
{
  $CI=get_instance();
      $CI->load->model('Mainmodel');
  return $result = $CI->Mainmodel->site_exsist($a);
  
}

  function assign_milestone($idpr)
{
  $CI=get_instance();
      $CI->load->model('Mainmodel');
  return $result = $CI->Mainmodel->get_assign_milestone($idpr);
  
}
//  function drawing_doc_count($project_id) 
// {
//   $CI=get_instance();
//       $CI->load->model('Mainmodel');
//   return $result = $CI->Mainmodel->count_drawing_doc($project_id);
  
// }
function feestructure_exsist($a)
{
  $CI=get_instance();
      $CI->load->model('Mainmodel');
  return $result = $CI->Mainmodel->fee_exsist($a);
  
}
function get_fee_details($id)
{
  $CI=get_instance();
      $CI->load->model('Mainmodel');
  return $result = $CI->Mainmodel->fee_details($id);
  
}
function get_approvalist_details()
{
  $CI=get_instance();
      $CI->load->model('Mainmodel');
  return $result = $CI->Mainmodel->approvalist_details();
  
}
function get_apprvcount($id,$pro)
{
  $CI=get_instance();
      $CI->load->model('Mainmodel');
  return $result = $CI->Mainmodel->get_apprvcount($id,$pro);
  
}
function get_clientdoc_details($id_lead)
{
  $CI=get_instance();
      $CI->load->model('Mainmodel');
  return $result = $CI->Mainmodel->clientdoc_details($id_lead);
  
}
function get_doc_count($lead)
{
  $CI=get_instance();
      $CI->load->model('Mainmodel');
  return $result = $CI->Mainmodel->count_client_doc($lead);
  
}
function get_clientdocuments($doc_id)
{
  $CI=get_instance();
      $CI->load->model('Mainmodel');
  return $result = $CI->Mainmodel->clientdocuments($doc_id);
  
}
// function dateName($date) {

//                 $result = "";

//                 $convert_date = strtotime($date);
//                 $month = date('F',$convert_date);
//                 $year = date('Y',$convert_date);
//                 $name_day = date('l',$convert_date);
//                 $day = date('j',$convert_date);


//                 $result = $day . " " . $day . ", " . $year . " - " . $name_day;

//                 return $result;
//         }
// 08.05.2018
function drawing_doc_count($project_id) 
{
  $CI=get_instance();
      $CI->load->model('Mainmodel');
  return $result = $CI->Mainmodel->count_drawing_doc($project_id);
  
}
    
        function get_submission_docs($project)
{
  $CI=get_instance();
      $CI->load->model('Mainmodel');
  return $result = $CI->Mainmodel->submission_docs($project);
  
}   
function get_drawing_documents($doc_drawid)
{
  $CI=get_instance();
      $CI->load->model('Mainmodel');
  return $result = $CI->Mainmodel->drawingdocuments($doc_drawid);
  
}         
// function other_apprv_count($project_id)
// {
//     $CI=get_instance();
//         $CI->load->model('Mainmodel');
//     return $result = $CI->Mainmodel->othrapcont($project_id);
  
// }       
function get_other_docs($id)
{
  $CI=get_instance();
      $CI->load->model('Mainmodel');
  return $result = $CI->Mainmodel->othrapdoc($id);
  
} 
function get_other_docslist($id)
{
  $CI=get_instance();
      $CI->load->model('Mainmodel');
  return $result = $CI->Mainmodel->othrapdoclist($id);
  
}     
function get_invoice_num()
{
        $CI=get_instance();
      $CI->load->model('Mainmodel');
  return $result = $CI->Mainmodel->invoice_num();
}
function get_projects()
{
  $CI=get_instance();
      $CI->load->model('Mainmodel');
  return $result = $CI->Mainmodel->get_project();
  
}
function get_invoice_details()
{
  $CI=get_instance();
      $CI->load->model('Mainmodel');
  return $result = $CI->Mainmodel->get_invoice();
  
}
function get_estimate_items()
{
          $CI=get_instance();
          $CI->load->model('Mainmodel');
          $data= $CI->Mainmodel->estimate_items();
          return $data;
}
function get_subestimate_items($estimate)
{
          $CI=get_instance();
          $CI->load->model('Mainmodel');
          $data= $CI->Mainmodel->sub_estimate_items($estimate);
          return $data;
}
function get_details_estimate()
{
          $CI=get_instance();
          $CI->load->model('Mainmodel');
          $data= $CI->Mainmodel->details_estimate();
          return $data;
}
  function get_estimate_num()
{
        $CI=get_instance();
      $CI->load->model('Mainmodel');
  return $result = $CI->Mainmodel->estimate_num();
}
function max_id($get_id)
{
          $CI=get_instance();
          $CI->load->model('Mainmodel');
          $data= $CI->Mainmodel->get_max_id($get_id);
          return $data;
}


function mincount($get_id,$daiy_id)
{
          $CI=get_instance();
          $CI->load->model('Mainmodel');
          $data= $CI->Mainmodel->get_mincount($get_id,$daiy_id);
          return $data;
}
function min_id($get_id)
{
          $CI=get_instance();
          $CI->load->model('Mainmodel');
          $data= $CI->Mainmodel->get_min_id($get_id);
          return $data;
}
function maxcount($get_id,$daiy_id)
{
          $CI=get_instance();
          $CI->load->model('Mainmodel');
          $data= $CI->Mainmodel->get_maxcount($get_id,$daiy_id);
          return $data;
}

function get_nextdairy_entries($get_id,$diary)
{
    
      $CI=get_instance();
      $CI->load->model('Mainmodel');
    $data= $CI->Mainmodel->nextdairy_details($get_id,$diary);
      
      return $data;

}
function get_daiycount($get_id)
{
    
      $CI=get_instance();
      $CI->load->model('Mainmodel');
    $data= $CI->Mainmodel->diary_count($get_id);
      
      return $data;

}
function invoice_data($id)
{
 $CI=get_instance();
   $CI->load->model('Mainmodel');
 return $result = $CI->Mainmodel->invoice_values($id);
 
}
function get_project_type($id)
{
          $CI=get_instance();
          $CI->load->model('Mainmodel');
          $data= $CI->Mainmodel->get_all_project_type($id);
          return $data;
}
function get_ta_details($ta)
{
      $CI=get_instance();
      $CI->load->model('Mainmodel');
      $data= $CI->Mainmodel->get_allowance($ta);
      return $data;
}
function get_cout_get_all_leads()
{
 $CI=get_instance();
   $CI->load->model('Mainmodel');
  $data= $CI->Mainmodel->get_all_leads();
  $count_data=count($data);
     return $count_data;
   
}
function get_staff_type_except_stafftype_code($staff_type_code)
{
 $CI=get_instance();
  $CI->load->model('Mainmodel');
 $data= $CI->Mainmodel->get_staff_type_except_stafftype_code($staff_type_code);
 
    return $data;
}
 function getsubtask($sub)
 {

   
$CI=get_instance();
    $CI->load->model('Mainmodel');
   $result = $CI->Mainmodel->subestimatelist($sub);

?>
            <ul class="sub-menus">
                <?php
               foreach ($result as $main) {
                 $head= $main['estimate_id'];
         
        ?>
              <tr>
                      <td></td>
                       <td><?php echo $main['item_name'];?></td>
                             <td><?php echo $main['area'];?></td>
                             
                            <td><?php echo $main['unit'];?></td>
                            <td></td> 
                            <td></td>
                      <td><a class="btn btn-danger delete" delt="<?php echo $main['cost_estim_id'];?>"><i class="fa fa-trash"></i></a></td>
                    </tr>
                    <?php
                    if($main['sub_item']=="t"){
                      echo "gdhf";
                      $code= $main['estim_val_id'];
                      $sublist= getsubtask($code);

                      }
                      ?>
                 <?php
        }
        ?>
            </ul>
<?php
}
function countprofile_details($id)
{
  $CI=get_instance();
      $CI->load->model('Mainmodel');
      $data= $CI->Mainmodel->get_all_projectdetails($id);
      $count_data=count($data);
      return $count_data;
  
}
// function profile_details($id)
// {
//           $CI=get_instance();
//           $CI->load->model('Mainmodel');
//           $data= $CI->Mainmodel->get_profiledetails($id);
//           return $data;
// }
function get_job_no()
{
  $CI=get_instance();
  $CI->load->model('Mainmodel');
 $data= $CI->Mainmodel->get_job_number();
 $job_no_increment=$data[0]['get_new_job_no'];
 $result= $CI->Mainmodel->get_ta_expense();
 if($result)
 {
  $branch_code= $result[0]['branch_code'];
  $year=date("y"); 
  $job_no=$branch_code.$job_no_increment."/".$year;
  }
  else
  {
    $job_no='';
  }
  
  return $job_no;
}
function get_all_staff_transmital_master($project_id)
{
 $CI=get_instance();
   $CI->load->model('Mainmodel');
   $data= $CI->Mainmodel->get_all_staff_transmital_master($project_id);
   return $data;
}
function get_projects_projectid($project_id)
{
 $CI=get_instance();
   $CI->load->model('Mainmodel');
   $data= $CI->Mainmodel->get_projects_projectid($project_id);
   return $data;
}
function get_projects_project_id($project_id)
{
  $CI=get_instance();
   $CI->load->model('Mainmodel');
   $data= $CI->Mainmodel->get_projects_project_id($project_id);
   return $data;
}
function get_consultanttype()
{
   
    $CI=get_instance();
    $CI->load->model('Mainmodel');
   $data= $CI->Mainmodel->consultanttype();
    return $data;

}
function get_type_name($typ)
{
   $CI=get_instance();
    $CI->load->model('Mainmodel');
    $data= $CI->Mainmodel->get_typename($typ);
  return $data;
}

function get_consultant()
{
   $CI=get_instance();
    $CI->load->model('Mainmodel');
    $data= $CI->Mainmodel->get_consultant();
  return $data;
}
function get_contractor()
{
   $CI=get_instance();
    $CI->load->model('Mainmodel');
    $data= $CI->Mainmodel->get_contractor();
  return $data;
}
 function getsubitems($sub)
 {

   
$CI=get_instance();
    $CI->load->model('Mainmodel');
   $result = $CI->Mainmodel->subestimatelist($sub);
               foreach ($result as $row1) {
                 $head= $row1['estimate_id'];
         
        ?>
              <tr>
                      <td><a class="control removeRow" href="#">x</a></td>
                      <td class="hidden"><input type="hidden" name="num" value="0"></td>
                       <td><input type="text" name="id" value="<?php echo $row1['estimate_id'];?>" readonly></td>
                     
                      <td><span><input type="text" value="<?php echo $row1['item_name'];?>" disabled/></span></td>
                      <td class="amount"><input type="text" value="<?php echo $row1['area'];?>"/></td>
                      <td class="unit"><input type="text" value="<?php echo $row1['unit'];?>"/></td>
                      <td class="rate"><input type="text" value="<?php echo $row1['rate'];?>" /></td>
                      <td><input type="text" value="0.00" class="sum" disabled/></td>
                    </tr>
                    <?php
                    if($row1['sub_item']=="t"){
                      $code= $row1['estimate_id'];
                      $sublist= getsubitems($code);

                      }
                      ?>
                 <?php
        }
}
function edit_estimate($id)
{
          $CI=get_instance();
          $CI->load->model('Mainmodel');
          $data= $CI->Mainmodel->estmmatemain($id);
          return $data;
}
function get_all_staff()
{
   $CI=get_instance();
    $CI->load->model('Mainmodel');
    $data= $CI->Mainmodel->get_staff();
  return $data;
}
// 31/07/2018
function get_all_project_sub_drawing_under_stage_id($stage_id,$project_type_code)
{
  $CI=get_instance();
    $CI->load->model('Mainmodel');
    $data= $CI->Mainmodel->get_all_project_sub_drawing_under_stage_id($stage_id,$project_type_code);
    return $data;
}
function get_project_sub_stage($sub_stage_id)
{
    $CI=get_instance();
    $CI->load->model('Mainmodel');
    $data= $CI->Mainmodel->get_project_sub_stage($sub_stage_id);
    return $data;
}
function staff_profile_details($staff_id)
{
  $CI=get_instance();
    $CI->load->model('Mainmodel');
    $data= $CI->Mainmodel->staff_profile_details($staff_id);
    return $data;
}
function assign_staff_project($staff_id)
{
  $CI=get_instance();
    $CI->load->model('Mainmodel');
    $data= $CI->Mainmodel->assign_staff_project($staff_id);
    return $data;
}
function get_staff_certificate($cv_id)
{
   $CI=get_instance();
    $CI->load->model('Mainmodel');
    $data= $CI->Mainmodel->get_staff_certificate($cv_id);
    return $data;
}
function view_weekly_report()
{
  $CI=get_instance();
    $CI->load->model('Mainmodel');
    $data= $CI->Mainmodel->view_weekly_report();
    return $data;
}
function get_all_workentry($projectid)
{
  $CI=get_instance();
    $CI->load->model('Mainmodel');
    $data= $CI->Mainmodel->get_all_workentry($projectid);
    return $data;
}
function get_sub_stage_name($sub_stage_id)
{
  $CI=get_instance();
    $CI->load->model('Mainmodel');
    $data= $CI->Mainmodel->get_sub_stage_name($sub_stage_id);
    return $data;
}















function get_all_clients_data()
{
  $CI=get_instance();
    $CI->load->model('Mainmodel');
    $data= $CI->Mainmodel->get_all_clients_data();
    return $data;
}

function get_project_stage_depend_ptid($project_type_id)
{
  $CI=get_instance();
    $CI->load->model('Mainmodel');
    $data= $CI->Mainmodel->get_project_stage_depend_ptid($project_type_id);
    return $data;
}

function get_project_sub_stage_depend_ptid($project_type_code,$stage_id)
{
  $CI=get_instance();
    $CI->load->model('Mainmodel');
    $data= $CI->Mainmodel->get_project_sub_stage_depend_ptid($project_type_code,$stage_id);
    return $data;
}
function get_all_project_drawings_under_stage($stage_id,$project_type_code,$sub_stage_id)
{
  $CI=get_instance();
    $CI->load->model('Mainmodel');
    $data= $CI->Mainmodel->get_all_project_drawings_under_stage($stage_id,$project_type_code,$sub_stage_id);
    return $data;
}

function get_pro_sub_draw_depend_drawing_id($drawing_id,$stage_id,$project_type_id,$sub_stage_id)
{
  $CI=get_instance();
    $CI->load->model('Mainmodel');
    $data= $CI->Mainmodel->get_pro_sub_draw_depend_drawing_id($drawing_id,$stage_id,$project_type_id,$sub_stage_id);
    return $data;
}


function get_pro_meeting_depend_sub_stage_id($stage_id,$project_type_code,$sub_stage_id)
{
  $CI=get_instance();
    $CI->load->model('Mainmodel');
    $data= $CI->Mainmodel->get_pro_meeting_depend_sub_stage_id($stage_id,$project_type_code,$sub_stage_id);
    return $data;
}





function staff_qualification_details($staff_id)
{
  $CI=get_instance();
    $CI->load->model('Mainmodel');
    $data= $CI->Mainmodel->staff_qualification_details($staff_id);
    return $data;
}

function staff_experiences_details($staff_id)
{
  $CI=get_instance();
    $CI->load->model('Mainmodel');
    $data= $CI->Mainmodel->staff_experiences_details($staff_id);
    return $data;
}
function get_drawing_name($drawid)
{
    $CI=get_instance();
    $CI->load->model('Mainmodel');
  return $result = $CI->Mainmodel->project_drawing_name($drawid);
}
 function profile_details($id)
{
                 $CI=get_instance();
                 $CI->load->model('Mainmodel');
                 $data= $CI->Mainmodel->get_profiledetails($id);
                 return $data;
}
function get_permision($id)
{
                 $CI=get_instance();
                 $CI->load->model('Mainmodel');
                 $data= $CI->Mainmodel->get_permision($id);
                 return $data;
}
function getstatusval($project,$apid)
{
                 $CI=get_instance();
                 $CI->load->model('Mainmodel');
                 $data= $CI->Mainmodel->checkstat($project,$apid);
                 return $data;
}
function get_logo()
{
                 $CI=get_instance();
                 $CI->load->model('Mainmodel');
                 $data= $CI->Mainmodel->get_logo_details();
                 return $data;
}
function get_branch()
{
                 $CI=get_instance();
                 $CI->load->model('Mainmodel');
                 $data= $CI->Mainmodel->get_branch();
                 return $data;
}
function estimate_data($id)
{
 $CI=get_instance();
   $CI->load->model('Mainmodel');
 return $result = $CI->Mainmodel->estimate_values($id);
 
}
function pro_type($id)
{
 $CI=get_instance();
   $CI->load->model('Mainmodel');
 return $result = $CI->Mainmodel->pro_type($id);
 
}
function get_project($id)
{
 $CI=get_instance();
   $CI->load->model('Mainmodel');
 return $result = $CI->Mainmodel->get_allowance_project($id);
 
}
function get_allstaff_details($id)
{
 $CI=get_instance();
   $CI->load->model('Mainmodel');
 return $result = $CI->Mainmodel->get_allstaff_details($id);
 
}
function get_staffexperience_details($id)
{
 $CI=get_instance();
   $CI->load->model('Mainmodel');
 return $result = $CI->Mainmodel->get_staffexperience_details($id);
 
}
function get_staff_qualification_details($id)
{
 $CI=get_instance();
   $CI->load->model('Mainmodel');
 return $result = $CI->Mainmodel->get_staff_qualification_details($id);
 
}
function get_current_status($id)
{
 $CI=get_instance();
   $CI->load->model('Mainmodel');
 return $result = $CI->Mainmodel->get_current_status($id);
 
}
?>

