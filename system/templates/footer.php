        <!--
            Footer
            THEME > dark
            SIZE  > large
        -->
        <div class="footer" data-theme="dark" data-size="large">
            <div class="sectionContainer">
            <div class="section">
                    <h4 class="fontTrebuchet">Pages</h4>
                    <a class="fontVerdana" href="<?php echo \URL; ?>">Homepage</a>
                    <a class="fontVerdana" href="<?php echo \URL; ?>user/explore/">Explore</a>
                </div>
                <div class="section">
                    <h4 class="fontTrebuchet">Legal</h4>
                    <a class="fontVerdana" href="<?php echo \URL; ?>legal/termsofservice/">Terms of Service</a>
                    <a class="fontVerdana" href="<?php echo \URL; ?>legal/privacypolicy/">Privacy Policy</a>
                    <a class="fontVerdana" href="<?php echo \URL; ?>legal/postingguidelines/">Posting Guidelines</a>
                </div>
                <div class="section">
                    <h4 class="fontTrebuchet">About</h4>
                    <a class="fontVerdana" href="<?php echo \URL; ?>about/">About <?php echo \WEBSITE_NAME; ?></a>
                    <a class="fontVerdana" href="<?php echo \URL; ?>about/faq/">Frequently Asked Questions</a>
                    <a class="fontVerdana" href="<?php echo \URL; ?>about/contact/">Contact Us</a>
                </div>
            </div>
            <div class="banner" data-size="large">
                &copy; 2021 - <?php echo date("Y"); ?> <a href="<?php echo \URL; ?>"><?php echo \WEBSITE_NAME; ?></a>. All Rights Reserved.
            </div>
        </div>

        <script>
            $(document).tooltip();

            $("#searchWebsite").on("click", function(){
                window.location.href = "<?php echo \URL; ?>tools/search/" + $("#searchWebsiteText").val() + "/";
            });

            $("#searchWebsiteText").on("keypress", function(e){
                if (e.which === 13) window.location.href = "<?php echo \URL; ?>tools/search/" + $("#searchWebsiteText").val() + "/";
            });
        </script>
    </body>
</HTML>