toastr.options = {
  "closeButton": true,
  "debug": false,
  "newestOnTop": false,
  "progressBar": false,
  "positionClass": "toast-top-right",
  "preventDuplicates": false,
  "onclick": null,
  "showDuration": "300",
  "hideDuration": "1000",
  "timeOut": "10000",
  "extendedTimeOut": "1000",
  "showEasing": "swing",
  "hideEasing": "linear",
  "showMethod": "fadeIn",
  "hideMethod": "fadeOut"
}

var toast_notification = function(style, message) {
  toastr[style](message)
} ;

Date.prototype.addFullYear= function(y){
    this.setFullYear(this.getFullYear()+y);
    return this;
}

Date.prototype.addHours= function(h){
    this.setHours(this.getHours()+h);
    return this;
}   

Date.prototype.addMinutes= function(m){
    this.setMinutes(this.getMinutes()+m);
    return this;
}
Date.prototype.addSeconds= function(m){
    this.setSeconds(this.getSeconds()+m);
    return this;
}