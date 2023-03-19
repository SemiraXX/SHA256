

function hashfile() {

    readbinaryfile(fileselector.files[0])
      .then(function(result) {
        result = new Uint8Array(result);
        return window.crypto.subtle.digest('SHA-256', result);
      }).then(function(result) {
        result = new Uint8Array(result);
        var resulthex = Uint8ArrayToHexString(result);
        //divresult.innerText = 'result: ' + resulthex;
        document.getElementById("filehashcode").value = resulthex;
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
    
    var filehashcode = $("#filehashcode").val();
    var originalfile = $("#originalfile").val();
    var fileselector = $("#fileselector").val().split('\\').pop();

    if(filehashcode != '')  
    {  
         $.ajax({  
              url:"/Check",  
              method:"Get",  
              data:{filehashcode:filehashcode,originalfile:originalfile,fileselector:fileselector},  
              success:function(data){  
                   $('#responsedata1').html(data);
              }  
         });  
    }
    else
    {
      alert("File Empty");
    }

});



