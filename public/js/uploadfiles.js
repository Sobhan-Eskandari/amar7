
$(document).ready(function () {
    document.getElementById("uploadHeader").onchange = function () {
        document.getElementById("headerPlace").value = this.value;
    };

    document.getElementById("uploadSlide1").onchange = function () {
        document.getElementById("slide1Place").value = this.value;
    };

    document.getElementById("uploadSlide2").onchange = function () {
        document.getElementById("slide2Place").value = this.value;
    };

    document.getElementById("uploadSlide3").onchange = function () {
        document.getElementById("slide3Place").value = this.value;
    };

    document.getElementById("uploadcontactus").onchange = function () {
        document.getElementById("contactusPlace").value = this.value;
    };
    document.getElementById("uploadAboutUs").onchange = function () {
        document.getElementById("aboutUsPlace").value = this.value;
    };



});

