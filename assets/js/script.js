function soundToggle(button) {
    let soundBtn = $(button).find("i");

    if (soundBtn.hasClass("fa-arrow-rotate-right")) {
        let previousClass = $(button).data("previous-class");
        soundBtn.removeClass("fa-arrow-rotate-right").addClass(previousClass);
        $(".preview-video").show();
        $(".preview-image").hide();
        $(".preview-video")[0].play();
    } else {
        let muted = $(".preview-video").prop("muted");
        $(".preview-video").prop("muted", !muted);

        if (!muted) {
            $(button).data("previous-class", "fa-volume-xmark");
            soundBtn.removeClass("fa-volume-high").addClass("fa-volume-xmark");
        } else {
            $(button).data("previous-class", "fa-volume-high");
            soundBtn.removeClass("fa-volume-xmark").addClass("fa-volume-high");
        }
    }
}

function previewEnded() {
    const soundBtn = document.getElementById('sound-btn');
    $(".preview-video").toggle();
    $(".preview-image").toggle();  

    $(soundBtn).find("i").removeClass("fa-volume-xmark fa-volume-high").addClass("fa-arrow-rotate-right");
}

function openModal() {
    $("#infoModal").show();
}

function closeModal() {
    $("#infoModal").hide();
}

$(window).click(function(event) {
    if ($(event.target).is("#infoModal")) {
        closeModal();
    }
});