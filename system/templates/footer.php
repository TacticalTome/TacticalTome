        <!--
            Footer
            THEME > dark
            SIZE  > large
        -->
        <div class="footer" data-theme="dark" data-size="large">
            <div class="sectionContainer">
            <div class="section">
                    <h4 class="fontTrebuchet">Pages</h4>
                    <a class="fontVerdana" href="<?php echo \URL; ?>">Home</a>
                    <a class="fontVerdana" href="">Explore</a>
                </div>
                <div class="section">
                    <h4 class="fontTrebuchet">About</h4>
                    <a class="fontVerdana" href="">About <?php echo \WEBSITE_NAME; ?></a>
                    <a class="fontVerdana" href="">Frequently Asked Questions</a>
                </div>
            </div>
            <div class="banner" data-size="large">
                &copy; 2021 - <?php echo date("Y"); ?> Silas Carlson. All Rights Reserved.
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