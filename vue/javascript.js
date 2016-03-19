window.addEventListener("load", function(){
    
    var radioBoutons = document.querySelectorAll("input[type=radio]");
    var societe = document.getElementById("societe");
    var poids = document.getElementById("poids");
    
        radioBoutons[0].addEventListener("change", function(){
            if(radioBoutons[0].checked)
            {
                societe.disabled = false;
            }
        });
    
        radioBoutons[1].addEventListener("change", function(){
            if(radioBoutons[1].checked)
            {
                societe.disabled = true;
                societe.value = "";
            }
        });
    
        radioBoutons[2].addEventListener("change", function(){
            if(radioBoutons[2].checked)
            {
                poids.disabled = false;
            }
        });
    
        radioBoutons[3].addEventListener("change", function(){
            if(radioBoutons[3].checked)
            {
                poids.disabled = true;
                poids.value = "";
            }
        });
});