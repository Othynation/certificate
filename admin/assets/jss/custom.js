  function genPDF(name,quality = 10) {
    $("#dload").hide();
              $('#loading').html('<img src="assets/icon/subloader.gif" height="80" style="margin-top:-20px;">');
        const filename = name+'.pdf';
         window.scrollTo(0,0); 
        html2canvas(document.querySelector('#testDiv'), 
                                {scale: quality,
                                width:840,
                            }
                         ).then(canvas => {
            var pdf = new jsPDF("l", "px", [828, 587]);
       
//          html2canvas(document.querySelector('#testDiv'), 
//                                 {
//                                     scale: quality,
//                                     width:840,

                             
//                             }
//                          ).then(canvas => {
//             var pdf = new jsPDF({
// orientation: 'l',
//         unit: 'pt',
//         format: [canvas.width,canvas.height],

//             });
            
            var imgData = canvas.toDataURL('image/jpeg');
            var imgProps= pdf.getImageProperties(imgData);
                var pdfWidth = pdf.internal.pageSize.getWidth();
        var pdfHeight = (imgProps.height * pdfWidth) / imgProps.width;
            pdf.addImage(imgData, 'JPEG', 0, 0, pdfWidth, pdfHeight);
            pdf.save(filename);
             $('#loading').html('');
               $("#dload").show();
                setTimeout(function(){ 
       window.close();
}, 1000);

              
        });


    }
    