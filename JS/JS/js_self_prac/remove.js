const list = document.querySelectorAll('li');
list[0].remove();

document.querySelector('.clear-tasks').addEventListener('click',onclickShow);

function onclickShow(e){

e.target.textContent='hello';
e.preventDefault();
}
