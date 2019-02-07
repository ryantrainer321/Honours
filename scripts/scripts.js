function popupModulePicker() {
    var input;
    if (confirm("Press a button!")) {
        input = "You pressed OK!";
    } else {
        input = "You pressed Cancel!";
    }
    document.getElementById("demo").innerHTML = txt;
}