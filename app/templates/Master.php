<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
	<head>
            <link rel="icon" type="image/png" href="http://www.earthexplorer.info/images/earth_location.png"/>
                <meta name="google-site-verification" content="<?php echo AgaviConfig::get('Google.site.verification');?>" />
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
		<base href="<?php echo $ro->getBaseHref(); ?>" />
		<title><?php if(isset($t['_title'])) echo htmlspecialchars($t['_title']) . ' - '; echo AgaviConfig::get('core.app_name'); ?></title>
                <!-- Stylesheet used by freebase topic suggest -->
                <link type="text/css" rel="stylesheet" href="http://freebaselibs.com/static/suggest/1.0.5/suggest.min.css" />

                <!-- CSS -->
                <link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/combo?3.1.0/build/cssfonts/fonts-min.css&amp;3.1.0/build/cssreset/reset-min.css&amp;3.1.0/build/cssgrids/grids-min.css"/>
                <!-- JS -->
                <script type="text/javascript" src="http://yui.yahooapis.com/combo?3.1.1/build/yui/yui-min.js"></script>

                <!-- Local styles -->
                <link rel="stylesheet" type="text/css" href="/css/base.css"/>
                <link rel="stylesheet" type="text/css" href="/css/buttons.css"/>
        </head>
	<body>
            <div id="wrapper">
                <div class="yui3-d3">
                    <div id="hd">
                        <div id="logo">
                            <h1><?php echo htmlspecialchars(AgaviConfig::get('core.app_name')); ?></h1>
                            <p>
                                Stay Home, Explore the World
                            </p>
                        </div>
                    </div>

                    <div id="menu">
                        <ul>
                            <li>
                                <a href="<?php echo $ro->gen('Home');?>" class="selected">Home</a>
                            </li>
                            <li>
                                <a href="<?php echo $ro->gen('Explore');?>">Explore</a>
                            </li>
                            <li>
                                <a href="<?php echo $ro->gen('Contact');?>">Contact</a>
                            </li>
                        </ul>
                    </div>
                    <div id="bd">
                        <div id="contentHeader">
                            <div id="headerTools" style="float:right">
                                <div id="google_translate_element" style="float:left"></div>
                                <script type="text/javascript">
                                function googleTranslateElementInit() {
                                  new google.translate.TranslateElement({
                                    pageLanguage: 'en'
                                  }, 'google_translate_element');
                                }
                                </script>
                                <script src="http://translate.google.com/translate_a/element.js?cb=googleTranslateElementInit" type="text/javascript"></script>
                                <div id="locationSearch">
                                    <form name="frmLocationSearch" method="post" action="<?php echo $ro->gen('Explore');?>">
                                        <input type="text" name="location" id="location" style="-webkit-appearance: searchfield;"/>
                                        <input type="submit" name="submit" value="Find a location" class="button green medium"/>
                                    </form>
                                </div>
                            </div>
                            <div>V<?php echo AgaviConfig::get('core.app_version');?></div>
                        </div>
                        
                        <div id="yui-main">
                            <?php if ($slots['adSenseBanner']) echo $slots['adSenseBanner']; ?>
                            <!-- AddThis Button BEGIN -->
                            <div class="addthis_toolbox addthis_default_style">
                                <div class="">
                                    <div><a class="addthis_button_facebook"></a></div>
                                    <div><a class="addthis_button_twitter"></a></div>
                                    <div><a class="addthis_button_tumblr"></a></div>
                                    <div><a class="addthis_button_linkedin"></a></div>
                                    <div><a class="addthis_button_wordpress"></a></div>
                                    <div><a class="addthis_button_digg"></a></div>
                                    <div><a class="addthis_button_email"></a></div>
                                    <div><a class="addthis_button_favorites"></a></div>
                                    <div><a class="addthis_button_print"></a></div>
                                    <div><a href="http://www.addthis.com/bookmark.php?v=250&amp;username=xa-4bd238497137f805" class="addthis_button_expanded">More</a></div>
                                    <div style="clear:both; float:none;"></div>
                                </div>
                            </div>
                            <script type="text/javascript" src="http://s7.addthis.com/js/250/addthis_widget.js#username=xa-4bd238497137f805"></script>
                            <!-- AddThis Button END -->
                            <div class="yui-b">
                                <?php echo $inner; ?>
                            </div>
                        </div>
                    </div>
                    <div id="ft">
                        <div class="yui3-gb">
                            <div class="yui3-u first" >
                                <div class="socialMediaList">
                                    <a href="http://www.twitter.com/AlchemyCS" title="@AlchemyCS on twitter"><img src="/images/vsmi/32px/twitter.png" alt=""/>@AlchemyCS</a><br/>
                                    <a href="http://careerprogrammer.tumblr.com" title="Authors Blog - Career Programmer"><img src="/images/vsmi/32px/tumblr.png" alt=""/>Author's Blog - Career Programmer</a><br/>
                                </div>
                            </div>
                            <div class="yui3-u">
                                <div class="credits">
                                    <p>
                                        <a href="<?php echo $ro->gen('PrivacyPolicy');?>" title="Privacy Policy">Privacy Policy</a>
                                    </p>
                                    <p>
                                    Developed by <a href="http://alchemycs.github.com/" title="AlchemyCS on GitHub">AlchemyCS</a>.<br/>
                                    <img src="/images/atom-48.png" alt=""/>
                                    </p>
                                </div>
                            </div>
                            <div class="yui3-u">
                                <div class=" systemInfo">
                                    Version: <?php echo AgaviConfig::get('core.app_version'); ?>
                                    <?php if (AgaviConfig::get('core.debug')): ?>
                                    <div>
                                        Environment: <?php echo AgaviConfig::get('core.environment');?>
                                    </div>
                                    <?php endif;?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- freebase autocomplete start -->
            <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>
            <script type="text/javascript" src="http://freebaselibs.com/static/suggest/1.0.5/suggest.min.js"></script>
            <script type="text/javascript">
            $(function() {
              $("#location").suggest({type:'/location/location'});
            });
            </script>
            <!-- freebase autocomplete end -->

            <!-- user voice start -->
            <script type="text/javascript">
            var uservoiceOptions = {
              /* required */
              key: '<?php echo AgaviConfig::get('UserVoice.key');?>',
              host: '<?php echo AgaviConfig::get('UserVoice.host');?>',
              forum: '<?php echo AgaviConfig::get('UserVoice.forum');?>',
              showTab: true,
              /* optional */
              alignment: 'left',
              background_color:'#f00',
              text_color: 'white',
              hover_color: '#06C',
              lang: 'en'
            };

            function _loadUserVoice() {
              var s = document.createElement('script');
              s.setAttribute('type', 'text/javascript');
              s.setAttribute('src', ("https:" == document.location.protocol ? "https://" : "http://") + "cdn.uservoice.com/javascripts/widgets/tab.js");
              document.getElementsByTagName('head')[0].appendChild(s);
            }
            _loadSuper = window.onload;
            window.onload = (typeof window.onload != 'function') ? _loadUserVoice : function() { _loadSuper(); _loadUserVoice(); };
            </script>
            <!-- user voice end -->

            <!-- google analytics -->
            <script type="text/javascript">
                var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
                document.write(unescape("%3Cscript src='" + gaJsHost + "google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E"));
            </script>
            <script type="text/javascript">
                try {
                    var pageTracker = _gat._getTracker("<?php echo AgaviConfig::get('Google.analytics');?>");
                    pageTracker._trackPageview();
                } catch(err) {}
            </script>

	</body>
</html>
