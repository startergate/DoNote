var saveEnable = function(res) {
  if (res) {
    $("#saveBtnTop").removeAttr("disabled", "none");
    $("#saveBtnBottom").removeAttr("disabled", "none");
  }
};
var saveDisable = function() {
  $("#saveBtnTop").attr("disabled", "disabled");
  $("#saveBtnBottom").attr("disabled", "disabled");
};
