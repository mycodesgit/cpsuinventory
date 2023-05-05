<script>
	$(function () {
	    $('#addClass').validate({
	        rules: {
	            class_name: {
	                required: true
	            },
	            class_code: {
	                required: true
	            }
	        },
	        messages: {
	            class_name: {
	                required: "Please enter a Classification Name"
	            },
	            class_code: {
	                required: "Please enter a Classification Code"
	            }
	        },
	        errorElement: 'span',
	        errorPlacement: function (error, element) {
	            error.addClass('invalid-feedback');
	            element.closest('.col-md-12').append(error);
	        },
	        highlight: function (element, errorClass, validClass) {
	            $(element).addClass('is-invalid');
	        },
	    });
	});
</script>

<script>
	$(function () {
	    $('#editClass').validate({
	        rules: {
	            class_name: {
	                required: true
	            },
	            class_code: {
	                required: true
	            }
	        },
	        messages: {
	            class_name: {
	                required: "Please enter a Classification Name"
	            },
	            class_code: {
	                required: "Please enter a Classification Code"
	            }
	        },
	        errorElement: 'span',
	        errorPlacement: function (error, element) {
	            error.addClass('invalid-feedback');
	            element.closest('.col-md-6').append(error);
	        },
	        highlight: function (element, errorClass, validClass) {
	            $(element).addClass('is-invalid');
	        },
	    });
	});
</script>