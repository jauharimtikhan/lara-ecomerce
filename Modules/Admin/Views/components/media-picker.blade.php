@props(['id', 'name', 'buttonTitle' => 'Pilih media'])

<div class="media-picker-wrapper" data-id="{{ $id }}">
    <!-- Input hidden untuk menyimpan ID media yang dipilih -->
    <input type="hidden" id="input-{{ $id }}" name="{{ $name }}" value="[]" data-view="[]">

    <!-- Tombol untuk membuka modal -->
    <button type="button" class="btn btn-primary btn-sm rounded-10 media-picker-btn-{{ $id }}"
        data-id="{{ $id }}">
        {{ $buttonTitle }}
    </button>

    <!-- Preview Media -->
    <div id="preview-{{ $id }}" class="media-preview mt-3">
        <p class="text-muted">Tidak ada media yang dipilih</p>
    </div>

    <!-- Modal Pilih Media -->
    <div class="modal fade media-picker-modal" id="modal-{{ $id }}" tabindex="-1" data-backdrop="static"
        aria-labelledby="modal-label-{{ $id }}" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content rounded-10">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal-label-{{ $id }}">Pilih Media</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <ul class="nav nav-tabs nav-justified" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="tab-select-{{ $id }}" data-toggle="tab"
                                href="#tab-pane-select-{{ $id }}" role="tab"
                                aria-selected="true">Pilih</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="tab-upload-{{ $id }}" data-toggle="tab"
                                href="#tab-pane-upload-{{ $id }}" role="tab"
                                aria-selected="false">Upload</a>
                        </li>
                    </ul>
                    <div class="tab-content bd bg-white bd-t-0 pd-20">
                        <div class="tab-pane fade show active" id="tab-pane-select-{{ $id }}"
                            role="tabpanel">
                            <div class="row g-3 media-list" data-id="{{ $id }}"></div>
                            <div class="mt-3 text-center pagination-controls" data-id="{{ $id }}"></div>
                        </div>
                        <div class="tab-pane fade" id="tab-pane-upload-{{ $id }}" role="tabpanel">
                            <div id="drag-drop-area-{{ $id }}"
                                class="drag-drop-area text-center p-4 border rounded-10 cursor-pointer">
                                <p class="text-muted">Drag & drop file di sini atau klik untuk mengunggah</p>
                                <input type="file" name="upload-media[]" id="upload-input-{{ $id }}"
                                    multiple class="d-none">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary rounded-10" data-dismiss="modal">Tutup</button>
                    <button type="button" class="btn btn-primary rounded-10 confirm-selection"
                        data-id="{{ $id }}">
                        Pilih Media
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

