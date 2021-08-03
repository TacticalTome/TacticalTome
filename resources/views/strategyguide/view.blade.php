@extends("layouts.app")

@section("pageTitle", $strategyGuide->title)

@section("content")

<!--
    Landing Container
-->
<div class="gameLandingContainer fullscreen positionRelative" style="background-image: url('{{ $strategyGuide->game->cover[array_rand($strategyGuide->game->cover)] }}');">
    <div class="content centerHorizontalVertical">
        <h1 class="fontAlfaSlabOne colorOrange" data-size="medium">{{ $strategyGuide->title }}</h1>
        <p class="fontTrebuchet"><a data-color="yellow" href="{{ route("game.view", $strategyGuide->game_id) }}">{{ $strategyGuide->game->name }}</a></p>
        <p class="fontTrebuchet"><b>By: <a href="{{ route("user.profile", $strategyGuide->user->id) }}" data-color="yellow" target="_blank">{{ $strategyGuide->user->username }}</a> on {{ \Carbon\Carbon::parse($strategyGuide->created_at)->format("D. F d, Y @ h:i A") }}</b></p>
        <p class="fontVerdana hideOnMobile">{{ substr(strip_tags($strategyGuide->content), 0, 150) }} --</p>
        @can('favorite', $strategyGuide)
            @if (Auth::user()->isFavoritingStrategyGuide($strategyGuide))
            <button data-color="red" onclick="gotoLink('{{ route("strategyguide.unfavorite", $strategyGuide->id) }}');" title="Removes this post from your favorites"><i class="fas fa-star"></i> Unfavorite</button>
            @else
                <button data-color="yellow" onclick="gotoLink('{{ route("strategyguide.favorite", $strategyGuide->id) }}');" title="Makes this post one of your favorites! Also helps promote this guide to others"><i class="fas fa-star"></i> Favorite</button>
            @endif
        @endcan
    </div>
</div>

<div class="contentContainer" data-theme="light" style="width: 75%; margin: auto;">
    <div class="content">
        <h1 class="fontTrebuchet" id="strategyGuideTitle">{{ $strategyGuide->title }}</h1>
        <div id="strategyGuideContent">{!! $strategyGuide->content !!}</div>

        <div class="spacer" data-size="medium"></div>

        <!-- Social Media Share Buttons -->
        <button data-color="blue" onclick="gotoLinkInNewTab('https://www.facebook.com/sharer/sharer.php?u={{ url()->full() }}');" title="Share on Facebook"><i class="fab fa-facebook"></i> Share</button>&emsp;
        <button data-color="blue" onclick="gotoLinkInNewTab('http://twitter.com/share?url={{ url()->full() }}')" title="Share on Twitter"><i class="fab fa-twitter"></i> Tweet</button>&emsp;
        <button data-color="blue" onclick="gotoLinkInNewTab('https://www.reddit.com/submit?title={{ $strategyGuide->game->name }} - {{ config("app.name") }}&url={{ url()->full() }}');" title="Share on Reddit"><i class="fab fa-reddit-alien"></i> Share</button>
    
        <div class="spacer" data-size="medium"></div>

        @can("edit", $strategyGuide)
            <button data-color="green" onclick="gotoLink('{{ route("strategyguide.edit", $strategyGuide->id) }}');">Edit</button>
        @endcan

        @can("delete", $strategyGuide)
            <button data-color="red" onclick="deleteStrategyGuide();">Delete</button>
        @endcan

        <div class="spacer" data-size="medium"></div>
        
        <!-- Comments -->
        <h2 class="fontTrebuchet" id="commentSection">Comments</h2>
        <hr>
        <ul>
            @foreach ($strategyGuide->comments as $comment)
                <li>
                    <h5 class="fontTrebuchet"><a href="{{ route("user.profile", $comment->user->id) }}">{{ $comment->user->username }}</a></h5>
                    <p class="fontTrebuchet" data-fontsize="small">{{ \Carbon\Carbon::parse($comment->created_at)->format("D. F d, Y @ h:i A") }}</p>
                    <p class="fontVerdana">{{ $comment->content }}</p>
                    @auth
                        <div class="linkButton fontTrebuchet" data-fontsize="small" data-float="left" onclick="openReplyContainer('{{ $comment->id }}');">Reply</div>
                    @endauth

                    @can("edit", $comment)
                    @endcan

                    @can("delete", $comment)
                        <div class="linkButton fontTrebuchet" style="margin-left: 10px;" data-fontsize="small" data-float="left" onclick="deleteReply('{{ $comment->id }}');">Delete</div>
                    @endcan
                </li>
            @endforeach
        </ul>
        <div class="spacer" data-size="medium"></div>

        <!-- Reply Buttons -->
        @auth
            <button class="simple" data-color="green" onclick="showReplyContainer();">Reply</button>
        @else
            <p class="fontVerdana">You must be <a href="{{ route("auth.login") }}" target="_blank">logged in</a> to reply.</p>
        @endauth

        <div class="spacer" data-size="medium"></div>
    </div>
