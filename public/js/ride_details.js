document.addEventListener('DOMContentLoaded', function() {    
    const buttons = document.querySelectorAll('[data-id-trajet]');

        buttons.forEach(function(button) {
            button.addEventListener('click', function() {

                const idTrajet = button.dataset.idTrajet;
                fetch('/connected/detail/' + idTrajet)
                    .then(function(response) {

                        return response.json()
                    })
                    .then(function(data) {

                        const detail = data[0];
                        document.getElementById('authorModal').textContent = detail['nom'] + ' ' + detail['prenom'];
                        document.getElementById('phoneModal').textContent = detail['telephone'];
                        document.getElementById('emailModal').textContent = detail['email'];
                        document.getElementById('totalSeatsModal').textContent = detail['nb_places_total'];
                    });
            });
        });
    });