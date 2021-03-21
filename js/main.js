/*global showPage*/



//soinner

var myVar;

function myFunction() {
    
    "use strict";

    myVar = setTimeout(showPage, 2000);
    
}

function showPage() {
    
    "use strict";
  
    document.getElementById("loader").style.display = "none";
    document.getElementById("myDiv").style.display = "block";
    new WOW().init();

}






// rel

/*
function showRel1() {
    
    "use strict";
    
    document.getElementById("form-1").style.display = "block";
    document.getElementById("form-2").style.display = "none";
    document.getElementById("form-3").style.display = "none";
    document.getElementById("form-4").style.display = "none";

}



function showRel2() {
    
    "use strict";
    
    document.getElementById("form-1").style.display = "none";
    document.getElementById("form-2").style.display = "block";
    document.getElementById("form-3").style.display = "none";
    document.getElementById("form-4").style.display = "none";
    
}



function showRel3() {
    
    "use strict";
    
    document.getElementById("form-1").style.display = "none";
    document.getElementById("form-2").style.display = "none";
    document.getElementById("form-3").style.display = "block";
    document.getElementById("form-4").style.display = "none";
    
}




function showRel4() {
    
    "use strict";
    
    document.getElementById("form-1").style.display = "none";
    document.getElementById("form-2").style.display = "none";
    document.getElementById("form-3").style.display = "none";
    document.getElementById("form-4").style.display = "block";

}


*/







