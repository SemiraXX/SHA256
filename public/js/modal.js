

//open team modal
$(document).on('click', '.add-team-button', function(){  
    $('#addteam').modal('show');        
});


//open categ modal
$(document).on('click', '.add-categ-button', function(){  
    $('#category').modal('show');        
});


//view report modal
$(document).on('click', '.view-report-button', function(){  
    var id = $(this).attr("id");  
    if(id != '')  
    {  
         $.ajax({  
              url:"/viewReport",  
              method:"GET",  
              data:{id:id},  
              success:function(data){  
                   $('#reportareponsedata').html(data);  
                   $('#reportmodal').modal('show');  
              }  
         });  
    }            
});


//edit acoount modal
$(document).on('click', '.edit-account-button', function(){  
    var id = $(this).attr("id");  
    if(id != '')  
    {  
         $.ajax({  
              url:"/Edit/Team",  
              method:"GET",  
              data:{id:id},  
              success:function(data){  
                   $('#accountareponsedata').html(data);  
                   $('#editaccount').modal('show');  
              }  
         });  
    }            
});


//delete acoount modal
$(document).on('click', '.delete-account-button', function(){  
    var id = $(this).attr("id");  
    if(id != '')  
    {  
         $.ajax({  
              url:"/Delete/Team",  
              method:"GET",  
              data:{id:id},  
              success:function(data){  
                   $('#accountdeleteareponsedata').html(data);  
                   $('#deleteaccount').modal('show');  
              }  
         });  
    }            
});



//open upload modal
$(document).on('click', '.upload-fille-button', function(){  
     $('#uploadmodal').modal('show');        
});

var myVar;

function myFunction() {
  myVar = setTimeout(showPage, 3000);
}

function showPage() {
  document.getElementById("loader").style.display = "none";
  document.getElementById("myDiv").style.display = "block";
}


 //redirect
 $(document).on('click', '.checkfile', function(){  
     window.location.replace("/Check/File");      
 });