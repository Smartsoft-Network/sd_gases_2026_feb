<div class="modal fade" id="iconPickerModal" tabindex="-1" role="dialog" aria-labelledby="iconPickerModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content" style="border-radius: 12px;">
            <div class="modal-header" style="border-bottom: none; padding: 1.5rem 2rem;">
                <h5 class="modal-title" id="iconPickerModalLabel" style="font-weight: 600; font-size: 1.25rem;">Select Icon</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="font-size: 1.5rem;">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" style="padding: 0 2rem 2rem;">
                <input type="text" id="icon-search" class="form-control mb-4" placeholder="Search icons..." style="border-radius: 8px; padding: 1rem; font-size: 1rem;">
                <div id="icon-grid" class="row text-center" style="max-height: 400px; overflow-y: auto;">
                    {{-- Icons will be loaded here by JavaScript --}}
                </div>
            </div>
        </div>
    </div>
</div>
