$("#ProductFormValidation").validate({
    rules: {
        name: {
            required: true,
            minlength: 2
        },
        slug: {
            required: true,
            minlength: 2
        },
        description: {
            required: true,
            minlength: 5
        },
        small_description: {
            required: true,
            minlength: 5
        },
        original_price: {
            number: true,
            min: 0
        },
        selling_price: {
            number: true,
            min: 0
        },
        quantity: {
            required: true,
            digits: true,
            min: 1
        }
    },
    messages: {
        name: {
            required: "Please enter a product name",
            minlength: "Name must be at least 2 characters"
        },
        slug: {
            required: "Please enter a product slug",
            minlength: "Slug must be at least 2 characters"
        },
        small_description: {
            required: "Please enter a product small description",
            minlength: "Description must be at least 5 characters"
        },
        description: {
            required: "Please enter a product description",
            minlength: "Description must be at least 5 characters"
        },
        original_price: {
            number: "Please enter a valid number",
            min: "Price must be greater than 0"
        },
        selling_price: {
            number: "Please enter a valid number",
            min: "Price must be greater than 0"
        },
        quantity: {
            required: "Please enter the quantity",
            digits: "Please enter a valid quantity",
            min: "Quantity must be at least 1"
        }
    },
    submitHandler: function(form) {
        form.submit();
    }
});
