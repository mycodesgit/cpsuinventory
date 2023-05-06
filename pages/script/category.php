<script>
	$(function () {
	    $('#addCat').validate({
	        rules: {
	            category_name: {
	                required: true
	            }	        },
	        messages: {
	            category_name: {
	                required: "Please enter a Category Name"
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
	    $('#editCat').validate({
	        rules: {
	            category_name: {
	                required: true
	            }	        },
	        messages: {
	            category_name: {
	                required: "Please enter a Category Name"
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