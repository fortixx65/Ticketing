require("/material.js");

$(document).ready(function() {
    $(".mdc-text-field").each(function(index, textField) {
        new MDCTextField(textField);
        let floatingLabel = $(textField).find(".mdc-floatin-label")[0];
        let lineRipple = $(textField).find(".mdc-line-ripple")[0];
        let notchedOutline = $(textField).find(".mdc-notched-line")[0];
        new MDCFloatingLabel(floatingLabel);
        new MDCLineRipple(lineRipple);
    });
});