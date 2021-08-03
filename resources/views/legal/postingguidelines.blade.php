@extends("layouts.app")

@section("pageTitle", "Terms of Service")

@section("content")
<!--
    Jumbotron
    THEME          > dark
    STICKYNAVABOVE > large
-->
<div class="jumbotron jumbotronWithBackground" data-theme="dark" data-stickynavabove="large">
    <div class="content">
        <h1 class="centerText fontAlfaSlabOne colorOrange">Posting Guidelines</h1>
    </div>
</div>

<!--
    Content Container
    THEME > light
-->
<div class="contentContainer" data-theme="light" style="width: 75%; margin: auto;">
    <div class="content">
        <p class="fontTrebuchet">Last Updated: June 16th, 2021</p>

        <h1 class="fontTrebuchet">Read before posting a strategy guide</h1>
        <hr>
        <p class="fontVerdana">By posting a strategy guide and by using {{ config("app.name") }} you acknowledge that you have read and understand the below requirements. Failure to follow the code of conduct and other various rulings will result in your account being terminated.</p>

        <div class="spacer" data-size="medium"></div>

        <h3 class="fontTrebuchet">Code of Conduct for Strategy Guides</h3>
        <p class="fontTrebuchet" data-fontsize="small"><i>These are in no particular order.</i></p>
        <ol class="fontVerdana">
            <li>Do not, under any circumstance, harass any other user based on their characteristics or beliefs. This also includes respecting other users on {{ config("app.name") }}</li>
            <li>Do not use or type racial slurs or any other severe vulgar language.</li>
            <li>Attempt to refrain from profanity or any other vulgar language; excessive swearing is not tolerated.</li>
            <li>All strategy guides shall be kept at a rating of PG-13, anything deemed excessive of that category is not allowed.</li>
            <li>Do not spam under any circumstance.</li>
            <li>Do not advertise other services or games. You may provide a link to other services if said service relates to the topic and enhances the conversation or guide.</li>
            <li>Do not post any links that lead to harmful or unwanted content. The following are forbidden: pornographic materials, gambling, or malicious software.</li>
            <li>Do not post any content that can be viewed as either harmful or inappropriate.</li>
            <li>Do not post any illegal content.</li>
            <li>Do not post any images that are illegal, inappropriate, or vulgar.</li>
            <li>Do not post any low effort content</li>
            <li>Do not post any private information of you or another person.</li>
            <li>Do not post any violent-enticing content.</li>
            <li>Do not post a strategy guide as a reply to another strategy guide, unless it is constructive and is a strategy guide in itself.</li>
            <li>Do not impersonate any person or other user.</li>
        </ol>
        <br>
        <p class="fontVerdana"><b>Please be aware that {{ config("app.name") }} has the full right to delete any post for any reason if it is deemed unwanted and breaks the above code of conduct.</b></p>
    
        <div class="spacer" data-size="medium"></div>
        <p class="fontVerdana"><i>Please continue . . .</i></p>
        <div class="spacer" data-size="medium"></div>

        <h3 class="fontTrebuchet">Helpful Information for Strategy Guides</h3>
        <p class="fontTrebuchet" data-fontsize="small"><i>These are in no particular order.</i></p>
        <ol class="fontVerdana">
            <li>For a good example of a strategy guide see <a href="{{ asset("strategyguide.view", 1) }}" target="_blank">here</a>.</li>
            <li>Refrain from using images. If you would like to include an image in your strategy guide include a link to an external site. Copying and pasting an image will cause your strategy guide to hit the character limit very fast.</li>
            <li>Do not post one singular "tips and tricks" onto a strategy guide. However you may group a bunch of "tips and tricks" together and post them under one guide.</li>
            <li>Put effort into your strategy guide and attempt to be as descriptive as possible. The more descriptive your strategy guide is, the more people will be able to find it.</li>
            <li>Refrain from using vulgar language in your strategy guide, they can be easily replaced. However this is exempt when quotes from games are used.</li>
            <li>Write your strategy guides as if your Grandma or Mom was going to read it later.</li>
        </ol>
        <br>

        <div class="spacer" data-size="medium"></div>

        <p class="fontVerdana"><b>Our Posting Guidelines may change with or without notice.</b></p>
    </div>
</div>
@endsection