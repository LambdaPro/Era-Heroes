$(document).ready(function(){
    $("#chat-btn").hide();
    $(".game-room").hide();
    $(".match-frame").hide();

    $(".serverChoice").click(function(){
        $(this).toggleClass("serverActive")
        .siblings()
        .removeClass("serverActive");
    });

    $("#chatForm").submit(function(e){
        e.preventDefault();
        var chat = $("#chat-box").val();
        var chat_filtered = " ";
        chat = chat.split(',').join(chat_filtered);
        $.post('./connections/sendchat.php', { id: chat }, function(data) {
        $("#chat-box").val("");
      });
    });

    $("#close-game-room").click(function(){
        $(".game-room").hide();
    });

    $(document).on("click", "#startGame", function(e){
        e.preventDefault();
        window.location.assign("../OnlineGame/connections/gamemap.php");
    });

    $(document).on("click", "#battle-btn", function(e){
        e.preventDefault();
        window.location.assign("../connections/battle.php");
    });

    $(document).on("click", ".map_columns", function(){
        var x = $(this).attr("data-x");
        var y = $(this).attr("data-y");
        $.post('../connections/gamemap.php', {x: x, y: y}, function(data){
            location.reload();
        });
    });

    setInterval(function (){
        $(".reFreshName").load("./connections/updateserver.php");
        $(".users").load("./connections/updatelobby.php");
        $(".chatOutput").load("./connections/updatechat.php");
        $("#lobby-left").load("./connections/updaterooms.php");
        $(".game-room").load("./connections/gameroom.php");
        $(".currentPlayers").load("../connections/battle.php");
    }, 1000);
});
