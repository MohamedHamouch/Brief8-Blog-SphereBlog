const sideBar = document.querySelector('#side-menu');
const sideChoices = sideBar.querySelectorAll('button');
const contentSections = document.querySelectorAll('.content-section');

// console.log(sideChoices);

sideChoices.forEach(choice => {
  choice.addEventListener('click', () => {
    const sectionId = choice.dataset.section;
    contentSections.forEach(section => {
      section.classList.add('hidden');
    });
    const selectedSection = document.querySelector(`#${sectionId}`);
    selectedSection.classList.remove('hidden');

  });
});


const editArticleForm = document.querySelector('#edit-article-form');
const editArticleBtns = document.querySelectorAll('.edit-article-btn');
const cancelArticleFormBtn = document.querySelector('#cancel-edit-article');

editArticleBtns.forEach(btn => {
  btn.addEventListener('click', () => {
    editArticleForm.classList.remove('hidden');
  });
});

cancelArticleFormBtn.addEventListener('click', () => {
  editArticleForm.classList.add('hidden');
});