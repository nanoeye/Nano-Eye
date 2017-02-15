$(document).ready(function(){
    $('#form1').validate({
        rules:{
            word:{
                required:true
            },
            spelling:{
                required:true
            },
            meaning:{
                required:true
            },
            cat:{
                required:true
            }
        },
        messages:{
            word:{
                required:"You must enter a word."
            },
            spelling:{
                required:"You must enter the word\'s spelling."
            },
            meaning:{
                required:"You must enter the word\'s meaning."
            },
            cat:{
                required:"You must select any category."
            }
        }
    });
});


