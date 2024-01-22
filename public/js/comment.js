if (document.querySelector('button.addComment')){
  document.getElementsByTagName('form')[0].addEventListener('submit', (e) => {
    e.preventDefault();
    const loader = document.querySelector('.loader');
    loader.classList.remove('d-none');
    let form = e.target;
    fetch(form.action, { method: form.method, body: new FormData(form) })
      .then(response => response.json())
      .then(response => {
        if(response.status === 'success')
        {
          const commentList = document.querySelector('.comment-list');
          const newComment = `<div class="single-comment justify-content-between d-flex bg-light mb-2 p-2">
												<div class="user justify-content-between d-flex">
													<div class="thumb">
														<img src="uploads/avatar/`+response.avatar+`" alt="">
													</div>
													<div class="desc">
														<h5>
															<a href="#">`+response.username+`</a>
														</h5>
														<p class="date">`+response.createdAt+`
														</p>
														<p class="comment">
                            `+response.comment+`
														</p>
													</div>
												</div>
											</div>`;
                      commentList.insertAdjacentHTML("afterbegin",newComment);
                      loader.classList.add('d-none');
        }

      });

    return false;
  });
}


