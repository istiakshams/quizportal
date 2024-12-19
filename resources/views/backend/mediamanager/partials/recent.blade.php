@forelse ($recentFiles as $key => $mediaFile)
<div class="media-item" data-active-file-id="{{ $mediaFile->id }}" onclick="handleSelectedFiles({{ $mediaFile->id }})">
    <div class="media-img">
        @if ($mediaFile->media_type == 'image')
        <img src="{{ uploadedAsset($mediaFile->id) }}" class="img-fluid" />
        @endif
    </div>
    <div class="qp-media-info-wrap p-2">
        <div class="qp-media-info">
            <p class="fs-base mb-0 text-truncate">{{ $mediaFile->media_name }}</p>
            <span class="text-muted fs-sm text-truncate">{{ $mediaFile->media_extension }}</span>
        </div>

    </div>
    <div class="qp-media-action-wrap d-flex align-items-center justify-content-center">
        <a class="qp-remove btn btn-sm px-2 btn-danger media-delete-btn" data-toggle="tooltip" data-placement="top"
            data-title="Remove this file" data-href="{{ route('uppy.delete', $mediaFile->id) }}"
            onclick="confirmDelete(this)"><i class="fa fa-trash" aria-hidden="true"></i></a>
    </div>
</div>
@empty
<div class="text-center text-danger p-5">No data found</div>
@endforelse