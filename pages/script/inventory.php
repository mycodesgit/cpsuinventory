<script>
	$(function () {
	    $('#addInventory').validate({
	        rules: {
	            property_no: {
	                required: true
	            },
	            qty: {
	                required: true
	            },
	            description: {
	                required: true
	            },	   
	            specification: {
	                required: true
	            },
	            acquisition_date: {
	                required: true
	            },     
	            unit: {
	                required: true
	            },
	            unit_value: {
	                required: true
	            },
	            classification_id: {
	                required: true
	            },
	            end_user: {
	                required: true
	            },
	            where_about: {
	                required: true
	            },
				remarks: {
	                required: true
	            }
	        },
	        messages: {
	            property_no: {
	                required: "Please enter a Property Number"
	            },
				qty: {
	                required: "Please enter a Qty"
	            },
				description: {
	                required: "Please enter a Description"
	            },
				specification: {
	                required: "Please enter a Specification"
	            },
				acquisition_date: {
	                required: "Please enter a Acquisition Date"
	            },
				unit: {
	                required: "Please enter a Unit"
	            },
				unit_value: {
	                required: "Please enter a Unit Value"
	            },
				classification_id: {
	                required: "Please select a Classification"
	            },
				end_user: {
	                required: "Please enter a End User"
	            },
				where_about: {
	                required: "Please select a Where About"
	            },
				remarks: {
	                required: "Please select a remarks"
	            }
	        },
	        errorElement: 'span',
	        errorPlacement: function (error, element) {
	            error.addClass('invalid-feedback');
	            element.closest('.col-md-4').append(error);
				element.closest('.col-md-8').append(error);
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