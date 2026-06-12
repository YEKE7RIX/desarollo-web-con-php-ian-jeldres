document.addEventListener('DOMContentLoaded', () => {

    document.querySelectorAll('.btnEstado')
        .forEach(btn => {

            btn.addEventListener('click', () => {

                const id = btn.dataset.id;

                fetch(`/productos/${id}/estado`, {

                    method: 'PATCH',

                    headers: {

                        'X-CSRF-TOKEN':
                        document.querySelector(
                        'meta[name="csrf-token"]')
                        ?.content || ''

                    }

                })

                .then(() => {

                    location.reload();

                });

            });

        });

});