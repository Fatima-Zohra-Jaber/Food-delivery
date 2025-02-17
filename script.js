

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

function filterPlats() {
    let selectedCategories = document.querySelectorAll('.boxCategorie:checked');
    console.log(selectedCategories);
    let listCategories = [];
    selectedCategories.forEach((checkbox) => {
    listCategories.push(checkbox.value);
    console.log(checkbox.value);

    });

    let plats = document.querySelectorAll('.plat');
    let categories = document.querySelectorAll('.categorie');
   
}

