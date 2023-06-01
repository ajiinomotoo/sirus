var form = $("#rjFormStep");
form.validate({
    debug: true,
    rules: {
        reg_no: {
            required: true,
            minlength: 7
        },
        poli_id_step2: {
            required: true
        },
        dr_id_step2: {
            required: true
        },
        klaim_id_step2: {
            required: true
        }
    },
    messages: {
        reg_no: {
            required: "Nomor Registrasi Kosong",
            minlength: jQuery.validator.format("At least 7 characters required!")
        },
        poli_id_step2: {
            required: "Poli Tidak Boleh Kosong !"
        },
        dr_id_step2: {
            required: "Dokter Tidak Boleh Kosong !"
        },
        klaim_id_step2: {
            required: "Klaim Tidak Boleh Kosong !"
        }
    }
});
form.children("div").steps({
    headerTag: "h2",
    bodyTag: "section",
    transitionEffect: "slideLeft",
    onStepChanging: function (event, currentIndex, newIndex) {
        form.validate().settings.ignore = ":disabled,:hidden";
        return form.valid();
    },
    onFinishing: function (event, currentIndex) {
        form.validate().settings.ignore = ":disabled";
        return form.valid();
    },
    onFinished: function (event, currentIndex) {

        console.log(form.serialize());
        alert("Submitted!");
    }
});