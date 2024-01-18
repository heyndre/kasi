<div class="" x-init="
FilePond.registerPlugin(FilePondPluginImagePreview);
FilePond.registerPlugin(FilePondPluginImageResize);
FilePond.setOptions({
    allowMultiple: {{isset($attributes['multiple']) ? 'true' : 'false'}},
    maxParallelUploads: 1,
    itemInsertLocation: 'after',
    server: {
        process: (fieldName, file, metadata, load, error, progress, abort, transfer, options) => {
            @this.upload('{{$attributes['wire:model']}}', file, load, error, progress);
        },
        revert: (filename, load) => {
            @this.removeUpload('{{$attributes['wire:model']}}', filename, load);
        }
    },

});

FilePond.create($refs.{{$attributes['wire:model']}});
" wire:ignore>
    <input type="file" wire:model='{{$attributes['wire:model']}}' x-ref='{{$attributes['wire:model']}}'>
</div>