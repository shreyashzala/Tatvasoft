if (window.location.href.indexOf('#loginmodal') != -1) {
        $('#loginmodal').modal('show');
        $('#loginmodal .close').click(function () {
          window.location.href = "";
        });
    
}
