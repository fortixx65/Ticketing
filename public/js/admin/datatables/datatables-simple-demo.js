window.addEventListener('DOMContentLoaded', event => {
    // Simple-DataTables
    // https://github.com/fiduswriter/Simple-DataTables/wiki

    const datatablesSimple = document.getElementById('datatablesSimple');
    if (datatablesSimple) {
        new simpleDatatables.DataTable(datatablesSimple, {
            labels: { 
                placeholder: "Rechercher...",
                perPage: "Afficher {select} éléments",
                noRows: "Aucune données",
                info: "Affichage de l'élément {start} à {end} sur {rows} éléments",
            }
        });}
});
