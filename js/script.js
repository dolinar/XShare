$(document).ready(function () {
	$('body').on('click', '#button-login', function () {
		if (!$('#username').val() || !$('#password').val()) {
			displayInfoModal('Login', 'Username and/or password missing.');
		} else {
			$.ajax({
				type: 'POST',
				url: '/handle-login.php',
				data: $('#login-form').serialize(),
				success: function (data) {
					if (data.trim() == 1) {
						displayInfoModal('Login', 'Login successful! Redirecting to front page in 2 seconds...');
						setTimeout(function() { window.location = '/'; }, 2000);
					} else if (data.trim() == 0) {
						displayInfoModal('Login', 'Wrong username or password.');
					} else {
						displayInfoModal('Login', 'Something went wrong.');
					}
				}
			});
		}
	});
});

$(document).ready(function () {
	$('body').on('click', '#button-sign-up', function () {
		//alert($('#password').val() + ' ' + $('#password-second').val());
		if ($('#password').val() != $('#password-second').val()) {
			displayInfoModal('Registration', 'Passwords do not match!');
		} else if (!$('#username').val() || !$('#password').val() || !$('#password-second').val() || !$('#mail').val()) {
			displayInfoModal('Login', 'Enter all fields.');
		} else {
			$.ajax({
				type: 'POST',
				url: '/handle-sign-up.php',
				data: $('#sign-up-form').serialize(),
				success: function (data) {
					if (data.trim() == 0) {
						displayInfoModal('Registration', 'Username is already in use.');
					} else if (data.trim() == 1) {
						displayInfoModal('Registration', 'Registration successful, you can now log in! Redirecting to front page in 3 seconds...');
						setTimeout(function() { window.location = '/'; }, 3000);
					} else {
						displayInfoModal('Registration', 'Something went wrong.');
						alert(data);
					}
				}
			});
		}
	});
});

function displayInfoModal(name, info) {
	$('#info-modal').modal('show');
	$('#info-modal').find('h4').html(name);
	$('#info-modal').find('p').html(info);
}

$(document).ready(function (e) {
	$("#uploadimage").on('submit',(function(e) {
		if ($('#name').val() == '') {
			alert('nope');
		} else if (!$('#file').val()) {
			alert('no file');
		} else {
			e.preventDefault();
			var form = document.getElementById('uploadimage');
			var formData = new FormData(form);
			$("#message").empty();
			$('#loading').show();
			$.ajax({
				url: "upload.php", // Url to which the request is send
				type: "POST",             // Type of request to be send, called as method
				data: formData, 		  // Data sent to server, a set of key/value pairs (i.e. form fields and values)
				contentType: false,       // The content type used when sending data to the server.
				cache: false,             // To unable request pages to be cached
				processData:false,        // To send DOMDocument or non processed data file it is set to false
				success: function(data) { // A function to be called if request succeeds
					$('#loading').hide();
					$("#message").html(data);
				}
			});
		}
	}));
	// Function to preview image after validation
	$(function() {
		$("#file").change(function() {
			$("#message").empty(); // To remove the previous error message
			var file = this.files[0];
			var imagefile = file.type;
			var match = ["image/jpeg","image/png","image/jpg"];
			if(!((imagefile==match[0]) || (imagefile==match[1]) || (imagefile==match[2]))) {
				$('#previewing').attr('src','noimage.png');
				$("#message").html("<p id='error'>Please Select A valid Image File</p>"+"<h4>Note</h4>"+"<span id='error_message'>Only jpeg, jpg and png Images type allowed</span>");
				return false;
			} else {
				var reader = new FileReader();
				reader.onload = imageIsLoaded;
				reader.readAsDataURL(this.files[0]);
			}
		});
	});

	function imageIsLoaded(e) {
		$("#file").css("color","green");
		$('#image_preview').css("display", "block");
		$('#previewing').attr('src', e.target.result);
		$('#previewing').attr('width', '250px');
		$('#previewing').attr('height', '230px');
	};
});

$(document).ready(function () {
	if (top.location.pathname === '/') {
    	var offsetVar = 0;
		var nearToBottom = 0;
		loadImages(offsetVar);
		offsetVar += 8;
		$(window).scroll(function(){
			if($(window).scrollTop() == $(document).height() - $(window).height()) { 
				
				loadImages(offsetVar);
				offsetVar += 8;
				
			}
		});
	}
});

function loadImages(offsetVar) {
	$.ajax({
		type: 'POST',
		url: '/handle-public-gallery.php',
		data: {offset : offsetVar},
		success: function(data) { 
			$('#public-gallery').append(data); 
		}
	});
}