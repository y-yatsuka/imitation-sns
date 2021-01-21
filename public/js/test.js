function OnButtonClick() {
     target = document.getElementById("output");
     buf = document.getElementById("buf")
     if(target.innerHTML == "Penguin"){
       target.innerHTML=buf.value;
     }else{
       target.innerHTML="Penguin";
     }
   }
