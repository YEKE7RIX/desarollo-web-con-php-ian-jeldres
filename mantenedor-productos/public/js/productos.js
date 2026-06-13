document.addEventListener('DOMContentLoaded', () => {

    const botones = document.querySelectorAll('.cambiar-estado');
    const csrf = document.querySelector('meta[name="csrf-token"]');

    if (!csrf) {
        return;
    }

    botones.forEach((boton) => {

        boton.addEventListener('click', async () => {

            const id = boton.dataset.id;

            boton.disabled = true;

            try {

                const respuesta = await fetch(`/productos/${id}/estado`, {

                    method: 'PATCH',

                    headers: {
                        'X-CSRF-TOKEN': csrf.content,
                        'Accept': 'application/json'
                    }

                });

                if (!respuesta.ok) {
                    throw new Error('No fue posible cambiar el estado.');
                }

                const datos = await respuesta.json();

                if (datos.success) {
                    window.location.reload();
                }

            } catch (error) {

                alert('No fue posible cambiar el estado del producto.');
                boton.disabled = false;

            }

        });

    });

});