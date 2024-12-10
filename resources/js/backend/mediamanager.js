var TT = TT || {};
TT.localize = {
    no_data_found: "No data found",
    selected_file: "Selected File",
    selected_files: "Selected Files",
    file_added: "File added",
    files_added: "Files added",
    no_file_chosen: "No file chosen",
    pleaseWait: "Please wait..",
    createContent: "Create Content",
    generateCode: "Generate Code",
    generateImage: "Generate Image",
    moveToFolder: "Move To Folder",
    moveProject: "Move Project",
    saveChanges: "Save Changes",
};
TT.baseUrl = "/";
TT.getMediaType = "all";
TT.getMediaSearch = "";
TT.allowedFileTypes = [".png", ".svg", ".gif", ".jpg", ".jpeg", ".webp"];
TT.uploadQty = "single";
TT.selectedFiles = null;
TT.nextPageUrl = null;

// get the media files via ajax
window.getMediaFiles = function (
    getMediaType = "all",
    getMediaSearch = "",
    search = false,
    divType = ""
) {
    // let url = '{{ route('uppy.index') }}';
    let url = "/media-manager/get-files";

    if (search == false) {
        $(".recent-uploads").empty();
    }
    $(".previous-uploads").empty();

    // get media files
    $.ajax({
        headers: {
            "X-CSRF-Token": $('meta[name="csrf-token"]').attr("content"),
        },
        type: "GET",
        data: {
            type: getMediaType,
            searchKey: search ? getMediaSearch : "",
            divType: divType ? divType : "",
        },
        url: url,
        success: function (data) {
            if (search == false) {
                $(".recent-uploads").append(data.recentFiles); // if !searched
            }
            $(".previous-uploads").append(data.mediaFiles);

            TT.nextPageUrl = data.mediaQuery.next_page_url;
            if (data.mediaQuery.next_page_url == null) {
                $(".load-more-media").addClass("d-none");
            } else {
                $(".load-more-media").removeClass("d-none");
            }

            // show selected counter in the media manager
            getSelectedFilesCount();

            // add active class when initialized --> delay to ready the document
            setTimeout(() => {
                activeSelectedFiles();
            }, 400);
            // initFeather();
        },
    });
};

// get next paginated files
window.getNextMediaFiles = function () {
    if (TT.nextPageUrl != null) {
        // get media files
        $.ajax({
            headers: {
                "X-CSRF-Token": $('meta[name="csrf-token"]').attr("content"),
            },
            type: "GET",
            url: TT.nextPageUrl,
            success: function (data) {
                $(".previous-uploads").append(data.mediaFiles);

                TT.nextPageUrl = data.mediaQuery.next_page_url;

                if (data.mediaQuery.next_page_url == null) {
                    $(".load-more-media").addClass("d-none");
                } else {
                    $(".load-more-media").removeClass("d-none");
                }
                // show selected counter in the media manager
                getSelectedFilesCount();

                // add active class when initialized --> delay to ready the document
                setTimeout(() => {
                    activeSelectedFiles();
                }, 400);
                // initFeather();
            },
        });
    }
};

// get the media files via ajax
window.getSelectedMediaFiles = async function (
    mediaIds,
    target = TT.showSelectedFilesDiv
) {
    // get media files
    $.ajax({
        headers: {
            "X-CSRF-Token": $('meta[name="csrf-token"]').attr("content"),
        },
        type: "GET",
        data: {
            mediaIds: mediaIds,
        },
        // url: '{{ route('uppy.selectedFiles') }}',
        url: "/media-manager/get-selected-files",
        success: function (data) {
            if ((TT.uploadQty = "single")) {
                target.children().not(".show-image-preview").remove();
            }

            target.prepend(data.mediaFiles);
            // initFeather();
        },
    });
};

// show media manager
window.showMediaManager = async function (thisWrapper) {
    // handle -> click chose file
    let selectedFilesInput = $(thisWrapper).find("input");
    TT.uploadQty = $(thisWrapper).data("selection");
    TT.selectedFiles =
        selectedFilesInput.val() != "" ? selectedFilesInput.val() : null;
    TT.selectedFilesInput = selectedFilesInput;
    TT.showSelectedFilesDiv = $(thisWrapper).parent();
    // handle -> click chose file

    // show media manager showMediaManager()
    $("#offcanvasBottom").modal("show");

    // invoke media file fetching function
    await getMediaFiles();
};

