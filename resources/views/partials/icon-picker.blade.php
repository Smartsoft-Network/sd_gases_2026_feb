@push('scripts')
<script>
    const socialIcons = {
        'facebook': 'fab fa-facebook',
        'instagram': 'fab fa-instagram',
        'youtube': 'fab fa-youtube',
        'twitter': 'fab fa-twitter',
        'linkedin': 'fab fa-linkedin',
        'whatsapp': 'fab fa-whatsapp',
    };

    function openIconPicker(input) {
        const iconGrid = document.getElementById('icon-grid');
        iconGrid.innerHTML = '';
        for (const [name, classes] of Object.entries(socialIcons)) {
            const iconWrapper = document.createElement('div');
            iconWrapper.className = 'col-md-3 col-sm-4 col-6 mb-4';
            iconWrapper.innerHTML = `
                <div class="icon-preview p-3 border rounded text-center h-100 d-flex flex-column justify-content-center align-items-center" data-icon="${name}" style="cursor: pointer; transition: all 0.2s ease-in-out; background-color: #fff; width: 169px;">
                    <i class="${classes}" style="font-size: 40px; color: #495057;"></i>
                    <div class="mt-2 text-muted" style="font-size: 14px; font-weight: 500;">${name}</div>
                </div>
            `;
            iconGrid.appendChild(iconWrapper);
        }

        $('#iconPickerModal').modal('show');

        $('.icon-preview').on('click', function() {
            const iconName = $(this).data('icon');
            $(input).val(iconName);
            $('#iconPickerModal').modal('hide');
        });

        $('#icon-search').on('keyup', function() {
            const searchTerm = $(this).val().toLowerCase();
            $('.icon-preview').each(function() {
                const iconName = $(this).data('icon').toLowerCase();
                if (iconName.includes(searchTerm)) {
                    $(this).parent().show();
                } else {
                    $(this).parent().hide();
                }
            });
        });
    }
</script>
@endpush
