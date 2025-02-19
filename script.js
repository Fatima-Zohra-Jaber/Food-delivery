

let qtSpan = document.getElementById("quantite");
let quantite = parseInt(qtSpan.innerHTML);

function changerQuantite(action){
    if(action === "increment"){
        quantite++;
    }else if (action === 'decrement' && quantite > 1) {
        quantite--;
    }
    document.getElementById("qtInput").value = quantite;
    qtSpan.innerHTML = quantite;
}