// show media manager for vision
window.showMediaManagerForVision = async function (thisWrapper) {
    // handle -> click chose file
    let selectedFilesInput = $(thisWrapper).find("input");
    TT.uploadQty = $(thisWrapper).data("selection");

    TT.selectedFiles =
        selectedFilesInput.val() != "" ? selectedFilesInput.val() : null;
    TT.selectedFilesInput = selectedFilesInput;

    TT.showSelectedFilesDiv = $("#vision_image");
    // handle -> click chose file

    // show media manager showMediaManager()
    $("#offcanvasBottom").modal("show");

    // invoke media file fetching function
    await getMediaFiles("all", "all", false, "vision");
};

// add active class to the selected files
window.activeSelectedFiles = function () {
    if (TT.selectedFiles != null) {
        TT.selectedFiles.split(",").forEach((selectedImage) => {
            $("[data-active-file-id=" + selectedImage + "]").addClass(
                "active-image"
            );
        });
    }
};

// on click event handler of files
window.handleSelectedFiles = function (fileId) {
    $("[data-active-file-id!=" + fileId + "]").removeClass("active-image"); // remove active class
    if (TT.uploadQty == "single") {
        TT.selectedFiles = "" + fileId + "";
    } else {
        if (TT.selectedFiles != null) {
            let tempSelected = TT.selectedFiles.split(",");

            if (tempSelected.includes("" + fileId + "")) {
                tempSelected = tempSelected.filter((tempId) => {
                    return tempId != "" + fileId + "";
                });

                $("[data-active-file-id=" + fileId + "]").removeClass(
                    "active-image"
                ); // remove active class
            } else {
                tempSelected.push(fileId);
            }

            if (tempSelected.length > 0) {
                TT.selectedFiles = tempSelected.toString();
            } else {
                TT.selectedFiles = null;
            }
        } else {
            TT.selectedFiles = "" + fileId + "";
        }
    }
    activeSelectedFiles();
    getSelectedFilesCount();
};

// show the selected file count in the media manager card-header
window.getSelectedFilesCount = function () {
    //
};

// show the chosen file count in specific pages
window.getChosenFilesCount = function () {
    //
};

// show selected files preview after selecting files from media manager
window.showSelectedFilePreview = function () {
    // for file chosen input counter
    TT.selectedFilesInput.val(TT.selectedFiles);
    generatePreview();
    hideMediaManager();
};

// show selected file preiview on load in specific pages
window.showSelectedFilePreviewOnLoad = function () {
    $(".show-image-preview").each(function () {
        let showSelectedFilesDiv = $(this).parent();
        let selectedFiles = $(this).find("input").val();
        generatePreview(selectedFiles, showSelectedFilesDiv);
    });
};

// remove (after clicking remove button) selected file in specific pages
window.removeSelectedFile = function (thisButton, mediaFileId) {
    let removeFileDiv = $(thisButton).closest(".selected-file"); //removeFileDiv.remove();
    let showSelectedFilesDiv = removeFileDiv.parent(); // .show-selected-files
    let choseMediaDiv = showSelectedFilesDiv.find(".show-image-preview"); //choose media button

    let selectedFilesInput = $(choseMediaDiv).find("input");
    let selectedFiles = selectedFilesInput.val();

    if (selectedFiles != null && selectedFiles != "") {
        let tempSelected = selectedFiles.split(",");

        tempSelected = tempSelected.filter((tempId) => {
            return tempId != "" + mediaFileId + "";
        });

        $("[data-active-file-id=" + mediaFileId + "]").removeClass(
            "active-image"
        ); // remove active class
        selectedFilesInput.val(tempSelected);
    }
    removeFileDiv.remove();
};

// generate preview
window.generatePreview = function (
    mediaIds = TT.selectedFiles,
    target = TT.showSelectedFilesDiv
) {
    if (mediaIds && mediaIds != "") {
        mediaIds = mediaIds.split(",");
        getSelectedMediaFiles(mediaIds, target);
    }
};

// hide media manager
window.hideMediaManager = function () {};

// media search
$("#media-search-from").on("submit", function (e) {
    e.preventDefault();
    TT.getMediaSearch = $("input[name=media-search]").val();
    getMediaFiles(
        TT.getMediaType,
        TT.getMediaSearch,
        TT.getMediaSearch != "" ? true : false
    );
});
