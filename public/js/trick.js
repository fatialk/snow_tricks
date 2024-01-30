// DELETE TRICK //

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
                location.reload();
                const trick = document.querySelector('div[data-trick-id="'+trickId+'"]');
                trick.remove();
                const myModal = bootstrap.Modal.getOrCreateInstance(modal);
                myModal.hide();
            }
        });

    } )
})


// ADD IMAGE AND VIDEO //

const addVideoLink = document.createElement('a')
addVideoLink.classList.add('add_video_list')
addVideoLink.href='#'
addVideoLink.innerText='Add a video'
addVideoLink.dataset.collectionHolderClass='videos'
document.createElement('li').append(addVideoLink)

const collectionVideos = document.querySelector('ul.videos')
collectionVideos.appendChild(addVideoLink)

const addImage = document.createElement('a')
addImage.classList.add('add_image_list')
addImage.href='#'
addImage.innerText='Add an illustration'
addImage.dataset.collectionHolderClass='images'
document.createElement('li').append(addImage)

const collectionImages = document.querySelector('ul.images')
collectionImages.appendChild(addImage)

const addFormToCollection = (e) => {
  e.preventDefault();
	const collectionHolder = document.querySelector('.' + e.currentTarget.dataset.collectionHolderClass);

      const item = document.createElement('li');

      item.innerHTML = collectionHolder
        .dataset
        .prototype
        .replace(
          /__name__/g,
          collectionHolder.dataset.index
        );

      collectionHolder.appendChild(item);

      collectionHolder.dataset.index++;
      addListenerToInputFiles();
}

addVideoLink.addEventListener("click", addFormToCollection)
addImage.addEventListener("click", addFormToCollection)


const previewPhoto = (e) => {
  const input = e.currentTarget;
  const file = input.files;
    if (file) {
        const fileReader = new FileReader();


        fileReader.onload = function (event) {
          const parent = input.parentNode;
          let preview = input.parentNode.querySelector('img');
          if(!preview)
          {
          const wrapper = document.createElement('div');
          wrapper.classList.add('flex')
          parent.replaceChild(wrapper, input);
          wrapper.appendChild(input);
          preview = document.createElement('img');
          preview.setAttribute('width', '100');
          wrapper.appendChild(preview);
          }

          if(preview)
          {
            preview.setAttribute('src', event.target.result);
          }


        }
        fileReader.readAsDataURL(file[0]);

    }
}

const addListenerToInputFiles = (e) => {
const fileInputs = document.querySelectorAll('input.imageAddInput');
fileInputs.forEach(fileInput => {
fileInput.addEventListener("change", previewPhoto);
});
}
addListenerToInputFiles();
