$("#CustomerFormValidation").validate({
    rules: {
        user_id: {
            required: true,
        },
        name: {
            required: true,
            minlength: 2
        },
        phone: {
            required: true,
            minlength: 11,
            maxlength: 11
        },
        pin_code: {
            required: true,
            minlength: 6
        },
        address: {
            required: true,
            minlength: 5
        },
        'images[]': {
            required: true
        },
    },
    messages: {
        user_id: {
            required: "Please select a user",
        },
        name: {
            required: "Please enter a name",
            minlength: "Name must be at least 2 characters"
        },
        phone: {
            required: "Please enter a phone number",
            minlength: "Phone number should be 11 characters"
        },
        pin_code: {
            required: "Please enter a pin code",
            minlength: "Pincode should be 6 characters"
        },
        address: {
            required: "Please enter an address",
            minlength: "Address must be at least 5 characters"
        },
        'images[]': {
            required: "Please choose at least one image"
        },
    },
    submitHandler: function(form) {
        form.submit();
    }
});