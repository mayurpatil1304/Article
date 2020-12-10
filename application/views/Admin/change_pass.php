<?php include('header.php'); ?>

<div class="container" style="margin-top: 20px ">
	<h1>Change Password</h1>

<body class="hold-transition sidebar-mini">
	<div class="wrapper">
		
		<div class="content-wrapper">
			<section class="content-header">
				<div class="container-fluid">
					
				</div>
			</section>
			<section class="container">
				<div class="container-fluid">
					<div class="row">
						<div class="col-mg-7">
							<div class="card card-primary">
								<div class="card-header">
									<h3 class="card_title"> Change Password</h3>
								</div>
								<form method="post" id="password_form" >
									<div class="card-body">
										<div class="form_group">
											<label for="Password"> Old Password<span class="text-danger">*</span>></label>
											<input type="password" name="old_pass" class="form-control" id="old_pass" tabindex="1">
											<div class="error" id="password_error"></div>
										</div>
										<div class="form_group">
											<label for="Password"> New Password<span class="text-danger">*</span>></label>
											<input type="password" name="new_pass" class="form-control" id="new_pass" tabindex="1">
											<div class="error" id="password_error"></div>
										</div>
										<div class="form_group">
											<label for="Password"> Confirm Password<span class="text-danger">*</span>></label>
											<input type="password" name="conf_pass" class="form-control" id="conf_pass" tabindex="1">
											<div class="error" id="password_error"></div>
										</div>
										<div class="form-group mb-0">
											<div class="custom-control custom-checkbox">
												<input type="checkbox" name="terms" class="custom-control-input" id="exampleCheck1">
												<label class="custom-control-label" for="exampleCheck1">I agree to the<a href="#">terms of service</a>.</label>
											</div>
										</div>
									</div>
									<div class="card-footer">
										<button type="submit" id="check_password" name="check_password" class="btn btn-primary" value="check_password"> Change password</button>
									</div>
								</form>
							</div>
						</div>
						<div class="col-mg-6"></div>
					</div>
				</div>
			</section>
		</div>
		<aside class="control-sidebar control-sidebar-dark">
			
		</aside>
	</div>
	<script>
		$(documemt).ready(function()
		{
			$('#password_form').validate({
				rules:{
					old_pass:{required:true},
					new_pass:{required:true},
					conf_pass:{equalTo:"#new_pass"},
				},
				message:{
					new_pass:{required:"Please enter first Name"},
					old_pass:{required:"Please Enter New password"},
					conf_pass:{required:"Plese enter correct password"},
				},
				submitHandle: function(form)
				{
					form.submit();
				}
			});
		});
		$("#old_pass").keyup(function()
		{
			$.ajax({
				url:"<?=base_url()?>admin"
			})
		})
</body>





	