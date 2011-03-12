<h2>Contact EarthExplorer.info</h2>
<p>
    We welcome all your feedback. If you have a suggestion, found something
    broken or just want to say hi you can contact us electronically.
</p>
<div class="yui3-g first">
    <div class="yui3-u first">
        <form action="<?php echo $ro->gen('Contact');?>" method="post">
            <fieldset class="yui-skin-sam">
                <legend>Electronic Contact</legend><br/>
                <label for="name">Name (required):</label><br/>
                <input id="name" type="text" name="name"/><br/>
                <label for="subject">Subject (required):</label><br/>
                <input id="subject" type="text" name="subject"/><br/>
                <label for="email">Email (required):</label><br/>
                <input id="email" type="text" name="email"/><br/>
                <label for="message">Message (required):</label><br/>
                <textarea id="message" name="message" style="width:85%; height:10em"></textarea><br/>
                <?php if ($us->isAuthenticated()):?>
                <input type="hidden" name="recaptcha_challenge_field" value="challenge"/>
                <input type="hidden" name="recaptcha_response_field" value="response"/>
                <?php else:?>
                    <?php echo $t['reCaptcha']->getCaptchaFormParts(null, $t['reCaptchaError']); ?>
                <?php endif;?>

                <input type="submit" value="Send" name="send" class="button green bigrounded"/>

            </fieldset>
        </form>
    </div>
    <div class="yui3-g">
        <div style="float:left; border: 1em solid gray; padding:6px; min-height: 10em; -webkit-border-radius:10px">
            <div style="float:right; width:50%;padding-left: 1em; border-left: 2px solid gray;">
                <img src="/images/earth_location.png" style="float:right; border:2px dotted gray; padding:2px"/>
                EarthExplorer<br/>
                PO BOX 1183<br/>
                <a href="<?php echo $ro->gen('Explore.Location', array('woeid'=>7225577, 'slug_name'=>'Broadway-Suburb-Australia'));?>">
                BROADWAY NSW 2007<br/>
                AUSTRALIA
                </a>
            </div>
            <div style="width:50%;padding: .5em">
                <p>
                    We would love to get a postcard from your part of the world!
                </p>
                <p>
                    Send us a postcard from your town and we'll reciprocate the favour.
                </p>
            </div>
        </div>

    </div>


</div>

<script type="text/javascript">
    YUI({
        //Last Gallery Build of this module
        gallery: 'gallery-2009.12.08-22'
    }).use('gallery-yui2', function(Y) {

        Y.yui2().use("simpleeditor", function () {

            var editor = new YAHOO.widget.SimpleEditor('message', {
                handleSubmit:true,
                collapse: true,
                titlebar: 'Message Editing Tools',
                draggable: false,
                buttons: [
                    { group: 'fontstyle', label: 'Font Name and Size',
                        buttons: [
                            { type: 'select', label: 'Arial', value: 'fontname', disabled: true,
                                menu: [
                                    { text: 'Arial', checked: true },
                                    { text: 'Arial Black' },
                                    { text: 'Comic Sans MS' },
                                    { text: 'Courier New' },
                                    { text: 'Lucida Console' },
                                    { text: 'Tahoma' },
                                    { text: 'Times New Roman' },
                                    { text: 'Trebuchet MS' },
                                    { text: 'Verdana' }
                                ]
                            },
                            { type: 'spin', label: '13', value: 'fontsize', range: [ 9, 75 ], disabled: false }
                        ]
                    },
                    { type: 'separator' },
                    { group: 'textstyle', label: 'Font Style',
                        buttons: [
                            { type: 'push', label: 'Bold CTRL + SHIFT + B', value: 'bold' },
                            { type: 'push', label: 'Italic CTRL + SHIFT + I', value: 'italic' },
                            { type: 'push', label: 'Underline CTRL + SHIFT + U', value: 'underline' },
                            { type: 'separator' },
                            { type: 'color', label: 'Font Color', value: 'forecolor', disabled: true },
                            { type: 'color', label: 'Background Color', value: 'backcolor', disabled: true }
                        ]
                    },
                    { type: 'separator' },
                    { group: 'indentlist', label: 'Lists',
                        buttons: [
                            { type: 'push', label: 'Create an Unordered List', value: 'insertunorderedlist' },
                            { type: 'push', label: 'Create an Ordered List', value: 'insertorderedlist' }
                        ]
                    },
                    { type: 'separator' },
                    { group: 'insertitem', label: 'Insert Item',
                        buttons: [
                            { type: 'push', label: 'HTML Link CTRL + SHIFT + L', value: 'createlink', disabled: false },
                            { type: 'push', label: 'Insert Image', value: 'insertimage' }
                        ]
                    }
                ]
            });
            editor.render();

        });

    });
</script>