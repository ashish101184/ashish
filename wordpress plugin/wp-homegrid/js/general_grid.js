/*Display ideal image size acccording to selected box */
function boximagesize(boxsize){
   if(boxsize){
     
     if(boxsize =='1,1'){
       $("#imgsize_divid").show();
       $("#imgsize_spanid").html("330x428");
     }
     
     if(boxsize =='1,2'){
       $("#imgsize_divid").show();
       $("#imgsize_spanid").html("330x886");
     }
     
     if(boxsize =='2,1'){
       $("#imgsize_divid").show();
       $("#imgsize_spanid").html("670x428");
     }
     
     if(boxsize =='2,2'){
       $("#imgsize_divid").show();
       $("#imgsize_spanid").html("670x886");
     }
     
     if(boxsize =='3,1'){
       $("#imgsize_divid").show();
       $("#imgsize_spanid").html("1010x428");
     }    
     
   }else {
      $("#imgsize_divid").hide();
   }
   
 }