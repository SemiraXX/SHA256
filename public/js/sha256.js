

function hashfile() {

    readbinaryfile(fileselector.files[0])
      .then(function(result) {
        result = new Uint8Array(result);
        return window.crypto.subtle.digest('SHA-256', result);
      }).then(function(result) {
        result = new Uint8Array(result);
        var resulthex = Uint8ArrayToHexString(result);
        var fileName = document.getElementById('fileselector').files[0].name;
        var ext = document.getElementById('fileselector').files[0].name;
        document.getElementById("filehashcode").value = resulthex;
        document.getElementById("fileName").value = fileName.split('.').slice(0, -1).join('.');
        document.getElementById("fileCateg").value = "."+fileName.split('.')[1];;
      });

}
  
function readbinaryfile(file) {
    return new Promise((resolve, reject) => {
      var fr = new FileReader();
      fr.onload = () => {
        resolve(fr.result)
      };
      fr.readAsArrayBuffer(file);
    });
}
  
function Uint8ArrayToHexString(ui8array) {
    var hexstring = '',
      h;
    for (var i = 0; i < ui8array.length; i++) {
      h = ui8array[i].toString(16);
      if (h.length == 1) {
        h = '0' + h;
      }
      hexstring += h;
    }
    var p = Math.pow(2, Math.ceil(Math.log2(hexstring.length)));
    hexstring = hexstring.padStart(p, '0');
    return hexstring;
}


//on file upload 
$(".uploadwrapperdesign").unbind("click").bind("click", function () {
  $("#fileselector").click();
});



//AJAX FUNCTION TO GET RESULT FROM CONTROLLER
$(document).on('click', '.result', function(){  
    
    var mainfile = $("#mainfile").val();
    var originalfile = $("#originalfile").val();

    if(filehashcode != '')  
    {  
         $.ajax({  
              url:"/Check",  
              method:"Get",  
              data:{mainfile:mainfile,originalfile:originalfile},  
              success:function(data){  
                   $('#responsedata1').html(data);
              }  
         });  
    }
    else
    {
      alert("Required: Choose file first.");
    }

});


$("form#files").submit(function(){

  var formData = new FormData($(this)[0]);

  $.ajax({
      url: "/Check",
      type: 'Post',
      data: formData,
      success: function (data) {
        $('#responsedata1').html(data);
      }
  });

  return false;
});


