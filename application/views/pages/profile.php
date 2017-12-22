<div class="panel panel-success">
	<div class="panel-heading">
    	<h3 class="panel-title"><?php echo $contentHeader; ?></h3>
  	</div>
	<div class="panel-body">

		<div class="nav-tabs-custom">
			<ul class="nav nav-tabs">
			  <li role="presentation" class="<?php echo $option=='profileDetails'?'active':'';?>"><a href="<?php echo base_url()?>profile/index/profileDetails">Profile</a></li>
			  <li role="presentation" class="<?php echo $option=='changePassword'?'active':'';?>"><a href="<?php echo base_url()?>profile/index/changePassword">Change Password</a></li>
			</ul>
			<div class="tab-content">
				<div class="tab-pane <?php echo $option=='profileDetails'?'active':'';?>">
		        	<div class="page-header">
						<h3>Profile Details</h3>
					</div>	
					<form action="<?php echo base_url()?>profile/index/profileDetails" id="updateProfileForm" class="form-horizontal ng-pristine ng-valid" method="post">	                
						<fieldset>
		                	<div class="form-group">
		                        <label class="col-sm-2 control-label" for="name">Username</label>
		                        <div class="col-sm-8">
		                            <input type="text" id="username" name="username" value="<?php echo $loggedIn['username']; ?>" class="form-control" placeholder="Username" disabled="1">	                        
		                        </div>
		                    </div>
		                    
		                    <div class="form-group">
		                        <label class="col-sm-2 control-label" for="name">Full Name</label>
		                        <div class="col-sm-8">
		                            <input type="text" id="name" name="name" value="<?php echo $loggedIn['fullname']; ?>" class="form-control" placeholder="Name">	                        
		                        </div>
		                    </div>

		                    <div class="form-group">
		                        <label class="col-sm-2 control-label" for="email">Email</label>
		                        <div class="col-sm-8">
		                            <input type="text" id="email" name="email" value="<?php echo $loggedIn['email']; ?>" class="form-control" placeholder="Name">	                        
		                        </div>
		                    </div>
		                    <div class="form-group">
		                        <label class="col-sm-2 control-label" for="phone">Phone</label>
		                        <div class="col-sm-8">
		                            <input type="text" id="phone" name="phone" value="<?php echo $loggedIn['phone']; ?>" class="form-control" placeholder="Name">	                        
		                        </div>
		                    </div>
		                    <div class="form-group">
		                        <label class="col-sm-2 control-label" for="address">address</label>
		                        <div class="col-sm-8">
		                            <input type="text" id="address" name="address" value="<?php echo $loggedIn['address']; ?>" class="form-control" placeholder="Name">	                        
		                        </div>
		                    </div>


		                    <div class="form-group">
		                        <div class="col-sm-offset-2 col-sm-8">                            
		                        	<input class="btn btn-primary" type="submit" name="submit" value="Save">
		                        </div>
		                    </div>

		                </fieldset>
		            </form>
				</div>
	
				<div class="tab-pane <?php echo $option=='changePassword'?'active':'';?>" >
		        	<div class="page-header">
						<h3>Change Password</h3>
					</div>
					<form action="<?php echo base_url()?>profile/index/changePassword" id="changePasswordForm" class="form-horizontal ng-pristine ng-valid" method="post">					
						<br>
						<br>
						<div class="form-group">
							<label class="col-sm-2 control-label" for="oldpassword">Old Password</label>
							<div class="col-sm-8">
								<input type="password" name="oldpassword" class="form-control" id="oldpassword" placeholder="Old Password" required="">
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label" for="password">New Password</label>
							<div class="col-sm-8">
								<input type="password" name="password" class="form-control" id="newpassword" placeholder="New Password" required="">
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label" for="cpassword">Confirm Password</label>
							<div class="col-sm-8">
								<input type="password" name="cpassword" class="form-control" id="confpassword" placeholder="Confirm Password" required="">
							</div>
						</div>
						<div class="form-group">
							<div class="col-sm-offset-2 col-sm-8">
								<input class="btn btn-primary" type="submit" name="submit" value="Save">
							</div>
						</div>					
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
	</div>
</div>
