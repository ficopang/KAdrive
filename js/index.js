
var modals = document.getElementsByClassName('modal-container');

function closeModal(){
    for(let i=0; i<modals.length; i++){
        modals[i].style.display = "none";
    }
}

function closeMsg(){
    document.getElementsByClassName('error-msg')[0].style.display = "none";
}