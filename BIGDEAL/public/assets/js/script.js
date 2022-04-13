function copyPOST_REGISTER() {
    var range = document.createRange();
    range.selectNode(document.getElementById("POST_REGISTER"));
    window.getSelection().removeAllRanges(); // clear current selection
    window.getSelection().addRange(range); // to select text
    document.execCommand("copy");
    window.getSelection().removeAllRanges();// to deselect
}

function copyPOST_PRODUCT() {
    var range = document.createRange();
    range.selectNode(document.getElementById("POST_PRODUCT"));
    window.getSelection().removeAllRanges(); // clear current selection
    window.getSelection().addRange(range); // to select text
    document.execCommand("copy");
    window.getSelection().removeAllRanges();// to deselect
}