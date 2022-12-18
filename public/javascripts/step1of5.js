(function () {
    var t = document.getElementById("step1of5Form");

    FormValidation.formValidation(t, {
        fields: {
            fn: {
                validators: {
                    notEmpty: { message: "Please enter first name " },
                },
            },
            ln: {
                validators: {
                    notEmpty: { message: "Please enter last name " },
                },
            },
            gender: {
                validators: {
                    notEmpty: { message: "Please select a gender" },
                },
            },
            phone: {
                validators: {
                    notEmpty: { message: "Please enter phone number" },
                },
            },
            country: {
                validators: {
                    notEmpty: { message: "Please select a city" },
                },
            },
            year: {
                validators: {
                    notEmpty: { message: "Please select a year" },
                },
            },
            date: {
                validators: {
                    notEmpty: { message: "Please select a day" },
                },
            },
            month: {
                validators: {
                    notEmpty: { message: "Please select a month" },
                },
            },
        },
        plugins: {
            trigger: new FormValidation.plugins.Trigger(),
            bootstrap: new FormValidation.plugins.Bootstrap5({
                eleValidClass: "",
                rowSelector: function (e, t) {
                    return ".mb-3";
                },
            }),
            submitButton: new FormValidation.plugins.SubmitButton({}),
            autoFocus: new FormValidation.plugins.AutoFocus(),
        },
    }).on("core.form.valid", function () {
        let formData = new FormData(t);
        let url = `${assetsPath}/api/user/first_step`;
        let obj = [];

        for (const [key, value] of formData) {
            obj[key] = value;
        }

        obj = { ...obj };
        $.post(url, obj, function (data) {
            if (data.result == "success") {
                location.href = "<?= url('/step/2'); ?>";
            }
        });
    });
})();
