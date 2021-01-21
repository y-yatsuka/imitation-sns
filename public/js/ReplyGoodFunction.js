$(document).ready(function () {

  //いいねボタンを押したときの処理
  $('#goodButton').click(function(){
    button=$('#goodButton');
    $.ajax({
         url:'/reply/good',
         type:'POST',
         headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
         data:{
             reply_id:$('#reply_id').val()
         }
     })
     // Ajaxリクエストが成功した時発動
     .done( (data) => {
       //いいねの件数とボタンの文字を変更
       $('#goodCount').html('いいね!:'+data.result+'件');
       if(button.html().trim()=='いいね!'){
         button.html('いいねを取り消す');
       }else{
         button.html('いいね!')
       }
     })
     // Ajaxリクエストが失敗した時発動
     .fail( (data) => {
         console.log(data);
     })
  });

  goodCount();
});

//いいねの件数をリアルタイムで表示する関数
function goodCount(){
  $.ajax({
       url:'/reply/good/count',
       type:'POST',
       headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
       data:{
           reply_id:$('#reply_id').val()
       }
   })
   // Ajaxリクエストが成功した時発動
   .done( (data) => {
     //現在のいいねの件数を表示し、その後再帰する
     $('#goodCount').html('いいね!: '+data.result+'件');
     setTimeout('goodCount()',1000);
   })
   // Ajaxリクエストが失敗した時発動
   .fail( (data) => {
       $('.result').html(data);
       console.log(data);
   })
}
