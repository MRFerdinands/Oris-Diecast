<div wire:ignore x-data x-init="FilePond.registerPlugin(FilePondPluginFileValidateType, {{ $attributes['preview'] ? 'FilePondPluginImagePreview' : '' }});
FilePond.setOptions({
    acceptedFileTypes: ['image/*'],
    fileValidateTypeLabelExpectedTypes: 'Expects an image file',
    credits: false,
    maxFiles: {{ $attributes['multiple'] ? ($attributes['maxFiles'] ? $attributes['maxFiles'] : '4') : 'null' }},
    allowMultiple: {{ $attributes['multiple'] ? 'true' : 'false' }},
    server: {
        process: (fieldName, file, metadata, load, error, progress, abort, transfer, options) => {
            @this.upload('{{ $attributes['wire:model'] }}', file, load, error, progress);
        },
        revert: (filename, load) => {
            @this.removeUpload('{{ $attributes['wire:model'] }}', filename, load);
        }
    },
    {{-- labelIdle: 'Seret & Lepas file Anda atau <span class="filepond--label-action"> Telusuri </span>', --}}
    labelInvalidField: 'Bidang berisi file yang tidak valid',
    labelFileWaitingForSize: 'Menunggu ukuran',
    labelFileSizeNotAvailable: 'Ukuran tidak tersedia',
    labelFileLoading: 'Memuat',
    labelFileLoadError: 'Kesalahan saat memuat',
    labelFileProcessing: 'Mengunggah',
    labelFileProcessingComplete: 'Unggahan selesai',
    labelFileProcessingAborted: 'Unggahan dibatalkan',
    labelFileProcessingError: 'Kesalahan saat mengunggah',
    labelFileProcessingRevertError: 'Kesalahan saat mengembalikan',
    labelFileRemoveError: 'Kesalahan saat menghapus',
    labelTapToCancel: 'ketuk untuk membatalkan',
    labelTapToRetry: 'ketuk untuk mencoba lagi',
    labelTapToUndo: 'ketuk untuk membatalkan',
    labelButtonRemoveItem: 'Hapus',
    labelButtonAbortItemLoad: 'Batalkan',
    labelButtonRetryItemLoad: 'Coba Lagi',
    labelButtonAbortItemProcessing: 'Batal',
    labelButtonUndoItemProcessing: 'Urungkan',
    labelButtonRetryItemProcessing: 'Coba Lagi',
    labelButtonProcessItem: 'Unggah',
});
const pond = FilePond.create($refs.input);
$wire.on('alert', (data) => {
    pond.removeFiles();
});">
    <input class="p-0" x-ref="input" type="file" />
</div>
