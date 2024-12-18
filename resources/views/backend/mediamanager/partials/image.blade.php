@foreach ($mediaFiles as $mediaFile)
<div class="qp-image-preview selected-file">
    <div data-toggle="offcanvas" data-target="#offcanvasBottom" onclick="showMediaManager(this)" data-selection="single"
        class="preview-image">
        <img class="img-fluid" src="{{ uploadedAsset($mediaFile->id) }}" alt="">
    </div>
    <span class="media-remove-btn" onclick="removeSelectedFile(this, {{ $mediaFile->id }})"><i
            class="far fa-trash-alt"></i></span>
</div>
@endforeach