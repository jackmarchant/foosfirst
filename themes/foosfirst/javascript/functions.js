var foosfirst = {
    init : function () {
        this.formMessage.timeoutMessage();
    },
    formMessage : {
        timeoutMessage : function () {
            setTimeout(function () {
                if ($('.message').length > 0) {
                    $('.message').fadeOut(300);
                }
            }, 5000);
        }
    }
}

$(document).ready(function () {
    foosfirst.init();
});