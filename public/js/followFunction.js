
$(document).ready(function () {

  $('#btn').click(function(){
    button=$('#btn');
    $.ajax({
         url:'/user/follow',
         type:'POST',
         headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
         data:{
             user_id:$('#user_id').val()
         }
     })
     // Ajaxリクエストが成功した時発動
       .done( (data) => {
       //ボタンの文字をフォロー中か否かによって変える
       if(button.text().trim()=="フォローをはずす"){
         button.text("フォローする");
       }else{
         button.text("フォローをはずす");
       }
     })
     // Ajaxリクエストが失敗した時発動
     .fail( (data) => {
         console.log(data);
     })
   });
})
