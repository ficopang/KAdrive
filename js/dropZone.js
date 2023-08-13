function getParameterByName(name, url = window.location.href) {
  name = name.replace(/[\[\]]/g, '\\$&');
  var regex = new RegExp('[?&]' + name + '(=([^&#]*)|&|#|$)'),
    results = regex.exec(url);
  if (!results) return null;
  if (!results[2]) return '';
  return decodeURIComponent(results[2].replace(/\+/g, ' '));
}

function uploadFile(e) {
  e.preventDefault();

  var files = e.dataTransfer.files;

  let isFolder = false;

  for (var i = 0, f; (f = files[i]); i++) {
    if (!f.type && f.size % 4096 == 0) {
      isFolder = true;
    }
  }

  if (isFolder == false) {
    ajax_file_upload(e.dataTransfer.files);
  } else {
    alert("You can't upload folder.");
  }
}

function allowDrop(e) {
  e.preventDefault();
}

function ajax_file_upload(files_obj) {
  if (files_obj != undefined) {
    let dir = getParameterByName('dir');
    let id = getParameterByName('id');

    var form_data = new FormData();
    for (i = 0; i < files_obj.length; i++) {
      form_data.append('file[]', files_obj[i]);
    }
    var xhttp = new XMLHttpRequest();

    xhttp.open('POST', '../extras/upload.php?id=' + id + '&dir=' + dir, true);

    xhttp.onload = function (event) {
      if (xhttp.status == 200) {
        alert(this.responseText);
      } else {
        alert(
          'Error ' + xhttp.status + ' occurred when trying to upload your file.'
        );
      }
    };

    xhttp.send(form_data);
  }
}
