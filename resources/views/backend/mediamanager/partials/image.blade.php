@foreach ($mediaFiles as $mediaFile)
<div class="qp-image-preview selected-file">
    <img class="img-fluid" src="{{ uploadedAsset($mediaFile->id) }}" alt="">
    <span class="qp-remove qp-icon-btn qp-red rounded-circle"
        onclick="removeSelectedFile(this, {{ $mediaFile->id }})"><i class="fa fa-trash" aria-hidden="true"></i></span>
</div>
@endforeach