@push('js')
    <script>
        $(document).ready(function() {

            const buttonShowModal = document.querySelector('.media-picker-btn-{{ $id }}');
            const uniqueIdShowModal = makeUniqueSelector(buttonShowModal);
            attachUniqueEvent(uniqueIdShowModal, 'click', (e) => {
                const pickerId = e.target.dataset.id

                $(`#modal-${pickerId}`).modal('show');
                loadMedia(pickerId);
            });

            function loadMedia(pickerId, page = 1) {
                const mediaList = $(`#modal-${pickerId} .media-list`);
                const paginationControls = $(`#modal-${pickerId} .pagination-controls`);

                $.ajax({
                    url: $.route('media.data.list'),
                    method: 'GET',
                    data: {
                        page
                    },
                    beforeSend: function() {
                        const loaderContainer = document.createElement('div');

                        const loader = document.createElement('span');
                        const iconLoader = document.createElement('i');
                        iconLoader.classList.add('fas', 'fa-spinner', 'fa-spin');
                        loader.appendChild(iconLoader);
                        loader.textContent = 'Loading...';
                        loaderContainer.appendChild(loader);
                        mediaList.html(loaderContainer);
                    },
                    success: function(data) {
                        mediaList.empty();
                        data.data.forEach((media) => {
                            const mediaHtml = `
                            <div class="col-md-3 text-center">
                                <label for="${pickerId}-media-${media.id}">
                                    <img src="${media.url}" alt="${media.title}" class="img-thumbnail media-item rounded-10"
                                         data-id="${media.id}" data-path="${media.url}" style="cursor: pointer;" />
                                </label>
                                <div class="d-flex align-items-center justify-content-center" style="gap:3px;">
                                    <input type="checkbox" id="${pickerId}-media-${media.id}" class="media-select mb-0"
                                           data-id="${media.id}" data-path="${media.url}" />
                                    <label for="${pickerId}-media-${media.id}" class="text-truncate" style="max-width: 100px;">${media.title}</label>
                                </div>
                            </div>`;
                            mediaList.append(mediaHtml);
                        });

                        // Render pagination
                        paginationControls.html(data.links.map((link) => `
                        <button ${link.active ? 'disabled' : ''} class="btn rounded-10 btn-sm btn-${link.active ? 'primary' : 'secondary'} mx-1" 
                                data-page="${link.label}">
                            ${link.label}
                        </button>
                    `).join(''));
                    },
                    error: function(err) {
                        console.error(err);
                    }
                });
            }
            $(document).on('click', '.pagination-controls button', function(e) {
                e.preventDefault();
                const pickerId = $(this).closest('.pagination-controls').data('id');
                const page = $(this).data('page');
                loadMedia(pickerId, page);
            });

            $(document).on('click', '.confirm-selection', function(e) {
                e.preventDefault()
                const pickerId = $(this).data('id');
                const selectedMedia = [];
                const previewContainer = $(`#preview-${pickerId}`);
                previewContainer.empty();

                $(`#modal-${pickerId} .media-select:checked`).each(function() {
                    const mediaPath = $(this).data('path');
                    selectedMedia.push($(this).data('id'));
                    previewContainer.append(
                        `<img src="${mediaPath}" alt="Preview" class="img-thumbnail" width="150">`
                    );
                });

                if (selectedMedia.length === 0) {
                    previewContainer.html('<p class="text-muted">Tidak ada media yang dipilih</p>');
                }

                $(`#input-${pickerId}`).val(JSON.stringify(selectedMedia));
                $(`#modal-${pickerId}`).modal('hide');
            });


            let buttonDragDrop = document.querySelector('#drag-drop-area-{{ $id }}');
            let uniqueIdDragDrop = makeUniqueSelector(buttonDragDrop);
            let uniqueIdUploadInput = getUniqueElement(uniqueIdDragDrop);
            uniqueIdUploadInput.addEventListener('dragover', (e) => {
                e.preventDefault();
                e.dataTransfer.dropEffect = 'copy';
                e.target.style.backgroundColor = 'rgba(0, 0, 0, 0.2)';
            });
            uniqueIdUploadInput.addEventListener('dragleave', (e) => {
                e.preventDefault();
                e.target.style.backgroundColor = 'rgba(0, 0, 0, 0)';
            });
            uniqueIdUploadInput.addEventListener('drop', (e) => {
                e.preventDefault();
                e.target.style.backgroundColor = 'rgba(0, 0, 0, 0)';
                let inputFiles = document.querySelector('#upload-input-{{ $id }}');
                let uniqueIdInputFiles = makeUniqueSelector(inputFiles);
                let getUniqueInputFiles = getUniqueElement(uniqueIdInputFiles);
                const files = e.dataTransfer.files;
                if (files.length > 0) {
                    Array.from(files).forEach(file => {

                        const reader = new FileReader();

                        // Event saat file selesai dibaca
                        reader.onload = function(event) {
                            const base64Data = event.target.result;
                            // Membuat elemen preview untuk gambar
                            const parentDivPreview = document.createElement('div');
                            parentDivPreview.style.position = 'relative';
                            parentDivPreview.style.display = 'inline-block';
                            parentDivPreview.style.padding = '1.2rem';

                            const img = new Image();
                            img.src = base64Data;
                            img.style.width = '150px';
                            img.style.height = 'auto';
                            img.classList.add('img-fluid');

                            const buttonRemove = document.createElement('button');
                            buttonRemove.type = 'button';
                            buttonRemove.style.position = 'absolute';
                            buttonRemove.style.top = '0';
                            buttonRemove.style.right = '0';
                            buttonRemove.style.backgroundColor = '#f44336';
                            buttonRemove.style.color = '#fff';
                            buttonRemove.classList.add('btn', 'btn-danger',
                                'btn-sm', 'rounded-10');
                            buttonRemove.innerHTML = '<i class="fas fa-times"></i>';

                            // Event untuk menghapus gambar dan mengatur ulang input
                            buttonRemove.addEventListener('click', function() {
                                parentDivPreview.remove();

                                let newInput = getUniqueInputFiles.cloneNode(true);
                                getUniqueInputFiles.parentNode.replaceChild(newInput,
                                    getUniqueInputFiles
                                );
                                newInput.addEventListener('change', getUniqueInputFiles
                                    .onchange
                                );
                                getUniqueInputFiles = newInput;
                            });

                            parentDivPreview.appendChild(img);
                            parentDivPreview.appendChild(buttonRemove);

                            const previewContainer = getUniqueElement(
                                uniqueIdDragDrop);
                            previewContainer.appendChild(parentDivPreview);
                            const pickerId = e.target.id.replace('drag-drop-area-', '');
                            handleFileUpload(files, pickerId);
                        };

                        // Event jika terjadi kesalahan saat membaca file
                        reader.onerror = function(error) {
                            console.error('Error reading file:', error);
                        };

                        // Membaca file sebagai URL Data (Base64)
                        reader.readAsDataURL(file);
                    })
                }

            });


            attachUniqueEvent(uniqueIdDragDrop, 'click', (e) => {
                const pickerId = e.target.id.replace('drag-drop-area-', '');
                // console.log(pickerId);

                let input = document.querySelector('#upload-input-' + pickerId);
                if (input) {
                    input.click();
                    input.onchange = function() {
                        const files = input.files;
                        if (files.length > 0) {
                            // Iterasi melalui semua file (jika input menerima beberapa file)
                            Array.from(files).forEach(file => {
                                const reader = new FileReader();
                                // Event saat file selesai dibaca
                                reader.onload = function(event) {
                                    const base64Data = event.target.result;

                                    // Membuat elemen preview untuk gambar
                                    const parentDivPreview = document.createElement('div');
                                    parentDivPreview.style.position = 'relative';
                                    parentDivPreview.style.display = 'inline-block';
                                    parentDivPreview.style.padding = '1.2rem';

                                    const img = new Image();
                                    img.src = base64Data;
                                    img.style.width = '150px';
                                    img.style.height = 'auto';
                                    img.classList.add('img-fluid');

                                    const buttonRemove = document.createElement('button');
                                    buttonRemove.type = 'button';
                                    buttonRemove.style.position = 'absolute';
                                    buttonRemove.style.top = '0';
                                    buttonRemove.style.right = '0';
                                    buttonRemove.style.backgroundColor = '#f44336';
                                    buttonRemove.style.color = '#fff';
                                    buttonRemove.classList.add('btn', 'btn-danger',
                                        'btn-sm', 'rounded-10');
                                    buttonRemove.innerHTML = '<i class="fas fa-times"></i>';

                                    buttonRemove.addEventListener('click', function() {
                                        parentDivPreview.remove();
                                        let newInput = input.cloneNode(true);
                                        input.parentNode.replaceChild(newInput,
                                            input
                                        );
                                        newInput.addEventListener('change', input
                                            .onchange
                                        );
                                        input = newInput;
                                    });

                                    parentDivPreview.appendChild(img);
                                    parentDivPreview.appendChild(buttonRemove);

                                    const previewContainer = getUniqueElement(
                                        uniqueIdDragDrop);
                                    previewContainer.appendChild(parentDivPreview);
                                };

                                // Event jika terjadi kesalahan saat membaca file
                                reader.onerror = function(error) {
                                    console.error('Error reading file:', error);
                                };

                                // Membaca file sebagai URL Data (Base64)
                                reader.readAsDataURL(file);
                            });
                        } else {
                            console.log('Tidak ada file yang dipilih.');
                        }
                    };
                }
            });

            $('a[href="#tab-pane-upload-{{ $id }}"]').on('shown.bs.tab', function(
                event) {
                let modalId = document.querySelector('#modal-{{ $id }}');
                let formUploadId = document.querySelector(
                    '#tab-pane-upload-{{ $id }}');

                let btn = document.createElement('button');
                btn.innerHTML = `<i class="fas fa-upload"></i> Upload Media`;
                btn.classList.add('btn', 'btn-success', 'rounded-10', 'btn-sm',
                    'btnSubmitMedia-{{ $id }}');
                btn.addEventListener('click', function(e) {
                    e.preventDefault();

                    handleFileUpload(formUploadId.querySelector(
                            'input#upload-input-{{ $id }}').files,
                        '{{ $id }}');
                })
                modalId.querySelector('.modal-footer').appendChild(btn);
            });

            $('a[href="#tab-pane-upload-{{ $id }}"]').on('hidden.bs.tab', function(event) {
                let modalId = document.querySelector('#modal-{{ $id }}');
                modalId.querySelector('button.btnSubmitMedia-{{ $id }}').remove();
            });


            function handleFileUpload(files, pickerId) {

                const formData = new FormData();
                $.each(files, function(index, file) {
                    formData.append('file[]', file);
                    formData.append('id', pickerId);

                })
                $.ajax({
                    url: $.route('media.data.upload'),
                    method: 'post',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    },
                    data: formData,
                    processData: false,
                    contentType: false,
                    beforeSend: function() {
                        let modalId = document.querySelector('#modal-{{ $id }}');
                        let buttonSubmit = modalId.querySelector(
                            'button.btnSubmitMedia-{{ $id }}');
                        buttonSubmit.disabled = true
                        buttonSubmit.innerHTML = `<i class="fas fa-spinner fa-spin"></i> Uploading...`
                    },
                    success: function(res) {
                        Toast({
                            icon: 'success',
                            title: res.message
                        });
                        loadMedia(pickerId);
                    },
                    complete: function() {
                        let modalId = document.querySelector('#modal-{{ $id }}');
                        let buttonSubmit = modalId.querySelector(
                            'button.btnSubmitMedia-{{ $id }}');
                        buttonSubmit.disabled = false
                        buttonSubmit.innerHTML = `<i class="fas fa-upload"></i> Upload Media`
                    },
                    error: function(err) {
                        if (err.status == 422) {
                            let parentNode = document.querySelector(
                                '#tab-pane-upload-{{ $id }}');

                            let spanError = document.createElement('span');
                            spanError.classList.add('text-danger');
                            spanError.classList.add('mt-1');
                            spanError.innerHTML = err.responseJSON.errors;
                            parentNode.appendChild(spanError);
                        } else {
                            Toast({
                                icon: 'error',
                                title: err.responseJSON.message,
                            })
                        }
                    }
                });
            }
        });
    </script>
@endpush
