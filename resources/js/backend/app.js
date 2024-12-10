window.$ = window.jQuery = require("jquery");

window.mediamanager = require("./mediamanager.js");

// on click delete confirmation -- outside footable
window.confirmDelete = function (thisLink) {
    var url = $(thisLink).data("href");
    $("#delete-modal").modal("show");
    $("#delete-link").attr("href", url);
};

// on click Hidden confirmation -- outside footable
window.confirmHidden = function (thisLink) {
    var url = $(thisLink).data("href");
    $("#hide-modal").modal("show");
    $("#hide-link").attr("href", url);
};

// on click all delete confirmation -- outside footable
window.confirmAllDelete = function (thisLink) {
    var url = $(thisLink).data("href");
    $("#all-delete-modal").modal("show");
    $("#all-delete-link").attr("href", url);
};

// delete confirmation
window.deleteConfirmation = function () {
    $(".confirm-delete").click(function (e) {
        e.preventDefault();
        var url = $(this).data("href");
        $("#delete-modal").modal("show");
        $("#delete-link").attr("href", url);
    });
};

// hide confirmation
window.hideConfirmation = function () {
    $(".confirm-hide").click(function (e) {
        e.preventDefault();
        var url = $(this).data("href");
        $("#hide-modal").modal("show");
        $("#hide-link").attr("href", url);
    });
};

// approve confirmation
window.approveConfirmation = function () {
    $(".confirm-approve").click(function (e) {
        e.preventDefault();
        var url = $(this).data("href");
        $("#approve-modal").modal("show");
        $("#approve-link").attr("href", url);
    });
};
// reject confirmation
window.rejectConfirmation = function () {
    $(".confirm-reject").click(function (e) {
        e.preventDefault();
        var url = $(this).data("href");
        $("#reject-modal").modal("show");
        $("#reject-link").attr("href", url);
    });
};
// re-submit confirmation
window.reSubmitConfirmation = function () {
    $(".confirm-re-submit").click(function (e) {
        e.preventDefault();
        var url = $(this).data("href");
        $("#re-submit-modal").modal("show");
        $("#re-submit-link").attr("href", url);
    });
};
