document.addEventListener("DOMContentLoaded", () => {
    const btnSearch = document.getElementById("recherche")

    if (btnSearch) {
        btnSearch.addEventListener("click", () => {
            // Récuprationon des 3 valeurs
            const departValue = document.getElementById('depart').value
            const arriveeValue = document.getElementById('arrivee').value
            const dateValue = document.getElementById('date').value
            // Appel methode
            getCovoitRecherches(departValue, arriveeValue, dateValue)
        })
    }

}) 

/**
 * Gets the filtered covoit
 * @param {string} depart depart
 * @param {string} arrivee arrivee
 * @param {date} date date
 */
function getCovoitRecherches(depart, arrivee, date) {
    $.ajax({
        url: '/covoiturage/getCovoitRecherches',
        method: 'GET',
        data: {
            'depart': depart,
            'arrivee': arrivee,
            'date': date,
        }
    }).done((response) => {
        console.log(response)
        // Test
        alert("OK")
        // filterCovoit(response['allCarIds'], response['fielteredIds'])
    }).fail((response) => {
        alert("Une erreur est survenue lors de la recherche")
    })
}

// TODO
function filterCovoit() {

}

