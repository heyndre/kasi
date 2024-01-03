<div wire:ignore x-data {{ $attributes }}>
    <script>
        // document.addEventListener('livewire:load', function (event) {
             window.livewire.hook('element.init', () => {         
             tinymce.init({
                 height: '50vh',
                      selector: 'textarea#{{$name}}',
                      plugins: [
                        'advlist', 'autolink', 'link', 'image', 'lists', 'charmap', 'preview', 'anchor', 'pagebreak', 
                        'searchreplace', 'wordcount', 'visualblocks', 'code', 'visualchars', 'fullscreen', 'insertdatetime',
                        'media', 'table', 'emoticons', 'template', 'help'
                    ], 
                    toolbar: 'undo redo | styles | bold italic | alignleft aligncenter alignright alignjustify | ' +
                    'bullist numlist outdent indent | link image | print preview media fullscreen | ' +
                    'forecolor backcolor emoticons | help',
                    menu: {
                        // view: { title: 'View', items: 'visualaid | preview | fullscreen' }
                    },
                    menubar: 'edit view insert format tools table help',
                    // content_css: 'css/content.css'
                    setup: function (editor) {
                        editor.on('init change', function () {
                            editor.save();
                        });
        
                        // This section says that when you leave the text edit area, it will set whatever livewire variable you like to the currnt contents
                        editor.on('blur', function (e) {
                            @this.set('{{$name}}', editor.getContent());
                        });
                    },
                }); 
            });
        // });
    </script>
    <textarea class="h-screen p-2" id="{{$name}}" name="{{$name}}"> </textarea>
</div>