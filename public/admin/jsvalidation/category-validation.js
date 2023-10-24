$("#CategoryFormValidation").validate({
    rules: {
        name: {
            required: true,
            minlength: 2
        },
        slug:{
            required: true,
            minlength: 2
        },
        description:{
            required: true,
            minlength: 5
        },
    },
    messages: {
        name: {
            required: "Please enter a category name",
            minlength: "Name must be at least 2 characters"
        },
        slug: {
            required: "Please enter a category slug",
            minlength: "Name must be at least 2 characters"
        },
        description: {
            required: "Please enter a category description",
            minlength: "Name must be at least 5 characters"
        },
        'images[]': {
            required: "Please choose at least one image"
        },
    },
    submitHandler: function(form) {
        form.submit();
    }
});