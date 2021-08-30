
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
    <?php
$csv_data = $this->session->userdata('csv');
?>
    <!--/ menu  -->
    <div class="main_content_iner ">
        <div class="container-fluid plr_30 body_white_bg pt_30">
            <div class="row justify-content-center">
                <div class="col-12">
                    <div class="QA_section">
                        <div class="white_box_tittle list_header">
                            <h4>Mapping</h4>
                            <div class="box_right d-flex lms_block">
                                <div class="serach_field_2">
                                    <div class="search_inner">
                                        <form Active="#">
                                            <div class="search_field">
                                                <input type="text" placeholder="Search content here...">
                                            </div>
                                            <button type="submit"> <i class="ti-search"></i> </button>
                                        </form>
                                    </div>
                                </div>

                            </div>
                        </div>

                        <div class="QA_table ">
                            <!-- table-responsive -->
                            <table class="table lms_table_active">
                                <thead>
                                    <tr>
                                        <th scope="col"></th>
                                        <th scope="col"><select id="first-col"><option value="employee_name" selected>Name</option><option value="employee_code" >Code</option><option value="dob" >Date of Birth</option><option value="experience" >Join date</option></select></th>
                                        <th scope="col"><select id="second-col"><option value="employee_name" >Name</option><option value="employee_code" selected>Code</option><option value="dob" >Date of Birth</option><option value="experience" >Join date</option></select></th>
                                        <th scope="col"><select id="third-col"><option value="employee_name" >Name</option><option value="employee_code" >Code</option><option value="dob" selected>Date of Birth</option><option value="experience" >Join date</option></select></th>
                                        <th scope="col"><select id="forth-col"><option value="employee_name" >Name</option><option value="employee_code" >Code</option><option value="dob" >Date of Birth</option><option value="experience" selected>Join date</option></select></th>
                                    </tr>
                                </thead>
                                <tbody>
                                <textarea style="display:none;"  name="" id="csv" values=""><?php echo $csv_data; ?></textarea>
                                <?php
$count = 1;
$data = json_decode($csv_data, TRUE);
foreach ($data as $row) {
	?>
                                    <tr>
                                        <th scope="row"> <a href="#" class="question_content"><?php echo $count++; ?></a></th>
                                        <td><?php echo $row["Name"]; ?></td>
                                        <td><?php echo $row["Code"]; ?></td>
                                        <td><?php echo $row["DOB"]; ?></td>
                                        <td><?php echo $row["Join Date"]; ?></td>
                                    </tr>

                                    <?php
}
?>

                                </tbody>
                            </table>
                        </div>
                        <a href=""  class="btn_1" id="add">Continue</a>
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
<script>
    $(document).ready(function () {
    $('#add').click(function(e) {
            e.preventDefault();
            var first = $('#first-col').val();
            var second = $('#second-col').val();
            var third = $('#third-col').val();
            var forth = $('#forth-col').val();
            var csv = $('#csv').val();

            $.ajax({
                url: "<?php echo base_url() ?>cv-data-import",
                data: {
                    first:first,
                    second:second,
                    third:third,
                    forth:forth,
                    csv:csv
                },
                method: "POST",
                success: function(response) {
                    // redirect('/');
                     window.location.href = "<?php echo base_url() ?>";
                },
                error: function(response) {
                    console.log(response)
                }
            });
        });

    });
    </script>