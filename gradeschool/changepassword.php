 <style>
 .message {
  display: none;
  padding: 10px;
  margin-bottom: 10px;
}

.error {
  background-color: #FFCCCC;
  color: #FF0000;
}

.success {
  background-color: #CCFFCC;
  color: #008000;
}
</style>
 <!-- Page-header start -->
 <div class="page-header">
                          <div class="page-block">
                              <div class="row align-items-center">
                                  <div class="col-md-8">
                                      <div class="page-header-title">
                                          <h5 class="m-b-10">Change Password</h5>
                                      </div>
                                  </div>
                                  <div class="col-md-4">
                                      <ul class="breadcrumb-title">
                                          <li class="breadcrumb-item">
                                              <a href="./index.php?page=home"> <i class="fa fa-home"></i> </a>
                                          </li>
                                          <li class="breadcrumb-item"><a href="#!">Change Password</a>
                                          </li>
                                      </ul>
                                  </div>
                              </div>
                          </div>
                      </div>
                      <!-- Page-header end -->
                        <div class="pcoded-inner-content">
                            <!-- Main-body start -->
                            <div class="main-body">
                                <div class="page-wrapper">
                                    <!-- Page-body start -->
                                    <div class="page-body">
                                        <div class="row">
                                          <div class="col-md-12">
                                                <div class="card">
                                                    <div class="card-header">
                                                        <h5>Change Password</h5>
                                                    </div>
                                                    <div class="card-block">
                                                        <form class="form-material" id="passwordChangeForm" onsubmit="return validateForm()">
                                                            <div class="form-group form-info">
                                                                <input class="form-control" type="password" id="currentPassword" name="currentPassword" oninput="showPasswordIcon(this.value)" required>
																<span id="currentPasswordToggle" onclick="togglePassword('currentPassword')" style="transform: translateY(-50%); cursor: pointer; position: absolute; top: 50%; right: 10px;" class="fa fa-eye-slash"></span>
																<span class="form-bar"></span>
																<label class="float-label">Current Password:</label>
                                                            </div>
															<div class="form-group form-info">
                                                                 <input class="form-control" type="password" id="newPassword" name="newPassword" required>
																<span id="newPasswordToggle" onclick="togglePassword('newPassword')" style="transform: translateY(-50%); cursor: pointer; position: absolute; top: 50%; right: 10px;" class="fa fa-eye-slash"></span>
																<span class="form-bar"></span>
                                                                <label class="float-label">New Password:</label>
                                                            </div>
                                                             <div class="form-group form-info">
                                                               <input class="form-control" type="password" id="confirmPassword" name="confirmPassword" required>
															   <span id="confirmPasswordToggle" onclick="togglePassword('confirmPassword')" style="  transform: translateY(-50%);cursor: pointer; position: absolute; top: 50%; right: 10px;" class="fa fa-eye-slash"></span>
															   <span class="form-bar"></span>
                                                                <label class="float-label">Confirm New Password:</label>
                                                            </div>
															<div id="message"></div>
															<button  type="submit" name="submitchange"  id="openModalLink" class="btn btn-primary" >SAVE</button>
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
                <!-- Page-body end -->
            </div>
            <div id="styleSelector"> </div>
        </div>
    </div>
	
	<script>
		function showPasswordIcon(inputValue) {
			const eyeIcon = document.getElementById('currentPasswordToggle');
			if (inputValue.trim().length > 0) {
				eyeIcon.style.display = 'block'; // Show eye icon
			} else {
				eyeIcon.style.display = 'none'; // Hide eye icon
			}
		}
		function showPasswordIcon(inputValue) {
			const eyeIcon = document.getElementById('newPasswordToggle');
			if (inputValue.trim().length > 0) {
				eyeIcon.style.display = 'block'; // Show eye icon
			} else {
				eyeIcon.style.display = 'none'; // Hide eye icon
			}
		}
		function showPasswordIcon(inputValue) {
			const eyeIcon = document.getElementById('confirmPasswordToggle');
			if (inputValue.trim().length > 0) {
				eyeIcon.style.display = 'block'; // Show eye icon
			} else {
				eyeIcon.style.display = 'none'; // Hide eye icon
			}
		}

		function togglePassword(inputId) {
			const passwordInput = document.getElementById(inputId);
			const eyeIcon = document.getElementById(inputId + 'Toggle');

			if (passwordInput.type === 'password') {
				passwordInput.type = 'text';
				eyeIcon.classList.remove('fa-eye-slash');
				eyeIcon.classList.add('fa-eye'); // Show open eye
			} else {
				passwordInput.type = 'password';
				eyeIcon.classList.remove('fa-eye');
				eyeIcon.classList.add('fa-eye-slash'); // Show closed eye
			}
		}
	</script>
	<script>
		   function validateForm() {
			var currentPassword = document.getElementById('currentPassword').value;
			var newPassword = document.getElementById('newPassword').value;
			var confirmPassword = document.getElementById('confirmPassword').value;

			var messageElement = document.getElementById('message');

			if (newPassword !== confirmPassword) {
				showMessage('error', 'New password and confirm password do not match.');
				return false;
			}

			// You can add more validation logic here

			// Send an AJAX request to update the password
			var formData = {
				currentPassword: currentPassword,
				newPassword: newPassword
			};

			$.ajax({
				type: 'POST',
				url: 'change_password.php', // Replace with the actual server-side script URL
				data: formData,
				success: function (response) {
					if(response == "Password updated successfully."){
					showMessage('success', 'Password updated successfully!');
					}else{
					showMessage('error', 'Current password is incorrect!');
					}
				  },
				  error: function () {
					showMessage('error', 'Error updating your password!');
				  }
			});

			// Prevent form submission (for demonstration purposes)
			return false;
		}
	  function showMessage(type, text) {
  var messageElement = document.getElementById('message');
  messageElement.innerHTML = text;
  messageElement.className = 'message ' + type;
  messageElement.style.display = 'block';

  // Hide the message after 5 seconds (5000 milliseconds)
  setTimeout(function() {
    messageElement.style.display = 'none';
  }, 5000);
}
  </script>