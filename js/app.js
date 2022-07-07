window.addEventListener('DOMContentLoaded', (event) => {
    console.log('Attivo');
    selezionaMeseAllenamentoAttivo();
});

//Attiva la proprietà selected sul mese in visualizzazione del calendario.
function selezionaMeseAllenamentoAttivo() {
    const meseCalendario = document.querySelector('h2').dataset.mese;
    const attivaSelezioneMese = document.getElementById(meseCalendario).selected = "true";
}