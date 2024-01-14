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


