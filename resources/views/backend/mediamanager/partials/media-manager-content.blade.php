<div class="row mb-4">
    {{-- recent uploads --}}
    <div class="col-12 col-lg-6">
        <div class="card card-default">
            <div class="card-header">
                <h3 class="card-title">Recent Uploads</h3>
            </div> <!-- /.card-header -->
            <div class="card-body">
                <div class="row g-2 recent-uploads qp-media-wrap">
                    {{-- data will come from ajax response --}}
                </div>
            </div>
        </div>
    </div>

    {{-- uploader --}}
    <div class="col-12 col-lg-6">
        <div class="card card-default">
            <div class="card-header">
                <h3 class="card-title">Upload New Media</h3>
            </div> <!-- /.card-header -->
            <div class="card-body">
                <!-- Form Content-->
                <div class="alert alert-success d-none mb-4" id="successMessage">Media uploaded successfully!</div>
                <form class="dropzone overflow-visible p-0" id="formDropzone" method="POST"
                    enctype="multipart/form-data" novalidate>
                    @csrf

                    <div class="form-group mb-4">
                        <div class="dropzone-drag-area form-control" id="previews">
                            <div class="dz-message text-muted opacity-50" data-dz-message>
                                <span>Drag file here to upload</span>
                            </div>
                            <div class="d-none" id="dzPreviewContainer">
                                <div class="dz-preview dz-file-preview">
                                    <div class="dz-photo">
                                        <img class="dz-thumbnail" data-dz-thumbnail>
                                    </div>
                                    <button class="dz-delete border-0 p-0" type="button" data-dz-remove>
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" id="times">
                                            <path fill="#FFFFFF"
                                                d="M13.41,12l4.3-4.29a1,1,0,1,0-1.42-1.42L12,10.59,7.71,6.29A1,1,0,0,0,6.29,7.71L10.59,12l-4.3,4.29a1,1,0,0,0,0,1.42,1,1,0,0,0,1.42,0L12,13.41l4.29,4.3a1,1,0,0,0,1.42,0,1,1,0,0,0,0-1.42Z">
                                            </path>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="invalid-feedback fw-bold">Please upload an image.</div>
                    </div>
                    <button class="btn btn-primary" id="formSubmit" type="submit">
                        <span class="spinner-border spinner-border-sm d-none me-2" aria-hidden="true"></span>
                        Upload
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="row mb-4">
    <div class="col-12">
        <div class="card card-default">
            <div class="card-header">
                <h3 class="card-title">All Uploads</h3>
            </div> <!-- /.card-header -->
            <div class="card-body">
                {{-- search --}}
                <div class="row">
                    <div class="col-12">
                        <form action="" id="media-search-from" class="media-search-from">
                            <div class="qp-search-box">
                                <div class="input-group">
                                    <input class="form-control rounded-start w-100" type="text" id="search"
                                        name="media-search" placeholder="Search by name">
                                </div>
                            </div>
                            <div class="qp-search-btn">
                                <button type="submit" class="btn btn-secondary">
                                    <i class="fas fa-search"></i>
                                    Search
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="previous-uploads qp-media-wrap">
                            {{-- data will come from ajax response --}}
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="mt-3 load-more-media d-none">
                            <button class="btn btn-primary" onclick="getNextMediaFiles()">
                                <span> <i data-feather="refresh-cw" class="me-2" width="18"></i>Load More</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>