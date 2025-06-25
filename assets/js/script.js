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

function goBack(){
    window.history.back();
}

function startHideTimer(){
    var timeout = null;
    $(document).on("mousemove", function() {
        clearTimeout(timeout);
        $(".watchNav").fadeIn();

        timeout = setTimeout(function() {
            $(".watchNav").fadeOut();
        }, 2000);
    })
}

function initVideo(videoId, username) {
    startHideTimer();
    setStartTime(videoId, username);
    updateProgressTimer(videoId, username);
}

function updateProgressTimer(videoId, username) {
    addDuration(videoId, username);

    var timer;

    $("video").on("playing", function(event){
        window.clearInterval(timer);
        timer = window.setInterval(function() {
            updateProgress(videoId, username, event.target.currentTime);
        }, 3000);
    }).on("ended", function() {
        setFinished(videoId, username);
        window.clearInterval(timer);
    })
}

function addDuration(videoId, username) {
    $.post("ajax/addDuration.php", { videoId: videoId, username: username }, function(data) {
        if(data !== null && data !== "") {
            alert(data);
        }
    })
}

function updateProgress(videoId, username, progress) {
    $.post("ajax/updateDuration.php", { videoId: videoId, username: username, progress: progress }, function(data) {
        if(data !== null && data !== "") {
            alert(data);
        }
    })
}

function setFinished(videoId, username) {
    $.post("ajax/setFinished.php", { videoId: videoId, username: username }, function(data) {
        if(data !== null && data !== "") {
            alert(data);
        }
    })
}

function setStartTime(videoId, username) {
    $.post("ajax/getProgress.php", { videoId: videoId, username: username }, function(data) {
        if(isNaN(data)) {
            alert(data);
            return;
        }

        $("video").on("canplay", function() {
            this.currentTime = data;
            $("video").off("canplay");
        })
    })
}

function restartVideo() {
    $("video")[0].currentTime = 0;
    $("video")[0].play();
    $(".upNext").fadeOut();
}

function watchVideo(videoId) {
    window.location.href = "watch.php?id=" + videoId;
}

function showUpNext() {
    $(".upNext").fadeIn();
}

$(window).click(function(event) {
    if ($(event.target).is("#infoModal")) {
        closeModal();
    }
});