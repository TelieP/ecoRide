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
         if (!Array.isArray(response)) {
            response = Object.values(response);
        }
        filterCovoit(response)
    }).fail((response) => {
        alert("Une erreur est survenue lors de la recherche")
    })
}

/**
 * Filters the covoits elements
 * @param {array} filteredCovoits 
 */
function filterCovoit(filteredCovoits) {
    // Nombre de covoits
    // FIXME
    // const covoitNumber = document.getElementById("covoitNumbers")
    // covoitNumber.textContent = filteredCovoits.length
   // Modification de la recherche
    const covoituragesElement = document.getElementById("covoiturages")
    covoituragesElement.innerHTML = ""
    filteredCovoits.forEach((covoit) => {
        console.log(covoit)
        covoituragesElement.innerHTML += "<tr>" +
        + "<td>" + covoit.lieu_depart + "</td>"
        + "<td>" + covoit.lieu_arrivee + "</td>"
        + "<td>" + new Date(covoit.date_depart).toLocaleDateString("fr-FR") + "</td>"
        + "<td>" + new Date(covoit.date_arrivee).toLocaleDateString("fr-FR") + "</td>"
        + "<td>" + covoit.heure_depart + "</td>"
        + "<td>" + covoit.nb_place + "</td>"
        + "<td>" + covoit.prix_personne + " €</td>"
        + "<td>"
            + "<a href=\"{{ path('app_covoiturage_show', {'id': " + covoit.id + "}) }}\" class=\"btn btn-info btn-sm\">Voir</a>"
           + " <a href=\"{{ path('app_covoiturage_edit', {'id':" + covoit.id + "}) }}\" class=\"btn btn-warning btn-sm\">Réserver</a>"
        + "</td>"
    + "</tr>"
    })
}