</div>

<!--
    Reply Container
-->
<div class="blurEntireBackground" id="replyContainer" data-theme="dark" style="display: none;">
    <div class="centerHorizontalVertical backgroundWhite roundedCorners centerText" style="padding: 2%;">
        <h1 class="fontTrebuchet">Reply</h1>
        <input name="replyContent" id="replyContent" type="text" value="" placeholder="Reply Here..." data-theme="dark" style="min-width: 25vw;"><br><br>
        <input name="replyId" id="replyId" type="hidden" value="">
        <button class="simple" data-color="green" style="min-width: 25vw;" onclick="submitReply();">Reply</button>
        <button class="simple" data-size="small" data-color="red" onclick="closeReplyContainer();">Close</button>
    </div>
</div>
@endsection

@push("scripts")
    <script>
        @can('delete', $strategyGuide)
            function deleteStrategyGuide() {
                const strategyGuideId = {{ $strategyGuide->id }};
                const token = $("meta[name='csrf-token']").attr("content");

                if (confirm("Are you sure you want to delete this post? This is irreversible.")) {
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': token
                        }
                    });
                    $.ajax({
                            url: "{{ route("ajax.strategyguide.delete") }}",
                            type: "POST",
                            data: {
                                strategy_guide_id: {{ $strategyGuide->id }}
                            },
                            dataType: "json",
                            success: (response) => {
                                if (response.success) {
                                    alert("Strategy Guide was successfully deleted");
                                    window.location.href = "{{ route("game.view", $strategyGuide->game_id) }}";
                                }
                            },
                            error: (response) => {
                                alert(response.responseJSON.errors[0]);
                            }
                    });
                }
            }
        @endcan

        @auth
            function submitReply() {
                const replyContent = $("#replyContent").val();
                const replyId = $("#replyId").val();
                const token = $("meta[name='csrf-token']").attr("content");

                if (replyContent && /\S/.test(replyContent)) {
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': token
                        }
                    });
                    $.ajax({
                        url: "{{ route("ajax.comment.create") }}",
                        data: {
                            strategy_guide_id: {{ $strategyGuide->id }},
                            reply_id: replyId,
                            content: replyContent,
                        },
                        type: "POST",
                        success: function(response) {
                            if (response.success) {
                                alert("Reply was successfully created");
                                window.location.reload();
                            }
                        }
                    });
                } else {
                    alert("Your reply is empty");
                }
            }

            function deleteReply(replyId) {
                const token = $("meta[name='csrf-token']").attr("content");

                if (confirm("Are you sure you want to delete this comment? This is irreversible.")) {
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': token
                        }
                    });
                    $.ajax({
                        url: "{{ route("ajax.comment.delete") }}",
                        data: {
                            reply_id: replyId
                        },
                        type: "POST",
                        success: function(response) {
                            if (response.success) {
                                alert("Reply was successfully deleted");
                                window.location.reload();
                            }
                        }
                    });
                }
            }

            function closeReplyContainer() {
                $("#replyId").val("");
                $("#replyContainer").fadeOut();
            }

            function showReplyContainer() {
                $("#replyId").val("");
                $("#replyContainer").fadeIn();
            }

            function openReplyContainer(id) {
                $("#replyId").val(replyId);
                $("#replyContainer").fadeIn();
            }
        @endauth
    </script>
@endpush