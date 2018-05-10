$(document).ready(function(){
    /*post message via ajax*/
    $("#reply").on("click", function(){
        var message = $.trim($("#message").val()),
            conversation_id = $.trim($("#conversation_id").val()),
            user_form = $.trim($("#user_form").val()),
            user_to = $.trim($("#user_to").val()),
            error = $("#error");
 
        if((message != "") && (conversation_id != "") && (user_form != "") && (user_to != "")){
            error.text("Sending...");
            $.post("/message/post_message_ajax",{message:message,conversation_id:conversation_id,user_form:user_form,user_to:user_to}, function(data){
                error.text("sent");
                //clear the message box
                $("#message").val("");
            });
        }
    });
 
 
    //get message
    c_id = $("#conversation_id").val();
    //get new message every 2 second
    setInterval(function(){
        $(".display-message").load("/message/get_message_ajax?c_id="+c_id);
    }, 1000);
 
     setInterval(function(){
        $(".contacts").load("/message/conversation_display");
    }, 1000);

   // $(".display-message").scrollTop($(".display-message")[0].scrollHeight);
});

function update(id)
{
     $.post("/message/update",
    {
        id: id
    },
    function(data, status){
        //alert("Data: " + data + "\nStatus: " + status);
    });
}