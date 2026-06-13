document.addEventListener('DOMContentLoaded', () => {

    document.querySelectorAll('.cambiar-estado')
    .forEach(btn => {

        btn.addEventListener('click', () => {

            const id = btn.dataset.id;

            fetch(`/productos/${id}/estado`, {

                method: 'PATCH',

                headers: {

                    'X-CSRF-TOKEN':
                    document.querySelector(
                    'meta[name="csrf-token"]'
                    ).content,

                    'Accept': 'application/json'

                }

            })

            .then(response => response.json())

            .then(data => {

                if(data.success){

                    location.reload();

                }

            });

        });

    });

});