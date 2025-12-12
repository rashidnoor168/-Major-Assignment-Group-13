jQuery(".form-valide").validate({
    ignore: [],
    errorClass: "invalid-feedback animated fadeInDown",
    errorElement: "div",
    errorPlacement: function(error, element) {
        jQuery(element).parents(".form-group > div").append(error);
    },
    highlight: function(element) {
        jQuery(element).closest(".form-group").removeClass("is-invalid").addClass("is-invalid");
    },
    success: function(element) {
        jQuery(element).closest(".form-group").removeClass("is-invalid");
        jQuery(element).remove();
    },
    rules: {
        "val-date": {
            required: true
        },
        "val-email": {
            required: true,
            email: true
        },
        "val-password": {
            required: true,
            minlength: 5
        },
        "val-confirm-password": {
            required: true,
            equalTo: "#val-password"
        },
        "val-select2": {
            required: true
        },
        "val-select2-multiple": {
            required: true,
            minlength: 2
        },
        "val-suggestions": {
            required: true,
            minlength: 5
        },
        "val-skill": {
            required: true
        },
        "val-currency": {
            required: true,
            currency: ["$", true]
        },
        "val-website": {
            required: true
        },
        "val-remark": {
            required: true
        },
        "leave-type": {
            required: true
        },
        "leave-cat": {
            required: function(element) {
                var val = jQuery("#leave-cat").val();
                if (val == 'Full Day') {
                    jQuery("#leave-date").removeAttr('required');
                    jQuery("#time-period").removeAttr('required');
                    jQuery("#start-date").prop('required', true);
                    jQuery("#end-date").prop('required', true);
                } else if (val == 'Half Day') {
                    jQuery("#start-date").removeAttr('required');
                    jQuery("#end-date").removeAttr('required');
                    jQuery("#leave-date").prop('required', true);
                    jQuery("#time-period").prop('required', true);
                }
                return true;
            }
        },
        "tour-cat": {
            required: function(element) {
                var val = jQuery("#tour-cat").val();
                if (val == 'Full Day') {
                    jQuery("#leave-date").removeAttr('required');
                    jQuery("#time-period").removeAttr('required');
                    jQuery("#start-date").prop('required', true);
                    jQuery("#end-date").prop('required', true);
                } else if (val == 'Half Day') {
                    jQuery("#start-date").removeAttr('required');
                    jQuery("#end-date").removeAttr('required');
                    jQuery("#leave-date").prop('required', true);
                    jQuery("#time-period").prop('required', true);
                }
                return true;
            }
        },
        "remarks": {
            required: true
        },
        "val-phoneus": {
            required: true,
            phoneUS: true
        },
        "val-digits": {
            required: true,
            digits: true
        },
        "val-number": {
            required: true,
            number: true
        },
        "val-range": {
            required: true,
            range: [1, 5]
        },
        "val-terms": {
            required: true
        },
        "firstname": {
            required: true
        },
        "lastname": {
            required: true
        },
        "emailid": {
            required: true
        },
        "pwd": {
            required: true
        },
        "department": {
            required: true
        }
    },
    messages: {
        "val-date": {
            required: "Please select a date"
        },
        "val-email": "Please enter a valid email address",
        "val-password": {
            required: "Please provide a password",
            minlength: "Your password must be at least 5 characters long"
        },
        "val-confirm-password": {
            required: "Please provide a password",
            minlength: "Your password must be at least 5 characters long",
            equalTo: "Please enter the same password as above"
        },
        "val-select2": "Please select a value!",
        "val-select2-multiple": "Please select at least 2 values!",
        "val-suggestions": "What can we do to become better?",
        "val-skill": "Please select office location",
        "val-currency": "Please enter a price!",
        "val-website": "Please select office location",
        "val-remark": "Please enter remark",
        "leave-type": "Please select leave type",
        "leave-cat": "Please select leave category",
        "start-date": "Please select start date",
        "end-date": "Please select end date",
        "leave-date": "Please select date",
        "time-period": "Please select time period",
        "remarks": "Please enter remark",
        "tour-cat": "Please select tour category",
        "val-phoneus": "Please enter a US phone!",
        "val-digits": "Please enter only digits!",
        "val-number": "Please enter a number!",
        "val-range": "Please enter a number between 1 and 5!",
        "val-terms": "You must agree to the service terms!"
    }
});
