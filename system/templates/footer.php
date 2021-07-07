        <!--
            Footer
            THEME > dark
            SIZE  > large
        -->
        <div class="footer" data-theme="dark" data-size="large">
            <div class="sectionContainer">
            <div class="section">
                    <h4 class="fontTrebuchet">Pages</h4>
                    <a class="fontVerdana" href="<?= \URL; ?>">Homepage</a>
                    <a class="fontVerdana" href="<?= \URL; ?>user/explore/">Explore</a>
                </div>
                <div class="section">
                    <h4 class="fontTrebuchet">Legal</h4>
                    <a class="fontVerdana" href="<?= \URL; ?>legal/termsofservice/">Terms of Service</a>
                    <a class="fontVerdana" href="<?= \URL; ?>legal/privacypolicy/">Privacy Policy</a>
                    <a class="fontVerdana" href="<?= \URL; ?>legal/postingguidelines/">Posting Guidelines</a>
                </div>
                <div class="section">
                    <h4 class="fontTrebuchet">About</h4>
                    <a class="fontVerdana" href="<?= \URL; ?>about/">About <?= \WEBSITE_NAME; ?></a>
                    <a class="fontVerdana" href="<?= \URL; ?>about/faq/">Frequently Asked Questions</a>
                    <a class="fontVerdana" href="<?= \URL; ?>about/contact/">Contact Us</a>
                </div>
                <div class="section">
                    <h4 class="fontTrebuchet">For Developers</h4>
                    <a class="fontVerdana" href="<?= \URL; ?>api/">API Documentation</a>
                </div>
            </div>
            <div class="banner" data-size="large">
                &copy; 2021 - <?= date("Y"); ?> <a href="<?= \URL; ?>"><?= \WEBSITE_NAME; ?></a>. All Rights Reserved.
            </div>
        </div>

        <script>
            $(document).tooltip();

            $("#searchWebsite").on("click", function(){
                window.location.href = "<?= \URL; ?>tools/search/" + $("#searchWebsiteText").val() + "/";
            });

            $("#searchWebsiteText").on("keypress", function(e){
                if (e.which === 13) window.location.href = "<?= \URL; ?>tools/search/" + $("#searchWebsiteText").val() + "/";
            });
        </script>
    </body>
</HTML>