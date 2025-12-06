document.addEventListener("DOMContentLoaded", function() { 
    const contactCols = document.querySelectorAll('.dk-contact-form .contact-form-row .contact-column-6'); 
    
    if(contactCols.length > 0 ) { 
        const lastContactCol = contactCols[contactCols.length - 1]; 
        if (contactCols.length % 2 !== 0) { 
            lastContactCol.classList.remove("contact-column-6", "col-md-6"); 
            lastContactCol.classList.add("contact-column-12", "col-md-12"); 
        } 
    } 


    const  compareRow = document.querySelectorAll('tr');
    console.log(compareRow)











});















