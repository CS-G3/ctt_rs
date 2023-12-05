document.addEventListener("DOMContentLoaded", function () {
    // Check the current URL and update the selected button
    var currentUrl = window.location.pathname;
    if (currentUrl.includes("/manager/rank/soc")) {
        $("#socButton").addClass('selected');
        $("#siddButton").removeClass('selected');
    } else if (currentUrl.includes("/manager/rank/sidd")) {
        $("#socButton").removeClass('selected');
        $("#siddButton").addClass('selected');
    }
});

function toggleVisibility(divId, redirectUrl) {
    var socDiv = $("#socDiv");
    var siddDiv = $("#siddDiv");

    if (divId === "socDiv") {
        socDiv.hide();
        siddDiv.show();
    } else if (divId === "siddDiv") {
        socDiv.show();
        siddDiv.hide();
    }

    // Update button styles based on selection
    $('.toggle-button').removeClass('selected');
    $(`#socButton, #siddButton`).addClass('selected');

    // Redirect to the specified URL using jQuery
    window.location.href = redirectUrl;
}