/** load more tricks **/

if (document.querySelector('button#loadMore')){
document.querySelector('button#loadMore').addEventListener("click", function() {
  const hiddenArticles = document.querySelectorAll('.trick.d-none');
  const hiddenArticles6 = Array.from(hiddenArticles).slice(0, 6);
  hiddenArticles6.forEach((element) => element.classList.remove("d-none"));
  const hiddenArticlesMAj = document.querySelectorAll('.trick.d-none').length;
  if(hiddenArticlesMAj === 0)
  {
    this.classList.add('d-none');
  }
});
}

/** load more comments **/

if (document.querySelector('button#loadMore')){
  document.querySelector('button#loadMore').addEventListener("click", function() {
    const hiddenComments = document.querySelectorAll('.comment.d-none');
    const hiddenComments10 = Array.from(hiddenComments).slice(0, 10);
    hiddenComments10.forEach((element) => element.classList.remove("d-none"));
    const hiddenCommentsMAj = document.querySelectorAll('.comment.d-none').length;
    if(hiddenCommentsMAj === 0)
    {
      this.classList.add('d-none');
    }
  });
  }

  /** header user **/



    document.querySelector('div#create-logout').addEventListener("click", function() {
      const elements = document.querySelector('ul.link');
      console.log(elements);
      if (elements.classList.contains("d-none")){
      elements.classList.remove("d-none");
      }else{
      elements.classList.add("d-none");
      }
    })


// FADE OUT FLASH MESSAGE //


const flashMessage = document.querySelector('div.alert-success');

console.log(flashMessage);

setTimeout(function() {
  flashMessage;
  flashMessage.style.display = 'none';
}, 5000);



/** BACK TO TOP BUTTON **/


//Get the button
let mybutton = document.getElementById("btn-back-to-top");

// When the user scrolls down 20px from the top of the document, show the button
window.onscroll = function () {
  scrollFunction();
};

function scrollFunction() {
  if (
    document.body.scrollTop > 20 ||
    document.documentElement.scrollTop > 20
  ) {
    mybutton.style.display = "block";
  } else {
    mybutton.style.display = "none";
  }
}
// When the user clicks on the button, scroll to the top of the document
mybutton.addEventListener("click", backToTop);

function backToTop() {
  document.body.scrollTop = 0;
  document.documentElement.scrollTop = 0;
}

