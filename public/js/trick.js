const modal= document.getElementById('modal')
modal.addEventListener('show.bs.modal', function (event) {
    // Button that triggered the modal
    const button = event.relatedTarget
    // Extract info from data-bs-* attributes
    const title = button.getAttribute('data-modal-title')
    const body = button.getAttribute('data-modal-body')
    const labelButton = button.getAttribute('data-modal-button-label')

    // If necessary, you could initiate an AJAX request here
    // and then do the updating in a callback.
    //
    // Update the modal's content.
    const modalTitle = modal.querySelector('.modal-title')
    const modalBody = modal.querySelector('.modal-body')
    const removeButton = modal.querySelector('.removeButton')

    modalTitle.textContent = title
    modalBody.textContent = body
    removeButton.textContent = labelButton;
    removeButton.addEventListener('click', (e)=>{
        const trickId = button.getAttribute('data-modal-trick-id')
        const removeUrlButton = button.getAttribute('data-modal-remove-url')

        fetch(removeUrlButton, { method: 'DELETE'})
        .then(response => response.json())
        .then(response => {
            if(response.status === 'success')
            {
                const trick = document.querySelector('div[data-trick-id="'+trickId+'"]');
                trick.remove();
                const myModal = bootstrap.Modal.getOrCreateInstance(modal);
                myModal.hide();
            }
        });

    } )
})