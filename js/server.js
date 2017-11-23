$(document).ready(function(){

    function createServer(type,obj,obj_id,url,show_parent,refreshType,refreshObj,show,hide,data_url){
        noRefresh(refreshType,refreshObj,show,hide);
        $(document).on(type, obj, function(e){
            e.preventDefault();
            $(show_parent).show();
            var id = $(this).attr(obj_id);
            $.post(url, {id: id}, function(data){
                $(data_url).html(data);
            });
        });
    }
    function checkObjAttr(type,obj,attr)
    {
        $(document).on(type,obj, function(){
            alert($(this).attr(attr));
        });
    }
    function noRefresh(type,obj,show,hide)
    {
        $(document).on(type,obj, function(e){
            e.preventDefault();
            $(show).show();
            $(hide).hide();
        });
    }

    createServer("click","#delete-room","data-roomid","./connections/deleteroom.php");
    createServer(null,null,null,null,null,"click","#stop-room-creation",null,".room-creation");
    createServer("click",".player","data-id","./playerInfo.php",".playerInfo",null,null,null,null,".playerInfo");
    createServer("click",".roomBtn","id","./connections/roomid.php",".game-room",null,null,null,null,".game-room");
    createServer("click","#close-game-room","data-roomid","./connections/deletegameroom.php");
    createServer("click","#hituser","data-id","../connections/functions.php");

    noRefresh("click","#close-room-creation",null,".room-creation");
    noRefresh("click",".card-x",null,".playerInfo");
    noRefresh("click","#new-room",".room-creation",null);
    noRefresh("click","#close-game-room",null,".game-room");

});
