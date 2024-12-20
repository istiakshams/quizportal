@foreach ($mediaFiles as $mediaFile)
<div class="qp-image-preview selected-file">
    <div class="preview-image">
        <img class="img-fluid" src="{{ uploadedAsset($mediaFile->id) }}" alt="">
    </div>
    <span class="media-remove-btn" onclick="removeSelectedFile(this, {{ $mediaFile->id }})"><i
            class="far fa-trash-alt"></i></span>
</div>
@endforeach

<script>
    document.querySelector('.media-remove-btn').addEventListener('click', function(e) { e.stopPropagation(); });
</script>