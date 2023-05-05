<script>
	$(function () {
	    $('#addOffice').validate({
	        rules: {
	            office_name: {
	                required: true
	            },
	            office_abbr: {
	                required: true
	            }
	        },
	        messages: {
	            office_name: {
	                required: "Please enter a Office name"
	            },
	            office_abbr: {
	                required: "Please enter a Office Abbreviation"
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
	    $('#editOffice').validate({
	        rules: {
	            office_name: {
	                required: true
	            },
	            office_abbr: {
	                required: true
	            }
	        },
	        messages: {
	            office_name: {
	                required: "Please enter a Office name"
	            },
	            office_abbr: {
	                required: "Please enter a Office Abbreviation"
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