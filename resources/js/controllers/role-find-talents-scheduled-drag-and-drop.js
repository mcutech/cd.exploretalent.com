function handleDragStart(e) {
  this.style.opacity = '0.5';  // this / e.target is the source node.
   dragSrcEl = this;

  e.dataTransfer.effectAllowed = 'move';
  e.dataTransfer.setData('text/html', this.innerHTML); 
}

function handleDragOver(e) {
  this.style.opacity = '1';
  if (e.preventDefault) {
    e.preventDefault(); // Necessary. Allows us to drop.
  }

  e.dataTransfer.dropEffect = 'move';  // See the section on the DataTransfer object.

  return false;
  this.classList.add('over');
}

function handleDragEnter(e) {
  this.classList.add('over');
}

function handleDragLeave(e) {
  this.style.opacity = '1';
  this.classList.remove('over'); 
}

function handleDrop(e) {
  this.classList.remove('over');
  if (e.stopPropagation) {
    e.stopPropagation(); // stops the browser from redirecting.
  }
  if (dragSrcEl != this) {
    // Set the source column's HTML to the HTML of the column we dropped on.
    dragSrcEl.innerHTML = this.innerHTML;
    this.innerHTML = e.dataTransfer.getData('text/html');
  }
  event.preventDefault();

  return false;
}

function handleDragEnd(e) {
  this.style.opacity = '1';
  [].forEach.call(cols, function (col) {
    col.classList.remove('over');
  });
  this.classList.remove('over');
}

var cols = document.querySelectorAll('.role-list-body .draggable-item');
[].forEach.call(cols, function(col) {
  col.addEventListener('dragstart', handleDragStart, false);
  col.addEventListener('dragenter', handleDragEnter, false);
  col.addEventListener('dragover', handleDragOver, false);
  col.addEventListener('dragleave', handleDragLeave, false);
  col.addEventListener('drop', handleDrop, false);
  col.addEventListener('dragend', handleDragEnd, false);
});