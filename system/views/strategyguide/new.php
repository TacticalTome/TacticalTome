<!--
    Landing Container
-->
<script src="<?php echo \URL; ?>javascript/editor.js"></script>
<div class="gameLandingContainer fullscreen positionRelative" style="background-image: url('<?php echo $this->game->getCoverURL(); ?>');">
    <div class="content hideOnMobile centerHorizontalVertical" style="width: 75%;">
        <div class="editor-container" style="background: #454545; padding: 10px; border-radius: 10px;">
            <h1 class="fontAlfaSlabOne colorOrange"><?php echo $this->game->getName(); ?></h1>
            <p class="fontVerdana"><b>Please view our <a href="<?php echo \URL; ?>legal/postingguidelines/" target="_blank" data-color="yellow">Posting Guidelines</a> before continuing</b></p>
            <table>
                <tbody>
                    <tr>
                        <td><button data-color="red" onclick="underline_text()" title="Underline the selected text"><i class="fas fa-underline"></i></button></td>
                        <td><button data-color="red" onclick="italic_text()" title="Italicize the selected text"><i class="fas fa-italic"></i></button></td>
                        <td><button data-color="red" onclick="bold_text()" title="Bold the selected text"><i class="fas fa-bold"></i></button></td>
                        <td><button data-color="red" onclick="strikethrough_text()" title="Strikethrough the selected text"><i class="fas fa-strikethrough"></i></button></td>
                        <td><button data-color="red" onclick="clear_formatting()" title="Removes formatting from the selected text"><i class="fas fa-trash-alt"></i></button></td>
                        <td><button data-color="red" onclick="number_list()" title="Makes a numbered list"><i class="fas fa-list-ol"></i></button></td>
                        <td><button data-color="red" onclick="bulletpoint_list()" title="Makes a bulletpointed list"><i class="fas fa-list-ul"></i></button></td>
                        <td><button data-color="red" onclick="undo()" title="Undo"><i class="fas fa-undo"></i></button></td>
                        <td><button data-color="red" onclick="redo()" title="Redo"><i class="fas fa-redo"></i></button></td>
                        <td><button data-color="red" onclick="left_align()" title="Align the selected text to the left"><i class="fas fa-align-left"></i></button></td>
                        <td><button data-color="red" onclick="justifty_align()" title="Align the selected text to justify"><i class="fas fa-align-justify"></i></button></td>
                        <td><button data-color="red" onclick="center_align()" title="Center the selected text"><i class="fas fa-align-center"></i></button></td>
                        <td><button data-color="red" onclick="right_align()" title="Align the selected text to the right"><i class="fas fa-align-right"></i></button></td>
                        <td><button data-color="red" onclick="insert_horizontal_line()" title="Insert a horizontal line"><i class="fas fa-sliders-h"></i></button></td>
                    </tr>
                </tbody>
            </table>

            <table>
                <tbody>
                    <tr>
                        <td><button data-color="red" onclick="change_font()" title="Change the selected text's font"><i class="fas fa-font"></i></button></td>
                        <td><button data-color="red" onclick="change_foreground()" title="Change the font color of the selected text"><i class="fas fa-tint"></i></button></td>
                        <td><button data-color="red" onclick="change_background()" title="Change the background color of the selected text"><i class="fas fa-highlighter"></i></button></td>
                        <td><button data-color="red" onclick="set_fontsize()" title="Change the selected text's font size"><i class="fas fa-expand-arrows-alt"></i></button></td>
                    </tr>
                    <tr>
                        <td>
                            <select id="font_select" onchange="font_select_change();">
                                <option value="Arial" style="font-family: arial">Arial</option>
                                <option value="Verdana" style="font-family: verdana">Verdana</option>
                                <option value="Helvetica" style="font-family: Helvetica">Helvetica</option>
                                <option value="Times New Roman" style="font-family: Times New Roman">Times New Roman</option>
                                <option value="Times" style="font-family: Times">Times</option>
                                <option value="Courier New" style="font-family: Courier New">Courier New</option>
                                <option value="Courier" style="font-family: Courier">Courier</option>
                                <option value="Georgia" style="font-family: Georgia">Georgia</option>
                                <option value="Palatino" style="font-family: Palatino">Palatino</option>
                                <option value="Garamond" style="font-family: Garamond">Garamond</option>
                                <option value="Bookman" style="font-family: Bookman">Bookman</option>
                                <option value="Impact" style="font-family: Impact">Impact</option>
                                <option value="Arial Black" style="font-family: Arial Black">Arial Black</option>
                                <option value="Trebuchet MS" style="font-family: Trebuchet MS">Trebuchet MS</option>
                                <option value="Comic Sans MS" style="font-family: Comic Sans MS">Comic Sans MS</option>
                            </select>
                        </td>
                        <td colspan="3">
                            <select id="color_select" onchange="color_select_change();">
                                <option value="black" style="color: black;">&#9632;</option>
                                <option value="red" style="color: red;">&#9632;</option>
                                <option value="yellow" style="color: yellow;">&#9632;</option>
                                <option value="blue" style="color: blue;">&#9632;</option>
                                <option value="purple" style="color: purple;">&#9632;</option>
                                <option value="green" style="color: green;">&#9632;</option>
                                <option value="violet" style="color: violet;">&#9632;</option>
                                <option value="orange" style="color: orange;">&#9632;</option>
                            </select>
                        </td>
                    </tr>
                </tbody>
            </table>
            <br>

            <div class="editor" id="title" style="background: #f9f9f9; min-height: 20px; color: black; outline: none;" contenteditable>Post Title</div>
            <br>

            <div class="editor" id="editor" style="background: #f9f9f9; min-height: 200px; max-height: 200px; color: black; outline: none; overflow-y: auto;" contenteditable>Post Content</div>

            <br>
            <button data-color="green" onclick="postStrategyGuide()">Post</button>
            <button data-color="red" onclick="backToGamePage()">Return</button>
        </div>
    </div>
</div>

<script>
    function postStrategyGuide() {
        var content = $("#editor").html();
        var title = $("#title").html();
        
        if (confirm("Are you sure you want to post this? Make sure that everything is how you want it before posting.\n\n*MAKE SURE IT ADHERES TO OUR RULES.")) {
            $.ajax({ url: "<?php echo \URL; ?>ajax/newstrategyguide/",
                    data: {title: title, content: content, gameID: <?php echo $this->game->getId(); ?>},
                    type: "POST",
                    success: function(data) {
                        alert(data);
                        if (data == "Successfully posted") window.location.href = "<?php echo $this->game->getURL(); ?>";
                    }
            });
        }
    }

    function backToGamePage() {
        if (confirm("Are you sure you want to leave?\n\nAll progress will be lost!")) {
            window.location.href = "<?php echo $this->game->getURL(); ?>";
        }
    }
</script>