<?php
$styles = array('Basic', 'Tabs', 'Accordion');
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
    <meta http-equiv="Content-type" content="text/html;charset=ISO-8859-1" />
    <title>Welcome to johnpangilinan.com</title>
    <link rel="stylesheet" href="styles/main.css" />
    <link rel="stylesheet" href="styles/smoothness/jquery-ui-1.8.1.css"></link>
    <script type="text/javascript" src="scripts/jquery-1.4.2.min.js"></script>
    <script type="text/javascript" src="scripts/jquery-ui-1.8.1.js"></script>

    <style type="text/css">
        a { outline: none; }
        #SwitchStyles
        {
            position: fixed;
            right: 0px; top: 0px;
            z-index: 10;
            border: solid 1px black;
            background-color: white;
        }

        #SwitchStyles h2
        {
            font-size: 12pt;
            margin: 10px;
        }

        #SwitchStyles ul { list-style-type: none; padding: 0px; margin-left: 15px; }
        #SwitchStyles li { text-align: left; }
    </style>
    <script type="text/javascript">
        var contactForm;
        $jq = jQuery;

        function switchStyles(styleType)
        {
            if(styleType != 'plaintext')
            {
                $jq("#" + styleType).siblings("div").hide();
                $jq("#" + styleType).show();
                hideContactForm();
            }
        }
        function showContactForm() { contactForm.dialog('open'); }
        function hideContactForm() { contactForm.dialog('close'); }
        function switchForm(formId)
        {
            $jq("#ContactForm").children('div[id*=Contact]').hide();
            $jq("#" + formId).show();
        }
        function sendMessage()
        {
            var in_contactEmail = $jq("#ContactEmail").val();
            var in_contactSubject = $jq("#ContactSubject").val();
            var in_contactMessage = $jq("#ContactMessage").val();
            $jq.ajax({
                url: 'contact_ajax_handler.php',
                type: 'post',
                data: 'ContactEmail=' + in_contactEmail + '&ContactSubject=' + in_contactSubject + '&ContactMessage=' + in_contactMessage,
                dataType: 'json',
                success: function(response)
                {
                    switchForm("Contact2");
                    $jq("#ContactIdButton").unbind("click");
                    if(response.success == true)
                    {
                        $jq("#ContactResponseMessage").html(response.message);
                        $jq("#ContactIdButton").click(function() { hideContactForm(); setTimeout(function() { switchForm("Contact1") }, 500) } );
                    }
                    else
                    {
                        $jq("#ContactResponseMessage").html(response.message);
                        $jq("#ContactIdButton").click(function() { switchForm("Contact1"); } )
                    }
                }

            });
        }

        $jq(function()
        {
            contactForm = $jq("#ContactForm").dialog( {width: 450, height: 370, autoOpen: false, show: 'slide', hide: 'slide', close: function() { switchForm("Contact1"); }  } );
            $jq("#Accordion").accordion({ header: "h2" }).css({"height": "600px" }).children("div").css({"height":"320px"});
            $jq('#Tabs').tabs();
            $jq("#Tabs").siblings("div").hide();

        });
    </script>
</head>
<body>
<div id="SwitchStyles">
    <h2>Switch Style</h2>
    <ul>
<?php
foreach($styles as $styleName)
{
$style = str_replace(' ', '', $styleName);
?>
        <li><a href="javascript: switchStyles('<?php echo $style; ?>');"><?php echo $styleName; ?></a></li>

<?php
}

?>
    </ul>
</div>

<div id="ContactForm" title="Contact Me" >
    <div id="Contact1">
        <div>
            <label>Email:</label>
        </div>
        <div>
            <input id="ContactEmail" name="ContactEmail" type="text" />
        </div>
        <div>
            <label>Subject:</label>
        </div>
        <div>
            <input id="ContactSubject" name="ContactSubject" type="text" value="Resume Inquiry" />
        </div>
        <div>
            <label>Message:</label>
        </div>
        <div>
            <textarea id="ContactMessage" name="ContactMessage" ></textarea>
        </div>
        <div>
            <input type="button" value="Send Email" onclick="sendMessage()" />
        </div>
    </div>
    <div id="Contact2">
        <div id="ContactResponseMessage">
        </div>
        <div style="text-align: center;">
            <input id="ContactIdButton" type="button" value="Ok" />
        </div>
    </div>
</div>

<div id="Container">
    <div id="Heading" class="heading">
        <h1>John Pangilinan</h1>
        <a href="/portfolio/">Portfolio</a>
        <?php /* <a href="#" onclick="showContactForm()">Contact Me</a> */ ?>
    </div>
    <div>
<?php
    include('basic.php');
    include('accordion.php');
    include('tabs.php');

?>
    </div>
<?php
/*
    <p id="W3Validation">
        <a href="http://validator.w3.org/check?uri=referer" target="new">
            <img src="http://www.w3.org/Icons/valid-xhtml10"
            alt="Valid XHTML 1.0 Transitional" height="31" width="88" />
        </a>
    </p>
*/
  ?>

</div>

</body>
</html>
