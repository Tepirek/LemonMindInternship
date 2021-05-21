(() => {
    const form = document.querySelector('form');
    const submit = document.querySelector('button[type="submit"]');
    const file = document.querySelector('.box__files');
    const dragndrop = document.querySelector('.uploadBox');
    const label = document.querySelector('.uploadBox label');
    var fileId = 0;

    ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
        dragndrop.addEventListener(eventName, e => {
            e.stopPropagation();
            e.preventDefault();
        }, false)
      })

    dragndrop.addEventListener('dragenter', e => {
        dragndrop.style.border = '1px dashed blue';
        label.innerHTML = 'Upuść plik';
    })

    dragndrop.addEventListener('dragleave', e => {
        dragndrop.style.border = '1px solid gray';
        label.innerHTML = '<strong><u>Wybierz</u> </strong>lub przeciągnij tutaj</span>.';
    })

    dragndrop.addEventListener('dragover', e => {
    })

    dragndrop.addEventListener('drop', e => {
        var f = e.dataTransfer.files;
        if(!checkFiles(f)) {
            dragndrop.style.border = '1px solid red';
            label.innerHTML = 'Pliki zawierają niedozwolone rozszerzenia!';
        } else {
            Array.from(f).forEach(file => {
                files.push({
                    'id': fileId,
                    'file': file
                });
                fileId += 1;
            })
            showFiles(files);
        }
        dragndrop.style.border = '1px solid gray';
        label.innerHTML = '<strong><u>Wybierz</u> </strong>lub przeciągnij tutaj</span>.';
    })

    const getFileType = (file) => {
        if(file.type === 'application/pdf') return 'icon-file-pdf';
        if(file.type === 'application/vnd.openxmlformats-officedocument.wordprocessingml.document' || file.type === 'application/msword') return 'icon-doc';
        if(file.type === 'image/png' || file.type === 'image/jpeg') return 'icon-file-image';
        return 'none';
    }

    const checkFiles = (files) => {
        //  jpg, png, doc, docx, pdf
        const valid = [
            'application/pdf',
            'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
            'application/msword',
            'image/png',
            'image/jpeg'
        ];
        for(var i = 0; i < files.length; i++) {
            if(!valid.includes(files[i].type)) {
                return false;
            }
        }
        return true;
    }

    const showFiles = (f) => {
        const uploadedFiles = document.querySelector('.uploadedFiles');
        uploadedFiles.innerHTML = "";
        Array.from(f).forEach(file => {
            var entry = document.createElement('div');
            entry.id = `file_${file.id}`;
            entry.classList.add('fileItem', 'col-md-4', 'col-6');
            entry.innerHTML = `
                <i class="${getFileType(file.file)}"></i>
                <div class="fileItemName">${file.file.name}</div>
                <i class="icon-trash" id="delete_file_${file.id}"></i>
            `;
            uploadedFiles.appendChild(entry);
            var deleteBtn = getElement(`#delete_file_${file.id}`);
            var i = file.id;
            deleteBtn.addEventListener('click', () => {
                var entry = getElement(`#file_${i}`);
                entry.parentElement.removeChild(entry);
                files = files.filter(f => f.id != i);
                console.log(files);
            });
        })
    }

    const sendRequest = async (method, url, formData) => {
        var result = await new Promise((resolve, reject) => {
            var request = new XMLHttpRequest();
            request.onload = function() {
                if (this.readyState == 4 && this.status == 200) {
                    resolve(request.response);
                } else {
                    reject({
                        status: this.status,
                        statusText: request.statusText
                    });
                }
            }
            request.onerror = function() {
                reject({
                    status: this.status,
                    statusText: request.statusText
                });
            }
            request.open(method, url, true);
            request.send(formData);
        });
        return result;
    }

    file.addEventListener('change', () => {
        var f = file.files;
        if(!checkFiles(f)) {
            dragndrop.style.border = '1px solid red';
            label.innerHTML = 'Pliki zawierają niedozwolone rozszerzenia!';
        } else {
            Array.from(f).forEach(file => {
                files.push({
                    'id': fileId,
                    'file': file
                });
                fileId += 1;
            })
            showFiles(files);
        }
    })

    form.addEventListener("submit", e => {
        submit.innerHTML = '<i class="icon-spin3 animate-spin"></i>';
        submit.setAttribute('disabled', true);
        e.preventDefault();
        e.stopPropagation();
        if(!validate()) {
            submit.innerHTML = 'Wyślij';
            submit.removeAttribute('disabled');
            return;
        };
        var formData = new FormData();
        formData.append('source', getValue('source'));
        formData.append('destination', getValue('destination'));
        formData.append('type', getValue('airplaneType'));
        formData.append('date', getValue('date'));
        formData.append('cargos', JSON.stringify(cargos));
        Array.from(files).forEach(file => {
            formData.append('files[]', file.file);
        });
        sendRequest('POST', '/api/transport', formData).then((result) => {
            submit.innerHTML = 'Wysłano';
            submit.classList.remove('btn-primary');
            submit.classList.add('btn-success');
            console.log(result);
        }).catch((result) => {
            console.log(result);
        });
    });
})();