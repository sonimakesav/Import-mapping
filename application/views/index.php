
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
                            <h3>Employee Details</h3>
                            <div class="box_right d-flex lms_block">
                        <!--         <div class="serach_field_2">
                                    <div class="search_inner">
                                        <form Active="#">
                                            <div class="search_field">
                                                <input type="text" placeholder="Search content here...">
                                            </div>
                                            <button type="submit"> <i class="ti-search"></i> </button>
                                        </form>
                                    </div>
                                </div> -->
                                <div class="add_button ml-10">
                                    <a href="#" data-toggle="modal" data-target="#addcategory" class="btn_1" >Add New</a>
                                    <a href="<?php echo base_url() ?>upload-csv"  class="btn_1" >Upload Csv</a>
                                </div>
                            </div>
                        </div>

                        <div class="QA_table ">
                            <!-- table-responsive -->
                            <table class="table lms_table_active">
                                <thead>
                                    <tr>
                                        <th scope="col">No.</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Code</th>
                                        <th scope="col">Age</th>
                                        <th scope="col">Experience</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
$count = 1;
foreach ($data as $row) {
	$from = new DateTime($row["dob"]);
	$to = new DateTime('today');
	$fromjoin = new DateTime($row["exp"]);
	?>
                                    <tr>
                                        <th scope="row"> <a href="#" class="question_content"><?php echo $count++; ?></a></th>
                                        <td><?php echo $row["name"]; ?></td>
                                        <td><?php echo $row["code"]; ?></td>
                                        <td><?php echo $from->diff($to)->y; ?></td>
                                        <td><?php echo $fromjoin->diff($to)->y; ?></td>
                                        <td><a href="#" class="status_btn">Active</a></td>
                                    </tr>
                                    <?php
}
?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal HTML Markup -->
<div id="addcategory" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title text-xs-center">Ad Employee Details</h4>
            </div>
            <div class="modal-body">
                <form role="form" method="POST" action="" id="employeeForm">
                    <input type="hidden" name="_token" value="">
                    <div class="form-group">
                        <label class="control-label">Name</label>
                        <div>
                            <input type="text" class="form-control input-lg" name="employee" id="name" value="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Employee Code</label>
                        <div>
                            <input type="text" class="form-control input-lg" name="code" id="code" readonly="true" value="<?php echo rand(100000, 999999) ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Date of Birth</label>
                        <div>
                            <input type="text" class="form-control input-lg" id="start_datepicker" name="dob" id="db">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Join Date</label>
                        <div>
                            <input type="text" class="form-control input-lg" name="exprience"  id="end_datepicker">
                        </div>
                    </div>
             <!--        <div class="form-group">
                        <div>
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="remember"> Remember Me
                                </label>
                            </div>
                        </div>
                    </div> -->
                    <div class="form-group">
                        <div>
                            <button type="submit" class="btn btn-info btn-block" id="add">Add Employee</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer text-xs-center">
                Don't have an account? <a href="/auth/register">Sign up »</a>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
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
        $('#employeeForm').validate({
                rules : {
                    employee : {
                        required: true
                    },
                    code : {
                        required: true
                    },
                    dob : {
                        required: true
                    },
                    exprience : {
                        required: true,
                        digits:true
                    },
                },
                 messages : {
                     employee : "This field is required",
                     code : "This field is required",
                      dob : "This field is required",
                       exprience : "This field is required",

                 },
                submitHandler: function(form) {
                form.submit();
            },

        });


    $('#add').click(function(e) {
            e.preventDefault();
            var name = $('#name').val();
            alert(name);
            var code = $('#code').val();
            var start_datepicker = $('#start_datepicker').val();
            var exp = $('#exp').val();
            // console.log(name+","+code+","+start_datepicker+","+exp);
            $.ajax({
                url: "<?php echo base_url() ?>add-employee",
                data: {
                    e_name:name,
                    code:code,
                    dob:start_datepicker,
                    exp:exp

                },

                method: "POST",
                success: function(response) {

                    location.reload();

                },
                error: function(response) {
                    console.log(response)
                }
            });
        });

    });
    </script>