<div class="modal fade" wire:ignore.self id="searchModal" tabindex="-1" role="dialog" aria-labelledby="searchModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ModalProduct">Form Product</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" onclick='cLoseSearcProduct()'>
                </button>
            </div>
            <div class="modal-body">
                <table id="rowDataproduct" class="table">
                    <thead>
                        <tr>
                            <th scope="col" class="col-1">Barcode</th>
                            <th>Item Name</th>
                        </tr>
                    </thead>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light"  data-bs-dismiss="modal" aria-label="Close" onclick='cLoseSearcProduct()'>Close</button>
           </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
