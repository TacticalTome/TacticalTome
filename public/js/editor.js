/*
	Main Editor
*/

/*
	Other
*/
function clear_formatting() {
	document.execCommand("removeFormat", false, null);
}

function insert_horizontal_line() {
	document.execCommand("insertHorizontalRule", false, null);
}

/*
	Fonts
*/
function set_fontsize() {
	var size = window.prompt("How big do you want the font to be?\ni.e. 42, 24, 18, 12, etc.");
    document.execCommand("fontSize", false, "1");
    var fontElements = document.getElementsByTagName("font");
    for (var i = 0, len = fontElements.length; i < len; ++i) {
        if (fontElements[i].size == "1") {
            fontElements[i].removeAttribute("size");
            fontElements[i].style.fontSize = size + "px";
        }
    }
}

function change_font() {
	document.execCommand("fontName", false, $("#font_select").val());
}

function font_select_change() {
	$("#font_select").css("font-family", $("#font_select").val());
}

function make_heading() {
	var size = window.prompt("How big do you want the heading to be? (1 thru 6)\n1 being the biggest and 6 being the smallest");
	document.execCommand("formatBlock", false, "H" + size);
}

/*
	Lists
*/
function number_list() {
	document.execCommand("insertOrderedList", false, null);
}

function bulletpoint_list() {
	document.execCommand("insertUnorderedList", false, null);
}

/*
	Simple Styling
*/
function underline_text() {
	document.execCommand("underline", false, null);
}

function italic_text() {
	document.execCommand("italic", false, null);
}

function bold_text() {
	document.execCommand("bold", false, null);
}

function strikethrough_text() {
	document.execCommand("strikethrough", false, null);
}

/*
	Undo & Redo
*/
function undo() {
	document.execCommand("undo", false, null);
}

function redo() {
	document.execCommand("redo", false, null);
}

/*
	Text Alignment
*/
function left_align() {
	document.execCommand("justifyLeft", false,  null);
}
function justifty_align() {
	document.execCommand("justifyFull", false,  null);
}
function center_align() {
	document.execCommand("justifyCenter", false,  null);
}
function right_align() {
	document.execCommand("justifyRight", false,  null);
}

/*
	Forground & Background & Colors
*/
function change_foreground() {
	document.execCommand("foreColor", false, $("#color_select").val());
}

function change_background() {
	document.execCommand("backColor", false, $("#color_select").val());
}

function color_select_change() {
	$("#color_select").css("color", $("#color_select").val());
}