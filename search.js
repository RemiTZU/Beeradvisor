function cb_clique(e) {
    let affiche = document.getElementById(e.target.className);
    if (affiche.style.visibility == 'visible') {
        affiche.style.visibility = 'hidden';
    } else {
        affiche.style.visibility = 'visible'
    }
}