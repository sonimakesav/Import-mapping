
<?php
$this->load->view('header');
?>
<section class="main_content dashboard_part">
        <!-- menu  -->
    <div class="container-fluid no-gutters">
        <div class="row">
            <div class="col-lg-12 p-0">
                <div class="header_iner d-flex justify-content-between align-items-center">
                    <div class="sidebar_icon d-lg-none">
                        <i class="ti-menu"></i>
                    </div>


                </div>
            </div>
        </div>
    </div>
    <!--/ menu  -->
    <div class="main_content_iner ">
        <div class="container-fluid plr_30 body_white_bg pt_30">
            <div class="row justify-content-center">
                <div class="col-12">
                    <div class="QA_section">
                        <div class="white_box_tittle list_header">
                            <h4>Table</h4>

                        </div>
                        <div style="color:red;">
                            <?php
$error_msg = "";
if ($this->session->flashdata('error_msg') && $this->session->flashdata('error_msg') != "") {
	$error_msg = $this->session->flashdata('error_msg');
}
echo $error_msg;
?>
                        </div>
                        <div style="color:green;">
                            <?php
$success_msg = "";
if ($this->session->flashdata('success_msg') && $this->session->flashdata('success_msg') != "") {
	$success_msg = $this->session->flashdata('success_msg');
}
echo $success_msg;
?>
                        </div>
                        <div class="main_content_iner ">
                            <div class="container-fluid plr_30 body_white_bg pt_30">
                                <div class="row justify-content-center">
                                    <div class="col-lg-6">
                                        <div class="white_box mb_80">
                                            <form action="<?php echo base_url() ?>import-csv" method="post" enctype="multipart/form-data" id="import_form">
                            <div style="margin-bottom:40px;">
                                <input type="file" name="file" style="display:inline-block;"/>
                                <input type="submit" class="btn btn-primary" name="importBtn" value="IMPORT">
                            </div>
                        </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<!-- footer part -->
<div class="footer_part">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="footer_iner text-center">
                    <p>2020 © Influence - Designed by <a href="#"> <i class="ti-heart"></i> </a><a href="#"> Dashboard</a></p>
                </div>
            </div>
        </div>
    </div>
</div>
</section>
<?php
$this->load->view('footer');
?>
