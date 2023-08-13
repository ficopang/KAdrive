var addFolderModal = document.getElementById('add-folder-modal-container');
var renameModal = document.getElementById('rename-modal-container');
var deleteModal = document.getElementById('delete-modal-container');

function showModal(elem) {
  if (elem == 0) {
    addFolderModal.style.display = 'block';
  } else if (elem == 1) {
    if (!isFile && !isFolder) {
      return;
    }
    let name = '';

    if (isFile) {
      name =
        fileChoosedSource.split('/')[fileChoosedSource.split('/').length - 1];
    } else if (isFolder) {
      name =
        folderChoosedSource.split('/')[
          folderChoosedSource.split('/').length - 1
        ];
    }

    document.getElementById('old-name').value = name;
    document.getElementById('new-name').value = name;

    renameModal.style.display = 'block';
  } else if (elem == 2) {
    if (!isFile && !isFolder) {
      return;
    }
    let name = '';

    if (isFile) {
      name =
        fileChoosedSource.split('/')[fileChoosedSource.split('/').length - 1];
    } else if (isFolder) {
      name =
        folderChoosedSource.split('/')[
          folderChoosedSource.split('/').length - 1
        ];
    }

    document.getElementById('f-name').value = name;

    deleteModal.style.display = 'block';
  }
}

var folders = document.getElementsByClassName('folder');
var files = document.getElementsByClassName('file');

if (document.getElementsByClassName('file-container').length) {
  document.getElementsByClassName('file-container')[0].onclick = fileChoosed;
}

if (document.getElementsByClassName('folder-container').length) {
  document.getElementsByClassName('folder-container')[0].onclick =
    folderChoosed;
}

document.body.onclick = checkButtonSelected;

var fileChoosedSource;
var folderChoosedSource;

var isFile = false;
var isFolder = false;

function folderChoosed(e) {
  if (e.target.tagName == 'IMG' || e.target.tagName == 'P') {
    folderChoosedSource = e.path[1].children[0].defaultValue;
  } else {
    folderChoosedSource = e.srcElement.children[0].defaultValue;
  }
}

function fileChoosed(e) {
  if (e.target.tagName == 'IMG') {
    fileChoosedSource = e.path[1].children[0].defaultValue;
  }
}

function checkButtonSelected() {
  let isChoosed = false;
  for (let i = 0; i < files.length; i++) {
    if (files[i] === document.activeElement) {
      isChoosed = true;
      isFile = true;
      isFolder = false;
    }
  }

  for (let i = 0; i < folders.length; i++) {
    if (folders[i] === document.activeElement) {
      isChoosed = true;
      isFolder = true;
      isFile = false;
    }
  }

  if (!isChoosed) {
    isFolder = false;
    isFile = false;
  }
}

function downloadButton() {
  if (isFile) {
    let source = fileChoosedSource.slice(1);
    let fileName =
      fileChoosedSource.split('/')[fileChoosedSource.split('/').length - 1];

    window.location.href =
      '/controller/download/downloadFileController.php?source=' +
      source +
      '&file=' +
      fileName;
  }

  if (isFolder) {
    let folderName =
      folderChoosedSource.split('/')[folderChoosedSource.split('/').length - 1];

    window.location.href =
      '/controller/download/downloadFolderController.php?source=' +
      folderChoosedSource +
      '&folder=' +
      folderName;
  }
}

if (document.getElementsByClassName('folder-container').length) {
  document.getElementsByClassName('folder-container')[0].ondblclick = moveDir;
}

function moveDir(e) {
  if (e.target.tagName == 'IMG' || e.target.tagName == 'P') {
    folderChoosedSource = e.path[1].children[0].defaultValue;
  } else {
    folderChoosedSource = e.srcElement.children[0].defaultValue;
  }

  let currLocation = window.location.href;
  let nextLocation = folderChoosedSource.replace('/all-drives', '');
  window.location.href =
    currLocation.slice(0, currLocation.indexOf('&dir=')) +
    '&dir=' +
    nextLocation +
    '/';
}
